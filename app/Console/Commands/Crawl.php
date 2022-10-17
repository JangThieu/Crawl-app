<?php

namespace App\Console\Commands;

use Exception;

use SheetDB\SheetDB;
use App\Jobs\ExcelJob;
use App\Jobs\MergeJob;
use App\Services\CrawlService;
use Illuminate\Console\Command;
use App\Http\Controllers\ExcelController;

class Crawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl1:hours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $crawlService;
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
            $options = array(
                'http' => array(
                    'method'  => 'GET'
                )
            );

            $googleSheetReponse = json_decode(
                file_get_contents('https://sheetdb.io/api/v1/zueyszymek6co?sheet=links', false, stream_context_create($options))
                // file_get_contents('https://sheetdb.io/api/v1/htkk06t37gb54?sheet=links', false, stream_context_create($options))
            );
            $googleSheetMegaReponse = json_decode(
                file_get_contents('https://sheetdb.io/api/v1/bb0mo915c6962?sheet=Mega', false, stream_context_create($options))
                // file_get_contents('https://sheetdb.io/api/v1/pq42kpm256zu6?sheet=Mega', false, stream_context_create($options))
            );

            $megaPrice = [];
            foreach ($googleSheetMegaReponse as $i => $row) {
                $megaPrice[trim($row->MSP)] = trim($row->PRICE);
            }

            $length = 2;
            for ($i = 0; $i <= 8; $i++) {
                $indexStart = $i * $length;
                $googleSheet = array_slice($googleSheetReponse, $indexStart, $length, true);
                switch ($i) {
                    case 0:
                        $job1 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job1);
                        break;
                    case 1:
                        $job2 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job2);
                        break;
                    case 2:
                        $job3 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job3);
                        break;
                    case 3:
                        $job4 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job4);
                        break;
                    case 4:
                        $job5 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job5);
                        break;
                    case 5:
                        $job6 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job6);
                        break;
                    case 6:
                        $job7 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job7);
                        break;
                    case 7:
                        $job8 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job8);
                        break;
                    case 8:
                        $job9 =  new ExcelJob($i, 'test_' . $i, $googleSheet, $megaPrice);
                        dispatch($job9);
                        break;
                    default:
                        break;
                }
            }

            echo "sleep here";
            // sleep(100);
            // exit("asas");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
