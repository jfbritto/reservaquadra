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
Route::post('/listar-horarios-disponiveis/{id}/{week_day}/{day}', 'ExternalController@list_available_day_times');
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
    Route::post('/reservas/change-status', 'ReservationController@change_status');

    
    // contratos
    Route::get('/contratos/listar/{id_student}', 'ContractController@list');
    Route::post('/contratos/cadastrar', 'ContractController@store');
    
    // faturas
    Route::get('/faturas/listar/{id_student}', 'InvoiceController@list');
    
    // planos
    Route::get('/planos/listar', 'PlanController@list');

    //alunos
    Route::get('/alunos', 'UserController@student');
    Route::get('/alunos/exibir/{id}', 'UserController@show_student');
    Route::get('/alunos/encontrar', 'UserController@find_student');
    Route::post('/alunos/listar', 'UserController@list_student');
    Route::post('/alunos/cadastrar', 'UserController@store_student');
    Route::post('/alunos/editar', 'UserController@update_student');
    Route::post('/alunos/deletar', 'UserController@destroy');

    //funcionarios
    Route::get('/funcionarios', 'UserController@employee');
    Route::post('/funcionarios/listar', 'UserController@list_employee');
    Route::post('/funcionarios/cadastrar', 'UserController@store_employee');
    Route::post('/funcionarios/editar', 'UserController@update_employee');
    Route::post('/funcionarios/deletar', 'UserController@destroy');

});