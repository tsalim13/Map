<?php
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => 'prevent-back-history'],function(){
	Route::group(['middleware' => 'auth'], function () {
		Route::post('download_emp','ExportPdfController@export_pdf');
		Route::get('locations', 'LocationsController@locationListe');
		Route::get('locationsHist', 'LocationsHistController@locationListeHist');
		Route::resource('edit', 'MarkersController');
		Route::resource('client-edit', 'ClientsController');
		Route::resource('map-client', 'LouersController');
		Route::resource('MarkerList', 'MarkerListController');
		Route::get('etat/{n}', 'ActionsController@etatMarker');
		Route::get('etatm/{n}', 'ActionsController@getHistMarker');
		Route::get('lastId/{n}', 'ActionsController@lastFace');
		Route::get('historic/{n}', 'ActionsController@getHistoric');
		Route::get('/accueil', 'AccueilController@index');
		Route::resource('user-edit', 'UsersController');
		Route::post('destroySupport', 'TypeEmplcController@destroyS');
		Route::resource('types', 'TypeEmplcController');
		Route::resource('faces', 'facesController');
		Route::resource('photo', 'PhotoController', ['only' => ['store']]);
		Route::resource('tarif', 'TarifsController');
	});
});
