<?php

use Illuminate\Support\Facades\Route;

//LOGIN
Route::get('/', 'AuthenticateController@index')->name('login');
Route::post('/login', 'AuthenticateController@login');

Route::get('/register', 'AuthenticateController@register')->name('register');
Route::post('/register', 'UserController@store');

//reserva
Route::get('/reservar', 'ExternalController@index');
Route::get('/listar-quadras', 'ExternalController@listCourts');
Route::get('/listar-dias-disponiveis/{id}', 'ExternalController@listWeekDays');
Route::get('/listar-horarios-disponiveis/{id}/{week_day}/{day}', 'ExternalController@listAvailableDayTimes');
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
    Route::get('/quadra/listar', 'CourtController@list');
    Route::post('/quadra/cadastrar', 'CourtController@store');
    Route::put('/quadra/editar', 'CourtController@update');
    Route::delete('/quadra/deletar', 'CourtController@destroy');

    //dias disponiveis
    Route::get('/datas-disponiveis/listar/{id}', 'AvailableDateController@list');
    Route::post('/datas-disponiveis/cadastrar', 'AvailableDateController@store');
    Route::delete('/datas-disponiveis/deletar', 'AvailableDateController@destroy');

    //reservas
    Route::get('/reservas', 'ReservationController@index');
    Route::get('/reservas/listar', 'ReservationController@list');
    Route::put('/reservas/change-status', 'ReservationController@changeStatus');

    // contratos
    Route::get('/contratos/listar/{id_student}', 'ContractController@list');
    Route::post('/contratos/cadastrar', 'ContractController@store');
    Route::delete('/contratos/cancelar', 'ContractController@destroy');
    
    // faturas
    Route::get('/faturas/listar/{id_student}', 'InvoiceController@listNextOpen');
    Route::get('/faturas/listar-recebidas/{id_student}', 'InvoiceController@listReceivedsByStudent');
    Route::get('/faturas/listar-entradas-por-mes', 'InvoiceController@listReceivedByMonth');
    Route::put('/faturas/receber', 'InvoiceController@receive');
    Route::post('/faturas/cadastrar', 'InvoiceController@store');
    Route::put('/faturas/editar', 'InvoiceController@update');
    Route::delete('/faturas/cancelar', 'InvoiceController@destroy');
    
    // tipos faturas
    Route::get('/tipos-faturas', 'InvoiceTypeController@index');
    Route::get('/tipos-faturas/listar', 'InvoiceTypeController@list');
    Route::post('/tipos-faturas/cadastrar', 'InvoiceTypeController@store');
    Route::put('/tipos-faturas/editar', 'InvoiceTypeController@update');
    Route::delete('/tipos-faturas/deletar', 'InvoiceTypeController@destroy');

    // planos
    Route::get('/planos', 'PlanController@index');
    Route::get('/planos/listar', 'PlanController@list');
    Route::post('/planos/cadastrar', 'PlanController@store');
    Route::put('/planos/editar', 'PlanController@update');
    Route::delete('/planos/deletar', 'PlanController@destroy');

    // aulas programadas
    Route::get('/aulas-programadas', 'ScheduledClassesController@index');
    Route::get('/aulas-programadas/listar/{id}', 'ScheduledClassesController@list');
    Route::get('/aulas-programadas/buscar', 'ScheduledClassesController@search');
    Route::post('/aulas-programadas/cadastrar', 'ScheduledClassesController@store');
    Route::delete('/aulas-programadas/deletar', 'ScheduledClassesController@destroy');
    
    // aulas programadas resultado
    Route::get('/aulas-programadas-resultado/listar/{id}', 'ScheduledClassesResultController@list');
    Route::post('/aulas-programadas-resultado/cadastrar', 'ScheduledClassesResultController@store');

    //alunos
    Route::get('/alunos', 'UserController@student');
    Route::get('/alunos/exibir/{id}', 'UserController@showStudent');
    Route::get('/alunos/encontrar', 'UserController@findStudent');
    Route::get('/alunos/listar', 'UserController@listStudent');
    Route::get('/alunos/listar-totais', 'UserController@listStudentTotal');
    Route::get('/alunos/buscar', 'UserController@searchStudent');
    Route::post('/alunos/cadastrar', 'UserController@storeStudent');
    Route::put('/alunos/editar', 'UserController@updateStudent');
    Route::put('/alunos/mudar-status', 'UserController@changeStatus');
    Route::delete('/alunos/deletar', 'UserController@destroy');

    //responsáveis
    Route::get('/responsaveis', 'UserController@responsible');
    Route::post('/responsaveis/cadastrar', 'UserController@storeResponsible');
    Route::get('/responsaveis/listar', 'UserController@listResponsible');
    Route::put('/responsaveis/editar', 'UserController@updateResponsible');
    Route::delete('/responsaveis/deletar', 'UserController@destroy');

    //funcionarios
    Route::get('/funcionarios', 'UserController@employee');
    Route::post('/funcionarios/cadastrar', 'UserController@storeEmployee');
    Route::get('/funcionarios/listar', 'UserController@listEmployee');
    Route::put('/funcionarios/editar', 'UserController@updateEmployee');
    Route::delete('/funcionarios/deletar', 'UserController@destroy');

    // entradas
    Route::get('/entradas', 'EntryController@index');
    Route::get('/entradas/listar', 'EntryController@list');

    // despesas
    Route::get('/despesas', 'ExpenseController@index');
    Route::get('/despesas/listar', 'ExpenseController@list');
    Route::post('/despesas/cadastrar', 'ExpenseController@store');
    Route::put('/despesas/pagar', 'ExpenseController@pay');
    Route::delete('/despesas/deletar', 'ExpenseController@destroy');

    //centro de custo
    Route::get('/centros-de-custo', 'CostCenterController@index');
    Route::get('/centros-de-custo/listar', 'CostCenterController@list');
    Route::post('/centros-de-custo/cadastrar', 'CostCenterController@store');
    Route::put('/centros-de-custo/editar', 'CostCenterController@update');
    Route::delete('/centros-de-custo/deletar', 'CostCenterController@destroy');

    //subtipos de centro de custo
    Route::get('/subtipos-de-centros-de-custo/listar', 'CostCenterSubtypeController@list');
    Route::post('/subtipos-de-centros-de-custo/cadastrar', 'CostCenterSubtypeController@store');
    Route::delete('/subtipos-de-centros-de-custo/deletar', 'CostCenterSubtypeController@destroy');

    //métodos de pagamento
    Route::get('/metodos-de-pagamento', 'PaymentMethodController@index');
    Route::get('/metodos-de-pagamento/listar', 'PaymentMethodController@list');
    Route::post('/metodos-de-pagamento/cadastrar', 'PaymentMethodController@store');
    Route::put('/metodos-de-pagamento/editar', 'PaymentMethodController@update');
    Route::delete('/metodos-de-pagamento/deletar', 'PaymentMethodController@destroy');

    //subtipos de métodos de pagamento
    Route::get('/subtipos-de-metodos-de-pagamento/listar', 'PaymentMethodSubtypeController@list');
    Route::post('/subtipos-de-metodos-de-pagamento/cadastrar', 'PaymentMethodSubtypeController@store');
    Route::delete('/subtipos-de-metodos-de-pagamento/deletar', 'PaymentMethodSubtypeController@destroy');

    //subtipos de métodos de pagamento
    Route::get('/condicoes-de-subtipos-de-metodos-de-pagamento/listar', 'PaymentMethodSubtypeConditionController@list');
    Route::post('/condicoes-de-subtipos-de-metodos-de-pagamento/cadastrar', 'PaymentMethodSubtypeConditionController@store');

    //telefones
    Route::get('/telefones/listar', 'PhoneController@list');

    //feriados
    Route::get('/feriados', 'HolidayController@index');
    Route::get('/feriados/listar', 'HolidayController@list');
    Route::post('/feriados/cadastrar', 'HolidayController@store');
    Route::put('/feriados/editar', 'HolidayController@update');
    Route::delete('/feriados/deletar', 'HolidayController@destroy');

    //interesses
    Route::get('/interesses', 'InterestController@index');
    Route::get('/interesses/listar', 'InterestController@list');
    Route::post('/interesses/cadastrar', 'InterestController@store');
    Route::put('/interesses/editar', 'InterestController@update');
    Route::put('/interesses/editar-status', 'InterestController@updateStatus');
    Route::put('/interesses/marcar-avaliacao', 'InterestController@markAvaliation');
    Route::delete('/interesses/deletar', 'InterestController@destroy');

    //debitos
    // Route::get('/debitos', 'DebtController@index');
    Route::get('/debitos/listar', 'DebtController@list');
    Route::post('/debitos/cadastrar', 'DebtController@store');
    Route::put('/debitos/receber', 'DebtController@receive');
    Route::delete('/debitos/deletar', 'DebtController@destroy');
});