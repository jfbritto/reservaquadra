@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')
    <h1><i class="fas fa-chalkboard-teacher"></i> &nbsp;Aulas</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> <input type="date" class="form-control" name="date" id="date" value="{{date('Y-m-d')}}"> </h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Quadra</th>
                            <th>Período</th>
                            <th>Status</th>
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
    <script src="/js/scheduled_classes/home.js"></script>
@stop