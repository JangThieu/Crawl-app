<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Excel;
use App\Services\CrawlService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ExcelController;

class Crawl2 extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:length';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check length files successfully';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // echo 'handle start ............';
            // $CrawlService = new CrawlService();
            // $fileDate = date('Y-m-d');
            // $path = public_path() . '/' . 'dataCrawl/' . $fileDate;
            // mkdir($path, 0777, true);
            // if (!file_exists($path)) {
            //     while (!is_dir($path . '/' . 'data.txt')) {
            //         $myfile = fopen($path . '/' . "data.txt", "w") or die("Unable to open file!");
            //         fwrite($myfile, '');
            //     }
            // }
            // $data = fread($myfile, filesize(public_path() . "/dataCrawl" . "/" . $fileDate . "/" . "data.txt"));
            // $filenames = explode(";", $data);

            // if (count($filenames) === 10) {
            //     echo 'start mergeTest.............';
            //     $CrawlService->mergeTest();
            // }

            echo 'handle start ............';
            $crawlService = new CrawlService();
            $fileDate = date('Y-m-d');
            $path = public_path() . '/' . 'dataCrawl/' . $fileDate;

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            echo 'check path .......';
            if (!file_exists($path . '/' . 'data.txt')) {
                $myFile = fopen($path . '/' . "data.txt", "w") or die("Unable to open file!");
                fwrite($myFile, '');
            }
            echo 'check file .......';

            // echo gettype($myFile);
            echo $path . '/' . "data.txt";
            $checkLenghtFile = filesize($path . '/' . "data.txt");

            echo $checkLenghtFile;
            if ($checkLenghtFile > 0 ) {
                $myFile = fopen($path . '/' . "data.txt", "r");
                echo $myFile;
                $data = fread($myFile,$checkLenghtFile);
                echo 'check write .......';
                $filenames = explode(";", $data);
                print_r(count($filenames));
                if (count($filenames) === 10) {
                    echo 'start mergeTest.............';
                    $crawlService->mergeTest();
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
        //Log::info("successfully");
    }
}
