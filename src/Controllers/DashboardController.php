<?php

namespace Valkyrie\Laracraft\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use File;

class DashboardController extends Controller
{
    public function index()
    {

        $storage_size = 0;
        foreach( File::allFiles(storage_path()) as $file)
        {
            $storage_size += $file->getSize();
        }
        $storage_size = number_format($storage_size / 1048576,2);

        $public_size = 0;
        foreach( File::allFiles(public_path()) as $file)
        {
            $public_size += $file->getSize();
        }
        $public_size = number_format($public_size / 1048576,2);

        $app_size = 0;
        foreach( File::allFiles(app_path()) as $file)
        {
            $app_size += $file->getSize();
        }
        $app_size = number_format($app_size / 1048576,2);

        $server_info = ['GATEWAY_INTERFACE', 'SERVER_ADDR', 'SERVER_NAME', 'SERVER_SOFTWARE', 'SERVER_PROTOCOL', 'DOCUMENT_ROOT', 'REMOTE_ADDR', 'REMOTE_PORT', 'SERVER_PORT'];
        
        preg_match_all("/^.*\.ERROR\:.*$/m", file_get_contents(storage_path().'/logs/laravel.log'), $matches);
        $last_log = array_reverse(array_slice($matches[0], -10, 10));

        //dd($last_log);
        return view('laracraft.dashboard.index', [
                                                    'storage_size'  => $storage_size, 
                                                    'public_size'   => $public_size, 
                                                    'app_size'      => $app_size, 
                                                    'server_info'   => $server_info,
                                                    'last_log'      => $last_log
                                                ]);
    }
}