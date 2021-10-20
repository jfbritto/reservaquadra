@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Métodos de Pagamento')

@section('content_header')
    <h1><i class="fas fa-comment-dollar"></i> &nbsp;Métodos de Pagamento</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="modalPaymentMethodSubtypes">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subtipos de Métodos de Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <h5 class="font-weight-bold mb-4">
                    <span id="title-method"></span>
                </h5>

                <div class="table-responsive">
                    <table class="table table-condensed table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="list-subtypes"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id_payment_method_add" value="">
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="modalPaymentMethodSubtypeCondition">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Condições de Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <h5 class="font-weight-bold mb-4">
                    <span id="title-subtype"></span>
                    <span class="pull-right"><button type="button" class="btn btn-success btn-sm float-right" id="openModalAddPaymentMethodSubtypeCondition">Adicionar condição de pagamento</button></span>
                </h5>

                <div class="table-responsive">
                    <table class="table table-condensed table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Parcelas</th>
                                <th>Porcentagem</th>
                                <th>Valor fixo</th>
                                <th>Dias para cair</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="list-subtype-conditions"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id_payment_method_condition_add" value="">
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalAddPaymentMethodSubtypeCondition">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Condição de Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formAddPaymentMethodSubtypeCondition">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parcel">Parcela</label>
                                <select type="text" required name="parcel" id="parcel" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_flat">Taxa é fixa?</label>
                                <select type="text" required name="is_flat" id="is_flat" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: none;" id="box-percentage">
                            <div class="form-group">
                                <label for="percentage_tax">Taxa em porcentagem</label>
                                <input type="text" name="percentage_tax" id="percentage_tax" class="form-control money" placeholder="Ex: 3,15">
                            </div>
                        </div>
                        <div class="col-md-6" style="display: none;" id="box-flat">
                            <div class="form-group">
                                <label for="flat_tax">Taxa em reais</label>
                                <input type="text" name="flat_tax" id="flat_tax" class="form-control money" placeholder="Ex: 1,50">
                            </div>
                        </div>
                        <div class="col-md-6" style="display: none;" id="box-days_for_payment">
                            <div class="form-group">
                                <label for="days_for_payment">Dias para cair na conta</label>
                                <input type="number" required name="days_for_payment" id="days_for_payment" class="form-control" placeholder="Informe o nº" min="0" min="50">
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formAddPaymentMethodSubtypeCondition">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/payment_method/home.js"></script>
@stop