<?php

Route::get("/", "NewsController@index");
Route::post("/news/search", "NewsController@search");
Route::post("/news/{news}/comments/search", "NewsCommentsController@search");

Route::get('/news/top', "NewsController@top");

Route::resource("news", "NewsController");

Route::resource("news.comments", "NewsCommentsController");

Route::bind('news', function ($value, $route){
    return App\News::whereSlug($value)->first();
});

Route::bind('comments', function($value, $route){
   return App\Comment::whereSlug($value)->first();
});

Route::get("/news/{news}/upvote", "NewsController@upvote");
Route::get("/news/{news}/downvote", "NewsController@downvote");