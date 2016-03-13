<?php

Route::group(['middleware' => 'web'], function() {
    Route::group(['namespace' => 'Language'], function () {
        require (__DIR__ . '/Routes/Language/Language.php');
    });
    Route::group(['namespace' => 'Frontend'], function () {
        require (__DIR__ . '/Routes/Frontend/Frontend.php');
        require (__DIR__ . '/Routes/Frontend/Access.php');
    });
});
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    require (__DIR__ . '/Routes/Backend/Dashboard.php');
    require (__DIR__ . '/Routes/Backend/Access.php');
    require (__DIR__ . '/Routes/Backend/LogViewer.php');
});

Route::group(['namespace' => 'Files'], function(){
   Route::get('file-structure','FileStructureController@index')->name('file_structure.index');
});
foreach(Config::get('routes.files') as $i => $file)
{
    require( str_replace('\\', '/', app_path()) . '/Http/Routes/' . $file) ;
}
