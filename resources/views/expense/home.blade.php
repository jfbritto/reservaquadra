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
                <div class="col-md-10">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="date-ini" style="padding-right: 15px;">De</label>
                            <input type="date" class="form-control" name="date-ini" id="date-ini" value="{{date('Y-m-01')}}">
                        </div>
                        <div class="form-group mx-sm-3">
                            <label for="date-end" style="padding-right: 15px;">a</label>
                            <input type="date" class="form-control" name="date-end" id="date-end" value="{{date('Y-m-t')}}">
                        </div>
                        <div class="form-group mx-sm-3">
                            <input type="text" class="form-control" name="provider_search" id="provider_search" placeholder="Fornecedor">
                        </div>
                        <div class="form-group mx-sm-3">
                            <input type="text" class="form-control" name="cost_center_search" id="cost_center_search" placeholder="Centro de custo">
                        </div>
                        <div class="form-group mx-sm-3">
                            <a href="#" class="btn btn-primary" id="search">Buscar</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 text-right">
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreExpense" style="margin-top: 1px;" title="Cadastrar nova despesa">
                        <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm" id="table">
                    <thead>
                        <tr>
                            <th>Vencimento</th>
                            <th title="Pagamento">Pagto</th>
                            <th title="Fornecedor">Forn.</th>
                            <th style="min-width: 200px;">Centro de custo</th>
                            <th style="min-width: 200px;">Subtipo</th>
                            <th style="min-width: 120px;">Valor</th>
                            <th>Observação</th>
                            <th>Status</th>
                            <th style="width: 220px;"></th>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_provider">Fornecedor</label>
                                <select name="id_provider" id="id_provider" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_cost_center">Centro de custo</label>
                                <select required name="id_cost_center" id="id_cost_center" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditExpense">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Despesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditExpense">
                    <input type="hidden" name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date_edit">Vencimento</label>
                                <input type="date" required name="due_date_edit" id="due_date_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_edit">Valor</label>
                                <input type="text" required name="price_edit" id="price_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_provider_edit">Fornecedor</label>
                                <select name="id_provider_edit" id="id_provider_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_cost_center_edit">Centro de custo</label>
                                <select required name="id_cost_center_edit" id="id_cost_center_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_cost_center_subtype_edit">Subtipo</label>
                                <select required name="id_cost_center_subtype_edit" id="id_cost_center_subtype_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observation_edit">Observação</label>
                                <textarea name="observation_edit" id="observation_edit" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditExpense">Salvar</button>
            </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="modalDuplicateExpense">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Duplicar Despesa</h5>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_provider_duplicate">Fornecedor</label>
                                <select name="id_provider_duplicate" id="id_provider_duplicate" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_cost_center_duplicate">Centro de custo</label>
                                <select required name="id_cost_center_duplicate" id="id_cost_center_duplicate" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
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