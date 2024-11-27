<?php

namespace App\Jobs;

use App\Repositories\SpotsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class RefetchSpots implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
	    // Make the API request for the current page
	    $response = Http::get($baseUrl);
    }
}
