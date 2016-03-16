<?php
Route::get('file-structure',
    'Files\FileStructureController@index')
    ->name('file_structure.index');

Route::post('api/file-structure-post',
    'Files\FileStructureController@storeDir')
    ->name('file_structure_store');

Route::get('api/file-structure-get',
    'Files\FileStructureController@get')
    ->name('file_structure_get');