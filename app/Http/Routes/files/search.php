<?php

Route::group(['namespace' => 'Search'], function () {

    Route::get('search', 'SearchController@getGrid')
        ->name('search.index');

    Route::post('search-source', 'SearchController@dataSource')
        ->name('search.data-source');

    /*
     * Sa se incarce formularul de actiun (actions form)
     */
    Route::post('search-get-action-form/{action}/{id?}', 'SearchController@getActionForm')
        ->name('search.get-action-form');

    /*
     * ce se intampla la Adauga/Salveaza/Sterge
     */
    Route::post('search-action/{action}/{id?}', 'SearchController@doAction')
        ->name('search-do-action');
});