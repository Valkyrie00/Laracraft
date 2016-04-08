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

        /*
            http://php.net/manual/en/class.splfileinfo.php
        */
        $controllers = File::allFiles(app_path().'/Http/Controllers');
        //dd($controllers);
        return View::make('laracraft.base.controller.index')->with('controllers', $controllers);
    }

    public function save(Request $request)
    {
        $file       = $this->file->get('/home/vagrant/laracraft/app/Http/Controllers/IgenicoController.php');
        $this->file->put('/home/vagrant/laracraft/app/Http/Controllers/IgenicoController.php', $request->input('contents'));

        return 'ciao';
    }

}