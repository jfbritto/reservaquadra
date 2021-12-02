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

                                    let txt_status = item.status=='A'?`Inativar aluno`:`Ativar aluno`;
                                    $("#edit-status-student").html(`<a href="#" title="${txt_status}" class="btn btn-tool btn-sm edit-status-student" data-id="${item.id}" data-status="${item.status}" id="edit-status-student"><i class="fas fa-power-off"></i></a>`);

                                    $("#status-student").html(item.status=='A'?``:`<span class="badge badge-danger">Inativo</span>`);

                                    // CARREGAR INFORMAÇÕES NA TELA
                                    $("#responsible_name").html(item.responsible_name);
                                    $("#responsible_rg").html(item.responsible_rg);
                                    $("#responsible_cpf").html(item.responsible_cpf);
                                    $("#responsible_civil_status").html(item.responsible_civil_status);
                                    $("#responsible_profession").html(item.responsible_profession);
                                    $("#responsible_nationality").html(item.responsible_nationality);
                                    $("#responsible_address").html(`${item.responsible_address} ${item.responsible_address_number}, ${item.responsible_complement}. ${item.responsible_neighborhood}, ${item.responsible_city} - ${item.responsible_uf} | ${item.responsible_zip_code}`);
                                    
                                    $("#name").html(item.name);
                                    $("#email").html(item.email);
                                    $("#birth").html(dateFormat(item.birth));
                                    $("#nationality").html(item.nationality);
                                    $("#cpf").html(item.cpf);
                                    $("#rg").html(item.rg);
                                    $("#civil_status").html(item.civil_status);
                                    $("#profession").html(item.profession);
                                    $("#address").html(`${item.address} ${item.address_number}, ${item.complement}. ${item.neighborhood}, ${item.city} - ${item.uf} | ${item.zip_code}`);
                                    $("#start_date").html(dateFormat(item.start_date));
                                    $("#health_plan").html(item.health_plan);
                                    $("#how_met").html(item.how_met);
                                    $("#special_care").html(item.special_care);
                                    $("#objective").html(objectiveName(item.objective));

                                    // CARREGAR INFORMAÇÕES NO MODAL
                                    $("#name_edit").val(item.name);
                                    $("#email_edit").val(item.email);
                                    $("#birth_edit").val(item.birth);
                                    $("#cpf_edit").val(item.cpf);
                                    $("#rg_edit").val(item.rg);
                                    $("#civil_status_edit").val(item.civil_status).change();
                                    $("#nationality_edit").val(item.nationality);
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

                                    $("#registration_type_edit").val(item.registration_type).change();

                                    $("#gender_edit").val(item.gender).change();
                                    $("#special_care_edit").val(item.special_care);
                                    $("#objective_edit").val(item.objective).change();

                                    $("#responsible_name_edit").val(item.responsible_name);
                                    $("#responsible_cpf_edit").val(item.responsible_cpf);
                                    $("#responsible_rg_edit").val(item.responsible_rg);
                                    $("#responsible_civil_status_edit").val(item.responsible_civil_status).change();
                                    $("#responsible_nationality_edit").val(item.responsible_nationality);
                                    $("#responsible_profession_edit").val(item.responsible_profession);

                                    $("#responsible_zip_code_edit").val(item.responsible_zip_code);
                                    $("#responsible_uf_edit").val(item.responsible_uf);
                                    $("#responsible_city_edit").val(item.responsible_city);
                                    $("#responsible_neighborhood_edit").val(item.responsible_neighborhood);
                                    $("#responsible_address_edit").val(item.responsible_address);
                                    $("#responsible_address_number_edit").val(item.responsible_address_number);
                                    $("#responsible_complement_edit").val(item.responsible_complement);

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

    // ATIVAR OU INATIVAR ALUNO
    $("#edit-status-student").on("click", ".edit-status-student", function(){

        let id = $(this).data("id");
        let status = $(this).data("status");
        
        let txt_status = status=='A'?`inativar`:`ativar`;
        let txt_status_resposta = status=='A'?`Inativado`:`Ativado`;

        if(status == "A")
            status = "I";
        else if(status == "I")
            status = "A";
        

        if(status == "A"){
            
            Swal.fire({
                title: 'Atenção!',
                text: `Deseja realmente ${txt_status} o aluno?`,
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
                                        url: window.location.origin + "/alunos/mudar-status",
                                        type: 'PUT',
                                        data: {id,status}
                                    })
                                        .then(function (data) {
                                            if (data.status == "success") {
                                                            
                                                showSuccess(`${txt_status_resposta} com sucesso!`, null, loadAll)
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

        }else{
            $("#id_user_inativate").val(id);
            $("#modalInactivateUser").modal("show")
        }
    });

    // INATIVAR ALUNO ADICIONANDO DÉBITO
    $("#formInactivateUser").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/debitos/cadastrar",
                        type: 'POST',
                        data: {
                            id_user: $("#id_user_inativate").val(),
                            price: $("#price_debit").val(),
                            observation: $("#observation").val(),
                            inactivate_user: 1
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formInactivateUser").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalInactivateUser").modal("hide");

                                showSuccess("Inativado com sucesso!", null, loadAll)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    // LISTAR DÉBITOS
    function loadDebts()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/debitos/listar", {
                        id_user:$("#id_usr").val()
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#lista-debitos").html(``);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 

                                        $("#lista-debitos").append(`
                                            <div class="alert alert-warning" role="alert">
                                                <h4 class="alert-heading">Débito registrado</h4>
                                                <p>Valor: <strong>R$${moneyFormat(item.price)}</strong></p>
                                                <p><a class="btn btn-success btn-sm btn-gera-fatura-debito" style="text-decoration: none" data-id="${item.id}" data-price="${item.price}" data-id_user="${item.id_user}">Gerar fatura</a></p>
                                                <p class="mb-0"><strong>Observação: </strong>${item.observation}.</p>
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

    $("#lista-debitos").on("click", ".btn-gera-fatura-debito", function(){

        let id_debit = $(this).data("id");
        let id_user = $(this).data("id_user");
        let price = $(this).data("price");

        Swal.fire({
            title: 'Atenção!',
            text: `Deseja gerar a fatura de debito no valor de ${moneyFormat(price)}?`,
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
                                    url: window.location.origin + "/debitos/receber",
                                    type: 'PUT',
                                    data: {id:id_debit,price,id_user}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess(`Fatura criada com sucesso!`, null, loadAll)
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

                                $("#box-phones-registered").html(``);
                                $("#box-phones-registered-responsible").html(``);
                                $("#box-phones").html(``);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 

                                        let class_alert = item.is_emergency==0?`light`:`warning`;

                                        if(item.is_responsible_number == 0){
                                            $("#box-phones-registered").append(`
                                                <div class="col-sm-3">
                                                    <div class="alert alert-${class_alert}">
                                                        <span data-type="phone" data-is_responsible_number="${item.is_responsible_number}" data-is_emergency="${item.is_emergency}">${item.number}</span>
                                                    </div>
                                                </div>
                                            `);
                                        }else{
                                            $("#box-phones-registered-responsible").append(`
                                                <div class="col-sm-3">
                                                    <div class="alert alert-${class_alert}">
                                                        <span data-type="phone" data-is_responsible_number="${item.is_responsible_number}" data-is_emergency="${item.is_emergency}">${item.number}</span>
                                                    </div>
                                                </div>
                                            `);
                                        }

                                        

                                        let random = Math.floor(Math.random() * 100000);
    
                                        $("#box-phones").append(`
                                            <div class="col-sm-3 random${random}">
                                                <div class="alert alert-${class_alert}">
                                                    <span class="phone_add" data-type="phone" data-is_responsible_number="${item.is_responsible_number}" data-is_emergency="${item.is_emergency}">${item.number}</span>
                                                    <button type="button" class="close close-alert" data-class_alert="random${random}" >
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

    // LISTAR TIPOS DE FATURAS
    function loadInvoiceTypes()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/tipos-faturas/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_type_invoice").html(``);
                                $("#id_type_invoice").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_type_invoice").append(`
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

    // CADASTRAR FATURA AVULSA
    $("#formStoreSingleInvoice").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/faturas/cadastrar", {
                        id_user: $("#id_usr").val(),
                        price: $("#price_invoice").val(),
                        due_date: $("#due_date_invoice").val(),
                        id_type: $("#id_type_invoice option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreSingleInvoice").each(function () {
                                    this.reset();
                                });

                                $("#modalAddSingleInvoice").modal("hide");

                                showSuccess("Fatura criada!", null, loadAll)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

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
                            <option data-months="${item.months}" data-price="${item.price}" data-price_march="${item.price_march}" data-price_april="${item.price_april}" data-price_may="${item.price_may}" data-price_june="${item.price_june}" data-price_july="${item.price_july}" data-price_august="${item.price_august}" data-price_september="${item.price_september}" data-price_october="${item.price_october}" data-price_november="${item.price_november}" data-price_december="${item.price_december}" value="${item.id}">${getAgeRange(item.age_range)} - ${getDayPeriod(item.day_period)} - ${item.lessons_per_week} aula(s)/semana - contrato ${periodContractedDescription(item.months)} - R$ ${moneyFormat(item.price)}</option>
                        `)
                        
                        $("#id_plan_renew").append(`
                            <option data-months="${item.months}" data-price="${item.price}" data-price_march="${item.price_march}" data-price_april="${item.price_april}" data-price_may="${item.price_may}" data-price_june="${item.price_june}" data-price_july="${item.price_july}" data-price_august="${item.price_august}" data-price_september="${item.price_september}" data-price_october="${item.price_october}" data-price_november="${item.price_november}" data-price_december="${item.price_december}" value="${item.id}">${getAgeRange(item.age_range)} - ${getDayPeriod(item.day_period)} - ${item.lessons_per_week} aula(s)/semana - contrato ${periodContractedDescription(item.months)} - R$ ${moneyFormat(item.price)}</option>
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

        let empty = $("#id_plan option:selected").val();
        if(empty == ""){
            $(".price_per_month_box").removeClass("col-md-6").addClass("col-md-12");
            $("#price_per_month").val("");
            $("#price_per_month_label").html("Mensalidade");
            $("#expiration_day").val("");
            $("#expiration_day").attr("disabled", false);
            $(".parcels").hide();
            return false;
        }

        let actual_day = new Date();

        $("#price_per_month").val(moneyFormat($("#id_plan option:selected").data('price')))
        $("#final_value").val(moneyFormat($("#id_plan option:selected").data('price')))
        
        if($("#id_plan option:selected").data('months') >= 13){
            // $("#expiration_day").val("1");
            // $("#expiration_day").attr("disabled", true);

            let price = 0;
            let select = 0;
            
            if(actual_day.getMonth() == 0){
                price = $("#id_plan option:selected").data('price');
                select = 12;
            }else if(actual_day.getMonth() == 1){
                price = $("#id_plan option:selected").data('price');
                select = 12;
            }else if(actual_day.getMonth() == 2){
                price = $("#id_plan option:selected").data('price_march');
                select = 11;
            }else if(actual_day.getMonth() == 3){
                price = $("#id_plan option:selected").data('price_april');
                select = 10;
            }else if(actual_day.getMonth() == 4){
                price = $("#id_plan option:selected").data('price_may');
                select = 9;
            }else if(actual_day.getMonth() == 5){
                price = $("#id_plan option:selected").data('price_june');
                select = 8;
            }else if(actual_day.getMonth() == 6){
                price = $("#id_plan option:selected").data('price_july');
                select = 7;
            }else if(actual_day.getMonth() == 7){
                price = $("#id_plan option:selected").data('price_august');
                select = 6;
            }else if(actual_day.getMonth() == 8){
                price = $("#id_plan option:selected").data('price_september');
                select = 5;
            }else if(actual_day.getMonth() == 9){
                price = $("#id_plan option:selected").data('price_october');
                select = 4;
            }else if(actual_day.getMonth() == 10){
                price = $("#id_plan option:selected").data('price_november');
                select = 3;
            }else if(actual_day.getMonth() == 11){
                price = $("#id_plan option:selected").data('price_december');
                select = 2;
            }

            $("#price_per_month").val(moneyFormat(price));
            $("#final_value").val(moneyFormat(price));

            $("#parcel").html(``)
            for (let index = 1; index <= select; index++) {
                let parcels = (price/index).toFixed(2);
                $("#parcel").append(`<option value="${index}">${index} x de ${moneyFormat(parcels)}</option>`)
            }

            $("#price_per_month_label").html("Anuidade");

            $(".price_per_month_box").removeClass("col-md-4").addClass("col-md-3");
            $(".price_per_month_box").show();
            $(".parcels").show();
        }else{
            $(".price_per_month_box").removeClass("col-md-3").addClass("col-md-4");
            $(".price_per_month_box").show();
            $("#price_per_month_label").html("Mensalidade");
            $("#expiration_day").val("");
            $("#expiration_day").attr("disabled", false);
            $(".parcels").hide();
        }
    })

    $("#discount_contract").on("keyup", function(){

        let price_per_month = $("#price_per_month").val().replace(".","").replace(",",".");
        let discount_contract = $("#discount_contract").val().replace(".","").replace(",",".");

        let plan_months = $("#id_plan option:selected").data("months");
        
        if(isNaN(price_per_month) || price_per_month == ""){
            price_per_month = 0;
        }
        
        if(isNaN(discount_contract) || discount_contract == "")
            discount_contract = 0;
        
        let final_value = parseFloat(price_per_month) - parseFloat(discount_contract);
        
        if(parseFloat(discount_contract) >= parseFloat(price_per_month)){
            showError("O desconto não pode ser maior ou igual a mensalidade!")
            $("#discount_contract").val("")
            final_value = parseFloat(price_per_month);
        }

        if(plan_months < 12){
            
        
        }else{

            let actual_day = new Date();
            let price = 0;
            let select = 0;
            
            if(actual_day.getMonth() == 0){
                price = $("#id_plan option:selected").data('price');
                select = 12;
            }else if(actual_day.getMonth() == 1){
                price = $("#id_plan option:selected").data('price');
                select = 12;
            }else if(actual_day.getMonth() == 2){
                price = $("#id_plan option:selected").data('price_march');
                select = 11;
            }else if(actual_day.getMonth() == 3){
                price = $("#id_plan option:selected").data('price_april');
                select = 10;
            }else if(actual_day.getMonth() == 4){
                price = $("#id_plan option:selected").data('price_may');
                select = 9;
            }else if(actual_day.getMonth() == 5){
                price = $("#id_plan option:selected").data('price_june');
                select = 8;
            }else if(actual_day.getMonth() == 6){
                price = $("#id_plan option:selected").data('price_july');
                select = 7;
            }else if(actual_day.getMonth() == 7){
                price = $("#id_plan option:selected").data('price_august');
                select = 6;
            }else if(actual_day.getMonth() == 8){
                price = $("#id_plan option:selected").data('price_september');
                select = 5;
            }else if(actual_day.getMonth() == 9){
                price = $("#id_plan option:selected").data('price_october');
                select = 4;
            }else if(actual_day.getMonth() == 10){
                price = $("#id_plan option:selected").data('price_november');
                select = 3;
            }else if(actual_day.getMonth() == 11){
                price = $("#id_plan option:selected").data('price_december');
                select = 2;
            }

            $("#price_per_month").val(moneyFormat(price));
            $("#final_value").val(moneyFormat(final_value));

            $("#parcel").html(``)
            for (let index = 1; index <= select; index++) {
                let parcels = (final_value/index).toFixed(2);
                $("#parcel").append(`<option value="${index}">${index} x de ${moneyFormat(parcels)}</option>`)
            }

        }

        $("#final_value").val(moneyFormat(final_value));

    });

    $("#discount_contract_renew").on("keyup", function(){

        let price_per_month_renew = $("#price_per_month_renew").val().replace(".","").replace(",",".");
        let discount_contract_renew = $("#discount_contract_renew").val().replace(".","").replace(",",".");

        let plan_months_renew = $("#id_plan_renew option:selected").data("months");
        
        if(isNaN(price_per_month_renew) || price_per_month_renew == ""){
            price_per_month_renew = 0;
        }
        
        if(isNaN(discount_contract_renew) || discount_contract_renew == "")
            discount_contract_renew = 0;
        
        let final_value_renew = parseFloat(price_per_month_renew) - parseFloat(discount_contract_renew);
        
        if(parseFloat(discount_contract_renew) >= parseFloat(price_per_month_renew)){
            showError("O desconto não pode ser maior ou igual a mensalidade!")
            $("#discount_contract_renew").val("")
            final_value_renew = parseFloat(price_per_month_renew);
        }

        if(plan_months_renew < 12){
            
        
        }else{

            let actual_day_renew = new Date();
            let price_renew = 0;
            let select_renew = 0;
            
            if(actual_day_renew.getMonth() == 0){
                price_renew = $("#id_plan_renew option:selected").data('price');
                select_renew = 12;
            }else if(actual_day_renew.getMonth() == 1){
                price_renew = $("#id_plan_renew option:selected").data('price');
                select_renew = 12;
            }else if(actual_day_renew.getMonth() == 2){
                price_renew = $("#id_plan_renew option:selected").data('price_march');
                select_renew = 11;
            }else if(actual_day_renew.getMonth() == 3){
                price_renew = $("#id_plan_renew option:selected").data('price_april');
                select_renew = 10;
            }else if(actual_day_renew.getMonth() == 4){
                price_renew = $("#id_plan_renew option:selected").data('price_may');
                select_renew = 9;
            }else if(actual_day_renew.getMonth() == 5){
                price_renew = $("#id_plan_renew option:selected").data('price_june');
                select_renew = 8;
            }else if(actual_day_renew.getMonth() == 6){
                price_renew = $("#id_plan_renew option:selected").data('price_july');
                select_renew = 7;
            }else if(actual_day_renew.getMonth() == 7){
                price_renew = $("#id_plan_renew option:selected").data('price_august');
                select_renew = 6;
            }else if(actual_day_renew.getMonth() == 8){
                price_renew = $("#id_plan_renew option:selected").data('price_september');
                select_renew = 5;
            }else if(actual_day_renew.getMonth() == 9){
                price_renew = $("#id_plan_renew option:selected").data('price_october');
                select_renew = 4;
            }else if(actual_day_renew.getMonth() == 10){
                price_renew = $("#id_plan_renew option:selected").data('price_november');
                select_renew = 3;
            }else if(actual_day_renew.getMonth() == 11){
                price_renew = $("#id_plan_renew option:selected").data('price_december');
                select_renew = 2;
            }

            $("#price_per_month_renew").val(moneyFormat(price_renew));
            $("#final_value_renew").val(moneyFormat(final_value_renew));

            $("#parcel_renew").html(``)
            for (let index = 1; index <= select_renew; index++) {
                let parcels = (final_value_renew/index).toFixed(2);
                $("#parcel_renew").append(`<option value="${index}">${index} x de ${moneyFormat(parcels)}</option>`)
            }

        }

        $("#final_value_renew").val(moneyFormat(final_value_renew));

    });

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

    // LISTAR PRÓXIMA FATURA
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
                                <td class="align-middle"><span class="badge bg-${InvoicesStatusClass(item.status)}">${InvoicesStatusName(item.status)}</span></td>
                                <td class="align-middle">${item.invoice_type}</td>
                                <td class="align-middle">${dateFormat(item.due_date)}</td>
                                <td class="align-middle">R$ ${moneyFormat(item.price)}</td>
                                <td class="align-middle" style="text-align: right">
                                    <a title="Cancelar fatura" data-id="${item.id}" href="#" class="btn btn-danger cancel-invoice"><i class="fas fa-trash"></i></a>
                                    <a title="Receber" data-id="${item.id}" data-due_date="${item.due_date}" data-price="${item.price}" href="#" class="btn btn-success pay-invoice"><i class="fas fa-comment-dollar"></i></a>
                                </td>
                            </tr>
                        `);       
                    });

                }else{

                    $("#list-invoices").append(`
                        <tr>
                            <td class="align-middle text-center" colspan="5">Nenhuma fatura aberta encontrada</td>
                        </tr>
                    `);  

                }

            } else if (data.status == "error") {
                showError(data.message)
            }
        })
        .catch();

    }

    //LISTAR FATURAS
    $("#list-all-invoices").on("click", function(){

        listAllInvoicesReceived();

    });

    function listAllInvoicesReceived()
    {
        $.get(window.location.origin + `/faturas/listar-recebidas/${$("#id_usr").val()}`, {

        })
        .then(function (data) {
            if (data.status == "success") {

                $("#list-all-invoices-modal").html(``);

                if(data.data.length > 0){

                    data.data.forEach(item => {

                        $("#list-all-invoices-modal").append(`
                            <tr>
                                <td class="align-middle"><span class="badge bg-${InvoicesStatusClass(item.status)}">${InvoicesStatusName(item.status)}</span></td>
                                <td class="align-middle">${item.invoice_type}</td>
                                <td class="align-middle">${dateFormat(item.due_date)}</td>
                                <td class="align-middle">R$ ${moneyFormat(item.price)}</td>
                                <td class="align-middle">${item.fiscal_note==null?`-`:item.fiscal_note}</td>
                                <td class="align-middle">${item.fiscal_note_e==null?`-`:item.fiscal_note_e}</td>
                                <td class="align-middle" style="text-align: right">
                                    <a title="Editar" data-id="${item.id}" data-fiscal_note="${item.fiscal_note}" data-fiscal_note_e="${item.fiscal_note_e}" href="#" class="btn btn-warning btn-sm edit-invoice"><i class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                        `);       
                    });

                }else{

                    $("#list-all-invoices-modal").append(`
                        <tr>
                            <td class="align-middle text-center" colspan="7">Nenhuma fatura aberta encontrada</td>
                        </tr>
                    `);  

                }

                $("#modalListInvoices").modal("show");

            } else if (data.status == "error") {
                showError(data.message)
            }
        })
        .catch();
    }

    // MODAL PARA EDITAR FATURA
    $("#list-all-invoices-modal").on("click", ".edit-invoice", function(){

        let id_invoice = $(this).data("id");
        let fiscal_note = $(this).data("fiscal_note");
        let fiscal_note_e = $(this).data("fiscal_note_e");

        $("#id_invoice_edit").val(id_invoice);
        $("#fiscal_note").val(fiscal_note);
        $("#fiscal_note_e").val(fiscal_note_e);

        $("#modalEditInvoice").modal("show");
    });

    // EDITAR FATURA
    $("#formEditInvoice").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/faturas/editar",
                        type: 'PUT',
                        data: {
                            fiscal_note: $("#fiscal_note").val(),
                            fiscal_note_e: $("#fiscal_note_e").val(),
                            id_invoice: $("#id_invoice_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditInvoice").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditInvoice").modal("hide");

                                showSuccess("Editada com sucesso!", null, listAllInvoicesReceived)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    // LISTAR MÉTODOS DE PAGAMENTO
    function loadPaymentMethods()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/metodos-de-pagamento/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_payment_method").html(``);
                                $("#id_payment_method").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_payment_method").append(`
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

    // LISTAR SUBTIPOS DE MÉTODOS DE PAGAMENTO
    $("#id_payment_method").on("change", function(){
        
        let id_payment_method = $("#id_payment_method option:selected").val();
        $("#id_payment_method_subtype_condition").html(``);
        $("#id_payment_method_subtype").html(``);

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/subtipos-de-metodos-de-pagamento/listar", {
                        id_payment_method:id_payment_method
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_payment_method_subtype").html(``);
                                $("#id_payment_method_subtype").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    let selected = ``;
                                    if(data.data.length == 1)
                                        selected = `selected="selected"`;


                                    data.data.forEach(item => { 
                                        $("#id_payment_method_subtype").append(`
                                            <option ${selected} value="${item.id}">${item.name}</option>
                                        `)
                                    });

                                    if(data.data.length == 1)
                                        $("#id_payment_method_subtype").change();

                                }

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);

    });

    // LISTAR PARCELAS DE SUBTIPOS DE MÉTODOS DE PAGAMENTO
    $("#id_payment_method_subtype").on("change", function(){
        
        let id_payment_method_subtype = $("#id_payment_method_subtype option:selected").val();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/condicoes-de-subtipos-de-metodos-de-pagamento/listar", {
                        id_payment_method_subtype:id_payment_method_subtype
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_payment_method_subtype_condition").html(``);
                                $("#id_payment_method_subtype_condition").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    let selected = ``;
                                    if(data.data.length == 1)
                                        selected = `selected="selected"`;


                                    data.data.forEach(item => { 
                                        $("#id_payment_method_subtype_condition").append(`
                                            <option ${selected} value="${item.id}">${item.parcel}</option>
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

    });


    $("#btn-new-contract").on("click", function(){

        $(".price_per_month_box").hide();
        $(".parcels").hide();
        $("#modalStoreContract").modal("show");
    })

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
                        parcel: $("#parcel option:selected").val(),
                        price_per_month: $("#price_per_month").val(),
                        discount: $("#discount_contract").val(),
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
        $("#expiration_day_renew").val(parseInt(expiration_day));
        $("#price_per_month_renew").val(moneyFormat(price_per_month));
        $("#id_plan_renew").val(id_plan).change();

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
                        parcel: $("#parcel_renew option:selected").val(),
                        price_per_month: $("#price_per_month_renew").val(),
                        discount: $("#discount_contract_renew").val(),
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

    $("#id_plan_renew").on("change", function(){

        let empty = $("#id_plan_renew option:selected").val();
        if(empty == ""){
            $(".price_per_month_box_renew").removeClass("col-md-6").addClass("col-md-12");
            $("#price_per_month_renew").val("");
            $("#price_per_month_label_renew").html("Mensalidade");
            $("#expiration_day_renew").val("");
            $("#expiration_day_renew").attr("disabled", false);
            $(".parcels_renew").hide();
            return false;
        }

        let actual_day = new Date();

        $("#price_per_month_renew").val(moneyFormat($("#id_plan_renew option:selected").data('price')))
        $("#final_value_renew").val(moneyFormat($("#id_plan option:selected").data('price')))

        if($("#id_plan_renew option:selected").data('months') >= 13){
            // $("#expiration_day_renew").val("1");
            // $("#expiration_day_renew").attr("disabled", true);

            let price = 0;
            let select = 0;
            
            if(actual_day.getMonth() == 0){
                price = $("#id_plan_renew option:selected").data('price');
                select = 12;
            }else if(actual_day.getMonth() == 1){
                price = $("#id_plan_renew option:selected").data('price');
                select = 12;
            }else if(actual_day.getMonth() == 2){
                price = $("#id_plan_renew option:selected").data('price_march');
                select = 11;
            }else if(actual_day.getMonth() == 3){
                price = $("#id_plan_renew option:selected").data('price_april');
                select = 10;
            }else if(actual_day.getMonth() == 4){
                price = $("#id_plan_renew option:selected").data('price_may');
                select = 9;
            }else if(actual_day.getMonth() == 5){
                price = $("#id_plan_renew option:selected").data('price_june');
                select = 8;
            }else if(actual_day.getMonth() == 6){
                price = $("#id_plan_renew option:selected").data('price_july');
                select = 7;
            }else if(actual_day.getMonth() == 7){
                price = $("#id_plan_renew option:selected").data('price_august');
                select = 6;
            }else if(actual_day.getMonth() == 8){
                price = $("#id_plan_renew option:selected").data('price_september');
                select = 5;
            }else if(actual_day.getMonth() == 9){
                price = $("#id_plan_renew option:selected").data('price_october');
                select = 4;
            }else if(actual_day.getMonth() == 10){
                price = $("#id_plan_renew option:selected").data('price_november');
                select = 3;
            }else if(actual_day.getMonth() == 11){
                price = $("#id_plan_renew option:selected").data('price_december');
                select = 2;
            }


            console.log(price)

            $("#price_per_month_renew").val(moneyFormat(price));
            $("#final_value_renew").val(moneyFormat(price));


            $("#parcel_renew").html(``)
            for (let index = 1; index <= select; index++) {
                let parcels = (price/index).toFixed(2);
                $("#parcel_renew").append(`<option value="${index}">${index} x de ${moneyFormat(parcels)}</option>`)
            }

            $("#price_per_month_label_renew").html("Anuidade");

            $(".price_per_month_box_renew").removeClass("col-md-4").addClass("col-md-3");
            $(".price_per_month_box_renew").show();
            $(".parcels_renew").show();
        }else{
            $(".price_per_month_box_renew").removeClass("col-md-3").addClass("col-md-4");
            $(".price_per_month_box_renew").show();
            $("#price_per_month_label_renew").html("Mensalidade");
            $("#expiration_day_renew").val("");
            $("#expiration_day_renew").attr("disabled", false);
            $(".parcels_renew").hide();
        }
    })


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


    // CANCELAR FATURA
    $("#list-invoices").on("click", ".cancel-invoice", function(){
        let id = $(this).data('id');

        Swal.fire({
            title: 'Para cancelar, informe a senha de administrador',
            input: 'password',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            showLoaderOnConfirm: false,
            preConfirm: (pass) => {

                if(pass == "admin123"){
                    return '1';
                }else{
                    return '0';
                }

            },
            allowOutsideClick: () => !Swal.isLoading()
          }).then((result) => {
            if (result.value == '1') {

                Swal.fire({
                    title: 'Atenção!',
                    text: "Deseja realmente cancelar a fatura?",
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
                                            url: window.location.origin + "/faturas/cancelar",
                                            type: 'DELETE',
                                            data: {id}
                                        })
                                            .then(function (data) {
                                                if (data.status == "success") {
                                                                
                                                    showSuccess("Fatura cancelada com sucesso!", null, loadAll)
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
                
            }else{
                
                showError("Senha incorreta!")

            }
          })

        // $("#id_invoice").val(id_invoice);
        // $("#due_date").val(due_date);
        // $("#price").val(moneyFormat(price));
        // $("#paid_price").val(moneyFormat(price));

        // $("#id_payment_method_subtype").html("");
        // $("#id_payment_method_subtype_condition").html("");

        // $("#modalReceiveInvoice").modal('show');
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

        $("#id_payment_method_subtype").html("");
        $("#id_payment_method_subtype_condition").html("");

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
                            paid_price: $("#paid_price").val(),
                            id_payment_method: $("#id_payment_method option:selected").val(),
                            id_payment_method_subtype: $("#id_payment_method_subtype option:selected").val(),
                            id_payment_method_subtype_condition: $("#id_payment_method_subtype_condition option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formReceiveInvoice").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalReceiveInvoice").modal("hide");

                                showSuccess("Recebimento efetuado!", null, loadAll)
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

        let phones = $(".phone_add");
        let phone_array = [];
        let phone_is_responsible_number_array = [];
        let phone_is_emergency_array = [];
        for (const key in phones) {
            if (Object.hasOwnProperty.call(phones, key)) {
                const element = $(phones[key]).data("type");
                let is_responsible_number = $(phones[key]).data("is_responsible_number");
                let is_emergency = $(phones[key]).data("is_emergency");
                if(element == "phone")
                    phone_array.push($(phones[key]).html())
                    phone_is_responsible_number_array.push(is_responsible_number)
                    phone_is_emergency_array.push(is_emergency)
            }
        }

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
                            nationality: $("#nationality_edit").val(),
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
                            
                            registration_type: $("#registration_type_edit option:selected").val(),

                            gender: $("#gender_edit").val(),
                            special_care: $("#special_care_edit").val(),
                            objective: $("#objective_edit option:selected").val(),
                            
                            responsible_name: $("#responsible_name_edit").val(),
                            responsible_cpf: $("#responsible_cpf_edit").val(),
                            responsible_rg: $("#responsible_rg_edit").val(),
                            responsible_civil_status: $("#responsible_civil_status_edit option:selected").val(),
                            responsible_nationality: $("#responsible_nationality_edit").val(),
                            responsible_profession: $("#responsible_profession_edit").val(),

                            responsible_zip_code: $("#responsible_zip_code_edit").val(),
                            responsible_uf: $("#responsible_uf_edit").val(),
                            responsible_city: $("#responsible_city_edit").val(),
                            responsible_neighborhood: $("#responsible_neighborhood_edit").val(),
                            responsible_address: $("#responsible_address_edit").val(),
                            responsible_address_number: $("#responsible_address_number_edit").val(),
                            responsible_complement: $("#responsible_complement_edit").val(),
                            
                            phones:phone_array,
                            phone_is_responsible_number:phone_is_responsible_number_array,
                            phone_is_emergency:phone_is_emergency_array
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
                                                <span class="badge badge-${scheduledClassResultStatusClass(item.result)}">${scheduledClassResultStatus(item.result)}</span>
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

    $("#btn-add-phone").on("click", function(){

        let number = $("#phone_number").val();
        let is_responsible_number = $("#is_responsible_number option:selected").val();
        let is_emergency = $("#is_emergency option:selected").val();
        let random = Math.floor(Math.random() * 100000);

        let class_alert = is_emergency==0?`light`:`warning`;

        $("#box-phones").append(`
            <div class="col-sm-2 random${random}">
                <div class="alert alert-${class_alert}">
                    <span class="phone_add" data-type="phone" data-is_responsible_number="${is_responsible_number}" data-is_emergency="${is_emergency}" >${number}</span>
                    <button type="button" class="close close-alert" data-class_alert="random${random}" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        `);

        $("#modalAddPhone").modal("hide");
        $("#phone_number").val("");
        $("#is_responsible_number").val("0").change();
        $("#is_emergency").val("0").change();

    });

    $("#box-phones").on("click", ".close-alert", function(){
        let class_alert = $(this).data("class_alert");
        $(`.${class_alert}`).remove()
    });

    $("#registration_type_edit").on("change", function(){

        let type = $("#registration_type_edit option:selected").val();

        if(type == 'A'){
            $(".adulto").show()
            $(".infantil").hide()

            $(".change-class").removeClass("col-md-6").addClass("col-md-3")
            $(".change-class").removeClass("col-md-6").addClass("col-md-3")
            $(".change-class").removeClass("col-md-6").addClass("col-md-3")
            $(".change-class").removeClass("col-md-6").addClass("col-md-3")

            $(".phone-class").removeClass("col-md-4").addClass("col-md-6")
        }else{
            $(".infantil").show()
            $(".adulto").hide()
            
            $(".change-class").removeClass("col-md-3").addClass("col-md-6")
            $(".change-class").removeClass("col-md-3").addClass("col-md-6")
            $(".change-class").removeClass("col-md-3").addClass("col-md-6")
            $(".change-class").removeClass("col-md-3").addClass("col-md-6")

            $(".phone-class").removeClass("col-md-6").addClass("col-md-4")
        }

    });

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
        //listar métodos de pagamento
        loadPaymentMethods();
        //listar tipos de faturas
        loadInvoiceTypes();
        // listar débitos
        loadDebts();
    }

});