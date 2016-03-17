<?php

namespace App\Http\Controllers\PS;
use App\Http\Controllers\Basic\BaseController;

use App\Http\Controllers\Controller;
use App\Models\PS\UserAccounts;
use Illuminate\Support\Facades\Auth;

class AccountsController extends BaseController
{
    public function index()
    {
        $this->makeNavigation();
        $accounts = UserAccounts::where('user_id', access()->user()->id)->get();
        return view('ps.user.accounts.index')
            ->with( $this->data('UserAccounts') )
            ->with(compact('accounts'));
    }

}
