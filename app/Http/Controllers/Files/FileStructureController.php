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
        $this->makeNavigation();
        return view('file-structure.index')
               ->with( $this->data('Strucura de fisiere', 'aici gasiti fisierele dvs') );
    }

}
