@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Entradas')

@section('content_header')
    <h1><i class="fas fa-comment-dollar"></i> &nbsp;Entradas</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 link-student">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-comment-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Recebido</span>
                    <span class="info-box-number" id="tot-entry"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 link-student">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-comment-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Esperado</span>
                    <span class="info-box-number" id="tot-billed"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header border-0">

            <form class="form-inline">
                <div class="form-group">
                    <label for="date-ini" style="padding-right: 15px;">De</label>
                    <input type="date" class="form-control" name="date-ini" id="date-ini" value="{{date('Y-m-01')}}">
                </div>
                <div class="form-group mx-sm-3">
                    <label for="date-end" style="padding-right: 15px;">a</label>
                    <input type="date" class="form-control" name="date-end" id="date-end" value="{{date('Y-m-t')}}">
                </div>
                <!-- <button type="submit" class="btn btn-primary mb-2">Confirm identity</button> -->
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header border-0">
                    Clientes que pagaram no período selecionado
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Pagamento</th>
                                    <th>Vencimento</th>
                                    <th>Valor</th>
                                    <th>Método</th>
                                    <th>Bandeira</th>
                                    <th title="Parcelas">Parc.</th>
                                    <th>NF</th>
                                    <th>Cliente</th>
                                </tr>
                            </thead>
                            <tbody id="list"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-0">
                    Recebimentos esperados para o período selecionado
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Compensação</th>
                                    <th>Pagamento</th>
                                    <th>Valor</th>
                                    <th>Taxa</th>
                                    <th>Método</th>
                                    <th>Bandeira</th>
                                    <th title="Parcelas">Parc.</th>
                                    <th>NF</th>
                                    <th>Cliente</th>
                                </tr>
                            </thead>
                            <tbody id="list2"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


@stop

@section('js')
    <script src="/js/entry/home.js"></script>
@stop