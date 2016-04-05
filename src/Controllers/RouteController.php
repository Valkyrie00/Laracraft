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

class RouteController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function index()
    {
        Return View::make('laracraft.routes.index');
    }

    public function create()
    {
        //
    }

}