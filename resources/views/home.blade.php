@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
            <div class="rounded-2xl shadow-2xl flex w-2/3 max-w-2xl justify-center bg-custom">
                <div class="w-4/5 p-5">

                    <label for="times" class="block mb-2 text-2xl font-bold text-gray-900 dark:text-gray-400 ">Add new
                        cronjob</label>
                    <h3 for="" class="text-left font-bold mb-2">Common setting</h3>
                    <select id="times"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Once Per Minute(* * * * *)</option>
                        <option value="5min">5 Minutes</option>
                        <option value="10min">10 Minutes</option>
                        <option value="15min">15 Minutes</option>
                        <option value="20min">20 Minutes</option>
                    </select>
                    <h3 class="font-bold text-left mt-4">Minutes</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <input
                            class="shadow appearance-none border rounded w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username" type="text" placeholder="*">
                        <select id="times"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Once Per Minute(*)</option>
                            <option value="5min">5 Minutes</option>
                            <option value="10min">10 Minutes</option>
                            <option value="15min">15 Minutes</option>
                            <option value="20min">20 Minutes</option>
                        </select>
                    </div>

                    <h3 class="font-bold text-left mt-4">Hours</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <input
                            class="shadow appearance-none border rounded w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username" type="text" placeholder="*">
                        <select id="times"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Every Hour(*)</option>
                            <option value="5hour">5 Hours</option>
                            <option value="10hour">10 Hours</option>
                            <option value="15hour">15 Hours</option>
                            <option value="20hour">20 Hours</option>
                        </select>
                    </div>

                    <h3 class="font-bold text-left mt-4">Days</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <input
                            class="shadow appearance-none border rounded w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username" type="text" placeholder="*">
                        <select id="times"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Every Day(*)</option>
                            <option value="5day">5 Days</option>
                            <option value="10day">10 Days</option>
                            <option value="15day">15 Days</option>
                            <option value="20day">20 Days</option>
                        </select>
                    </div>

                    <h3 class="font-bold text-left mt-4">Month</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <input
                            class="shadow appearance-none border rounded w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username" type="text" placeholder="*">
                        <select id="times"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Every Month(*)</option>
                            <option value="5month">5 Months</option>
                            <option value="10month">10 Months</option>
                            <option value="15month">15 Months</option>
                            <option value="20month">20 Months</option>
                        </select>
                    </div>

                    <h3 class="font-bold text-left mt-4">Command</h3>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" value="{{ old('command') }}" name="run-command" id="input-command"
                        placeholder="php /path/to/artisan schedule:run 1>> /dev/null 2>&1">
                    {{-- <a href="{{ route('run-file') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded mt-4"></a> --}}
                    <button type="submit" id="run-command" name="runCommand"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded mt-4"> Run Command
                    </button>
                    {{-- <a href="../../batch.bat"> run</a> --}}
                    {{-- <button type="button" id="run-batch-file"> run</button> --}}
                    <div class="py-10">
                        <div class="flex flex-col items-center mt-4" id="showDownload">
                            <div class="progress-bar" id="progress-bar"></div>
                            <a href="/download" id="download"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded mt-2">
                                <i class="fa-solid fa-download mr-2"></i>
                                Download File
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @php

if(isset($_POST['runCommand'])){
    exec('batch.bat');
  }

function runFile()
{
    $file = '/batch.bat';
    if (!$file) {
        die('file not found');
    } else {
        // Set headers
        header('Cache-Control: public');
        header('Content-Description: File Transfer');
        header("Content-Disposition: attachment; filename=$file");
        header('Content-Type: application/bat');
        header('Content-Transfer-Encoding: ASCII');

        //Read the file from disk
        readfile($file);
    }
}

@endphp --}}

@section('script')
    <script language="javascript" type="text/javascript">
        $(function() {
            $('#showDownload').hide();
            $("button[id=run-command]").click(function() {
                $('#showDownload').fadeIn(3000);
            })
        })

        $(document).ready(function() {
            $('button[id="run-command"]').click(function() {
                // WshShell = new ActiveXObject("Wscript.Shell");
                // WshShell.run("batch.bat");
                $.ajax({
                    url: 'run-command',
                    type: "post",
                    // command: command
                })
            })
        })
    </script>
    {{-- <script src="js/index.js">
        $(function() {
            $("button[id=run-batch-file]").click(function() {
                runBatchFile();
            })
        })
    </script> --}}
@endsection
