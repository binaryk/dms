<?php

namespace App\Http\Controllers\Directors;
use App\Http\Controllers\Basic\BaseController;
use App\Models\Director;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class DirectorStructureController extends BaseController
{
    public function index()
    {
        $files = $this->userFiles();
        $this->makeNavigation();
        return view('file-structure.index')
               ->with( $this->data('Strucura de directoare','pentru a crea un director root, click pe "Creeaza director" din dreapta') )
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
        if($data['name'] === ''){
            return error('Lungimea numelui trebuie sa aiba minim un caracter.');
        }
        try{
            // make user root
            $user_root_path = public_path(config('general.upload') . access()->user()->id);
            $user_root = Director::where('path',$user_root_path)->first();
            if(! $user_root){
                // daca nu exista deja director root, facem unul nou
                $user_root = Director::create([
                    'name' => access()->user()->id,
                    'type' => 'director',
                    'path' => public_path(config('general.upload') . access()->user()->id),
                    'user_id' => access()->user()->id,
                    'location' => asset(config('general.upload') . access()->user()->id),
                ]);
                File::makeDirectory($user_root->path, 0775, true);
                $this->log('Utilizatorul:'.$this->current_user->name.' a creat directorul root.', 'info');
            }
            if(! file_exists(public_path(config('general.upload') . access()->user()->id . DIRECTORY_SEPARATOR . $data['name']))){
                $root = Director::create([
                    'name' => $data['name'],
                    'type' => $data['type'],
                    'path' => public_path(config('general.upload') . access()->user()->id . DIRECTORY_SEPARATOR . $data['name']),
                    'user_id' => access()->user()->id,
                    'location' => asset(config('general.upload') . access()->user()->id . DIRECTORY_SEPARATOR . $data['name']),
                ]);
                $root->makeChildOf($user_root);
                $this->log('Utilizatorul:'.$this->current_user->name.' a creat directorul '.$root->path.'.', 'info');
                File::makeDirectory($root->path, 0775, true);
            }else{
                throw  new \Exception('Exista deja director cu acest nume', 500);
            }

        }
        catch(\Exception $e){
            return error($e->getMessage());
        }
        return success(['inserted' => $root]);
    }

    public function remove()
    {
        $path = null;
        $dir_deleted = false;
        try{
            $data = Input::get('data');
            $child = Director::find($data);
            $path  = $child->path;
            $dir_deleted = File::deleteDirectory($child->path);
            $this->deleteAllFiles($data);
            $child->delete();
            $this->log('Utilizatorul:'.$this->current_user->name.' a sters directorul (si toate fisierele din el) '.$child->path.'.', 'warning');
        }catch(\Exception $e){
            return error($e->getMessage());
        }
        return success(['removed' => 'true', 'path' => $path, 'dir_removed' => $dir_deleted]);
    }

    public function deleteAllFiles($dir_id)
    {
        return \App\Models\File::where('director', $dir_id)->delete();
    }

    public function dir($data)
    {
        $inserted = null;
        if($data['current']['name'] === ''){
            return error('Lungimea numelui trebuie sa aiba minim un caracter.');
        }
        try{
            $root = Director::find($data['parent']['id']);
            if(! file_exists($root->path . DIRECTORY_SEPARATOR . $data['current']['name'])) {
                $inserted = Director::create([
                    'name' => $data['current']['name'],
                    'type' => $data['current']['type'],
                    'path' => $root->path . DIRECTORY_SEPARATOR . $data['current']['name'],
                    'user_id' => access()->user()->id,
                    'location' => $root->location . DIRECTORY_SEPARATOR . $data['current']['name'],
                ]);
                $this->log('Utilizatorul:'.$this->current_user->name.' a creat directorul :'.$inserted->path.'.', 'info');
                $inserted->makeChildOf($root);
                File::makeDirectory($inserted->path, 0775, true);
            }else{
                throw  new \Exception('Exista deja director cu acest nume', 500);
            }
        }
        catch(\Exception $e){
            return error($e->getMessage());
        }
        return success(['inserted' => $inserted]);
    }



}
