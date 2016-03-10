<?php

namespace App\Http\Controllers\Files;
use App\Models\FileStructure;

use App\Http\Controllers\Controller;
class FileStructureController extends Controller
{
    public function index()
    {
        $root = FileStructure::find(2);
        $B = FileStructure::create(['name' => 'B', 'type' => 'folder']);
        $B->makeChildOf($root);
        dd($root->descendants());
        return $root;

        return view('frontend.index');
    }

}
