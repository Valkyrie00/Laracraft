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



class ModelController extends Controller
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
        $models = [];
        $fModels = File::files(app_path());
        foreach ($fModels as $fModel) {
            $models[] = new \SplFileInfo($fModel);
        }
        return View::make('laracraft.base.model.index')->with('models', $models);
    }

}