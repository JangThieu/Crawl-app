<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\CountLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public $CountLink;

    public function runCommand(Request $request)
    {
        // Log::info("asasa");
        try {
            chdir('..');
            $exec_command = `start batch.bat`;
            echo $exec_command;
            return 1;
        } catch (Exception $e) {
            Log::error($e);
            return 2;
        }
    }

    public function returnTotalLink()
    {
        $CountLink = new CountLink();
        $totalLink = $CountLink->getToltalLink(1);
        $targetLink = $CountLink->getTargetLink(1);
        $data = [
            'totalLink' => $totalLink,
            'targetLink' => $targetLink
        ];
        return $data;
    }

    public function resetLinks() {
        $CountLink = new CountLink();
        $resetLink = $CountLink->resetLink(1);
        return $resetLink;
    }
}
