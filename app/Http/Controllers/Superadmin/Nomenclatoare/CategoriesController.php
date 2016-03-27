<?php namespace App\Http\Controllers\Superadmin\Nomenclatoare;

use \App\Http\Controllers\Basic\BaseController;
use Illuminate\Support\Facades\Input;

use App\Repositories\Superadmin\Nomenclatoare\Categories\Grid;
use App\Repositories\Superadmin\Nomenclatoare\Categories\Rows;
use App\Repositories\Superadmin\Nomenclatoare\Categories\Form;
use App\Repositories\Superadmin\Nomenclatoare\Categories\Action;

class CategoriesController extends BaseController
{

    /**
     * $this->data() - vine din BaseController cu chestii comune (breadcrumb, meniu, ....)
     */
    public function getGrid()
    {
        $this->makeNavigation();
        return
            view('superadmin.nomenclatoare.categories.grid.index')
                ->with( $this->data('Categorii de fisiere', 'pentru filtrare') )
                ->withGrid( (new Grid())->parameters( Input::all()) )
                ->withToolbar( str_replace([Chr(13), Chr(10), Chr(9)], '', view('superadmin.nomenclatoare.categories.grid.toolbar')->withActionRoute(\URL::route('superadmin.nomenclatoare.categories.get-action-form', ['action' => 'insert']))->render()) )
                ->withIcon(NULL)
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
                ->route(\URL::route('superadmin.nomenclatoare.categories-do-action', ['action' => $action, 'id' => $id]))
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
        $action = (new Action($action, $id))->data(Input::get('data'));
        return \Response::json($action->commit());
    }

}