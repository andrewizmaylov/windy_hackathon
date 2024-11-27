<?php

namespace App\Repositories;

use App\Jobs\FetchSpotsByUrl;
use App\Traits\HasLogError;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SpotsRepository
{
	use HasLogError;

	public static function index(): array
	{
		$data = Cache::get('all_public_spots');

		if (!$data) {
			// запускаем джобы по обновлению кэша
			self::fetchAndCacheData();
			// возвращаем первую страничку
			$data = self::fetchChankByUrl('https://api.windyapp.co/apiV9.php?method=getPublicSpots&timestamp=0&page=0');
		}

		return $data;
    }

	public static function fetchChankByUrl(string $url): mixed
	{
		$client = new Client();
		try {
			$response = $client->get(
				$url,
				[
					'stream' => true,
					'headers' => [
						'Accept' => 'application/json',
						'Content-Type' => 'application/json',
					],
				]
			);

			$data = json_decode($response->getBody());

			$previous = Cache::get('all_public_spots') ?? [];

			Cache::forget('all_public_spots');
			Cache::put('all_public_spots', array_merge($previous, $data->response->spots), now()->addHours(12));

			return $data->response->spots;
		} catch (\Exception $e) {
			return self::logError($e);
		}
	}

	public static function fetchAndCacheData(): void
	{
		$totalPages = 51;

		$jobs = [];

		for ($page = 0; $page <= $totalPages; $page++) {
			$url = 'https://api.windyapp.co/apiV9.php?method=getPublicSpots&timestamp=0&page=' . $page;
			$jobs[] = (new FetchSpotsByUrl($url))->delay(now()->addSeconds(10));
		}

		Bus::batch($jobs)
			->then(function ($batch) {
				Log::info('Batch completed successfully.');
			})
			->catch(function ($batchException) {
				Log::error('Batch failed: ' . $batchException->getMessage());
			})->dispatch();
	}
}
