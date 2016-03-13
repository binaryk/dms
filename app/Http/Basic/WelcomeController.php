<?php namespace App\Http\Controllers\Basic;

class WelcomeController extends BaseController
{

    public function index()
    {
    	$this->makeNavigation();

        return view('basic.welcome.index', $this->data(trans('messages.welcome.guest')));
    }
   
}
