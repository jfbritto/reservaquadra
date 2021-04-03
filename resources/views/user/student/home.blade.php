@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')
    <h1>Alunos</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> <input type="text" class="form-control" placeholder="Buscar pelo nome"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreStudent">
                <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="just-pc">Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreStudent">
        <div class="modal-dialog modal-xl" role="document">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome do aluno">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Informe o email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birth">Data de nascimento</label>
                                <input type="date" required name="birth" id="birth" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" name="cpf" id="cpf" class="form-control cpf" placeholder="Informe o CPF">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rg">RG</label>
                                <input type="text" name="rg" id="rg" class="form-control" placeholder="Informe o RG">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="civil_status">Estado civil</label>
                                <select name="civil_status" id="civil_status" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="Solteiro">Solteiro(a)</option>
                                    <option value="Casado">Casado(a)</option>
                                    <option value="Divorciado">Divorciado(a)</option>
                                    <option value="Viuvo">Viuvo(a)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="profession">Profissão</label>
                                <input type="text" name="profession" id="profession" class="form-control" placeholder="Informe a profissão">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="zip_code">CEP</label>
                                <input type="text" name="zip_code" id="zip_code" data-type="add" class="form-control zip_code" placeholder="Informe o CEP" maxlength="9">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="uf">UF</label>
                                <input type="text" name="uf" id="uf" class="form-control" placeholder="Informe o UF">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">Cidade</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="Informe a cidade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="neighborhood">Bairro</label>
                                <input type="text" name="neighborhood" id="neighborhood" class="form-control" placeholder="Informe o bairro">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Endereço</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Informe o endereço">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address_number">Número</label>
                                <input type="text" name="address_number" id="address_number" class="form-control" placeholder="Informe o número">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="complement">Complemento</label>
                                <input type="text" name="complement" id="complement" class="form-control" placeholder="Ex: Casa, Ap. 101">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="start_date">Data início</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" placeholder="" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="health_plan">Plano de saúde</label>
                                <input type="text" name="health_plan" id="health_plan" class="form-control" placeholder="Informe o plano de saúde">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="how_met">Como conheceu?</label>
                                <select name="how_met" id="how_met" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="Placa">Placa</option>
                                    <option value="Indicacao">Indicação</option>
                                    <option value="Folder">Folder</option>
                                    <option value="Internet">Internet</option>
                                    <option value="Outros">Outros</option>
                                </select>
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
                    <input type="hidden" required name="id_edit" id="id_edit" class="form-control">                

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do aluno">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_edit">Email</label>
                                <input type="email" name="email_edit" id="email_edit" class="form-control" placeholder="Informe o email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birth_edit">Data de nascimento</label>
                                <input type="date" required name="birth_edit" id="birth_edit" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cpf_edit">CPF</label>
                                <input type="text" name="cpf_edit" id="cpf_edit" class="form-control cpf" placeholder="Informe o CPF">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rg_edit">RG</label>
                                <input type="text" name="rg_edit" id="rg_edit" class="form-control" placeholder="Informe o RG">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="civil_status_edit">Estado civil</label>
                                <select name="civil_status_edit" id="civil_status_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="Solteiro">Solteiro(a)</option>
                                    <option value="Casado">Casado(a)</option>
                                    <option value="Divorciado">Divorciado(a)</option>
                                    <option value="Viuvo">Viuvo(a)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="profession_edit">Profissão</label>
                                <input type="text" name="profession_edit" id="profession_edit" class="form-control" placeholder="Informe a profissão">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="zip_code_edit">CEP</label>
                                <input type="text" name="zip_code_edit" id="zip_code_edit" data-type="edit" class="form-control zip_code" placeholder="Informe o CEP" maxlength="9">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="uf_edit">UF</label>
                                <input type="text" name="uf_edit" id="uf_edit" class="form-control" placeholder="Informe o UF">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city_edit">Cidade</label>
                                <input type="text" name="city_edit" id="city_edit" class="form-control" placeholder="Informe a cidade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="neighborhood_edit">Bairro</label>
                                <input type="text" name="neighborhood_edit" id="neighborhood_edit" class="form-control" placeholder="Informe o bairro">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address_edit">Endereço</label>
                                <input type="text" name="address_edit" id="address_edit" class="form-control" placeholder="Informe o endereço">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address_number_edit">Número</label>
                                <input type="text" name="address_number_edit" id="address_number_edit" class="form-control" placeholder="Informe o número">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="complement_edit">Complemento</label>
                                <input type="text" name="complement_edit" id="complement_edit" class="form-control" placeholder="Ex: Casa, Ap. 101">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="start_date_edit">Data início</label>
                                <input type="date" name="start_date_edit" id="start_date_edit" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="health_plan_edit">Plano de saúde</label>
                                <input type="text" name="health_plan_edit" id="health_plan_edit" class="form-control" placeholder="Informe o plano de saúde">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="how_met_edit">Como conheceu?</label>
                                <select name="how_met_edit" id="how_met_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="Placa">Placa</option>
                                    <option value="Indicacao">Indicação</option>
                                    <option value="Folder">Folder</option>
                                    <option value="Internet">Internet</option>
                                    <option value="Outros">Outros</option>
                                </select>
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