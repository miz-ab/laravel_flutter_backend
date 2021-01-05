<?php

use Illuminate\Http\Request;
Use App\Article;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/articles', 'ArticleController@index');
Route::get('/articles/{id}', 'ArticleController@show');
Route::post('/articles', 'ArticleController@create');
Route::put('/articles/{id}', 'ArticleController@update');
Route::delete('/articles/{id}', 'ArticleController@delete');

