<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use App\Services\CrawlService;
use App\Services\ExcelService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\ExcelController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MergeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $lineInExcel = 0;
    // public $lineTest = 0;
    //public ExcelController $instance;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($index, $queueName)
    {
        $this->index = $index;
        $this->queue = $queueName->delay(300);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            echo 'handle start ............';
            $CrawlService = new CrawlService();
            $fileDate = date('Y-m-d');
            $path = public_path() . '/' . 'dataCrawl/' . $fileDate;
            mkdir($path, 0777, true);
            while (!is_dir($path . '/' . 'data.txt')) {
                $myfile = fopen($path . '/' . "data.txt", "w") or die("Unable to open file!");
                fwrite($myfile, '');
                $data = fread($myfile, filesize(public_path() . "/dataCrawl/' .$fileDate. /data.txt"));
                $filenames = explode(";", $data);
            }
            if (!file_exists($path)) {
                if (count($filenames) === 10) {
                    echo 'start mergeTest.............';
                    $CrawlService->mergeTest();
                }
            }
            exit;
            // $CrawlService = new CrawlService();
            // $myfile = fopen(public_path() . "/dataCrawl/' .$fileDate. /data.txt", "r") or die("Unable to open file!");
            // $data = fread($myfile, filesize(public_path() . "/dataCrawl/' .$fileDate. /data.txt"));
            // $filenames = explode(";", $data);
            // if (!file_exists($path)) {
            //     if (count($filenames) === 10) {
            //         echo 'start mergeTest.............';
            //         $CrawlService->mergeTest();
            //     }
            // }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
