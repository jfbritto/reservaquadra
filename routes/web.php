<?php

use Illuminate\Support\Facades\Route;

//LOGIN
Route::get('/', 'AuthenticateController@index')->name('login');
Route::post('/login', 'AuthenticateController@login');

Route::get('/register', 'AuthenticateController@register')->name('register');
Route::post('/register', 'UserController@store');

//reserva
Route::get('/reservar', 'ExternalController@index');
Route::post('/listar-quadras', 'ExternalController@listCourts');
Route::post('/listar-dias-disponiveis/{id}', 'ExternalController@listWeekDays');
Route::post('/listar-horarios-disponiveis/{id}/{week_day}/{day}', 'ExternalController@listAvailableDayTimes');
Route::post('/reservar-horario', 'ExternalController@store');

Route::group(['middleware' => ['admin']], function(){

    //logout
    Route::post('/logout', 'AuthenticateController@logout');

    //home
    Route::get('/home', 'HomeController@index');
    Route::get('/home/all', 'HomeController@all');

    //calendario
    Route::get('/calendario', 'CalendarController@index');
    Route::get('/calendario/carregar', 'CalendarController@load');

    //quadra
    Route::get('/quadras', 'CourtController@index');
    Route::post('/quadra/cadastrar', 'CourtController@store');
    Route::get('/quadra/listar', 'CourtController@list');
    Route::post('/quadra/editar', 'CourtController@update');
    Route::post('/quadra/deletar', 'CourtController@destroy');

    //dias disponiveis
    Route::get('/datas-disponiveis/listar/{id}', 'AvailableDateController@list');
    Route::post('/datas-disponiveis/cadastrar', 'AvailableDateController@store');
    Route::post('/datas-disponiveis/deletar', 'AvailableDateController@destroy');

    //reservas
    Route::get('/reservas', 'ReservationController@index');
    Route::get('/reservas/listar', 'ReservationController@list');
    Route::post('/reservas/change-status', 'ReservationController@changeStatus');

    // contratos
    Route::get('/contratos/listar/{id_student}', 'ContractController@list');
    Route::post('/contratos/cadastrar', 'ContractController@store');
    Route::post('/contratos/cancelar', 'ContractController@destroy');
    
    // faturas
    Route::get('/faturas/listar/{id_student}', 'InvoiceController@listNextOpen');
    Route::post('/faturas/receber', 'InvoiceController@receive');
    Route::get('/faturas/listar-entradas-por-mes', 'InvoiceController@listReceivedByMonth');
    
    // planos
    Route::get('/planos', 'PlanController@index');
    Route::get('/planos/listar', 'PlanController@list');
    Route::post('/planos/cadastrar', 'PlanController@store');
    Route::post('/planos/editar', 'PlanController@update');
    Route::post('/planos/deletar', 'PlanController@destroy');

    // aulas programadas
    Route::get('/aulas-programadas', 'ScheduledClassesController@index');
    Route::get('/aulas-programadas/buscar', 'ScheduledClassesController@search');
    Route::post('/aulas-programadas/cadastrar', 'ScheduledClassesController@store');
    Route::get('/aulas-programadas/listar/{id}', 'ScheduledClassesController@list');
    Route::post('/aulas-programadas/deletar', 'ScheduledClassesController@destroy');
    
    // aulas programadas resultado
    Route::post('/aulas-programadas-resultado/cadastrar', 'ScheduledClassesResultController@store');
    Route::get('/aulas-programadas-resultado/listar/{id}', 'ScheduledClassesResultController@list');

    //alunos
    Route::get('/alunos', 'UserController@student');
    Route::get('/alunos/exibir/{id}', 'UserController@showStudent');
    Route::get('/alunos/encontrar', 'UserController@findStudent');
    Route::get('/alunos/listar', 'UserController@listStudent');
    Route::post('/alunos/cadastrar', 'UserController@storeStudent');
    Route::post('/alunos/editar', 'UserController@updateStudent');
    Route::get('/alunos/buscar', 'UserController@searchStudent');
    Route::post('/alunos/deletar', 'UserController@destroy');

    //responsáveis
    Route::get('/responsaveis', 'UserController@responsible');
    Route::post('/responsaveis/cadastrar', 'UserController@storeResponsible');
    Route::get('/responsaveis/listar', 'UserController@listResponsible');
    Route::post('/responsaveis/editar', 'UserController@updateResponsible');
    Route::post('/responsaveis/deletar', 'UserController@destroy');

    //funcionarios
    Route::get('/funcionarios', 'UserController@employee');
    Route::post('/funcionarios/cadastrar', 'UserController@storeEmployee');
    Route::get('/funcionarios/listar', 'UserController@listEmployee');
    Route::post('/funcionarios/editar', 'UserController@updateEmployee');
    Route::post('/funcionarios/deletar', 'UserController@destroy');

    // entradas
    Route::get('/entradas', 'EntryController@index');
    Route::get('/entradas/listar', 'EntryController@list');

    // despesas
    Route::get('/despesas', 'ExpenseController@index');
    Route::post('/despesas/cadastrar', 'ExpenseController@store');
    Route::get('/despesas/listar', 'ExpenseController@list');
    Route::post('/despesas/deletar', 'ExpenseController@destroy');

    //centro de custo
    Route::get('/centros-de-custo', 'CostCenterController@index');
    Route::post('/centros-de-custo/cadastrar', 'CostCenterController@store');
    Route::get('/centros-de-custo/listar', 'CostCenterController@list');
    Route::post('/centros-de-custo/editar', 'CostCenterController@update');
    Route::post('/centros-de-custo/deletar', 'CostCenterController@destroy');

    //subtipos de centro de custo
    Route::get('/subtipos-de-centros-de-custo/listar', 'CostCenterSubtypeController@list');
    Route::post('/subtipos-de-centros-de-custo/cadastrar', 'CostCenterSubtypeController@store');
    Route::post('/subtipos-de-centros-de-custo/deletar', 'CostCenterSubtypeController@destroy');
});