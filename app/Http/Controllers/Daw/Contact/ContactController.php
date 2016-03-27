<?php namespace App\Http\Controllers\Daw\Contact;

use App\Http\Controllers\Basic\BaseController;

class ContactController extends BaseController
{

    public function index()
    {
        $this->makeNavigation();
        return view('daw.contact.index', $this->data(trans('messages.welcome.contact')));
    }

}
