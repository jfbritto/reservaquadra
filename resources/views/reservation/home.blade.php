@extends('adminlte::page')

@section('title', 'Reservas')

@section('content_header')
    <h1>Reservas</h1>
@stop

@section('content')
    
    <div class="card card-default">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-condensed table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Telefone</th>
                            <th>Data</th>
                            <th>Dia</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Valor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>

        </div>
    </div>

@stop

@section('js')
    <script src="/js/reservation/home.js"></script>
@stop