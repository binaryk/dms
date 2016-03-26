<?php namespace App\Http\Controllers\Files;

use \App\Http\Controllers\Basic\BaseController;
use App\Models\Director;
use App\Models\File;
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
        }

        $actionObject = (new Action($action, $id))->data($data);
        if( $action == 'insert' ){
            $actionObject->addData('director', $dir_id);
            $res = $actionObject->commit();
            $this->insertIntoHistory($res);
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
        $file = File::find($id);
        $dir = Director::find($file->director);
        $zipper = new \Chumper\Zipper\Zipper;
        $compresed = $zipper->make($dir->path . '/' .$file->name . '.zip')->add($file->path);

        return success(['arch_path' => $dir->location . '/' . $file->name . '.zip'],'Arhivarea a avut loc cu success');
    }

}