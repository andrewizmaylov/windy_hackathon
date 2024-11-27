<?php

namespace App\Repositories;

use App\Jobs\RefetchSpots;
use App\Traits\HasLogError;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SpotsRepository
{
	use HasLogError;

	public static function index(): JsonResponse
	{
		$data = Cache::get('all_public_spots');
		if (!$data) {
			RefetchSpots::dispatch();
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

		return $data;
    }

	public static function fetchAndCacheData(): JsonResponse
	{
		// Base API URL
		$baseUrl = 'https://api.windyapp.co/apiV9.php';
		$method = 'getPublicSpots';
		$timestamp = 0; // Replace with the correct timestamp if needed

		// Total number of pages
		$totalPages = 52;
		$allData = [];

		// Loop through all pages
		for ($page = 1; $page <= $totalPages; $page++) {
			// Make the API request for the current page
			$response = Http::get($baseUrl, [
				'method' => $method,
				'timestamp' => $timestamp,
				'page' => $page,
			]);

			// Check if the request was successful
			if ($response->successful()) {
				// Merge the current page data into the allData array
				$allData = array_merge($allData, $response->json());
			} else {
				// Log error or handle failure for the current page
				Log::error("Failed to fetch data for page $page", [
					'status' => $response->status(),
					'url' => $response->url(),
				]);
			}
		}

		Cache::delete('all_public_spots');
		Cache::put('all_public_spots', $allData, now()->addHours(12));

		RefetchSpots::dispatch()->delay(now()->addHours(12));

		return response()->json(['message' => 'Data cached successfully!']);
	}
}
