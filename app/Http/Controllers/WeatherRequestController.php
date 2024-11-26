<?php

namespace App\Http\Controllers;


use App\Models\Prompt;
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
		$coordinates = [
			'lat' => $request['spot']['lat'],
			'lon' => $request['spot']['lon'],
		];

		// Получаем данные по координатам
		$forecast = ForecastService::getData($coordinates);

		return ForecastService::getAiForecast($forecast);
	}
}
