<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use App\Services\CrawlService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $index;
    public $googleSheet;
    public $megaPrice;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($index, $queueName, $googleSheet, $megaPrice)
    {
        $this->index = $index;
        $this->queue = $queueName;
        $this->googleSheet = $googleSheet;
        $this->megaPrice = $megaPrice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::debug('MSP : ');
            $CrawlService = new CrawlService();
            $CrawlService->crawlData($this->googleSheet, $this->megaPrice);
        } catch (Exception $e) {
            echo $e;
        }
    }
}
