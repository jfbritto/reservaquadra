@extends('adminlte::page')

@section('title', 'Despesas')

@section('content_header')
    <h1><i class="fas fa-comment-dollar"></i> &nbsp;Despesas</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStorePlan">
                <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStorePlan">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Plano</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStorePlan">
                    <div class="row">
                        <!-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome do plano">
                            </div>
                        </div> -->
                        <input type="hidden" required name="name" id="name" class="form-control" placeholder="Informe o nome do plano">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age_range">Faixa etária</label>
                                <select required name="age_range" id="age_range" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Infantil</option>
                                    <option value="2">Juvenil</option>
                                    <option value="3">Adulto</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="day_period">Período do dia</label>
                                <select required name="day_period" id="day_period" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Diurno</option>
                                    <option value="2">Noturno</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lessons_per_week">Aulas por semana</label>
                                <select required name="lessons_per_week" id="lessons_per_week" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="months">Período contrato</label>
                                <select required name="months" id="months" class="form-control">
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
                                <label for="price" id="price_label">Valor mensal</label>
                                <input type="text" required name="price" id="price" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStorePlan">Salvar</button>
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
                        <!-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="hidden" required name="id_edit" id="id_edit" class="form-control">
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do plano">
                            </div>
                        </div> -->
                        <input type="hidden" required name="id_edit" id="id_edit" class="form-control">
                        <input type="hidden" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do plano">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age_range_edit">Faixa etária</label>
                                <select required name="age_range_edit" id="age_range_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Infantil</option>
                                    <option value="2">Juvenil</option>
                                    <option value="3">Adulto</option>
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

@stop

@section('js')
    <script src="/js/expense/home.js"></script>
@stop