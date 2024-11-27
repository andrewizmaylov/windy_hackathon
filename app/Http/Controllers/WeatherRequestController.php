<?php

namespace App\Http\Controllers;


use App\Repositories\SpotsRepository;
use App\Services\ForecastService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class WeatherRequestController extends Controller
{
	/**
	 * @throws GuzzleException
	 */
	public function index(Request $request): Response
	{
		$spots = Cache::remember('spots', 3600, function () {
			return SpotsRepository::index();
		});

		$request_data = ApiController::getDataFromRequest();

		$forecast = Cache::remember('forecasts:' . $request_data['lat'] . ':' . $request_data['lon'], 60*60*3, function () {
			return ApiController::forecastSimple();
		});

		return Inertia::render('Weather/IndexPage', [
			'spots' => $spots,
			'simple' => $forecast,
			'request_data' => $request_data
		]);
	}

	/**
	 * @throws GuzzleException
	 */
	public function fetchForecast(Request $request): JsonResponse
	{
		$forecast = $request['forecast'];
		$request_data = $request['request_data'];

		return Cache::remember('processed_data:' . $request_data['lat'] . ':' . $request_data['lon'], 60*60*3, function () use ($forecast) {
			return ForecastService::getAiForecast($forecast, ApiController::getCurrentPromptsFromQuery());
		});
	}
}
