@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Tipos de Fatura')

@section('content_header')
    <h1><i class="fas fa-file-invoice-dollar"></i> &nbsp;Tipos de Fatura</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreInvoiceType">
                <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreInvoiceType">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Tipo de Fatura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreInvoiceType">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreInvoiceType">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditInvoiceType">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Tipo de Fatura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditInvoiceType">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="hidden" required name="id_edit" id="id_edit">
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditInvoiceType">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/invoice_type/home.js"></script>
@stop