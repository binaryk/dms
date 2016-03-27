<?php namespace App\Http\Controllers\Search;

use \App\Http\Controllers\Basic\BaseController;
use App\Models\File;
use Illuminate\Support\Facades\Input;

use App\Repositories\Search\Grid;
use App\Repositories\Search\Rows;
use App\Repositories\Search\Form;
use App\Repositories\Search\Action;

class SearchController extends BaseController
{

    /**
     * $this->data() - vine din BaseController cu chestii comune (breadcrumb, meniu, ....)
     */
    public function getGrid()
    {
        $this->makeNavigation();
        return
            view('search.grid.index')
                ->with( $this->data('Cautare fisiere', 'în total sunt('.File::count().') fișiere') )
                ->withGrid( (new Grid())->parameters( Input::all()) )
                ->withToolbar( str_replace([Chr(13), Chr(10), Chr(9)], '', view('search.grid.toolbar')->withActionRoute(null)->render()) )
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
                ->route(\URL::route('search-do-action', ['action' => $action, 'id' => $id]))
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