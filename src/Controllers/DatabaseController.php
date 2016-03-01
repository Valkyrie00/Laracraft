<?php
namespace Valkyrie\Laracraft\Controllers;

use Symfony\Component\Console\Output\StreamOutput;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use View;
use Redirect;
use Artisan;

use Event;
use Valkyrie\Laracraft\Events\ProcessStatus;
use Illuminate\Redis\RedisServiceProvider;

use App\Http\Controllers\Controller;
use Valkyrie\Laracraft\Helpers\Helper;
use Illuminate\Http\Request;
use Input;

class DatabaseController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function index()
    {
        Return View::make('laracraft.database.index');
    }

    public function migration()
    {
        $process = new Process('cd ..; php artisan migrate');
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            event(new ProcessStatus($buffer));
        });
    }

}