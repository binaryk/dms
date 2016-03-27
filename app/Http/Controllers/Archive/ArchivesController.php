<?php namespace App\Http\Controllers\Archive;

use \App\Http\Controllers\Basic\BaseController;
use App\Models\Archive;
use Illuminate\Support\Facades\Input;

use App\Repositories\Archives\Grid;
use App\Repositories\Archives\Rows;
use App\Repositories\Archives\Form;
use App\Repositories\Archives\Action;

class ArchivesController extends BaseController
{

    /**
     * $this->data() - vine din BaseController cu chestii comune (breadcrumb, meniu, ....)
     */
    public function getGrid()
    {
        $this->makeNavigation();
        $grid = (new Grid())
            ->parameters( Input::all() )
            ->setUrl();

        return
            view('archives.grid.index')
                ->with( $this->data('Arhivele dvs din sistem.') )
                ->withBack( route('archives.index') )
                ->withGrid( $grid )
                ->withToolbar( null )
                ->withIcon(NULL)
                ->withDescription(NULL)
            ;
    }

    /*
     * Generarea inregistrari pentru Grid
     */
    public function dataSource()
    {
        return (new Rows())->parameters(Input::all())->postAddCells()->response();
    }

    /*
     * Trimite catre index formularul "actions"
     */
    public function getActionForm($action,  $id = NULL)
    {
        $form =
            (new Form($action, $id))
                ->route(\URL::route('archives-do-action', ['action' => $action, 'id' => $id]))
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
    public function doAction($action, $id = NULL )
    {
        $arch = Archive::find($id);
        $data = Input::except('file');
        $actionObject = (new Action($action, $id))->data($data);
        $res = $actionObject->commit();
        return \Response::json($res);
    }

}