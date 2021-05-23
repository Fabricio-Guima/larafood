<?php

//ROTAS ADMIN DE PLANOS
Route::prefix('admin')
        ->namespace('Admin')
        ->group(function(){

Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');



            //Rotas de plano 
Route::get('plans/create', 'PlanController@create')->name('plans.create');
Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
Route::get('plans/edit/{url}', 'PlanController@edit')->name('plans.edit');
Route::any('plans/search', 'PlanController@search')->name('plans.search');
Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
Route::post('plans', 'PlanController@store')->name('plans.store');
Route::get('plans', 'PlanController@index')->name('plans.index');



Route::get('/', 'Admin\PlanController@index')->name('admin.index');
});




Route::get('/', function () {
    return view('welcome');
});
