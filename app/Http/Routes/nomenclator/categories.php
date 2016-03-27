<?php

Route::group(['namespace' => 'Superadmin\Nomenclatoare'], function () {

    Route::get('superadmin/nomenclatoare/categories', 'CategoriesController@getGrid')
        ->name('superadmin.nomenclatoare.categories.index');

    Route::post('superadmin/nomenclatoare/categories-source', 'CategoriesController@dataSource')
        ->name('superadmin.nomenclatoare.categories.data-source');

    /*
     * Sa se incarce formularul de actiun (actions form)
     */
    Route::post('superadmin/nomenclatoare/categories-get-action-form/{action}/{id?}', 'CategoriesController@getActionForm')
        ->name('superadmin.nomenclatoare.categories.get-action-form');

    /*
     * ce se intampla la Adauga/Salveaza/Sterge
     */
    Route::post('superadmin/nomenclatoare/categories-action/{action}/{id?}', 'CategoriesController@doAction')
        ->name('superadmin.nomenclatoare.categories-do-action');
});