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
        <div class="card-header border-0">
            <h3 class="card-title">  </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalEditStudent" title="Editar Aluno">
                    <i class="fas fa-pen"></i>
                </a>
            </div>
        </div>
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
                <div class="col-md-3 col-6">

                    <strong><i class="fas fa-birthday-cake mr-1"></i> Nascimento</strong>
                    <p class="text-muted" id="birth"></p>

                </div>
                <div class="col-md-3 col-6">

                    <strong><i class="fas fa-user mr-1"></i> CPF</strong>
                    <p class="text-muted" id="cpf"></p>

                </div>
                <div class="col-md-3 col-6">

                    <strong><i class="fas fa-user mr-1"></i> RG</strong>
                    <p class="text-muted" id="rg"></p>
                
                </div>
                <div class="col-md-3 col-6">

                    <strong><i class="fas fa-ring mr-1"></i> Estado civil</strong>
                    <p class="text-muted" id="civil_status"></p>

                </div>
                <div class="col-md-3 col-6">

                    <strong><i class="fas fa-user-tie mr-1"></i> Profissão</strong>
                    <p class="text-muted" id="profession"></p>

                </div>
                <div class="col-md-3 col-6">

                    <strong><i class="fas fa-calendar-alt mr-1"></i> Data início</strong>
                    <p class="text-muted" id="start_date"></p>

                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-10 col-8">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
                    <p class="text-muted" id="address"></p>
                </div>
                <div class="col-md-2 col-4">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> CEP</strong>
                    <p class="text-muted" id="zip_code"></p>
                </div>
                
            </div>

            <hr>

            <div class="row">    
                <div class="col-md-6 col-6">

                    <strong><i class="fas fa-first-aid mr-1"></i> Plano de saúde</strong>
                    <p class="text-muted" id="health_plan"></p>

                </div>
                <div class="col-md-6 col-6">

                    <strong><i class="fas fa-handshake mr-1"></i> Como conheceu?</strong>
                    <p class="text-muted" id="how_met"></p>

                </div>

            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
        
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title"> Contrato Vigente </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" id="" title="Listar contratos">
                            <i class="fas fa-list"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreContract" id="btn-new-contract" style="display: none;" title="Cadastrar contrato">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover">
                            <thead>
                                <tr>
                                    <th>Data inicio</th>
                                    <th>Plano</th>
                                    <th>Status</th>
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
                        <a href="#" class="btn btn-tool btn-sm" id="" title="Listar faturas">
                            <i class="fas fa-list"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm" id="" title="Cadastrar fatura avulsa">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover">
                            <thead>
                                <tr>
                                    <th>Status</th>
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

    <div class="row">
        <div class="col-md-6">
        
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title"> Aulas Semanais </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreStudent">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    
                </div>
            </div>

        </div>
        <div class="col-md-6">

            <!-- <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">  </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreStudent">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    
                </div>
            </div> -->

        </div>
    </div>



    <!-- ****************************
    *                               *
    *        MODAIS DA PÁGINA       *
    *                               * 
    ********************************* -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreContract">
        <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-md-6">
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expiration_day">Dia vencimento</label>
                                <input type="number" required name="expiration_day" id="expiration_day" class="form-control" placeholder="Informe o melhor dia para o vencimento" max="30">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_per_month">Mensalidade</label>
                                <input type="text" required name="price_per_month" id="price_per_month" class="form-control money" placeholder="Informe o valor das mensalidades">
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
                        <div class="col-md-6">
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expiration_day_renew">Dia vencimento</label>
                                <input type="number" required name="expiration_day_renew" id="expiration_day_renew" class="form-control" placeholder="Informe o melhor dia para o vencimento" max="30">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_per_month_renew">Mensalidade</label>
                                <input type="text" required name="price_per_month_renew" id="price_per_month_renew" class="form-control money" placeholder="Informe o valor das mensalidades">
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

                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" form="formReceiveInvoice">Receber</button>
            </div>
            </div>
        </div>
    </div>
    
@stop

@section('js')
    <script src="/js/user/student/show.js"></script>
@stop