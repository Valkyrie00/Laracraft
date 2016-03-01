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

class ComposerController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function index()
    {
        Return View::make('laracraft.composer.index');
    }

    public function composerUpdate()
    {
        $process = new Process('cd ..; php composer.phar update');
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            event(new ProcessStatus($buffer));
        });
    }

    public function composerInstall(Request $request)
    {
        $repository_name = $request->input('repository_name');
        $process = new Process('cd ..; php composer.phar require '.$repository_name);
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            event(new ProcessStatus($buffer));
        });
    }

}