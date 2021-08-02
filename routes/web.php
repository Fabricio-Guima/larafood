<?php

//ROTAS ADMIN DE PLANOS
Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function(){



//Plan x Profile

//vincular permissão a um perfil
Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');

Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');


Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');

Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');

//listar todos os plans que tem x permissão
Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');





//Permission x Profile

//vincular permissão a um perfil
Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');

Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');


Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');

Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');

//listar todos os profiles que tem x permissão
Route::get('permissions/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profile');








//rota de Permissions (permissões)
Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
Route::resource('permissions', 'ACL\PermissionController');    



//rota de Profiles (perfis)
Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
Route::resource('profiles', 'ACL\ProfileController');


//rota de detalhes do plano
// create view
Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
//delete
Route::delete('plans/{urlPlan}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
//show
Route::get('plans/{urlPlan}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
//update
Route::put('plans/{urlPlan}/details/{idDetail}/update', 'DetailPlanController@update')->name('details.plan.update'); 
//edit view
Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');    
//store 
Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');

//index todos os detalhes de um plano x
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



Route::get('/', 'PlanController@index')->name('admin.index');
});


Route::get('/', function () {
    return view('welcome');
});

//autenticação
Auth::routes();


