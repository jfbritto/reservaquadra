@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Despesas')

@section('content_header')
    <h1><i class="fas fa-comment-dollar"></i> &nbsp;Despesas</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 link-student">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-comment-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total pagas</span>
                    <span class="info-box-number" id="tot-expenses-paid"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 link-student">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-comment-dollar" style="color: #fff"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total pendentes</span>
                    <span class="info-box-number" id="tot-expenses-pendent"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header border-0">
    
            <div class="row">
                <div class="col-md-6">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="date-ini" style="padding-right: 15px;">De</label>
                            <input type="date" class="form-control" name="date-ini" id="date-ini" value="{{date('Y-m-01')}}">
                        </div>
                        <div class="form-group mx-sm-3">
                            <label for="date-end" style="padding-right: 15px;">a</label>
                            <input type="date" class="form-control" name="date-end" id="date-end" value="{{date('Y-m-t')}}">
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreExpense" style="margin-top: 1px;">
                        <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Vencimento</th>
                            <th>Pagamento</th>
                            <th style="min-width: 200px;">Centro de custo</th>
                            <th style="min-width: 200px;">Subtipo</th>
                            <th style="min-width: 120px;">Valor</th>
                            <th>Observação</th>
                            <th>Status</th>
                            <th style="width: 200px;"></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreExpense">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Despesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreExpense">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date">Vencimento</label>
                                <input type="date" required name="due_date" id="due_date" class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Valor</label>
                                <input type="text" required name="price" id="price" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_cost_center">Centro de custo</label>
                                <select required name="id_cost_center" id="id_cost_center" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_cost_center_subtype">Subtipo</label>
                                <select required name="id_cost_center_subtype" id="id_cost_center_subtype" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observation">Observação</label>
                                <textarea name="observation" id="observation" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreExpense">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditPlan">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Plano</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditPlan">
                    <div class="row">
                        <input type="hidden" required name="id_edit" id="id_edit" class="form-control">
                        <input type="hidden" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do plano">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age_range_edit">Plano</label>
                                <select required name="age_range_edit" id="age_range_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Infantil</option>
                                    <option value="2">Juvenil</option>
                                    <option value="3">Adulto</option>
                                    <option value="4">Pré Equipe</option>
                                    <option value="5">Pacote de Aulas</option>
                                    <option value="6">GynPass</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="day_period_edit">Período do dia</label>
                                <select required name="day_period_edit" id="day_period_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Diurno</option>
                                    <option value="2">Noturno</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lessons_per_week_edit">Aulas por semana</label>
                                <select required name="lessons_per_week_edit" id="lessons_per_week_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="months_edit">Período contrato</label>
                                <select required name="months_edit" id="months_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Mensal</option>
                                    <option value="3">Trimestral</option>
                                    <option value="6">Semestral</option>
                                    <option value="12">Anual</option>
                                    <option value="13">Anual - (Tenis +)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_edit" id="price_edit_label">Valor mensal</label>
                                <input type="text" required name="price_edit" id="price_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditPlan">Salvar</button>
            </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="modalDuplicateExpense">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Duplicar Despeza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formDuplicateExpense">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date_duplicate">Vencimento</label>
                                <input type="date" required name="due_date_duplicate" id="due_date_duplicate" class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_duplicate">Valor</label>
                                <input type="text" required name="price_duplicate" id="price_duplicate" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_cost_center_duplicate">Centro de custo</label>
                                <select required name="id_cost_center_duplicate" id="id_cost_center_duplicate" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_cost_center_subtype_duplicate">Subtipo</label>
                                <select required name="id_cost_center_subtype_duplicate" id="id_cost_center_subtype_duplicate" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observation_duplicate">Observação</label>
                                <textarea name="observation_duplicate" id="observation_duplicate" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formDuplicateExpense">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/expense/home.js"></script>
@stop