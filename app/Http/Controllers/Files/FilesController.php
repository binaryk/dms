<?php namespace App\Http\Controllers\Files;

use \App\Http\Controllers\Basic\BaseController;
use App\Models\Archive;
use App\Models\Director;
use App\Models\File;
use Illuminate\Support\Facades\File as SFile;
use App\Models\FileHistory;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Input;

use App\Repositories\Files\Grid;
use App\Repositories\Files\Rows;
use App\Repositories\Files\Form;
use App\Repositories\Files\Action;

class FilesController extends BaseController
{

    /**
     * $this->data() - vine din BaseController cu chestii comune (breadcrumb, meniu, ....)
     */
    public function getGrid($id)
    {
        $this->makeNavigation();
        $dir = Director::find($id);
        if(! $dir){
            return error('Nu exista director cu id:'.$id);
        }
        $grid = (new Grid())
            ->parameters( Input::all() )
            ->withParameter('dir_id', $dir->id)
            ->setUrl();

        return
            view('director-files.grid.index')
                ->with( $this->data('Fișiere în directorul: '.$dir->name) )
                ->withBack( route('file_structure.index') )
                ->withGrid( $grid )
                ->withToolbar( str_replace([Chr(13), Chr(10), Chr(9)], '', view('director-files.grid.toolbar')->withActionRoute(\URL::route('director-files.get-action-form',
                    ['dir_id' => $dir->id, 'action' => 'insert','grid_id' => $grid->getId()]))->render()) )
                ->withIcon(NULL)
                ->withDescription(NULL)
            ;
    }

    /*
     * Generarea inregistrari pentru Grid
     */
    public function dataSource($dir_id, $grid_name)
    {
        return (new Rows())->parameters(Input::all())->addParameter('dir_id',$dir_id)->addParameter('grid_id',$grid_name)->postAddCells()->response();
    }

    /*
     * Trimite catre index formularul "actions"
     */
    public function getActionForm($dir_id, $action, $grid_id = NULL,  $id = NULL)
    {
        $form =
            (new Form($action, $id, $grid_id))
                ->setGridId($grid_id)
                ->route(\URL::route('director-files-do-action', ['dir_id' => $dir_id,'action' => $action, 'id' => $id]))
        ;
        return \Response::json([
            'caption' => $form->caption(),
            'form'    => $form->render(),
            'action'  => $form->actionCaption(),
            'route'   => $form->getRoute(),
            'impact' => $action,
        ]);
    }

    /**
     * do Action - se face adaugarea/modificarea/stergere
     */
    public function doAction($dir_id, $action, $id = NULL )
    {
        $data = Input::except('file');
        if(Input::hasFile('file')){
            $dir = Director::find($dir_id);
            $file = Input::file('file');
            $res = $file->move($dir->path, $file->getClientOriginalName());
            $data['author'] = access()->user()->id;
            $data['path']   = $res->getPathName();
            $data['extention'] = $res->getExtension();
            $data['storage'] = formatSizeUnits($res->getSize());
            $data['location'] = $dir->location . '/' . $file->getClientOriginalName();
            $this->log('Utilizatorul:'.$this->current_user->name.' a incarcat fisierul:'.$data['path'].'.', 'info');

        }
        $actionObject = (new Action($action, $id))->data($data);
        if( $action == 'insert' ){
            $actionObject->addData('director', $dir_id);
            $res = $actionObject->commit();
            $this->insertIntoHistory($res);
        }else{
            $res = $actionObject->commit();
        }

        return \Response::json($res);
    }

    public function insertIntoHistory($res)
    {
        $new_data = $res['record']->toArray();
        $new_data['file_id'] = $new_data['id'];
        unset($new_data['id']);
        $out = FileHistory::create($new_data);
        return $out;
    }

    public function archive($id)
    {
        if( ! file_exists($arch_root = config('general.archives') . access()->user()->id ) ){
            SFile::makeDirectory($arch_root, 0775, true);
        }
        $file = File::find($id);
        $path = public_path($arch_root . '/' . $file->name . '.zip');
        $zipper = new \Chumper\Zipper\Zipper;
        $zipper->make($path)->add($file->path);
        $location = asset($arch_root . '/' . $file->name . '.zip');
        $this->insertDbArchive($file->toArray(), $path,$location);
        $this->log('Utilizatorul:'.$this->current_user->name.' a creat arhiva :'.$path.'.', 'info');
        return success(['arch_path' => $location],'Arhivarea a avut loc cu success');
    }

    public function insertDbArchive($data, $final_path,$location)
    {
        $data['file_id'] = $data['id'];
        if(! $archive =  Archive::where('file_id', $data['id'])->first()){
            unset($data['id']);
            $data['location'] = $location;
            $data['path'] = $final_path;
            $data['extention'] = 'zip';
            Archive::create($data);
        }else{
            $archive->location = $location;
            $archive->path = $final_path;
            $archive->save();
        }
    }

    public static function syncFiles($path, $actual_path)
    {
        $files = SFile::allFiles($path);
        foreach ($files as $file)
        {
            $tfile = new SFile($file->getPathname());
            $tfile->move($actual_path, $file->getClientOriginalName());
        }

        return true;
    }

}