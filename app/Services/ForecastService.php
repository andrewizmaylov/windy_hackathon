<?php

namespace App\Services;

use App\Traits\HasLogError;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;


class ForecastService
{
	use HasLogError;

	public static function getData(array $spot): JsonResponse
	{
		$url = self::getUrlFromSpot($spot);
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

			$data = json_decode($response->getBody(), true);
			return response()->json($data);
		} catch (\Exception $e) {
			return self::logError($e);
		}
	}

	private static function getUrlFromSpot(array $spot): string
	{
		$url = 'https://api.windyapp.co/apiV9.php';

		$from_ts = time();
		$to_ts = strtotime('+48 hours', $from_ts);

		$models = ['ecmwf','gfs27'];

		$query_params = [
			'from_ts' => $from_ts,
			'to_ts' => $to_ts,
			'lat' => $spot['lat'],
			'lon' => $spot['lon'],
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
}
