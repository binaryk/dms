<?php

Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'PS'], function() {
        Route::get('ps/accounts', 'AccountsController@index')->name('ps.accounts.index');
    });

    Route::get('ps/user-accounts', 'UserAccounts@getGrid')
        ->name('ps.user-accounts.index');

    Route::post('ps/user-accounts-source', 'UserAccounts@dataSource')
        ->name('ps.user-accounts.data-source');

    /*
     * Sa se incarce formularul de actiun (actions form)
     */
    Route::post('ps/user-accounts-get-action-form/{action}/{id?}', 'UserAccounts@getActionForm')
        ->name('ps.user-accounts.get-action-form');

    /*
     * ce se intampla la Adauga/Salveaza/Sterge
     */
    Route::post('ps/user-accounts-action/{action}/{id?}', 'UserAccounts@doAction')
        ->name('ps.user-accounts-do-action');
});