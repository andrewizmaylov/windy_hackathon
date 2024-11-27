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
	/**
	 * @throws GuzzleException
	 */
	public function index(Request $request): Response
	{
		$spots = Cache::remember('spots', 3600, function () {
			return SpotsRepository::index();
		});

		$request_data = ApiController::getDataFromRequest();

		$forecast = ApiController::forecastSimple();

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
		return ForecastService::getAiForecast($request['forecast'], ApiController::getCurrentPromptsFromQuery());
	}
}
