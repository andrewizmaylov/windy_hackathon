<?php

namespace App\Services;

use App\Traits\HasLogError;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class ChatGptService
{
	use HasLogError;

	private ?string $api_key;

	public function __construct()
	{
		$this->api_key = config('services.chat_gpt.api_key');
	}

	/**
	 * @throws GuzzleException
	 */
	public function handleRequest(string $forecast, string $prompt): JsonResponse
	{
		if (!$this->api_key) {
			throw new \Exception('API key not set');
		}

		$client = new Client();
		$api_url = 'https://api.openai.com/v1/chat/completions';

		try {
			$response = $client->post($api_url, [
				'json' => [
					'model' => 'gpt-4o-mini',
					'messages' => [
						['role' => 'system', 'content' => $prompt],
						['role' => 'user', 'content' => 'Json with weather model data for 48 hours: ' . $forecast]
					],
					'temperature' => 0.7
				],
				'headers' => [
					'Authorization' => 'Bearer ' . $this->api_key,
					'Content-Type' => 'application/json'
				]
			]);

			// Get the body of the response
			$responseBody = $response->getBody();

			// Decode the JSON response
			$data = json_decode($responseBody, true);

			$data = json_decode($response->getBody(), true);

			return response()->json($data);
		} catch (\Exception $e) {
			return self::logError($e);
		}
	}
}