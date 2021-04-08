@extends('adminlte::page')

@section('title', 'Calendário')

@section('content_header')
    <h1>Calendário</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <!-- <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreCourt">
                <i class="fas fa-plus"></i>
                </a> -->
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-valign-middle table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Dom</th>
                            <th>Seg</th>
                            <th>Ter</th>
                            <th>Qua</th>
                            <th>Qui</th>
                            <th>Sex</th>
                            <th>Sáb</th> 
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/calendar/home.js"></script>
@stop