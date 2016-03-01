<?php 

namespace Valkyrie\Laracraft\Helpers;

use RuntimeException;
use Illuminate\Filesystem\Filesystem as Filesystem;
use File;

Class Helper {

    public function __construct()
    {
        $this->file = new Filesystem;
    }

    public function liveExecuteCommand($cmd)
    {

        while (@ ob_end_flush()); // end all output buffers if any

        $proc = popen("$cmd 2>&1 ; echo Exit status : $?", 'r');

        $live_output     = "";
        $complete_output = "";

        while (!feof($proc))
        {
            $live_output     = fread($proc, 4096);
            $complete_output = $complete_output . $live_output;
            //echo "$live_output";
            @ flush();
        }

        pclose($proc);

        // get exit status
        preg_match('/[0-9]+$/', $complete_output, $matches);

        // return exit status and intended output
        return array (
                        'exit_status'  => $matches[0],
                        'output'       => str_replace("Exit status : " . $matches[0], '', $complete_output)
                     );
    }

    public function replaceAndSave($oldFile, $search, $replace, $newFile = null)
    {
        $newFile    = ($newFile == null) ? $oldFile : $newFile ;
        $file       = $this->file->get($oldFile);
        $replacing  = str_replace($search, $replace, $file);
        $this->file->put($newFile, $replacing);
    }

    public function replaceAndConcatenate($oldFile, $search, $replace, $newFile = null)
    {
        $newFile    = ($newFile == null) ? $oldFile : $newFile ;
        $file       = $this->file->get($oldFile);
        $replacing  = str_replace($search, $replace, $file);
        $this->file->append($newFile, $replacing);
    }

    public function generateModelComponent($package_component, $structure_modal = 1)
    {
        if($structure_modal == 1 ){
            $structure_modal = 'Complete';

            $spec   = '';
            $n      = count($package_component['component']);
            $i      = 0;
            foreach ($package_component['component'] as $value) {
                $i++;

                $spec .= '\''.$value['column_name'].'\'';

                if($i < $n)
                {
                    $spec .= ",";
                }
            }

            $data_search  = [
                    '{{ModelName}}', 
                    '{{ModelTable}}',
                    '{{spec}}'
                ];

            $data_replace = [
                    ucfirst($package_component['model_name']), 
                    $package_component['model_table'], 
                    $spec
                ];

        }else{
            $structure_modal = 'Single';

            $data_search  = [
                    '{{ModelName}}', 
                    '{{ModelTable}}',
                ];

            $data_replace = [
                    ucfirst($package_component['model_name']), 
                    $package_component['model_table'], 
                ];
        }

        $file_name         = ucfirst($package_component['model_name']);
        $model_path        = app_path().'/';

        $model = $model_path.$file_name.'.php';
        $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Model.stub', $data_search, $data_replace, $model);

        return true;
    }

    public function generateControllerComponent($package_component, $structure_modal = 1)
    {
        if($structure_modal == 2){
            $this->generateCrud($package_component);
        }else{
            if($structure_modal == 1 ){
                $structure_modal = 'Complete';
                $data_search  = [
                                    '{{ModelName}}', 
                                    '{{ControllerName}}',
                                ];

                $data_replace = [
                                    $package_component['model_name'], 
                                    ucfirst($package_component['controller_name']), 
                                ];
            }else{
                $structure_modal = 'Single';
                $data_search  = [
                                    '{{ControllerName}}',
                                ];

                $data_replace = [
                                    ucfirst($package_component['controller_name']), 
                                ];
            }

            $file_name         = ucfirst($package_component['controller_name']);
            $model_path        = app_path().'/Http/Controllers/';

            $model = $model_path.$file_name.'Controller.php';
            $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Controller.stub', $data_search, $data_replace, $model);

            return true;
        }
    }

    public function generateMigrationComponent($package_component, $structure_modal = 1)
    {

        $spec   = '';
        $n      = count($package_component['component']);
        $i      = 0;
        foreach ($package_component['component'] as $value) {
            $i++;

            $spec .= '$table->'.$value['column_type'].'(\''.$value['column_name'].'\')';

            if(isset($value['unsigned']) && $value['unsigned'] === true){
                $spec .= '->unsigned()';
            }

            if(isset($value['nullable']) && $value['nullable'] === true){
                $spec .= '->nullable()';
            }

            if(isset($value['default']) && $value['default'] !== ''){
                $spec .= '->default(\''.$value['default'].'\')';
            }

            $spec .= ';';
            if($i < $n)
            {
                $spec .= "\n";
            }
        }

        if($structure_modal == 1 ){
            $structure_modal = 'Complete';
        }else{
            $structure_modal = 'Single';
        }
        $date_for_name = date('Y_m_d_his');
        $file_name         = strtolower($package_component['migration_name']);
        $model_path        = app_path().'/../database/migrations/';
        
        $data_search  = [
                            '{{MigrationName}}', 
                            '{{TableName}}',
                            '{{spec}}'
                        ];

        $data_replace = [
                            ucfirst($package_component['migration_name']), 
                            strtolower($package_component['table_name']), 
                            $spec
                        ];

        $model = $model_path.$date_for_name.'_create_'.$file_name.'_table.php';
        $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Migration.stub', $data_search, $data_replace, $model);

        return true;
    }

    public function generateCrud($package_component){
        $structure_modal = 'Crud';


            $inputCreate   = '';
            foreach ($package_component['component'] as $value) {
                  $inputCreate .= '      <div class="form-group">';
                  $inputCreate .= '         <label>'.$value['column_name'].':</label>';
                  $inputCreate .= '         <input type="text" value="" class="form-control" name="'.$value['column_name'].'" placeholder="'.$value['column_name'].'">';
                  $inputCreate .= '     </div>';
                  $inputCreate .= "\n";
            }

            $inputEdit   = '';
            foreach ($package_component['component'] as $value) {
                  $inputEdit .= '      <div class="form-group">';
                  $inputEdit .= '         <label>'.$value['column_name'].':</label>'; 
                  $inputEdit .= '         <input type="text" value="{{ $ydata->'.$value['column_name'].' }}" class="form-control" name="'.$value['column_name'].'" placeholder="'.$value['column_name'].'">';
                  $inputEdit .= '     </div>';
                  $inputEdit .= "\n";
            }

            $inputIndex   = '';
            foreach ($package_component['component'] as $value) {
                  $inputIndex .= '      <span>{{ $ydata->'.$value['column_name'].' }}</span> -';
                  $inputIndex .= "\n";
            }


        $data_search  = [
                            '{{ModelName}}', 
                            '{{ControllerName}}',
                            '{{cControllerName}}',
                            '{{inputCreate}}',
                            '{{inputEdit}}',
                            '{{inputIndex}}',
                        ];

        $data_replace = [
                            $package_component['model_name'], 
                            ucfirst($package_component['controller_name']), 
                            lcfirst($package_component['controller_name']),
                            $inputCreate,
                            $inputEdit,
                            $inputIndex
                        ];

        $file_name         = ucfirst($package_component['controller_name']);
        $controller_path   = app_path().'/Http/Controllers/';

        $controller = $controller_path.$file_name.'Controller.php';
        $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Controller.stub', $data_search, $data_replace, $controller);

        $views_path       = app_path().'/../resources/views/'.lcfirst($package_component['controller_name']).'/';

        File::makeDirectory($views_path.'layouts', $mode = 0777, true, true);

        $view_master_path = $views_path.'layouts/master.blade.php';
        $view_index_path  = $views_path.'index.blade.php';
        $view_edit_path   = $views_path.'edit.blade.php';
        $view_create_path = $views_path.'create.blade.php';
        $view_show_path   = $views_path.'show.blade.php';

        $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Views/layouts/master.blade.stub', $data_search, $data_replace, $view_master_path);
        $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Views/index.blade.stub', $data_search, $data_replace, $view_index_path);
        $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Views/edit.blade.stub', $data_search, $data_replace, $view_edit_path);
        $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Views/create.blade.stub', $data_search, $data_replace, $view_create_path);
        $this->replaceAndSave(__DIR__.'/../StructureModules/'.$structure_modal.'/Views/show.blade.stub', $data_search, $data_replace, $view_show_path);

        $routes_path = app_path().'/Http/routes.php';
        $this->replaceAndConcatenate(__DIR__.'/../StructureModules/'.$structure_modal.'/routes.stub', $data_search, $data_replace, $routes_path);

        return true;
    }

}