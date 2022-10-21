<?php

use Illuminate\Http\Request;
use App\Services\CrawlService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::match(['get', 'post'], '/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/download', function () {
    // $fileDate= date('Y-m-d');
    // $file = public_path() . '/data.xlsx';

    // $headers = array(
    //     'Content-Type : application/xlsx',
    // );

    // return Response::download($file, 'data.xlsx', $headers);
    $zip_file = 'dataCrawl.zip';
    touch($zip_file);

    $zip = new ZipArchive();
    $this_zip = $zip->open($zip_file);
    $fileDate = date('Y-m-d');

    if ($this_zip) {
        $file_with_path = 'dataCrawl/' . $fileDate . '/' . 'data.xlsx';
        $name = "data.xlsx";
        $zip->addFile($file_with_path, $name);
    }
});

// Route::post('/run-command', [ApiController::class, 'runCommand'])->name('command');
// Route::get('/run-command', [ApiController::class, 'runCommand'])->name('command');
Route::post('/test-api', [ApiController::class, 'testApi'])->name('testApi');
Route::match(['get', 'post'], '/run-file', [HomeController::class, 'runFile'])->name('run-file');
Route::get('/return-links', [ApiController::class, 'returnTotalLink']);
Route::post('/reset-link', [ApiController::class, 'resetLinks']);
