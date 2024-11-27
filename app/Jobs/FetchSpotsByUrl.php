<?php

namespace App\Jobs;

use App\Repositories\SpotsRepository;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchSpotsByUrl implements ShouldQueue
{
    use Queueable;
	use Batchable;

    public function __construct(private readonly string $url) {}

    public function handle(): void
    {
		sleep(3);
	    SpotsRepository::fetchChankByUrl($this->url);
    }
}
