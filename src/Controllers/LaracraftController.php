<?php

namespace Valkyrie\Laracraft\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use File;

use Valkyrie\Laracraft\Events\ProcessStatus;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class LaracraftController extends Controller
{
    public function startServer()
    {
        $process = new Process('cd ..; node laracraft.js');
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            event(new ProcessStatus($buffer));
        });

        return true;
    }
}