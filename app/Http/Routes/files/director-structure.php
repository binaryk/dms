<?php
Route::group(['middleware' => 'auth'], function() {
    Route::get('file-structure',
        'Directors\DirectorStructureController@index')
        ->name('file_structure.index');

    Route::post('api/file-structure-post',
        'Directors\DirectorStructureController@storeDir')
        ->name('file_structure_store');

    Route::post('api/file-structure-remvoe',
        'Directors\DirectorStructureController@remove')
        ->name('file_structure_remove');

    Route::post('api/file-structure-sync',
        'Directors\DirectorStructureController@sync')
        ->name('file_structure_sync');

    Route::get('api/file-structure-get',
        'Directors\DirectorStructureController@get')
        ->name('file_structure_get');
});