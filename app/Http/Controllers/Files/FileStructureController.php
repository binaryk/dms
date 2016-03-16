<?php

namespace App\Http\Controllers\Files;
use App\Http\Controllers\Basic\BaseController;
use App\Models\FileStructure;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class FileStructureController extends BaseController
{
    public function index()
    {
        $files = $this->userFiles();
        $this->makeNavigation();
        return view('file-structure.index')
               ->with( $this->data('Strucura de fisiere', 'aici gasiti fisierele dvs') )
                ->with(compact('files'))
            ;
    }

    public function get()
    {
        return response()->json([
            'files' => $files = $this->userFiles(),
        ]);
    }


    public function storeDir()
    {
        try{
            $data = Input::get('data');
            $root = FileStructure::create([
                'name' => $data['name'],
                'type' => $data['type'],
                'path' => public_path(config('general.upload') . access()->user()->id . DIRECTORY_SEPARATOR . $data['name']),
                'user_id' => access()->user()->id,
            ]);
            $result = File::makeDirectory($root->path, 0775, true);
        }
        catch(\Exception $e){
            return error($e->getMessage());
        }
        return success();
    }

    public function userFiles()
    {
        return access()->user()->files();
    }



}
