@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreScheduledClassesResult">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resultado da aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreScheduledClassesResult">
                    <input type="hidden" id="id_scheduled_classes" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="result">Resultado</label>
                                <select required name="result" id="result" class="form-control">
                                    <option selected="selected" value="P">Presente</option>
                                    <option value="F">Falta</option>
                                    <option value="FJ">Falta Justificada</option>
                                    <option value="CH">Chuva</option>
                                    <option value="FP">Falta do Professor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_teacher">Professor</label>
                                <select required name="id_teacher" id="id_teacher" class="form-control">
                                    <option value="">-- Selecione --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: none;" id="box-remark">
                            <div class="form-group">
                                <label for="remark">A aula será remarcada?</label>
                                <select name="remark" id="remark" class="form-control">
                                    <option value="N">Não</option>
                                    <option value="S">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" style="display: none;" id="box-date-remarked">
                            <div class="form-group">
                                <label for="date_remarked">Data da reposição</label>
                                <input type="date" name="date_remarked" id="date_remarked" min="{{date('Y-m-d')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observation">Observação</label>
                                <textarea name="observation" id="observation" cols="30" rows="3" class="form-control" placeholder="Descreva brevemente como foi a aula, ou o motivo de não ter sido realizada!"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreScheduledClassesResult">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/scheduled_classes/home.js"></script>
@stop