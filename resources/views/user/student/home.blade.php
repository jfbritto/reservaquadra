@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Alunos')

@section('content_header')
    <h1><i class="fas fa-user-graduate"></i> &nbsp; Alunos</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 link-student">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-graduate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ativos</span>
                    <span class="info-box-number" id="tot-students-active"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 link-student">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-graduate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Inativos</span>
                    <span class="info-box-number" id="tot-students-inactive"><i class="fas fa-spinner fa-pulse"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> <input type="text" class="form-control" name="search" id="search" placeholder="Buscar pelo nome"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" title="Cadastrar aluno" data-toggle="modal" data-target="#modalStoreStudent">
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
                            <th>Contrato ativo</th>
                            <th>Status</th>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="registration_type">Tipo Cadastro</label>
                                <select name="registration_type" id="registration_type" class="form-control">
                                    <option value="A">Adulto</option>
                                    <option value="I">Infantil</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome do aluno">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Informe o email">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="birth">Data de nascimento</label>
                                <input type="date" required name="birth" id="birth" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3 adulto">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" name="cpf" id="cpf" class="form-control cpf" placeholder="Informe o CPF">
                            </div>
                        </div>
                        <div class="col-md-3 adulto">
                            <div class="form-group">
                                <label for="rg">RG</label>
                                <input type="text" name="rg" id="rg" class="form-control" placeholder="Informe o RG">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">Gênero</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="F">Feminino</option>
                                    <option value="M">Masculino</option>
                                    <option value="O">Outro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 adulto">
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
                        <div class="col-md-3 adulto">
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
                        <div class="col-md-3" style="display: none;">
                            <div class="form-group">
                                <label for="start_date">Data início</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" placeholder="" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="health_plan">Plano de saúde?</label>
                                <input type="text" name="health_plan" id="health_plan" class="form-control" placeholder="Informe qual">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="special_care">Cuidado especial?</label>
                                <input type="text" name="special_care" id="special_care" class="form-control" placeholder="Informe qual">
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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

                    <hr class="infantil" style="display: none;">

                    <div class="row infantil" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsible_name">Nome</label>
                                <input type="text" name="responsible_name" id="responsible_name" class="form-control" placeholder="Informe o nome do responsável">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsible_cpf">CPF</label>
                                <input type="text" name="responsible_cpf" id="responsible_cpf" class="form-control cpf" placeholder="Informe o CPF do responsável">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_rg">RG</label>
                                <input type="text" name="responsible_rg" id="responsible_rg" class="form-control" placeholder="Informe o RG do responsável">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_civil_status">Estado civil</label>
                                <select name="responsible_civil_status" id="responsible_civil_status" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="Solteiro">Solteiro(a)</option>
                                    <option value="Casado">Casado(a)</option>
                                    <option value="Divorciado">Divorciado(a)</option>
                                    <option value="Viuvo">Viuvo(a)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_profession">Profissão</label>
                                <input type="text" name="responsible_profession" id="responsible_profession" class="form-control" placeholder="Informe a profissão do responsável">
                            </div>
                        </div>
                    </div>

                    <hr class="infantil" style="display: none;">
                    
                    <div class="row infantil" style="display: none;">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="responsible_zip_code">CEP</label>
                                <input type="text" name="responsible_zip_code" id="responsible_zip_code" data-type="add-responsible" class="form-control zip_code" placeholder="Informe o CEP" maxlength="9">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="responsible_uf">UF</label>
                                <input type="text" name="responsible_uf" id="responsible_uf" class="form-control" placeholder="Informe o UF">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_city">Cidade</label>
                                <input type="text" name="responsible_city" id="responsible_city" class="form-control" placeholder="Informe a cidade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_neighborhood">Bairro</label>
                                <input type="text" name="responsible_neighborhood" id="responsible_neighborhood" class="form-control" placeholder="Informe o bairro">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_address">Endereço</label>
                                <input type="text" name="responsible_address" id="responsible_address" class="form-control" placeholder="Informe o endereço">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_address_number">Número</label>
                                <input type="text" name="responsible_address_number" id="responsible_address_number" class="form-control" placeholder="Informe o número">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_complement">Complemento</label>
                                <input type="text" name="responsible_complement" id="responsible_complement" class="form-control" placeholder="Ex: Casa, Ap. 101">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row" id="box-phones">
                    
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <a title="Adicionar telefone" href="#" class="btn btn-success" data-toggle="modal" data-target="#modalAddPhone"><i class="fas fa-plus"></i>&nbsp;&nbsp;<i class="fas fa-phone"></i></a>
                <button type="submit" class="btn btn-primary" form="formStoreStudent">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalAddPhone">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Telefone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">    
                        <div class="col-md-6 phone-class">
                            <div class="form-group">
                                <label for="phone_number">Número</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control phone" placeholder="Informe o telefone">
                            </div>
                        </div>
                        <div class="col-md-4 infantil" style="display: none;">
                            <div class="form-group">
                                <label for="is_responsible_number">Pertence ao</label>
                                <select name="is_responsible_number" id="is_responsible_number" class="form-control">
                                    <option value="0">Aluno</option>
                                    <option value="1">Responsável</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 phone-class">
                            <div class="form-group">
                                <label for="is_emergency">É de emergência?</label>
                                <select name="is_emergency" id="is_emergency" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-success" id="btn-add-phone">Adicionar</a>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/user/student/home.js"></script>
@stop