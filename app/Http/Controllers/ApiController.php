<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use App\Services\ForecastService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ApiController extends Controller
{
	public static function forecastSimple(): false|\Illuminate\Http\JsonResponse|string
	{
		return ForecastService::getData(self::getDataFromRequest());
    }

	/**
	 * @throws GuzzleException
	 */
	public static function forecastByCoordinatesAi(): void
	{
		$prompt = self::getCurrentPromptsFromQuery();

		$forecast = self::forecastSimple();

		$data = ForecastService::getAiForecast($forecast, $prompt);
		$first_result = json_decode($data->content())->choices[0];

		echo $first_result->message->content;
	}

	public static function getDataFromRequest(): array
	{
		$data = $_GET ?? json_decode(file_get_contents('php://input'), true);
		
		return [
			'lat' => $data['lat'] ?? config('services.geo.default.lat'),
			'lon' => $data['lon'] ?? config('services.geo.default.lon'),
			'prompt' => $data['prompt'] ?? null,
		];
	}

	public static function getPrompts()
	{
		return json_decode(Prompt::all());
	}

	public static function getCurrentPromptsFromQuery(): string
	{
		$data = self::getDataFromRequest();
		$prompts = $data['prompt'] ?? null;

		$string = '';

		if (empty($prompts)) {
			return Prompt::default();
		}

		$prompts_id = explode(',', $prompts);
		$data = Prompt::whereIn('id', $prompts_id)
			->where('user_id', auth()->id())->get();

		if ($data->isEmpty()) {
			return Prompt::default();
		}

		foreach ($data as $item) {
			$string .= $item->text . '. ';
		}

		return $string;
	}
}
