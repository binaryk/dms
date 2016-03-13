<?php

namespace App\Http\Controllers\Posts;
use App\Http\Controllers\Basic\BaseController;
use App\Models\FileStructure;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
    public function index()
    {
        $this->makeNavigation();
        return view('posts.index')
            ->with( $this->data('Posturi') );
    }

}
