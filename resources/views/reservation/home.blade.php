@extends('adminlte::page')

@section('title', 'Reservas')

@section('content_header')
    <h1>Reservas</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th class="just-pc">Telefone</th>
                            <th>Data</th>
                            <th class="just-pc">Dia</th>
                            <th class="just-pc">Início</th>
                            <th class="just-pc">Fim</th>
                            <th class="just-pc">Valor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalShowReservation">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <p><strong>Cliente: </strong> <span id="show-name_reserved"></span></p>
                <p><strong>Telefone: </strong> <span id="show-phone_reserved"></span></p>
                <p><strong>Data: </strong> <span id="show-reservation_date"></span></p>
                <p><strong>Hora: </strong> <span id="show-hora"></span></p>
                <p><strong>Valor: </strong> <span id="show-price"></span></p>
                
            </div>

            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/reservation/home.js"></script>
@stop