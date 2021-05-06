@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Planos')

@section('content_header')
    <h1><i class="fas fa-puzzle-piece"></i> &nbsp;Planos</h1>
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
                            <th>Faixa etária</th>
                            <th>Período do dia</th>
                            <th>Aulas por semana</th>
                            <th>Período contrato</th>
                            <th>Valor mensal</th>
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

                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_march">Valor caso entre em março</label>
                                <input type="text" name="price_march" id="price_march" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_april">Valor caso entre em abril</label>
                                <input type="text" name="price_april" id="price_april" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_may">Valor caso entre em maio</label>
                                <input type="text" name="price_may" id="price_may" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_june">Valor caso entre em junho</label>
                                <input type="text" name="price_june" id="price_june" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_july">Valor caso entre em julho</label>
                                <input type="text" name="price_july" id="price_july" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_august">Valor caso entre em agosto</label>
                                <input type="text" name="price_august" id="price_august" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_september">Valor caso entre em setembro</label>
                                <input type="text" name="price_september" id="price_september" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_october">Valor caso entre em outubro</label>
                                <input type="text" name="price_october" id="price_october" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_november">Valor caso entre em novembro</label>
                                <input type="text" name="price_november" id="price_november" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan" style="display: none;">
                            <div class="form-group">
                                <label for="price_december">Valor caso entre em dezembro</label>
                                <input type="text" name="price_december" id="price_december" class="form-control money" placeholder="Informe o valor">
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
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_march_edit">Valor caso entre em março</label>
                                <input type="text" name="price_march_edit" id="price_march_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_april_edit">Valor caso entre em abril</label>
                                <input type="text" name="price_april_edit" id="price_april_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_may_edit">Valor caso entre em maio</label>
                                <input type="text" name="price_may_edit" id="price_may_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_june_edit">Valor caso entre em junho</label>
                                <input type="text" name="price_june_edit" id="price_june_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_july_edit">Valor caso entre em julho</label>
                                <input type="text" name="price_july_edit" id="price_july_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_august_edit">Valor caso entre em agosto</label>
                                <input type="text" name="price_august_edit" id="price_august_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_september_edit">Valor caso entre em setembro</label>
                                <input type="text" name="price_september_edit" id="price_september_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_october_edit">Valor caso entre em outubro</label>
                                <input type="text" name="price_october_edit" id="price_october_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_november_edit">Valor caso entre em novembro</label>
                                <input type="text" name="price_november_edit" id="price_november_edit" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>
                        <div class="col-md-6 year-plan-edit" style="display: none;">
                            <div class="form-group">
                                <label for="price_december_edit">Valor caso entre em dezembro</label>
                                <input type="text" name="price_december_edit" id="price_december_edit" class="form-control money" placeholder="Informe o valor">
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
    <script src="/js/plan/home.js"></script>
@stop