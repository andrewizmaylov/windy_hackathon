<?php

namespace App\Repositories;

use App\Traits\HasLogError;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class SpotsRepository
{
	use HasLogError;

	public static function index(): JsonResponse
	{
		$client = new Client();
		try {
			$response = $client->get(
				'https://api.windyapp.co/apiV9.php?method=getPublicSpots&timestamp=0&page=0',
				[
					'stream' => true,
					'headers' => [
						'Accept' => 'application/json',
						'Content-Type' => 'application/json',
					],
				]
			);

			$data = json_decode($response->getBody());

			return response()->json($data->response->spots);
		} catch (\Exception $e) {
			return self::logError($e);
		}
    }
}
