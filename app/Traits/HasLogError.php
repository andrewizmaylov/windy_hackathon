<?php

namespace App\Traits;

use App\Enums\StatusEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait HasLogError
{
	public static function logError(\Exception $e): JsonResponse
	{
		print_r([$e->getCode(), $e->getMessage()]);

		Log::error('An error occurred: '.$e->getMessage(), [
			'exception' => $e,
			'stack_trace' => $e->getTraceAsString(),
			'timestamp' => now(),
			'user_id' => auth()->id(),
		]);

		return response()->json([
			'success' => StatusEnum::Error,
			'message' => $e->getMessage(),
		]);
	}
}