<?php namespace App\Http\Controllers\Basic;

use Illuminate\Support\Facades\Auth;

class WelcomeController extends BaseController
{

    public function index()
    {
    	$this->makeNavigation();
        return view('basic.welcome.index', $this->data(access()->user() ? trans('messages.welcome.auth') : trans('messages.welcome.guest')));
    }
   
}
