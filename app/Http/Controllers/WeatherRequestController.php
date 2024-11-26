<?php

namespace App\Http\Controllers;


use App\Repositories\SpotsRepository;
use App\Services\ChatGptService;
use App\Services\ForecastService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class WeatherRequestController extends Controller
{
	public function index(): Response
	{
		$spots = Cache::remember('spots', 3600, function () {
			return SpotsRepository::index();
		});

		return Inertia::render('Weather/IndexPage', [
			'spots' => $spots
		]);
	}

	/**
	 * @throws GuzzleException
	 */
	public static function show(Request $request): JsonResponse
	{
		$forecast = ForecastService::getData($request['spot']);
		$data = json_encode($forecast['response']['forecast']);

		$command = "python3 " . base_path('resources/scripts/WeatherProcessorV02.py') . " " . escapeshellarg($data);
		$weather_summary = shell_exec($command . " 2>&1");  // Capture both stdout and stderr

		if ($weather_summary === null) {
			return response()->json(['error' => 'Error executing Python script'], 500);
		}

//		$prompt = $request['prompt'];
		$prompt = 'Ты мой лучший друг метеорологб объясни мне все кратко и простыми словами';
		try {
			return (new ChatGptService())->handleRequest(json_encode($weather_summary), $prompt);
		} catch (\Exception $exception) {
			echo $exception->getMessage();
		}

		return response()->json([
			'success' => false,
		]);
	}
}
