$(document).ready(function () {

    // listar dados do aluno
    loadStudent();
    // listar planos no select
    loadPlans();
    // listar os contratos do aluno
    loadContracts();
    // listar as faturas do aluno
    loadInvoices();

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

                                    $("#name").html(item.name);
                                    $("#email").html(item.email);
                                    $("#birth").html(dateFormat(item.birth));
                                    $("#cpf").html(item.cpf);
                                    $("#rg").html(item.rg);
                                    $("#civil_status").html(item.civil_status);
                                    $("#profession").html(item.profession);
                                    $("#zip_code").html(item.zip_code);
                                    $("#city").html(`${item.city} - ${item.uf}`);
                                    $("#neighborhood").html(item.neighborhood);
                                    $("#address").html(`${item.address}, ${item.address_number}`);
                                    $("#complement").html(item.complement);
                                    $("#start_date").html(dateFormat(item.start_date));
                                    $("#health_plan").html(item.health_plan);
                                    $("#how_met").html(item.how_met);

                                }

                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
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
                            <option data-months="${item.months}" value="${item.id}">${item.name}</option>
                        `)
                        
                        $("#id_plan_renew").append(`
                            <option data-months="${item.months}" value="${item.id}">${item.name}</option>
                        `)

                    });

                }

            } else if (data.status == "error") {
                Swal.fire({
                    icon: "error",
                    text: data.message,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: "OK",
                    onClose: () => {},
                });
            }
        })
        .catch();

    }

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
                                <td class="align-middle">${item.plan_name}</td>
                                <td class="align-middle">${item.status=='A'?`<span class="badge bg-success">Ativo</span>`:`<span class="badge bg-warning">${item.status}</span>`}</td>
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
                // showError(data.message);
                Swal.fire({
                    icon: "error",
                    text: data.message,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: "OK",
                    onClose: () => {},
                });
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
                // showError(data.message);
                Swal.fire({
                    icon: "error",
                    text: data.message,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: "OK",
                    onClose: () => {},
                });
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
                                
                                loadStudent();
                                loadContracts();
                                loadInvoices();
                                $("#modalStoreContract").modal("hide");

                                Swal.fire({
                                    icon: "success",
                                    text: "Cadastro efetuado!",
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

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

    // RENOVAR CONTRATO
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
                                
                                loadStudent();
                                loadContracts();
                                loadInvoices();
                                $("#modalRenewContract").modal("hide");

                                Swal.fire({
                                    icon: "success",
                                    text: "Contrato renovado!",
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

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
                console.log(result)
                if (result.value) {

                    Swal.queue([
                        {
                            title: "Carregando...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onOpen: () => {
                                Swal.showLoading();
                                $.post(window.location.origin + "/contratos/cancelar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            loadStudent();
                                            loadContracts();
                                            loadInvoices();
            
                                            Swal.fire({
                                                icon: "success",
                                                text: "Cancelado com sucesso!",
                                                showConfirmButton: false,
                                                showCancelButton: true,
                                                cancelButtonText: "OK",
                                                onClose: () => {},
                                            });
                                        } else if (data.status == "error") {
                                            // showError(data.message);
                                            Swal.fire({
                                                icon: "error",
                                                text: data.message,
                                                showConfirmButton: false,
                                                showCancelButton: true,
                                                cancelButtonText: "OK",
                                                onClose: () => {},
                                            });
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
                    $.post(window.location.origin + "/faturas/receber", {
                        id: $("#id_invoice").val(),
                        discount: $("#discount").val(),
                        paid_price: $("#paid_price").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formReceiveInvoice").each(function () {
                                    this.reset();
                                });
                                
                                loadStudent();
                                loadContracts();
                                loadInvoices();
                                $("#modalReceiveInvoice").modal("hide");

                                Swal.fire({
                                    icon: "success",
                                    text: "Cadastro efetuado!",
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    












    // EDITAR ALUNO
    $("#list").on("click", ".edit-student", function(){

        let id = $(this).data('id');

        $("#id_edit").val(id);

        $("#name_edit").val($(this).data('name'));
        $("#email_edit").val($(this).data('email'));
        $("#birth_edit").val($(this).data('birth'));
        $("#cpf_edit").val($(this).data('cpf'));
        $("#rg_edit").val($(this).data('rg'));
        $("#civil_status_edit").val($(this).data('civil_status')).change();
        $("#profession_edit").val($(this).data('profession'));
        $("#zip_code_edit").val($(this).data('zip_code'));
        $("#uf_edit").val($(this).data('uf'));
        $("#city_edit").val($(this).data('city'));
        $("#neighborhood_edit").val($(this).data('neighborhood'));
        $("#address_edit").val($(this).data('address'));
        $("#address_number_edit").val($(this).data('address_number'));
        $("#complement_edit").val($(this).data('complement'));
        $("#start_date_edit").val($(this).data('start_date'));
        $("#health_plan_edit").val($(this).data('health_plan'));
        $("#how_met_edit").val($(this).data('how_met')).change();

        $("#modalEditStudent").modal("show");
    });

    $("#formEditStudent").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/alunos/editar", {
                        id: $("#id_edit").val(),
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
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditStudent").each(function () {
                                    this.reset();
                                });
                                
                                loadStudent();
                                $("#modalEditStudent").modal("hide");

                                Swal.fire({
                                    icon: "success",
                                    text: "Cadastro efetuado!",
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" ALUNO
    $("#list").on("click", ".delete-student", function(){
        
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
                console.log(result)
                if (result.value) {

                    Swal.queue([
                        {
                            title: "Carregando...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onOpen: () => {
                                Swal.showLoading();
                                $.post(window.location.origin + "/alunos/deletar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            loadStudent();
            
                                            Swal.fire({
                                                icon: "success",
                                                text: "Deletado com sucesso!",
                                                showConfirmButton: false,
                                                showCancelButton: true,
                                                cancelButtonText: "OK",
                                                onClose: () => {},
                                            });
                                        } else if (data.status == "error") {
                                            // showError(data.message);
                                            Swal.fire({
                                                icon: "error",
                                                text: data.message,
                                                showConfirmButton: false,
                                                showCancelButton: true,
                                                cancelButtonText: "OK",
                                                onClose: () => {},
                                            });
                                        }
                                    })
                                    .catch();
                            },
                        },
                    ]);

                }
            })

    });





    // BUSCA DE ENDEREÇO

    $("#zip_code").on("keyup", function(){

        if($(this).val().length == 9){

            let type = $(this).data('type');
            let zip_code = $(this).val();

            zip_code = zip_code.replace("-","");

            Swal.queue([
                {
                    title: "Carregando...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onOpen: () => {
                        Swal.showLoading();
                        $.get(`http://viacep.com.br/ws/${zip_code}/json`, { })
                            .then(function (data) {

                                if(data.erro){
                                    Swal.fire('Erro!', "Cep não encontrado!", 'error');
                                    return false;
                                }

                                if(type == 'add'){
                                    
                                    $("#uf").prop("readonly", true)
                                    $("#city").prop("readonly", true)
                                    $("#neighborhood").prop("readonly", true)
                                    $("#address").prop("readonly", true)
                                    
                                    $("#uf").val(data.uf);
                                    $("#city").val(data.localidade);
                                    $("#neighborhood").val(data.bairro);
                                    $("#address").val(data.logradouro);
    
                                    if(data.uf == "")
                                        $("#uf").prop("readonly", false)
    
                                    if(data.localidade == "")
                                        $("#city").prop("readonly", false)
    
                                    if(data.bairro == "")
                                        $("#neighborhood").prop("readonly", false)
    
                                    if(data.logradouro == "")
                                        $("#address").prop("readonly", false)
                                        
                                }else{

                                    $("#uf_edit").prop("readonly", true)
                                    $("#city_edit").prop("readonly", true)
                                    $("#neighborhood_edit").prop("readonly", true)
                                    $("#address_edit").prop("readonly", true)
                                    
                                    $("#uf_edit").val(data.uf);
                                    $("#city_edit").val(data.localidade);
                                    $("#neighborhood_edit").val(data.bairro);
                                    $("#address_edit").val(data.logradouro);
    
                                    if(data.uf == "")
                                        $("#uf_edit").prop("readonly", false)
    
                                    if(data.localidade == "")
                                        $("#city_edit").prop("readonly", false)
    
                                    if(data.bairro == "")
                                        $("#neighborhood_edit").prop("readonly", false)
    
                                    if(data.logradouro == "")
                                        $("#address_edit").prop("readonly", false)
                                    
                                }

                                
                                Swal.close();

                            })
                            .catch();
                    },
                },
            ]);


        }


    })






    


});