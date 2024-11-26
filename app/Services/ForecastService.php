<?php

namespace App\Services;

use App\Models\Prompt;
use App\Traits\HasLogError;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;


class ForecastService
{
	use HasLogError;

	public static function getData(array $coordinates): false|JsonResponse|string
	{
		$url = self::getUrlFromSpot($coordinates);
		$client = new Client();

		try {
			$response = $client->get(
				$url,
				[
					'headers' => [
						'Accept' => 'application/json',
						'Content-Type' => 'application/json',
					],
				]
			);

			$forecast = json_decode($response->getBody(), true);

			return self::proceedDataWithPython($forecast);
		} catch (\Exception $e) {
			return self::logError($e);
		}
	}

	private static function getUrlFromSpot(array $coordinates): string
	{
		$url = 'https://api.windyapp.co/apiV9.php';

		$from_ts = strtotime('today 8am');
		$to_ts = strtotime('+48 hours', $from_ts);

		$models = ['ecmwf','gfs27'];

		$query_params = [
			'from_ts' => $from_ts,
			'to_ts' => $to_ts,
			'lat' => $coordinates['lat'],
			'lon' => $coordinates['lon'],
			'method' => 'forecastConstructor',
			'models' => implode(',', $models),
			'period' => 1,
			'spot_id' => 282903,
			'swellModels' => 'mfwam',
		];

		$query_string = http_build_query($query_params);
		$query_string = str_replace('%2C', ',', $query_string);

		return $url . '?' . $query_string;
	}

	private static function proceedDataWithPython(array $forecast): false|JsonResponse|string
	{
		$data = json_encode($forecast['response']['forecast']);

		$command = "python3 " . base_path('resources/scripts/WeatherProcessorV02.py') . " " . escapeshellarg($data);
		$weather_summary = shell_exec($command . " 2>&1");  // Capture both stdout and stderr

		if ($weather_summary === null) {
			return response()->json(['error' => 'Error executing Python script'], 500);
		}

		return $weather_summary;
	}

	/**
	 * @throws GuzzleException
	 */
	public static function getAiForecast(string $weather_summary, Prompt $prompted = null)
	{
		$prompt = $prompted ?: Prompt::first()->text;

		try {
			return (new ChatGptService())->handleRequest($weather_summary, $prompt);
		} catch (\Exception $exception) {
			echo $exception->getMessage();
		}

		return response()->json([
			'success' => false,
		]);
	}
}
