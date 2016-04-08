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

use Illuminate\Filesystem\Filesystem as Filesystem;
use File;

class ConfigController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
        $this->file = new Filesystem;
    }

    public function getEnv()
    {
        $path_file = base_path().'/.env';

        $data = [];
        foreach(file($path_file) as $line) {
            $explode = explode("=", $line);
            if(isset($explode[1]))
            {
                $data[$explode[0]] = $explode[1];
            }
        }

        Return View::make('laracraft.env.index', ['data' => $data]);
    }

    public function postEnv(Request $request)
    {
        $env_file = base_path().'/.env';

        foreach ($request->input('edit') as $key => $value) {
            $file       = $this->file->get($env_file);
            preg_match_all("/$key=.*/m", $file, $search);
            $replace = "$key=$value";
            $replacing  = str_replace($search[0], $replace, $file);
            $this->file->put(base_path().'/.env', $replacing);
        }

        if($request->input('new')) {
            foreach ($request->input('new') as $key => $value) {
                $add  = $value['name']."=".$value['value']."\n";
                $this->file->append(base_path().'/.env', $add);
            }
        }
        

        return redirect('/laracraft/config/env');
    }

}