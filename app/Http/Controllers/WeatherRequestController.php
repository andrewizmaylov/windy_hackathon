<?php

namespace App\Http\Controllers;


use App\Repositories\SpotsRepository;
use App\Services\ChatGptService;
use App\Services\ForecastService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WeatherRequestController extends Controller
{
	public function index()
	{
		return Inertia::render('Weather/IndexPage', [
			'spots' => SpotsRepository::index()
		]);
	}

	/**
	 * @throws GuzzleException
	 */
	public static function show(Request $request): JsonResponse
	{
		$forecast = ForecastService::getData($request->spot);

		$weather_request = $forecast->getData()->response->forecast;
		$prompt = 'Ты мой друг, опытный метеоролог, дай мне совет на основании предоставленных данных в формате HTML с указанием специальных классов для основных параметров. Классы я стилизую позже. Спасибо друг. С тобой спокойно и безопасно!';

		try {
			return (new ChatGptService())->handleRequest(json_encode($weather_request), $prompt);
		} catch (\Exception $exception) {
			echo $exception->getMessage();
		}

		return response()->json([
			'success' => false,
		]);
	}
}
