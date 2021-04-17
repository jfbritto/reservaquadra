@extends('adminlte::page')

@section('title', 'Calendário')

@section('content_header')
    <h1><i class="fas fa-calendar"></i> &nbsp;Calendário</h1>
@stop

@section('css')
    <style>

        .box-cel{
            min-height: 150px !important;
            /* background-color: grey; */
        }
        .title-cel{
            /* margin-top: -60px !important;
            margin-left: -3px !important; */
            height: 20px !important;
            margin-bottom: 10px !important;
            text-align: right !important;
        }

        .item-cel{
            margin-bottom: 3px;
            cursor: pointer !important;
        }
        .item-cel:hover{
            opacity: 0.8 !important;
        }
        .badge{
            border-radius: 30px !important;
            font-size: 100% !important;
        }
        .class_bloq{
            opacity: 0.2 !important;
        }

    </style>
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
                <table class="table table-valign-middle table-bordered">
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
                    <tbody id="list">

                    
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalInfoCalendar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalhes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p><strong>Aluno: </strong><span id="info-student"></span></p>
                <p><strong>Quadra: </strong><span id="info-court"></span></p>

            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/calendar/home.js"></script>
@stop