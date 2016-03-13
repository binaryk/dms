<?php

    Route::get('posts-index',[
        'as' => 'posts.index',
        'uses' => 'Posts\PostController@index',
    ]);