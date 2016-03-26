<?php namespace App\Http\Controllers\Basic;

use App\Models\File;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends BaseController
{

    public function index()
    {
    	$this->makeNavigation();
        $fielCount = File::count();
        return view('basic.welcome.index', $this->data(access()->user() ? trans('messages.welcome.auth') : trans('messages.welcome.guest')))
                ->withFileCount($fielCount)
                ->withStorage(File::storage());
    }
   
}
