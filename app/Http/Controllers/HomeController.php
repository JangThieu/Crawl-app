<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    function runFile()
    {
        $file = '/batch.bat';
        if (!$file) {
            die('file not found');
        } else {

            // Set headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file");
            header("Content-Type: application/bat");
            header("Content-Transfer-Encoding: ASCII");

            //Read the file from disk
            readfile($file);
        }

        // return view("home");
    }
}
