<?php

use Illuminate\Support\Facades\Route;

//LOGIN
Route::get('/login', 'AuthenticateController@index')->name('login');
Route::post('/login', 'AuthenticateController@login');

Route::get('/register', 'AuthenticateController@register')->name('register');
Route::post('/register', 'UserController@store');

//reserva
Route::get('/', 'ExternalController@index');
Route::post('/listar-quadras', 'ExternalController@list_courts');
Route::post('/listar-dias-disponiveis/{id}', 'ExternalController@list_week_days');
Route::post('/listar-horarios-disponiveis/{id}/{day}', 'ExternalController@list_available_day_times');
Route::post('/reservar-horario', 'ExternalController@store');

Route::group(['middleware' => ['auth']], function(){

    //logout
    Route::post('/logout', 'AuthenticateController@logout');

    //quadra
    Route::get('/quadras', 'CourtController@index');
    Route::post('/quadra/cadastrar', 'CourtController@store');
    Route::post('/quadra/listar', 'CourtController@list');
    Route::post('/quadra/editar', 'CourtController@update');
    Route::post('/quadra/deletar', 'CourtController@destroy');

    //dias disponiveis
    Route::post('/datas-disponiveis/listar/{id}', 'AvailableDateController@list');
    Route::post('/datas-disponiveis/cadastrar', 'AvailableDateController@store');
    Route::post('/datas-disponiveis/deletar', 'AvailableDateController@destroy');

    //reservas
    Route::get('/reservas', 'ReservationController@index');
    Route::post('/reservas/listar', 'ReservationController@list');

});