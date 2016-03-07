<?php

namespace Valkyrie\Laracraft\Controllers;

use View;
use File;
use Input;
use Illuminate\Http\Request;
use Redirect;

use App\Http\Controllers\Controller;
use Valkyrie\Laracraft\Helpers\Helper;
use Valkyrie\Laracraft\Events\ProcessStatus;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class PackageController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function index()
    {
        Return View::make('laracraft.package.create');
    }

    public function create(Request $request){

        event(new ProcessStatus('Generate structure'));

        $data = [
            'package_folder' => $request->package['directory'],
            'vendor_name'    => $request->package['vendor'],
            'package_name'   => $request->package['name']
        ];

        //****************************************
        // Generate package folder, src folder and facades folder
        //****************************************
        if($this->helper->generateDirComponent($data) === true)
        {
            event(new ProcessStatus('Generate components'));
            //****************************************
            // Generate composer
            //****************************************
            $this->helper->generateSimpleComposer($data);

            //****************************************
            // Generate component
            //****************************************
            $this->helper->generateSimpleComponent($data);

            //****************************************
            // Generate suite phpspec
            //****************************************
            $this->helper->generateSimpleSpecSuite($data);

            event(new ProcessStatus('Add new components in laravel'));

            //****************************************
            // Autoload package
            //****************************************
            $this->helper->addToAppComposer($data);

            $process = new Process('cd ..; php composer.phar update');
            $process->setTimeout(null);
            $process->run(function ($type, $buffer) {
                event(new ProcessStatus($buffer));
            });

            $this->helper->addSimpleToAppProviders($data);
            $this->helper->addSimpleToAppAliases($data);
        }

        event(new ProcessStatus('Package successfully created'));

    }

}