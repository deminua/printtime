<?php


Route::group(['middleware' => ['web']], function () {
	Route::resource('product', 'ProductController');
	Route::post('img/{id}/upload', ['as' => 'img.upload', 'uses' => 'ImgController@upload']);

	#Route::get('/home', 'HomeController@index');

	Route::get('/', function () {     
	    return view('welcome');
	});


});


Route::group(['middleware' => 'web'], function () {
	Route::auth();
	#Route::get(...
});
