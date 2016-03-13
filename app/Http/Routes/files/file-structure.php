<?php
Route::get('file-structure',
    'Files\FileStructureController@index')
    ->name('file_structure.index');