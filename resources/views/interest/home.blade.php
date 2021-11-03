@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Interesses')

@section('content_header')
    <h1><i class="fas fa-address-book"></i> &nbsp;Interesses</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreInterest">
                <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm tadatable-table" id="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Objetivo</th>
                            <th>Tel</th>
                            <th style="text-align: center;">Seg</th>
                            <th style="text-align: center;">Ter</th>
                            <th style="text-align: center;">Qua</th>
                            <th style="text-align: center;">Qui</th>
                            <th style="text-align: center;">Sex</th>
                            <th style="text-align: center;">Todos</th>
                            <th>Avaliação</th>
                            <th>Resultado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreInterest">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Interesse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreInterest">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome do aluno">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">Idade</label>
                                <input type="number" min="1" max="120" required name="age" id="age" class="form-control" placeholder="Informe a idade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone1">Telefone 1</label>
                                <input type="text" required name="phone1" id="phone1" class="form-control phone" placeholder="Informe o 1º telefone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone2">Telefone 2</label>
                                <input type="text" name="phone2" id="phone2" class="form-control phone" placeholder="Informe o 2º telefone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="objective">Objetivo</label>
                                <select name="objective" id="objective" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="evolucao">Evolução</option>
                                    <option value="prazer">Prazer</option>
                                    <option value="suor">Suor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="row">    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mon">Segunda</label>
                                <select required name="mon" id="mon" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mon_period">Período na Seg.</label>
                                <select name="mon_period" id="mon_period" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tue">Terça</label>
                                <select required name="tue" id="tue" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tue_period">Período na Ter.</label>
                                <select name="tue_period" id="tue_period" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wed">Quarta</label>
                                <select required name="wed" id="wed" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wed_period">Período na Quar.</label>
                                <select name="wed_period" id="wed_period" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="thu">Quinta</label>
                                <select required name="thu" id="thu" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="thu_period">Período na Qui.</label>
                                <select name="thu_period" id="thu_period" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fri">Sexta</label>
                                <select required name="fri" id="fri" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fri_period">Período na Sex.</label>
                                <select name="fri_period" id="fri_period" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sat">Sábado</label>
                                <select required name="sat" id="sat" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sat_period">Período no Sáb.</label>
                                <select name="sat_period" id="sat_period" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sun">Domingo</label>
                                <select required name="sun" id="sun" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sun_period">Período no Dom.</label>
                                <select name="sun_period" id="sun_period" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="all_days">Todos os dias</label>
                                <select required name="all_days" id="all_days" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="all_days_period">Período dos dias</label>
                                <select name="mon_period" id="mon_period" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreInterest">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditInterest">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Interesse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditInterest">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="hidden" required name="id_edit" id="id_edit">
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do aluno">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age_edit">Idade</label>
                                <input type="number" min="1" max="120" required name="age_edit" id="age_edit" class="form-control" placeholder="Informe a idade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone1_edit">Telefone 1</label>
                                <input type="text" required name="phone1_edit" id="phone1_edit" class="form-control phone" placeholder="Informe o 1º telefone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone2_edit">Telefone 2</label>
                                <input type="text" name="phone2_edit" id="phone2_edit" class="form-control phone" placeholder="Informe o 2º telefone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="objective_edit">Objetivo</label>
                                <select name="objective_edit" id="objective_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="evolucao">Evolução</option>
                                    <option value="prazer">Prazer</option>
                                    <option value="suor">Suor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="row">    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mon">Segunda</label>
                                <select required name="mon_edit" id="mon_edit" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mon_period">Período na Seg.</label>
                                <select name="mon_period_edit" id="mon_period_edit" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tue">Terça</label>
                                <select required name="tue_edit" id="tue_edit" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tue_period">Período na Ter.</label>
                                <select name="tue_period_edit" id="tue_period_edit" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wed">Quarta</label>
                                <select required name="wed_edit" id="wed_edit" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wed_period">Período na Quar.</label>
                                <select name="wed_period_edit" id="wed_period_edit" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="thu">Quinta</label>
                                <select required name="thu_edit" id="thu_edit" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="thu_period">Período na Qui.</label>
                                <select name="thu_period_edit" id="thu_period_edit" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fri">Sexta</label>
                                <select required name="fri_edit" id="fri_edit" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fri_period">Período na Sex.</label>
                                <select name="fri_period_edit" id="fri_period_edit" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sat">Sábado</label>
                                <select required name="sat_edit" id="sat_edit" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sat_period">Período no Sáb.</label>
                                <select name="sat_period_edit" id="sat_period_edit" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sun">Domingo</label>
                                <select required name="sun_edit" id="sun_edit" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sun_period">Período no Dom.</label>
                                <select name="sun_period_edit" id="sun_period_edit" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="all_days">Todos os dias</label>
                                <select required name="all_days_edit" id="all_days_edit" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="all_days_period">Período dos dias</label>
                                <select name="mon_period_edit" id="mon_period_edit" class="form-control">
                                    <option value="0">Nenhum</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                    <option value="4">Todos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditInterest">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditStatusInterest">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">No quê resultou?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditStatusInterest">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status_interest_edit">Resultado</label>
                                <select name="status_interest_edit" id="status_interest_edit" class="form-control">
                                    <option value="A">Pendente</option>
                                    <option value="DS">Desistiu</option>
                                    <option value="NHD">Não tem horário disponível</option>
                                    <option value="MA" disabled>Marcou avaliação</option>
                                    <option value="STA">Se tornou aluno</option>
                                </select>
                                <input type="hidden" required name="id_edit_status" id="id_edit_status">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observation">Observação</label>
                                <textarea name="observation" id="observation" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditStatusInterest">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalAvaliationInterest">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Marcar avaliação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formAvaliationInterest">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="avaliation_date">Data para avaliação</label>
                                <input type="date" name="avaliation_date" id="avaliation_date" class="form-control">
                                <input type="hidden" name="id_avaliation_date" id="id_avaliation_date" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formAvaliationInterest">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/interest/home.js"></script>
@stop