<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
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
		$data = self::getDataFromRequest();
		$prompt = $data['prompt'] ? Prompt::find($data['prompt'])?->text : null;

		$forecast = self::forecastByCoordinatesSimple();

		$data = ForecastService::getAiForecast($forecast, $prompt);
		$first_result = json_decode($data->content())->choices[0];

		echo $first_result->message->content;
	}

	private static function getDataFromRequest()
	{
		return $_GET ?? json_decode(file_get_contents('php://input'), true);
	}


	public function getPrompts()
	{
		return json_decode(Prompt::all());
	}
}
