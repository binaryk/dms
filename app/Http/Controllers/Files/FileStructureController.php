<?php

namespace App\Http\Controllers\Files;
use App\Http\Controllers\Basic\BaseController;
use App\Models\FileStructure;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FileStructureController extends BaseController
{
    public function index()
    {
        /*$root = FileStructure::find(2);
        $B = FileStructure::create(['name' => 'B', 'type' => 'folder']);
        $B->makeChildOf($root);
        dd($root->descendants());
        return $root;*/

        $this->makeNavigation();
        return view('file-structure.index')
               ->with( $this->data() );
    }

}
