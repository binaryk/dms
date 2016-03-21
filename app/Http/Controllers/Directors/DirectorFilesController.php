<?php namespace App\Http\Controllers\Directors;

use \App\Http\Controllers\Basic\BaseController;
use App\Models\FileStructure;
use Illuminate\Support\Facades\Input;

use App\Repositories\Directors\Grid;
use App\Repositories\Directors\Rows;
use App\Repositories\Directors\Form;
use App\Repositories\Directors\Action;

class DirectorFilesController extends BaseController
{

    /**
     * $this->data() - vine din BaseController cu chestii comune (breadcrumb, meniu, ....)
     */
    public function getGrid($id)
    {
        $this->makeNavigation();
        $dir = FileStructure::find($id);
        if(! $dir){
            return error('Nu exista director cu id:'.$id);
        }
        $grid = (new Grid())
            ->parameters( Input::all() )
            ->withParameter('dir_id', $dir->id)
            ->setUrl();

        return
            view('director-files.grid.index')
                ->with( $this->data() )
                ->withGrid( $grid
                )
                ->withToolbar( str_replace([Chr(13), Chr(10), Chr(9)], '', view('director-files.grid.toolbar')->withActionRoute(\URL::route('director-files.get-action-form', ['dir_id' => $dir->id, 'action' => 'insert','grid_id' => $grid->getId()]))->render()) )
                ->withIcon(NULL)
                ->withCaption('Fisiere din directorul - '.$dir->name.': ')
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
            $dir = FileStructure::find($dir_id);
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
        }
        return \Response::json($actionObject->commit());
    }

}