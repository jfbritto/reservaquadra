$(document).ready(function () {

    // CARREGAR DADOS NA TELA
    loadAll();

    // LISTAR DADOS DO ALUNO
    function loadStudent()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/alunos/encontrar", {
                        id:$("#id_usr").val()
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                if(data.data.length > 0){

                                    let item = data.data[0];
                                    $(".name_user").html(item.name);

                                    // CARREGAR INFORMAÇÕES NA TELA
                                    $("#name").html(item.name);
                                    $("#email").html(item.email);
                                    $("#birth").html(dateFormat(item.birth));
                                    $("#cpf").html(item.cpf);
                                    $("#rg").html(item.rg);
                                    $("#civil_status").html(item.civil_status);
                                    $("#profession").html(item.profession);
                                    $("#zip_code").html(item.zip_code);
                                    $("#address").html(`${item.address} ${item.address_number}, ${item.complement}. ${item.neighborhood}, ${item.city} - ${item.uf}`);
                                    $("#start_date").html(dateFormat(item.start_date));
                                    $("#health_plan").html(item.health_plan);
                                    $("#how_met").html(item.how_met);

                                    // CARREGAR INFORMAÇÕES NO MODAL
                                    $("#name_edit").val(item.name);
                                    $("#email_edit").val(item.email);
                                    $("#birth_edit").val(item.birth);
                                    $("#cpf_edit").val(item.cpf);
                                    $("#rg_edit").val(item.rg);
                                    $("#civil_status_edit").val(item.civil_status).change();
                                    $("#profession_edit").val(item.profession);
                                    $("#zip_code_edit").val(item.zip_code);
                                    $("#uf_edit").val(item.uf);
                                    $("#city_edit").val(item.city);
                                    $("#neighborhood_edit").val(item.neighborhood);
                                    $("#address_edit").val(item.address);
                                    $("#address_number_edit").val(item.address_number);
                                    $("#complement_edit").val(item.complement);
                                    $("#start_date_edit").val(item.start_date);
                                    $("#health_plan_edit").val(item.health_plan);
                                    $("#how_met_edit").val(item.how_met).change();

                                }

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    // LISTAR TELEFONES
    function loadPhones()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/telefones/listar", {
                        id_user:$("#id_usr").val()
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#box-phones").html(``);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#box-phones").append(`
                                            <div class="col-sm-3">
                                                <div class="alert alert-light">
                                                    <span class="phone_add" data-type="phone">${item.number}</span>
                                                    <button type="button" class="close close-alert">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        `);
                                    });

                                }

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    // LISTAR QUADRAS
    function loadCourts()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/quadra/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_court").html(``);
                                $("#id_court").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_court").append(`
                                            <option value="${item.id}">${item.name}</option>
                                        `)
                                    });

                                }

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    // LISTAR PLANOS NO SELECT
    function loadPlans()
    {

        $.get(window.location.origin + "/planos/listar", {

        })
        .then(function (data) {
            if (data.status == "success") {

                $("#id_plan").html(``);
                $("#id_plan_renew").html(``);
                
                $("#id_plan").html(`<option data-months="" value="">-- Selecione --</option>`);
                $("#id_plan_renew").html(`<option data-months="" value="">-- Selecione --</option>`);

                if(data.data.length > 0){

                    data.data.forEach(item => {
                        
                        $("#id_plan").append(`
                            <option data-months="${item.months}" data-price="${item.price}" value="${item.id}">${getAgeRange(item.age_range)} - ${getDayPeriod(item.day_period)} - ${item.lessons_per_week} aula(s)/semana - contrato ${periodContractedDescription(item.months)} - R$ ${moneyFormat(item.price)}</option>
                        `)
                        
                        $("#id_plan_renew").append(`
                            <option data-months="${item.months}" data-price="${item.price}" value="${item.id}">${getAgeRange(item.age_range)} - ${getDayPeriod(item.day_period)} - ${item.lessons_per_week} aula(s)/semana - contrato ${periodContractedDescription(item.months)} - R$ ${moneyFormat(item.price)}</option>
                        `)

                    });

                    $("#id_plan").select2().css('width', '100%');
                    $("#id_plan_renew").select2().css('width', '100%');

                }

            } else if (data.status == "error") {
                showError(data.message)
            }
        })
        .catch();

    }

    $("#id_plan").on("change", function(){
        let price = $("#id_plan option:selected").data('price');
        let months = $("#id_plan option:selected").data('months');
        
        $("#price_per_month").val(moneyFormat(price))

        if(months == 13){
            $("#expiration_day").val("1");
            $("#expiration_day").attr("disabled", true);
        }else{
            $("#expiration_day").attr("disabled", false);
        }
    })

    // LISTAR CONTRATOS
    function loadContracts()
    {
        $.get(window.location.origin + `/contratos/listar/${$("#id_usr").val()}`, {

        })
        .then(function (data) {
            if (data.status == "success") {

                $("#list-contracts").html(``);

                if(data.data.length > 0){

                    $("#btn-new-contract").hide();

                    data.data.forEach(item => {

                        $("#list-contracts").append(`
                            <tr>
                                <td class="align-middle">${dateFormat(item.start_date)}</td>
                                <td class="align-middle">${getAgeRange(item.age_range)} / ${getDayPeriod(item.day_period)} / ${item.lessons_per_week}X / ${periodContractedDescription(item.months)}</td>
                                <td class="align-middle" style="text-align: right">
                                    ${item.faturas_abertas==0?`
                                    <a title="Renovar" data-id="${item.id}" data-id_plan="${item.id_plan}" data-expiration_day="${item.expiration_day}" data-price_per_month="${item.price_per_month}" href="#" class="btn btn-info renew-contract"><i class="fas fa-retweet"></i></a>`:`
                                    <a title="Cancelar" data-id="${item.id}" href="#" class="btn btn-danger cancel-contract"><i class="fas fa-ban"></i></a>`}
                                </td>
                            </tr>
                        `);       
                    });

                }else{

                    $("#btn-new-contract").show();

                    $("#list-contracts").append(`
                        <tr>
                            <td class="align-middle text-center" colspan="4">Nenhum contrato ativo encontrado</td>
                        </tr>
                    `);  

                }

            } else if (data.status == "error") {
                showError(data.message)
            }
        })
        .catch();

    }

    // LISTAR FATURAS
    function loadInvoices()
    {
        $.get(window.location.origin + `/faturas/listar/${$("#id_usr").val()}`, {

        })
        .then(function (data) {
            if (data.status == "success") {

                $("#list-invoices").html(``);

                if(data.data.length > 0){

                    data.data.forEach(item => {

                        $("#list-invoices").append(`
                            <tr>
                                <td class="align-middle">${item.status=='A'?`<span class="badge bg-success">Aberta</span>`:`<span class="badge bg-warning">${item.status}</span>`}</td>
                                <td class="align-middle">${dateFormat(item.due_date)}</td>
                                <td class="align-middle">R$ ${moneyFormat(item.price)}</td>
                                <td class="align-middle" style="text-align: right">
                                    <a title="Receber" data-id="${item.id}" data-due_date="${item.due_date}" data-price="${item.price}" href="#" class="btn btn-success pay-invoice"><i class="fas fa-comment-dollar"></i></a>
                                </td>
                            </tr>
                        `);       
                    });

                }else{

                    $("#list-invoices").append(`
                        <tr>
                            <td class="align-middle text-center" colspan="4">Nenhuma fatura aberta encontrada</td>
                        </tr>
                    `);  

                }

            } else if (data.status == "error") {
                showError(data.message)
            }
        })
        .catch();

    }


    // CADASTRAR CONTRATO
    $("#formStoreContract").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/contratos/cadastrar", {
                        id_plan: $("#id_plan option:selected").val(),
                        id_user: $("#id_usr").val(),
                        start_date: $("#start_date_contract").val(),
                        expiration_day: $("#expiration_day").val(),
                        months: $("#id_plan option:selected").data('months'),
                        price_per_month: $("#price_per_month").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreContract").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalStoreContract").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadAll)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    // RENOVAR CONTRATO
    $("#list-contracts").on("click", ".renew-contract", function(){
        let id = $(this).data('id');
        let id_plan = $(this).data('id_plan');
        let expiration_day = $(this).data('expiration_day');
        let price_per_month = $(this).data('price_per_month');

        $("#id_contract_renew").val(id);
        $("#id_plan_renew").val(id_plan).change();
        $("#expiration_day_renew").val(parseInt(expiration_day));
        $("#price_per_month_renew").val(moneyFormat(price_per_month));

        $("#modalRenewContract").modal("show");
    });

    $("#formRenewContract").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/contratos/cadastrar", {
                        id_contract_renew: $("#id_contract_renew").val(),
                        id_plan: $("#id_plan_renew option:selected").val(),
                        id_user: $("#id_usr").val(),
                        start_date: $("#start_date_contract_renew").val(),
                        expiration_day: $("#expiration_day_renew").val(),
                        months: $("#id_plan_renew option:selected").data('months'),
                        price_per_month: $("#price_per_month_renew").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formRenewContract").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalRenewContract").modal("hide");

                                showSuccess("Contrato renovado!", null, loadAll)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // CANCELAR CONTRATO
    $("#list-contracts").on("click", ".cancel-contract", function(){
        
        let id = $(this).data('id');

        Swal.fire({
            title: 'Atenção!',
            text: "Deseja realmente cancelar o contrato? todas as faturas vinculadas à ele que estão em aberto serão canceladas!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Sim',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {

                    Swal.queue([
                        {
                            title: "Carregando...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onOpen: () => {
                                Swal.showLoading();
                                $.ajax({
                                    url: window.location.origin + "/contratos/cancelar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Cancelado com sucesso!", null, loadAll)
                                        } else if (data.status == "error") {
                                            showError(data.message)
                                        }
                                    })
                                    .catch();
                            },
                        },
                    ]);

                }
            })

    });


    // ABRIR MODAL DE RECEBIMENTO
    $("#list-invoices").on("click", ".pay-invoice", function(){
        let id_invoice = $(this).data('id');
        let due_date = $(this).data('due_date');
        let price = $(this).data('price');

        $("#id_invoice").val(id_invoice);
        $("#due_date").val(due_date);
        $("#price").val(moneyFormat(price));
        $("#paid_price").val(moneyFormat(price));

        $("#modalReceiveInvoice").modal('show');
    });

    // APLICAR DESCONTO
    $("#discount").on("keyup", function(){

        let discount = $(this).val();
        let price = $("#price").val();
        let paid_price = $("#price").val();

        if(discount){

            discount = discount.replace('.','');
            discount = discount.replace(',','.');
            price = price.replace('.','');
            price = price.replace(',','.');
    
            paid_price = parseFloat(price) - parseFloat(discount);
    
            if(parseFloat(discount)>parseFloat(price))
                paid_price = 0;
            
            $("#paid_price").val(moneyFormat(paid_price.toFixed(2)));
        }else{
            $("#paid_price").val($("#price").val());
        }


    });

    // RECEBER FATURA
    $("#formReceiveInvoice").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/faturas/receber",
                        type: 'PUT',
                        data: {
                            id: $("#id_invoice").val(),
                            discount: $("#discount").val(),
                            paid_price: $("#paid_price").val()
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formReceiveInvoice").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalReceiveInvoice").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadAll)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    
    // EDITAR ALUNO
    $("#formEditStudent").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/alunos/editar",
                        type: 'PUT',
                        data: {
                            id: $("#id_usr").val(),
                            name: $("#name_edit").val(),
                            email: $("#email_edit").val(),
                            birth: $("#birth_edit").val(),
                            cpf: $("#cpf_edit").val(),
                            rg: $("#rg_edit").val(),
                            civil_status: $("#civil_status_edit option:selected").val(),
                            profession: $("#profession_edit").val(),
                            zip_code: $("#zip_code_edit").val(),
                            uf: $("#uf_edit").val(),
                            city: $("#city_edit").val(),
                            neighborhood: $("#neighborhood_edit").val(),
                            address: $("#address_edit").val(),
                            address_number: $("#address_number_edit").val(),
                            complement: $("#complement_edit").val(),
                            start_date: $("#start_date_edit").val(),
                            health_plan: $("#health_plan_edit").val(),
                            how_met: $("#how_met_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditStudent").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditStudent").modal("hide");

                                showSuccess("Editado com sucesso!", null, loadAll)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" ALUNO
    $("#delete-student").on("click", function(){
        
        let id = $("#id_usr").val();

        Swal.fire({
            title: 'Atenção!',
            text: "Deseja realmente deletar?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Sim',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {

                    Swal.queue([
                        {
                            title: "Carregando...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onOpen: () => {
                                Swal.showLoading();
                                $.ajax({
                                    url: window.location.origin + "/alunos/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletado com sucesso!", null, redirect)
                                        } else if (data.status == "error") {
                                            showError(data.message)
                                        }
                                    })
                                    .catch();
                            },
                        },
                    ]);

                }
            })

    });

    // REDIRECIONAR APÓS DELETAR
    function redirect()
    {
        window.location.replace("/alunos");
    }

    // CADASTRAR AULA
    $("#formStoreScheduledClasses").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/aulas-programadas/cadastrar", {
                        id_user: $("#id_usr").val(),
                        id_court: $("#id_court option:selected").val(),
                        week_day: $("#week_day").val(),
                        start_time: $("#start_time").val(),
                        end_time: $("#end_time").val(),
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreScheduledClasses").each(function () {
                                    this.reset();
                                });

                                $("#modalStoreScheduledClasses").modal("hide");

                                showSuccess("Aula cadastrada!", null, loadAll)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    // LISTAR AULAS AGENDADAS
    function listScheduledClasses()
    {
        let id = $("#id_usr").val();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + `/aulas-programadas/listar/${id}`, {
                        
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            
                            $("#list-scheduled-classes").html(``);

                            if(data.data.length > 0){

                                data.data.forEach(item => {

                                    $("#list-scheduled-classes").append(`
                                        <tr>
                                            <td class="align-middle">${item.court_name}</td>
                                            <td class="align-middle">${weekDayDescription(item.week_day)}</td>
                                            <td class="align-middle">${item.start_time} às ${item.end_time}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-scheduled-classes"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `);
                                    
                                });

                            }else{

                                $("#list-scheduled-classes").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="4">Nenhuma aula cadastrada</td>
                                    </tr>
                                `);

                            }

                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch();
                },
            },
        ]);
    }

    // "DELETAR" AULA
    $("#list-scheduled-classes").on("click", ".delete-scheduled-classes", function(){
    
        let id = $(this).data('id');

        Swal.fire({
            title: 'Atenção!',
            text: "Deseja realmente deletar?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Sim',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {

                    Swal.queue([
                        {
                            title: "Carregando...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onOpen: () => {
                                Swal.showLoading();
                                $.ajax({
                                    url: window.location.origin + "/aulas-programadas/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletada com sucesso!", null, loadAll)
                                        } else if (data.status == "error") {
                                            showError(data.message)
                                        }
                                    })
                                    .catch();
                            },
                        },
                    ]);

                }
            })
    });

    // LISTAR AULAS REALIZADAS/CANCELADAS/REAGENDADAS
    function listScheduledClassesResults()
    {
        let id = $("#id_usr").val();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + `/aulas-programadas-resultado/listar/${id}`, {
                        
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            
                            $("#list-scheduled-classes-results").html(``);

                            if(data.data.length > 0){

                                data.data.forEach(item => {

                                    $("#list-scheduled-classes-results").append(`
                                        <tr>
                                            <td class="align-middle">${item.court_name}</td>
                                            <td class="align-middle">${weekDayDescription(item.week_day)}</td>
                                            <td class="align-middle">${dateFormat(item.date)}</td>
                                            <td class="align-middle">${item.start_time} às ${item.end_time}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <span class="badge badge-${scheduledClassResultStatusClass(item.status)}">${scheduledClassResultStatus(item.status)}</span>
                                            </td>
                                        </tr>
                                    `);
                                    
                                });

                            }else{

                                $("#list-scheduled-classes-results").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="5">Nenhuma aula realizada</td>
                                    </tr>
                                `);

                            }

                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch();
                },
            },
        ]);
    }


    // CARREGAR DADOS NA TELA
    function loadAll()
    {
        // listar dados do aluno
        loadStudent();
        // listar planos no select
        loadPlans();
        // listar os contratos do aluno
        loadContracts();
        // listar as faturas do aluno
        loadInvoices();
        // listar quadras
        loadCourts();
        // listar aulas programadas
        listScheduledClasses();
        // listar aulas aplicadas/canceladas/reagendadas
        listScheduledClassesResults();
        // listar telefones
        loadPhones();
    }

});