<?php
namespace Valkyrie\Laracraft\Controllers;

use Valkyrie\Laracraft\Models\Backup;
use View;
use File;
use Input;
use Illuminate\Http\Request;

use Redirect;
use Response;

use App\Http\Controllers\Controller;
use Valkyrie\Laracraft\Helpers\Helper;

class BackupController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function index()
    {
        $backups = Backup::get();
        Return View::make('laracraft.backups.index', ['backups' => $backups]);
    }

    public function store(Request $request)
    {
        $backup_name = $request->backup_name != '' ? date('Y_m_d_His').'_'.$request->backup_name : date('Y_m_d_His').'_backup';

        $backup_zip_name = $backup_name.'.zip';

        $path_backup = base_path()."/backups/";
        $path_file_backup = $path_backup.$backup_zip_name;

        if(!File::exists($path_backup)) {
            File::makeDirectory($path_backup, $mode = 0777, true, true);
        }

        $status = $this->addZip(base_path() , $path_file_backup);

        if($status === true)
        {
            $backup = Backup::create(['name' => $backup_name, 'file' => $backup_zip_name]);
            return Redirect::to("laracraft/backups")->with('success');
        }

        return Redirect::to("laracraft/backups")->with('fail');
    }

    function addZip($source, $destination) {
        set_time_limit(0);
        // Get real path for our folder
        $rootPath = realpath($source);

        // Initialize archive object
        $zip = new \ZipArchive();
        $zip->open($destination, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($rootPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            set_time_limit(0);
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        return $zip->close();
    }

    public function downloadBackup($id = null)
    {
        if($id !== null)
        {
            $backup = Backup::find($id);
            $file = base_path(). "/Backups/".$backup->file;
            $headers = array(
                  'Content-Type: application/zip',
                );
            return Response::download($file, $backup->file, $headers);
        }
    }

}