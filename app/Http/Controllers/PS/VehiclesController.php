<?php namespace App\Http\Controllers\PS;

use \App\Http\Controllers\Basic\BaseController;
use App\Models\PS\Vehicle;
use Illuminate\Support\Facades\Input;

use App\Repositories\PS\Vehicles\Grid;
use App\Repositories\PS\Vehicles\Rows;
use App\Repositories\PS\Vehicles\Form;
use App\Repositories\PS\Vehicles\Action;

class VehiclesController extends BaseController
{
    protected $admin;
    /**
     * $this->data() - vine din BaseController cu chestii comune (breadcrumb, meniu, ....)
     */
    public function getGrid()
    {
        $this->admin = access()->user()->hasRole('Administrator');

        $this->makeNavigation();
        return
            view('ps.vehicles.grid.index')
                ->with( $this->data( $this->admin ? 'CRUD vehicles' : 'View vehicles') )
                ->withGrid( (new Grid())->parameters( Input::all())->withParameter('admin', $this->admin) )
                ->withToolbar(  $this->admin ? str_replace([Chr(13), Chr(10), Chr(9)], '', view('ps.vehicles.grid.toolbar')
                                            ->withActionRoute( \URL::route('ps.vehicles.get-action-form', ['action' => 'insert']) )->render()) : null )
                ->withIcon(NULL)
                ->withDescription(NULL)
            ;
    }

    /*
     * Generarea inregistrari pentru Grid
     */
    public function dataSource()
    {
        $this->admin =  access()->user()->hasRole('Administrator');

        return
            (new Rows())
            ->parameters(Input::all())
            ->postAddCell()
            ->addParameter('admin',$this->admin)->response();
    }

    /*
     * Trimite catre index formularul "actions"
     */
    public function getActionForm($action, $id = NULL)
    {
        $this->admin =  access()->user()->hasRole('Administrator');

        $form =
            (new Form($action, $id))
                ->setParameter('admin', $this->admin)
                ->route(\URL::route('ps.vehicles-do-action', ['action' => $action, 'id' => $id]))
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