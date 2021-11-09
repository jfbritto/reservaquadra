$(document).ready(function () {

    loadExpenses();
    loadCostCenter();

    // LISTAR DESPESAS
    function loadExpenses()
    {
        let date_ini = $("#date-ini").val();
        let date_end = $("#date-end").val();
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/despesas/listar", {
                        date_ini,
                        date_end
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                let tot_expenses_paid = 0;
                                let tot_expenses_pendent = 0;

                                if(data.data.length > 0){
                                    
                                    data.data.forEach(item => {

                                        // <a title="Editar" data-id="${item.id}" href="#" class="btn btn-warning edit-court"><i style="color: white" class="fas fa-edit"></i></a>

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${dateFormat(item.due_date)}</td>
                                                <td class="align-middle">${dateFormat(item.paid_date)}</td>
                                                <td class="align-middle">${item.name_cost_center}</td>
                                                <td class="align-middle">${item.name_cost_center_subtype}</td>
                                                <td class="align-middle">R$ ${moneyFormat(item.price)}</td>
                                                <td class="align-middle">${item.observation}</td>
                                                <td class="align-middle">${item.status=='P'?'<span class="badge badge-warning">Pendente</span>':'<span class="badge badge-success">Paga</span>'}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    ${item.status=='P'?`<a title="Informar pagamento" data-id="${item.id}" href="#" class="btn btn-success pay-expense"><i class="fas fa-comment-dollar"></i></a>`:''}
                                                    <a title="Duplicar despeza" data-id="${item.id}" data-next_month="${item.next_month}" data-price="${item.price}" data-id_cost_center="${item.id_cost_center}" data-id_cost_center_subtype="${item.id_cost_center_subtype}" data-subtype_name="${item.subtype_name}" data-observation="${item.observation}" href="#" class="btn btn-primary duplicate-expense"><i class="fas fa-copy"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-court"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       

                                        if(item.status == 'R')
                                            tot_expenses_paid += parseFloat(item.price);

                                        if(item.status == 'P')
                                            tot_expenses_pendent += parseFloat(item.price);
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="8">Nenhuma despesa encontrada</td>
                                        </tr>
                                    `);  
                                }

                                $("#tot-expenses-paid").html("R$ "+moneyFormat(tot_expenses_paid));
                                $("#tot-expenses-pendent").html("R$ "+moneyFormat(tot_expenses_pendent));


                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    // LISTAR CENTROS DE CUSTO
    function loadCostCenter()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/centros-de-custo/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_cost_center, #id_cost_center_duplicate").html(``);
                                $("#id_cost_center, #id_cost_center_duplicate").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_cost_center, #id_cost_center_duplicate").append(`
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

    // LISTAR SUBTIPOS DE CENTRO DE CUSTO
    $("#id_cost_center").on("change", function(){
        
        let id_cost_center = $("#id_cost_center option:selected").val();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/subtipos-de-centros-de-custo/listar", {
                        id_cost_center:id_cost_center
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_cost_center_subtype").html(``);
                                $("#id_cost_center_subtype").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_cost_center_subtype").append(`
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

    });

    // LISTAR SUBTIPOS DE CENTRO DE CUSTO - DUPLICAÇÃO
    $("#id_cost_center_duplicate").on("change", function(){
        
        let id_cost_center_duplicate = $("#id_cost_center_duplicate option:selected").val();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/subtipos-de-centros-de-custo/listar", {
                        id_cost_center:id_cost_center_duplicate
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_cost_center_subtype_duplicate").html(``);
                                $("#id_cost_center_subtype_duplicate").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_cost_center_subtype_duplicate").append(`
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

    });

    // CADASTRAR DESPESA
    $("#formStoreExpense").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/despesas/cadastrar", {
                        due_date: $("#due_date").val(),
                        price: $("#price").val(),
                        id_cost_center: $("#id_cost_center option:selected").val(),
                        id_cost_center_subtype: $("#id_cost_center_subtype option:selected").val(),
                        observation: $("#observation").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreExpense").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalStoreExpense").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadExpenses)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    // CADASTRAR DUPLICAÇÃO DE DESPESA
    $("#formDuplicateExpense").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/despesas/cadastrar", {
                        due_date: $("#due_date_duplicate").val(),
                        price: $("#price_duplicate").val(),
                        id_cost_center: $("#id_cost_center_duplicate option:selected").val(),
                        id_cost_center_subtype: $("#id_cost_center_subtype_duplicate option:selected").val(),
                        observation: $("#observation_duplicate").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formDuplicateExpense").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalDuplicateExpense").modal("hide");

                                showSuccess("Duplicação efetuada!", null, loadExpenses)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // // EDITAR DESPESA
    // $("#list").on("click", ".edit-court", function(){

    //     let id = $(this).data('id');
    //     let name = $(this).data('name');
    //     let months = $(this).data('months');
    //     let age_range = $(this).data('age_range');
    //     let day_period = $(this).data('day_period');
    //     let lessons_per_week = $(this).data('lessons_per_week');
    //     let price = $(this).data('price');

    //     $("#id_edit").val(id);
    //     $("#name_edit").val(name);
    //     $("#months_edit").val(months).change();
    //     $("#age_range_edit").val(age_range).change();
    //     $("#day_period_edit").val(day_period).change();
    //     $("#lessons_per_week_edit").val(lessons_per_week).change();
    //     $("#price_edit").val(moneyFormat(price));

    //     $("#modalEditPlan").modal("show");
    // });

    // $("#formEditPlan").submit(function (e) {
    //     e.preventDefault();

    //     Swal.queue([
    //         {
    //             title: "Carregando...",
    //             allowOutsideClick: false,
    //             allowEscapeKey: false,
    //             onOpen: () => {
    //                 Swal.showLoading();
    //                 $.post(window.location.origin + "/planos/editar", {
    //                     id: $("#id_edit").val(),
    //                     name: $("#name_edit").val(),
    //                     age_range: $("#age_range_edit option:selected").val(),
    //                     day_period: $("#day_period_edit option:selected").val(),
    //                     lessons_per_week: $("#lessons_per_week_edit option:selected").val(),
    //                     annual_contract: $("#annual_contract_edit option:selected").val(),
    //                     months: $("#months_edit option:selected").val(),
    //                     price: $("#price_edit").val(),
    //                 })
    //                     .then(function (data) {
    //                         if (data.status == "success") {

    //                             $("#formEditPlan").each(function () {
    //                                 this.reset();
    //                             });
                                
    //                             $("#modalEditPlan").modal("hide");

    //                             showSuccess("Edição efetuada!", null, loadExpenses)
    //                         } else if (data.status == "error") {
    //                             showError(data.message)
    //                         }
    //                     })
    //                     .catch();
    //             },
    //         },
    //     ]);
    // });


    // "DELETAR" DESPESA
    $("#list").on("click", ".delete-court", function(){
        
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
                                    url: window.location.origin + "/despesas/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletada com sucesso!", null, loadExpenses)
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

    // PAGAR DESPESA
    $("#list").on("click", ".pay-expense", function(){
        
        let id = $(this).data('id');

        Swal.fire({
            title: 'Atenção!',
            text: "Confirma que o valor foi pago?",
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
                                    url: window.location.origin + "/despesas/pagar",
                                    type: 'PUT',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Pagamento efetuado com sucesso!", null, loadExpenses)
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

    // DUPLICAR DESPESA
    $("#list").on("click", ".duplicate-expense", function(){
        
        let id = $(this).data('id');
        let next_month = $(this).data('next_month');
        let price = $(this).data('price');
        let id_cost_center = $(this).data('id_cost_center');
        let id_cost_center_subtype = $(this).data('id_cost_center_subtype');
        let subtype_name = $(this).data('subtype_name');
        let observation = $(this).data('observation');

        $("#due_date_duplicate").val(next_month);
        $("#price_duplicate").val(moneyFormat(price));
        $("#id_cost_center_duplicate").val(id_cost_center).change();
        setTimeout(() => {
            $("#id_cost_center_subtype_duplicate").val(id_cost_center_subtype).change();
        }, 400);
        // $("#id_cost_center_subtype_duplicate").html(`<option selected value="${id_cost_center_subtype}">${subtype_name}</option>`);
        $("#observation_duplicate").val(observation);
        

        $("#modalDuplicateExpense").modal("show");

        // Swal.fire({
        //     title: 'Atenção!',
        //     text: "Confirma que o valor foi pago?",
        //     type: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     confirmButtonText: 'Sim',
        //     cancelButtonColor: '#d33',
        //     cancelButtonText: 'Não'
        //     }).then((result) => {
        //         if (result.value) {

        //             Swal.queue([
        //                 {
        //                     title: "Carregando...",
        //                     allowOutsideClick: false,
        //                     allowEscapeKey: false,
        //                     onOpen: () => {
        //                         Swal.showLoading();
        //                         $.ajax({
        //                             url: window.location.origin + "/despesas/pagar",
        //                             type: 'PUT',
        //                             data: {id}
        //                         })
        //                             .then(function (data) {
        //                                 if (data.status == "success") {
                                                        
        //                                     showSuccess("Pagamento efetuado com sucesso!", null, loadExpenses)
        //                                 } else if (data.status == "error") {
        //                                     showError(data.message)
        //                                 }
        //                             })
        //                             .catch();
        //                     },
        //                 },
        //             ]);

        //         }
        //     })

    });

    $("#date-ini, #date-end").on("change", function(){
        loadExpenses();
    });


});