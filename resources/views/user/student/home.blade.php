@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')
    <h1>Alunos</h1>
@stop

@section('content')
    
    <div class="card card-default">
        <div class="card-header">
            <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalStoreStudent"><i class="fas fa-plus-circle"></i></button>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-condensed table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreStudent">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreStudent">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome do aluno">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" required name="email" id="email" class="form-control" placeholder="Informe o email">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreStudent">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditStudent">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditStudent">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="hidden" required name="id_edit" id="id_edit" class="form-control">
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do aluno">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_edit">Email</label>
                                <input type="email" required name="email_edit" id="email_edit" class="form-control" placeholder="Informe o email">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditStudent">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/user/student/home.js"></script>
@stop