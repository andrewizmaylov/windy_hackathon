<?php

namespace App\Http\Controllers;

use App\Services\ForecastService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ApiController extends Controller
{
	public function forecastByCoordinatesSimple(): false|\Illuminate\Http\JsonResponse|string
	{
		$data = self::getDataFromRequest();

		$coordinates = [
			'lat' => $data['lat'],
			'lon' => $data['lon'],
		];

		return ForecastService::getData($coordinates);
    }

	/**
	 * @throws GuzzleException
	 */
	public function forecastByCoordinatesAi(): void
	{
		$forecast = self::forecastByCoordinatesSimple();
		$data = ForecastService::getAiForecast($forecast);
		$first_result = json_decode($data->content())->choices[0];

		echo $first_result->message->content;
	}

	private static function getDataFromRequest()
	{
		$content = file_get_contents('php://input');

		return json_decode($content, true);
	}
}
