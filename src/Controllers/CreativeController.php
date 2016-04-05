<?php

namespace Valkyrie\Laracraft\Controllers;

use View;
use File;
use Input;
use Illuminate\Http\Request;
use Redirect;
use Session;

use App\Http\Controllers\Controller;
use Valkyrie\Laracraft\Helpers\Helper;


class CreativeController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function index()
    {
        Return View::make('laracraft.creative.create');
    }

    public function create(Request $request){

        if($request->migration['migration_name'] != ''){
            $component = [];
            if(isset($request->migration['component'])){
                foreach ($request->migration['component'] as $column) {
                    $component[] = ['column_name' => $column['column_name'], 
                                    'column_type' => $column['column_type'],
                                    'unsigned' => isset($column['unsigned']) ? true : false,
                                    'nullable' => isset($column['nullable']) ? true : false,
                                    'default' => $column['default']
                                   ];
                }
            }

            $data_migration = [
                'migration_name'    => $request->migration['migration_name'],
                'table_name'        => $request->migration['table_name'],
                'component'         => $component,
            ];

            $this->helper->generateMigrationComponent($data_migration);
        }

        if($request->model['model_name'] != ''){
            $model_name  = $request->model['model_name'];
            $model_table = $request->migration['table_name'] != '' ? $request->migration['table_name'] : $request->model['model_table'];

            $generation_modal = 0;
            $component = [];
            if(isset($request->migration['component'])){
                $generation_modal = 1;
                foreach ($request->migration['component'] as $column) {
                    $component[] = ['column_name' => $column['column_name']];
                }
            }

            $data_model = [
                'model_name'    => $model_name,
                'model_table'   => $model_table,
                'component'     => $component,
            ];

            $this->helper->generateModelComponent($data_model, $generation_modal);
        }

        if($request->controller['controller_name'] != ''){
            $controller_name        = $request->controller['controller_name'];
            $controller_model_name  = $request->model['model_name'] != '' ? $request->model['model_name'] : '';


            $component = [];
            if(isset($request->migration['component'])){
                $generation_modal = 1;
                foreach ($request->migration['component'] as $column) {
                    $component[] = ['column_name' => $column['column_name']];
                }
            }

            $data_controller = [
                'model_name'        => $controller_model_name,
                'controller_name'   => $controller_name,
                'component'         => $component,
            ];

            $generation_modal = 0;
            if(isset($request->model['model_name']) && $request->model['model_name'] != ''){
                if(isset($request->controller['crud'])){
                    $generation_modal = 2;
                }else{
                    $generation_modal = 1;
                }
            }

            $this->helper->generateControllerComponent($data_controller, $generation_modal);
        }

        return Redirect::to("laracraft/creative")->with('success', true);
    }

}