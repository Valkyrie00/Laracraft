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



class MigrationController extends Controller
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
        $migrations = File::allFiles(base_path().'/database/migrations');

        return View::make('laracraft.base.migration.index')->with('migrations', $migrations);
    }

}