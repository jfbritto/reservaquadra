@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('title', 'Aluno')

@section('content_header')
    
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-user-graduate"></i> &nbsp;Aluno <span id="status-student"></span></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/alunos"><i class="fas fa-user-graduate"></i> &nbsp;Alunos</a></li>
                    <li class="breadcrumb-item active name_user"></li>
                </ol>
            </div>
        </div>
    </div>

@stop

@section('content')

    <div id="lista-debitos"></div>

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> Dados do Aluno </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" id="delete-student" title="Deletar Aluno">
                    <i class="fas fa-trash"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalEditStudent" title="Editar Aluno">
                    <i class="fas fa-pen"></i>
                </a>
                <span id="edit-status-student"></span>
            </div>
        </div>
        <div class="card-body">
            <input type="hidden" id="id_usr" value="{{$id}}">

            <div class="row">
                <div class="col-md-8">

                    <div class="row">
                        <div class="col-md-3 change-class">

                            <strong><i class="fas fa-user mr-1"></i> Nome</strong>
                            <p class="text-muted" id="name"></p>

                        </div>
                        <div class="col-md-3 change-class">

                            <strong><i class="fas fa-at mr-1"></i> Email</strong>
                            <p class="text-muted" id="email"></p>

                        </div>
                        <div class="col-md-3 change-class">

                            <strong><i class="fas fa-birthday-cake mr-1"></i> Nascimento</strong>
                            <p class="text-muted" id="birth"></p>

                        </div>
                        <div class="col-md-3 change-class">

                            <strong><i class="fas fa-globe-americas mr-1"></i> Nacionalidade</strong>
                            <p class="text-muted" id="nationality"></p>

                        </div>
                        <div class="col-md-3 adulto">

                            <strong><i class="fas fa-user mr-1"></i> CPF</strong>
                            <p class="text-muted" id="cpf"></p>

                        </div>
                        <div class="col-md-3 adulto">

                            <strong><i class="fas fa-user mr-1"></i> RG</strong>
                            <p class="text-muted" id="rg"></p>
                        
                        </div>
                        <div class="col-md-3 adulto">

                            <strong><i class="fas fa-ring mr-1"></i> Estado civil</strong>
                            <p class="text-muted" id="civil_status"></p>

                        </div>
                        <div class="col-md-3 adulto">

                            <strong><i class="fas fa-user-tie mr-1"></i> Profissão</strong>
                            <p class="text-muted" id="profession"></p>

                        </div>
                        <div class="col-md-3 change-class">

                            <strong><i class="fas fa-calendar-alt mr-1"></i> Data início</strong>
                            <p class="text-muted" id="start_date"></p>

                        </div>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="row">    
                        <div class="col-md-6 col-6">

                            <strong><i class="fas fa-first-aid mr-1"></i> Plano de saúde</strong>
                            <p class="text-muted" id="health_plan"></p>

                        </div>
                        <div class="col-md-6 col-6">

                            <strong><i class="fas fa-first-aid mr-1"></i> Cuidado Especial</strong>
                            <p class="text-muted" id="special_care"></p>

                        </div>
                        <div class="col-md-6 col-6">

                            <strong><i class="fas fa-handshake mr-1"></i> Como conheceu?</strong>
                            <p class="text-muted" id="how_met"></p>

                        </div>
                        <div class="col-md-6 col-6">

                            <strong><i class="fas fa-handshake mr-1"></i> Objetivo</strong>
                            <p class="text-muted" id="objective"></p>

                        </div>

                    </div>

                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 col-12">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
                    <p class="text-muted" id="address"></p>
                </div>
            </div>

            <hr>

            <div class="row" id="box-phones-registered"></div>

        </div>
    </div>


    <div class="card infantil">
        <div class="card-header border-0">
            <h3 class="card-title"> Dados do Responsável </h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-2">

                    <strong><i class="fas fa-user mr-1"></i> Nome</strong>
                    <p class="text-muted" id="responsible_name"></p>

                </div>
                <div class="col-md-2">

                    <strong><i class="fas fa-user mr-1"></i> CPF</strong>
                    <p class="text-muted" id="responsible_rg"></p>

                </div>
                <div class="col-md-2">

                    <strong><i class="fas fa-user mr-1"></i> RG</strong>
                    <p class="text-muted" id="responsible_cpf"></p>
                
                </div>
                <div class="col-md-2">

                    <strong><i class="fas fa-ring mr-1"></i> Estado civil</strong>
                    <p class="text-muted" id="responsible_civil_status"></p>

                </div>
                <div class="col-md-2">

                    <strong><i class="fas fa-user-tie mr-1"></i> Profissão</strong>
                    <p class="text-muted" id="responsible_profession"></p>

                </div>
                <div class="col-md-2">

                    <strong><i class="fas fa-globe-americas mr-1"></i> Nacionalidade</strong>
                    <p class="text-muted" id="responsible_nationality"></p>

                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 col-12">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
                    <p class="text-muted" id="responsible_address"></p>
                </div>
            </div>

            <hr>

            <div class="row" id="box-phones-registered-responsible"></div>

        </div>
    </div>


    <div class="row" style="padding-bottom: 200px;">
        <div class="col-md-6">
        
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title"> Contrato Vigente </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" id="" title="Listar contratos" style="display: none;">
                            <i class="fas fa-list"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm" id="btn-new-contract" style="display: none;" title="Cadastrar contrato">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Data inicio</th>
                                    <th>Plano</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="list-contracts"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title"> Próxima Fatura </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" id="list-all-invoices" title="Listar faturas">
                            <i class="fas fa-list"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalAddSingleInvoice" title="Cadastrar fatura avulsa">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Tipo</th>
                                    <th>Vencimento</th>
                                    <th>Valor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="list-invoices"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row" style="display: none;">
        <div class="col-md-6">
        
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title"> Aulas Semanais </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreScheduledClasses">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Quadra</th>
                                    <th>Dia</th>
                                    <th>Período</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="list-scheduled-classes"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title"> Últimas Aulas Realizadas / Reagendadas / Canceladas </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" id="" title="Listar aulas realizadas">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Quadra</th>
                                    <th>Dia</th>
                                    <th>Data</th>
                                    <th>Período</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="list-scheduled-classes-results"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!-- ****************************
    *                               *
    *        MODAIS DA PÁGINA       *
    *                               * 
    ********************************* -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditStudent">
        <div class="modal-dialog modal-xl" role="document">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="registration_type_edit">Tipo Cadastro</label>
                                <select name="registration_type_edit" id="registration_type_edit" class="form-control">
                                    <option value="A">Adulto</option>
                                    <option value="I">Infantil</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do aluno">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email_edit">Email</label>
                                <input type="email" name="email_edit" id="email_edit" class="form-control" placeholder="Informe o email">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="birth_edit">Data de nascimento</label>
                                <input type="date" name="birth_edit" id="birth_edit" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 adulto">
                            <div class="form-group">
                                <label for="cpf_edit">CPF</label>
                                <input type="text" name="cpf_edit" id="cpf_edit" class="form-control cpf" placeholder="Informe o CPF">
                            </div>
                        </div>
                        <div class="col-md-2 adulto">
                            <div class="form-group">
                                <label for="rg_edit">RG</label>
                                <input type="text" name="rg_edit" id="rg_edit" class="form-control" placeholder="Informe o RG">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="gender_edit">Gênero</label>
                                <select name="gender_edit" id="gender_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="F">Feminino</option>
                                    <option value="M">Masculino</option>
                                    <option value="O">Outro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nationality_edit">Nacionalidade</label>
                                <input type="text" name="nationality_edit" id="nationality_edit" class="form-control" placeholder="Ex: Brasileiro">
                            </div>
                        </div>
                        <div class="col-md-3 adulto">
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
                        <div class="col-md-3 adulto">
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="start_date_edit">Data início</label>
                                <input type="date" name="start_date_edit" id="start_date_edit" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="health_plan_edit">Plano de saúde</label>
                                <input type="text" name="health_plan_edit" id="health_plan_edit" class="form-control" placeholder="Informe o plano de saúde">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="special_care_edit">Cuidado especial?</label>
                                <input type="text" name="special_care_edit" id="special_care_edit" class="form-control" placeholder="Informe qual">
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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

                    <hr class="infantil" style="display: none;">

                    <div class="row infantil" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsible_name_edit">Nome</label>
                                <input type="text" name="responsible_name_edit" id="responsible_name_edit" class="form-control" placeholder="Informe o nome do responsável">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsible_cpf_edit">CPF</label>
                                <input type="text" name="responsible_cpf_edit" id="responsible_cpf_edit" class="form-control cpf" placeholder="Informe o CPF do responsável">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="responsible_rg_edit">RG</label>
                                <input type="text" name="responsible_rg_edit" id="responsible_rg_edit" class="form-control" placeholder="Informe o RG do responsável">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="responsible_civil_status_edit">Estado civil</label>
                                <select name="responsible_civil_status_edit" id="responsible_civil_status_edit" class="form-control">
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
                                <label for="responsible_nationality_edit">Nacionalidade</label>
                                <input type="text" name="responsible_nationality_edit" id="responsible_nationality_edit" class="form-control" placeholder="Nacionalidade do responsável">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="responsible_profession_edit">Profissão</label>
                                <input type="text" name="responsible_profession_edit" id="responsible_profession_edit" class="form-control" placeholder="Informe a profissão do responsável">
                            </div>
                        </div>
                    </div>

                    <hr class="infantil" style="display: none;">
                    
                    <div class="row infantil" style="display: none;">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="responsible_zip_code_edit">CEP</label>
                                <input type="text" name="responsible_zip_code_edit" id="responsible_zip_code_edit" data-type="edit-responsible" class="form-control zip_code" placeholder="Informe o CEP" maxlength="9">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="responsible_uf_edit">UF</label>
                                <input type="text" name="responsible_uf_edit" id="responsible_uf_edit" class="form-control" placeholder="Informe o UF">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_city_edit">Cidade</label>
                                <input type="text" name="responsible_city_edit" id="responsible_city_edit" class="form-control" placeholder="Informe a cidade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_neighborhood_edit">Bairro</label>
                                <input type="text" name="responsible_neighborhood_edit" id="responsible_neighborhood_edit" class="form-control" placeholder="Informe o bairro">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_address_edit">Endereço</label>
                                <input type="text" name="responsible_address_edit" id="responsible_address_edit" class="form-control" placeholder="Informe o endereço">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_address_number_edit">Número</label>
                                <input type="text" name="responsible_address_number_edit" id="responsible_address_number_edit" class="form-control" placeholder="Informe o número">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="responsible_complement_edit">Complemento</label>
                                <input type="text" name="responsible_complement_edit" id="responsible_complement_edit" class="form-control" placeholder="Ex: Casa, Ap. 101">
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
                <button type="submit" class="btn btn-primary" form="formEditStudent">Salvar</button>
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
                        <div class="col-md-4 phone-class">
                            <div class="form-group">
                                <label for="phone_number">Número</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control phone" placeholder="Informe o telefone">
                            </div>
                        </div>
                        <div class="col-md-4 infantil">
                            <div class="form-group">
                                <label for="is_responsible_number">Pertence ao</label>
                                <select name="is_responsible_number" id="is_responsible_number" class="form-control">
                                    <option value="0">Aluno</option>
                                    <option value="1">Responsável</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 phone-class">
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreContract">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreContract">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_plan">Plano</label>
                                <select required name="id_plan" id="id_plan" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date_contract">Data inicio</label>
                                <input type="date" required name="start_date_contract" id="start_date_contract" class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expiration_day">Dia vencimento</label>
                                <input type="number" required name="expiration_day" id="expiration_day" class="form-control" placeholder="Informe o melhor dia para o vencimento" max="30">
                            </div>
                        </div>
                        <div class="col-md-4 price_per_month_box" style="display: none;">
                            <div class="form-group">
                                <label for="price_per_month" id="price_per_month_label">Mensalidade</label>
                                <input type="text" required readonly name="price_per_month" id="price_per_month" class="form-control money" placeholder="Informe o valor das mensalidades">
                            </div>
                        </div>
                        <div class="col-md-4 price_per_month_box" style="display: none;">
                            <div class="form-group">
                                <label for="discount_contract" id="discount_contract_label">Desconto</label>
                                <input type="text" name="discount_contract" id="discount_contract" class="form-control money" placeholder="Informe o valor do desconto nas mensalidades">
                            </div>
                        </div>
                        <div class="col-md-4 price_per_month_box" style="display: none;">
                            <div class="form-group">
                                <label for="final_value" id="final_value_label">Valor Final</label>
                                <input type="text" readonly name="final_value" id="final_value" class="form-control money">
                            </div>
                        </div>
                        <div class="col-md-3 parcels" style="display: none;">
                            <div class="form-group">
                                <label for="parcel">Parcelas</label>
                                <select name="parcel" id="parcel" class="form-control">
                                    <option selected value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreContract">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalRenewContract">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Renovar Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formRenewContract">
                    <input type="hidden" name="id_contract_renew" id="id_contract_renew" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_plan_renew">Plano</label>
                                <select required name="id_plan_renew" id="id_plan_renew" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date_contract_renew">Data inicio</label>
                                <input type="date" required name="start_date_contract_renew" id="start_date_contract_renew" class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expiration_day_renew">Dia vencimento</label>
                                <input type="number" required name="expiration_day_renew" id="expiration_day_renew" class="form-control" placeholder="Informe o melhor dia para o vencimento" max="30">
                            </div>
                        </div>
                        <div class="col-md-4 price_per_month_box_renew" style="display: none;">
                            <div class="form-group">
                                <label for="price_per_month_renew" id="price_per_month_label_renew">Mensalidade</label>
                                <input type="text" required readonly name="price_per_month_renew" id="price_per_month_renew" class="form-control money" placeholder="Informe o valor das mensalidades">
                            </div>
                        </div>
                        <div class="col-md-4 price_per_month_box_renew" style="display: none;">
                            <div class="form-group">
                                <label for="discount_contract_renew">Desconto</label>
                                <input type="text" name="discount_contract_renew" id="discount_contract_renew" class="form-control money" placeholder="Informe o valor do desconto nas mensalidades">
                            </div>
                        </div>
                        <div class="col-md-4 price_per_month_box_renew" style="display: none;">
                            <div class="form-group">
                                <label for="final_value_renew">Valor Final</label>
                                <input type="text" readonly name="final_value_renew" id="final_value_renew" class="form-control money">
                            </div>
                        </div>
                        <div class="col-md-3 parcels_renew" style="display: none;">
                            <div class="form-group">
                                <label for="parcel_renew">Parcelas</label>
                                <select name="parcel_renew" id="parcel_renew" class="form-control">
                                    <option selected value=""></option>
                                </select>
                            </div>
                        </div>


                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formRenewContract">Renovar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalReceiveInvoice" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Receber Fatura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formReceiveInvoice">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="due_date">Vencimento</label>
                                <input type="hidden" required name="id_invoice" id="id_invoice" class="form-control">
                                <input type="date" readonly required name="due_date" id="due_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Valor</label>
                                <input type="text" readonly required name="price" id="price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount">Desconto</label>
                                <input type="text" name="discount" id="discount" class="form-control money" placeholder="0,00">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="paid_price">Valor final</label>
                                <input type="text" readonly required name="paid_price" id="paid_price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_payment_method">Método de Pagamento</label>
                                <select required name="id_payment_method" id="id_payment_method" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_payment_method_subtype">Subtipo/Bandeira</label>
                                <select required name="id_payment_method_subtype" id="id_payment_method_subtype" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_payment_method_subtype_condition">Parcelas</label>
                                <select required name="id_payment_method_subtype_condition" id="id_payment_method_subtype_condition" class="form-control"></select>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" form="formReceiveInvoice">Receber</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreScheduledClasses">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Aulas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreScheduledClasses">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_court">Quadra</label>
                                <select required name="id_court" id="id_court" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="week_day">Dia da semana</label>
                                <select required name="week_day" id="week_day" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="1">Segunda</option>
                                    <option value="2">Terça</option>
                                    <option value="3">Quarta</option>
                                    <option value="4">Quinta</option>
                                    <option value="5">Sexta</option>
                                    <option value="6">Sábado</option>
                                    <option value="7">Domingo</option>
                                    <option value="9">Dias de semana</option>
                                    <option value="8">Todos os dias</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_time">Hora início</label>
                                <input type="time" required name="start_time" id="start_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_time">Hora fim</label>
                                <input type="time" required name="end_time" id="end_time" class="form-control">
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreScheduledClasses">Salvar</button>
            </div>
            </div>
        </div>
    </div>
    


    <div class="modal fade" tabindex="-1" role="dialog" id="modalAddSingleInvoice">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Fatura Avulsa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreSingleInvoice">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price_invoice">Valor</label>
                                <input type="text" required name="price_invoice" id="price_invoice" class="form-control money" placeholder="Informe o valor">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="due_date_invoice">Vencimento</label>
                                <input type="date" required name="due_date_invoice" id="due_date_invoice" class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_type_invoice">Tipo</label>
                                <select required name="id_type_invoice" id="id_type_invoice" class="form-control"></select>
                            </div>
                        </div>

                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreSingleInvoice">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalListInvoices">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Faturas Recebidas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-striped table-valign-middle table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Tipo</th>
                                <th>Vencimento</th>
                                <th>Valor</th>
                                <th>NF</th>
                                <th>NFE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="list-all-invoices-modal"></tbody>
                    </table>
                </div>

            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditInvoice">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Fatura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditInvoice">
                    <div class="form-group">
                        <label for="fiscal_note">Nº Nota Fiscal</label>
                        <input type="text" name="fiscal_note" id="fiscal_note" class="form-control" placeholder="Informe o nº">
                        <input type="hidden" id="id_invoice_edit">
                    </div>
                    <div class="form-group">
                        <label for="fiscal_note_e">Nº Nota Fiscal Eletrônica</label>
                        <input type="text" name="fiscal_note_e" id="fiscal_note_e" class="form-control" placeholder="Informe o nº">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditInvoice">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalInactivateUser">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inativar aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInactivateUser">
                    <div class="form-group">
                        <label for="price_debit">Adicionar Débito</label>
                        <input type="text" name="price_debit" id="price_debit" class="form-control money" placeholder="Informe o valor do débito">
                        <input type="hidden" id="id_user_inativate">
                    </div>
                    <div class="form-group">
                        <label for="observation">Observação</label>
                        <textarea name="observation" id="observation" class="form-control" placeholder="Informe o motivo do débito"></textarea>
                    </div>
                </form>

                <div class="alert alert-warning">
                    Ao inativar o aluno, seu contrato e faturas serão automaticamente cancelados.
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formInactivateUser">Inativar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/user/student/show.js"></script>
@stop