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
        $data = Input::get('data');
        if(array_key_exists("parent", $data)){
           return $this->dir($data);
        }else{
           return $this->rootDir($data);
        }
    }

    public function userFiles()
    {
        return access()->user()->files();
    }

    public function rootDir($data)
    {
        $root = null;
        try{
            // make user root
            $user_root_path = public_path(config('general.upload') . access()->user()->id);
            $user_root = FileStructure::where('path',$user_root_path)->first();
            if(! $user_root){
                // daca nu exista deja director root, facem unul nou
                $user_root = FileStructure::create([
                    'name' => access()->user()->id,
                    'type' => 'director',
                    'path' => public_path(config('general.upload') . access()->user()->id),
                    'user_id' => access()->user()->id,
                ]);
                File::makeDirectory($user_root->path, 0775, true);
            }
            $root = FileStructure::create([
                'name' => $data['name'],
                'type' => $data['type'],
                'path' => public_path(config('general.upload') . access()->user()->id . DIRECTORY_SEPARATOR . $data['name']),
                'user_id' => access()->user()->id,
            ]);
            $root->makeChildOf($user_root);
            File::makeDirectory($root->path, 0775, true);
        }
        catch(\Exception $e){
            return error($e->getMessage());
        }
        return success(['inserted' => $root]);
    }

    public function dir($data)
    {
        $inserted = null;
        try{
            $root = FileStructure::find($data['parent']['id']);
            $inserted = FileStructure::create([
                'name' => $data['current']['name'],
                'type' => $data['current']['type'],
                'path' => $root->path . DIRECTORY_SEPARATOR . $data['current']['name'],
                'user_id' => access()->user()->id,
            ]);
            $inserted->makeChildOf($root);
            File::makeDirectory($inserted->path, 0775, true);
        }
        catch(\Exception $e){
            return error($e->getMessage());
        }
        return success(['inserted' => $inserted]);
    }



}
