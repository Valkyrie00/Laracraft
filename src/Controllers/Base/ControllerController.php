<?php

namespace Valkyrie\Laracraft\Controllers\Base;

use View;
use File;
use Input;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Route;
use Storage;
use Illuminate\Filesystem\Filesystem as Filesystem;

use App\Http\Controllers\Controller;
use Valkyrie\Laracraft\Helpers\Helper;



class ControllerController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
        $this->file = new Filesystem;
    }

    public function index()
    {

        $controllers = [];
        $loader = require base_path('vendor/autoload.php');

        foreach($loader->getClassMap() as $class => $file)
        {
            if (strpos($file, 'packages') !== false) {
                continue;
            }

            if (preg_match('/[a-z]+Controller$/', $class))
            {
                $reflection = new \ReflectionClass($class);
                $methods = [];

                // exclude inherited methods
                /*foreach ($reflection->getMethods() as $method) {
                    if ($method->class == $reflection->getName())
                        $methods[] = $method->name;
                }*/

                $controllers[] = $class;
                //var_dump($file);
            }
        }

        //dd('ciao');

        return View::make('laracraft.base.controller.index')->with('controllers', $controllers);
    }

    public function save(Request $request)
    {
        $file       = $this->file->get('/home/vagrant/laracraft/app/Http/Controllers/IgenicoController.php');
        $this->file->put('/home/vagrant/laracraft/app/Http/Controllers/IgenicoController.php', $request->input('contents'));

        return 'ciao';
    }

}