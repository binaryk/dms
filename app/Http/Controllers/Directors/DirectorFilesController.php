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
        return
            view('director-files.grid.index')
                ->with( $this->data() )
                ->withGrid( (new Grid())->parameters( Input::all()) )
                ->withToolbar( str_replace([Chr(13), Chr(10), Chr(9)], '', view('director-files.grid.toolbar')->withActionRoute(\URL::route('director-files.get-action-form', ['action' => 'insert']))->render()) )
                ->withIcon(NULL)
                ->withCaption('Fisiere din directorul - '.$dir->name.': ')
                ->withDescription(NULL)
            ;
    }

    /*
     * Generarea inregistrari pentru Grid
     */
    public function dataSource()
    {
        return (new Rows())->parameters(Input::all())->response();
    }

    /*
     * Trimite catre index formularul "actions"
     */
    public function getActionForm($action, $id = NULL)
    {

        $form =
            (new Form($action, $id))
                ->route(\URL::route('director-files-do-action', ['action' => $action, 'id' => $id]))
        ;
        return \Response::json([
            'caption' => $form->caption(),
            'form'    => $form->render(),
            'action'  => $form->actionCaption(),
            'route'   => $form->getRoute(),
        ]);
    }

    /**
     * do Action - se face adaugarea/modificarea/stergere
     */
    public function doAction( $action, $id = NULL )
    {
        dd(Input::get('data'));
        $action = (new Action($action, $id))->data(Input::get('data'));
        return \Response::json($action->commit());
    }

}