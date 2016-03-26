<?php namespace App\Http\Controllers\History;

use \App\Http\Controllers\Basic\BaseController;
use App\Models\File;
use App\Models\Director;
use App\Models\FileHistory;
use Illuminate\Support\Facades\Input;

use App\Repositories\History\Grid;
use App\Repositories\History\Rows;
use App\Repositories\History\Form;
use App\Repositories\History\Action;

class FileHistoryController extends BaseController
{

    /**
     * $this->data() - vine din BaseController cu chestii comune (breadcrumb, meniu, ....)
     */
    public function getGrid($id)
    {
        $this->makeNavigation();
        $file = File::find($id);

        if(! $file){
            return error('Nu exista fisier cu id:'.$id);
        }
        $grid = (new Grid())
            ->parameters( Input::all() )
            ->withParameter('parent_file_id', $file->id)
            ->setUrl();

        return
            view('file-history.grid.index')
                ->with( $this->data('Istoria fisierului - '.$file->name.': ') )
                ->withBack( route('director-files.index',['dir_id' => $file->director]) )
                ->withGrid( $grid )
                ->withToolbar( str_replace([Chr(13), Chr(10), Chr(9)], '', view('file-history.grid.toolbar')
                    ->withActionRoute(\URL::route('file-history.get-action-form', ['file_id' => $file->id, 'action' => 'insert','grid_id' => $grid->getId()]))
                    ->render()) )
                ->withIcon(NULL)
                ->withCaption(null)
                ->withDescription(NULL)
            ;
    }

    /*
     * Generarea inregistrari pentru Grid
     */
    public function dataSource($parent_file_id, $grid_id)
    {
        return (new Rows())
            ->parameters(Input::all())
            ->addParameter('parent_file_id',$parent_file_id)
            ->addParameter('grid_id',$grid_id)
            ->postAddCells()
            ->response();
    }

    /*
     * Trimite catre index formularul "actions"
     */
    public function getActionForm($file_id, $action, $grid_id = NULL,  $id = NULL)
    {

        if($action === 'insert'){
            $id = $this->dublicateLastRecord($file_id)->id;
            $action = 'update';
        }

        $form =
            (new Form($action, $id, $grid_id))->setGridId($grid_id)
                ->route(\URL::route('file-history-do-action', ['file_id' => $file_id,'action' => $action, 'id' => $id]))
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
    public function doAction($parent_file_id, $action, $id = NULL )
    {
        $data = Input::except('file');
        $data['file_id'] = $parent_file_id;
        if(Input::hasFile('file')){
            $parent = File::find($parent_file_id);
            $file = Input::file('file');
            $res = $file->move($parent->path, $file->getClientOriginalName());
            $data['author'] = access()->user()->id;
            $data['path']   = $res->getPathName();
            $data['extention'] = $res->getExtension();
            $data['storage'] = formatSizeUnits($res->getSize());
            $data['location'] = $file->location . '/' . $file->getClientOriginalName();
        }

        $actionObject = (new Action($action, $id))->data($data);
        if( $action == 'insert' ){
            $actionObject->addData('director', $parent_file_id);
        }
        $result = $actionObject->commit();
        $this->updateFileTable($result['record']->toArray());
        return \Response::json($result);
    }

    public function dublicateLastRecord($file_id)
    {
        $data = FileHistory::where('file_id', $file_id)->orderBy('id','desc')->first();
        if($data){
            $data = $data->toArray();
            $data['version'] += 1;
            unset($data['id']);
            $out = FileHistory::create($data);
            return $out;
        }
        return null;
    }

    public function updateFileTable($data)
    {
        $id = $data['file_id'];
        unset($data['file_id']);
        unset($data['id']);
        $object = File::where('id',$id)->update($data);
        return $object;
    }

}