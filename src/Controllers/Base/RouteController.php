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



class RouteController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
        $this->file = new Filesystem;
    }

    public function index()
    {


$classes = get_declared_classes();
include '/home/vagrant/laracraft/app/Http/Controllers/AsdasdController.php';
$diff = array_diff(get_declared_classes(), $classes);
$class = reset($diff);

// Get class's methods

$methods = get_class_methods($class);

// Print them out

echo "Class : ".$class;


dd($methods);


        // /home/vagrant/laracraft/app/Http/Controllers/AsdasdController.php

        $class = new \ReflectionClass('AsdasdController');
        $method = $class->getMethod();
        dd($method);

        /*
            http://php.net/manual/en/class.splfileinfo.php
        */
        $controllers = File::allFiles(app_path().'/Http/Controllers');

        return View::make('laracraft.base.route.index')->with('controllers', $controllers);
    }

    public function create(Request $request)
    {
        dd($request);
    }

    public function getMethods()
    {
        $methods = ['ciao', 'calimero'];
        return $methods;
    }
}