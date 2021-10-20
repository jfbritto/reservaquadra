$(document).ready(function () {

    loadPaymentMethod();

    // LISTAR MÉTODOS DE PAGAMENTO
    function loadPaymentMethod()
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
                                $("#list").html(``);

                                if(data.data.length > 0){
                                    
                                    data.data.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Subtipos de métodos de pagamento" href="#" data-id="${item.id}" data-name="${item.name}" class="btn btn-primary list-subtypes"><i style="color: white" class="fas fa-list"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhum métodos de pagamento cadastrado</td>
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

    // LISTAR SUBTIPOS DE MÉTODOS DE PAGAMENTO
    $("#list").on("click", ".list-subtypes", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $("#title-method").html(name);
        $("#id_payment_method_add").val(id);

        listSubtypes(id);
    });

    function listSubtypes(id)
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + `/subtipos-de-metodos-de-pagamento/listar`, {
                        id_payment_method:id
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list-subtypes").html(``);

                                if(data.data.length > 0){

                                    data.data.forEach(item => {

                                        $("#list-subtypes").append(`
                                            <tr>
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Condições de pagamento" href="#" data-id="${item.id}" data-name="${item.name}" class="btn btn-primary list-subtypes"><i style="color: white" class="fas fa-list"></i></a>
                                                </td>
                                            </tr>
                                        `);
                                        
                                    });

                                }else{

                                    $("#list-subtypes").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhum subtipo cadastrado</td>
                                        </tr>
                                    `);

                                }

                                $("#modalPaymentMethodSubtypes").modal("show");

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }


    // LISTAR CONDIÇÕES DE PAGAMENTO
    $("#list-subtypes").on("click", ".list-subtypes", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $("#title-subtype").html(name);
        $("#id_payment_method_condition_add").val(id);

        listSubtypeCondition(id);
    });

    function listSubtypeCondition(id)
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + `/condicoes-de-subtipos-de-metodos-de-pagamento/listar`, {
                        id_payment_method_subtype:id
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list-subtype-conditions").html(``);

                                if(data.data.length > 0){

                                    data.data.forEach(item => {

                                        $("#list-subtype-conditions").append(`
                                            <tr>
                                                <td class="align-middle">${item.parcel}</td>
                                                <td class="align-middle">${item.percentage_tax==0?``:`${item.percentage_tax}%`}</td>
                                                <td class="align-middle">${item.flat_tax==0?'':`R$${moneyFormat(item.flat_tax)}`}</td>
                                                <td class="align-middle">${item.days_for_payment}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    
                                                </td>
                                            </tr>
                                        `);

                                        // <a title="Condições de pagamento" href="#" data-id="${item.id}" data-parcel="${item.parcel}" class="btn btn-primary list-subtype-conditions"><i style="color: white" class="fas fa-list"></i></a>
                                        // <a title="Deletar" data-id="${item.id}" data-id_payment_method="${item.id_payment_method_subtype}" href="#" class="btn btn-danger delete-subtype"><i class="fas fa-trash-alt"></i></a>
                                        
                                    });

                                }else{

                                    $("#list-subtype-conditions").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="5">Nenhuma condição de pagamento cadastrada</td>
                                        </tr>
                                    `);

                                }

                                $("#modalPaymentMethodSubtypeCondition").modal("show");

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    // CADASTRAR CONDIÇÕES DE PAGAMENTO
    $("#formAddPaymentMethodSubtypeCondition").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/condicoes-de-subtipos-de-metodos-de-pagamento/cadastrar", {
                        id_payment_method: $("#id_payment_method_condition_add").val(),
                        parcel: $("#parcel").val(),
                        is_flat: $("#is_flat").val(),
                        percentage_tax: $("#percentage_tax").val(),
                        flat_tax: $("#flat_tax").val(),
                        days_for_payment: $("#days_for_payment").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formAddPaymentMethodSubtypeCondition").each(function () {
                                    this.reset();
                                });

                                $("#modalAddPaymentMethodSubtypeCondition").modal("hide");

                                showSuccess("Cadastro efetuado!", null, listSubtypeCondition, $("#id_payment_method_condition_add").val())
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" SUBTIPOS
    $("#list-subtypes").on("click", ".delete-subtype", function(){
        
        let id = $(this).data('id');
        let id_payment_method = $(this).data('id_payment_method');

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
                                    url: window.location.origin + "/subtipos-de-metodos-de-pagamento/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletada com sucesso!", null, listSubtypes, id_payment_method)
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


    $("#openModalAddPaymentMethodSubtypeCondition").on("click", function(){

        $("#box-percentage").hide();
        $("#box-flat").hide();
        $("#percentage_tax").prop("required", false);
        $("#flat_tax").prop("required", false);
        $("#percentage_tax").val("");
        $("#flat_tax").val("");
        $("#box-days_for_payment").hide();
        $("#days_for_payment").val("");

        $("#parcel, #is_flat").val("");
        $("#parcel, #is_flat").change();
        
        $("#modalAddPaymentMethodSubtypeCondition").modal("show")

    });

    $("#is_flat").on("change", function(){

        let is_flat = $("#is_flat option:selected").val();

        if(is_flat == "1"){
            $("#box-flat").show();
            $("#box-percentage").hide();
            $("#flat_tax").prop("required", true);
            $("#percentage_tax").prop("required", false);
            $("#box-days_for_payment").show();
        }else{
            if(is_flat == "0"){
                $("#box-percentage").show();
                $("#box-flat").hide();
                $("#percentage_tax").prop("required", true);
                $("#flat_tax").prop("required", false);
                $("#box-days_for_payment").show();
            }else{
                $("#box-percentage").hide();
                $("#box-flat").hide();
                $("#percentage_tax").prop("required", false);
                $("#flat_tax").prop("required", false);
                $("#box-days_for_payment").hide();
                $("#days_for_payment").val("");
            }
        }
            
        
    });

});