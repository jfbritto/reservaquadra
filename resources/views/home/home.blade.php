@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Home - teste</h1>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-graduate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Alunos</span>
                    <span class="info-box-number" id="tot-students"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Aulas hoje</span>
                    <span class="info-box-number" id="tot-classes"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clipboard-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Reservas pendentes</span>
                    <span class="info-box-number" id="tot-reservations"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Débitos pendentes</span>
                    <span class="info-box-number" id="tot-debts"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>

    </div>

@stop

@section('js')
    <script src="/js/home/home.js"></script>
@stop