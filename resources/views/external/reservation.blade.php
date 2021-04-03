@extends('base.external_base')

@section('title', 'Reservar Horário')

@section('content_header')
    <div class="jumbotron text-center" style="padding: 1.5rem 2rem; margin-bottom: 1rem;">
        <h1 class="display-4">Reservar Horário</h1>
        <!-- <hr class="my-4">
        <h1 class="display-4">Vini Tennis</h1> -->
    </div>
@stop

@section('content')
    
    <a href="#" class="btn btn-danger btn-block mb-3" id="reset" style="display: none;">Resetar escolha</a>

    <div class="row" id="list-courts"></div>

    <div class="row" id="list-available-week-days"></div>

    <div class="list-group pb-5" id="list-available-times"></div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalReservation">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Finalizar reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Quadra: </strong> <span id="court-chosen"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Dia: </strong> <span id="available-day-chosen"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Horário: </strong> <span id="time-chosen"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Valor: </strong> <span id="price-chosen"></span></p>
                    </div>
                </div>
                <hr>
                <form id="formReservation">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_reserved">Nome</label>
                                <input type="text" required name="name_reserved" id="name_reserved" class="form-control" placeholder="Informe seu nome">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_reserved">Telefone</label>
                                <input type="text" required name="phone_reserved" id="phone_reserved" class="form-control phone" placeholder="Informe seu nº">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="id_available_date" value="">
                    <input type="hidden" id="reservation_date" value="">
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" form="formReservation">Reservar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/external/reservation.js"></script>
@stop