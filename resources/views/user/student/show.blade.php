@extends('adminlte::page')

@section('title', 'Aluno')

@section('content_header')
    
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Aluno</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/alunos">Alunos</a></li>
                    <li class="breadcrumb-item active name_user"></li>
                </ol>
            </div>
        </div>
    </div>

@stop

@section('content')

    <div class="card">
        <!-- <div class="card-header border-0">
            <h3 class="card-title">  </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreStudent">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div> -->
        <div class="card-body">
            <input type="hidden" id="id_usr" value="{{$id}}">

            <div class="row">
                <div class="col-md-3">

                    <strong><i class="fas fa-user mr-1"></i> Nome</strong>
                    <p class="text-muted" id="name"></p>

                </div>
                <div class="col-md-3">

                    <strong><i class="fas fa-at mr-1"></i> Email</strong>
                    <p class="text-muted" id="email"></p>

                </div>
                <div class="col-md-3">

                    <strong><i class="fas fa-birthday-cake mr-1"></i> Nascimento</strong>
                    <p class="text-muted" id="birth"></p>

                </div>
                <div class="col-md-3">

                    <strong><i class="fas fa-user mr-1"></i> CPF</strong>
                    <p class="text-muted" id="cpf"></p>

                </div>
                <div class="col-md-3">

                    <strong><i class="fas fa-user mr-1"></i> RG</strong>
                    <p class="text-muted" id="rg"></p>
                
                </div>
                <div class="col-md-3">

                    <strong><i class="fas fa-ring mr-1"></i> Estado civil</strong>
                    <p class="text-muted" id="civil_status"></p>

                </div>
                <div class="col-md-3">

                    <strong><i class="fas fa-user-tie mr-1"></i> Profissão</strong>
                    <p class="text-muted" id="profession"></p>

                </div>
                <div class="col-md-3">

                    <strong><i class="fas fa-calendar-alt mr-1"></i> Data início</strong>
                    <p class="text-muted" id="start_date"></p>

                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
                    <p class="text-muted" id="address"></p>
                </div>
                <div class="col-md-3">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Bairro</strong>
                    <p class="text-muted" id="neighborhood"></p>
                </div>
                <div class="col-md-2">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Cidade</strong>
                    <p class="text-muted" id="city"></p>
                </div>
                <div class="col-md-2">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Complemento</strong>
                    <p class="text-muted" id="complement"></p>
                </div>
                <div class="col-md-2">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> CEP</strong>
                    <p class="text-muted" id="zip_code"></p>
                </div>
                
            </div>

            <hr>

            <div class="row">    
                <div class="col-md-6">

                    <strong><i class="fas fa-first-aid mr-1"></i> Plano de saúde</strong>
                    <p class="text-muted" id="health_plan"></p>

                </div>
                <div class="col-md-6">

                    <strong><i class="fas fa-handshake mr-1"></i> Como conheceu?</strong>
                    <p class="text-muted" id="how_met"></p>

                </div>

            </div>

        </div>
    </div>
    
@stop

@section('js')
    <script src="/js/user/student/show.js"></script>
@stop