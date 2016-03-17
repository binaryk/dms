<?php
Route::get('file-structure',
    'Files\FileStructureController@index')
    ->name('file_structure.index');

Route::post('api/file-structure-post',
    'Files\FileStructureController@storeDir')
    ->name('file_structure_store');

Route::post('api/file-structure-remvoe',
    'Files\FileStructureController@remove')
    ->name('file_structure_remove');

Route::get('api/file-structure-get',
    'Files\FileStructureController@get')
    ->name('file_structure_get');