<?php

namespace Valkyrie\Laracraft\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use File;

use Valkyrie\Laracraft\Events\ProcessStatus;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class LogController extends Controller
{
    public function index()
    {

        $filearray = file(storage_path().'/logs/laravel.log');
        $logs = array_slice($filearray,0);

        Return View::make('laracraft.logs.index', ['logs' => $logs]);
    }

    public function clearLog()
    {

        $fh = fopen(storage_path().'/logs/laravel.log', 'w' );
        fclose($fh);

        return redirect('/laracraft/logs');
    }
}