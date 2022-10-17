<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Threads\AsyncOperationThread;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ApiController extends Controller
{
    public function runCommand(Request $request)
    {
        Log::info("asasa");
        try {
            chdir('..');
            // shell_exec('sh');
            // shell_exec('sh start.sh');
            // shell_exec('SCHTASKS /RUN /TN "start.sh" ');
            $exec_command = `start batch.bat`;
            echo $exec_command;
            // $output = shell_exec('ls');
            // echo $output;
            // sleep(3);
            return 1;
        } catch (Exception $e) {
            Log::error($e);
            return 2;
        }
    }
}
