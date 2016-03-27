<?php
Route::group(['middleware' => 'auth'], function() {
    Route::group(['namespace' => 'Archive'], function () {

        Route::get('archives', 'ArchivesController@getGrid')
            ->name('archives.index');

        Route::post('archives-source', 'ArchivesController@dataSource')
            ->name('archives.data-source');

        /*
         * Sa se incarce formularul de actiun (actions form)
         */
        Route::post('archives-get-action-form/{action}/{id?}', 'ArchivesController@getActionForm')
            ->name('archives.get-action-form');

        /*
         * ce se intampla la Adauga/Salveaza/Sterge
         */
        Route::post('archives-action/{action}/{id?}', 'ArchivesController@doAction')
            ->name('archives-do-action');
    });
});