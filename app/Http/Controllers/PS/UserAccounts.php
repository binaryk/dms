<?php namespace App\Http\Controllers\PS;

use \App\Http\Controllers\Basic\BaseController;
use Illuminate\Support\Facades\Input;

use App\Repositories\Superadmin\PS\CategoriiParteneri\Grid;
use App\Repositories\Superadmin\PS\CategoriiParteneri\Rows;
use App\Repositories\Superadmin\PS\CategoriiParteneri\Form;
use App\Repositories\Superadmin\PS\CategoriiParteneri\Action;

class UserAccountsController extends BaseController
{

    /**
     * $this->data() - vine din BaseController cu chestii comune (breadcrumb, meniu, ....)
     */
    public function getGrid()
    {
        $this->makeNavigation();

        return
            view('superadmin.nomenclatoare.categorii-parteneri.grid.index')
                ->with( $this->data() )
                ->withGrid( (new Grid())->parameters( Input::all()) )
                ->withToolbar( str_replace([Chr(13), Chr(10), Chr(9)], '', view('superadmin.nomenclatoare.categorii-parteneri.grid.toolbar')->withActionRoute(\URL::route('superadmin.nomenclatoare.categorii-parteneri.get-action-form', ['action' => 'insert']))->render()) )
                ->withIcon(NULL)
                ->withCaption('Categorii parteneri')
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
                ->route(\URL::route('superadmin.nomenclatoare.categorii-parteneri-do-action', ['action' => $action, 'id' => $id]))
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