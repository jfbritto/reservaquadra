@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Relatórios')

@section('content_header')
    <h1><i class="fas fa-chart-pie"></i> &nbsp;Relatórios</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header">
            Faturamento esperado
        </div>
        <div class="card-body">
            <canvas id="myChart" height="100" ></canvas>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            Despesas esperadas
        </div>
        <div class="card-body">
            <canvas id="myChart2" height="100" ></canvas>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/report/home.js"></script>
@stop