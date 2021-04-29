$(document).ready(function () {

    loadExpenses();
    loadCostCenter();

    // LISTAR DESPESAS
    function loadExpenses()
    {
        let date = $("#date").val();
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/despesas/listar", {
                        date
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
                                                <td class="align-middle">${item.name_cost_center}</td>
                                                <td class="align-middle">${item.name_cost_center_subtype}</td>
                                                <td class="align-middle">R$ ${moneyFormat(item.price)}</td>
                                                <td class="align-middle">${item.status=='P'?'<span class="badge badge-warning">Pendente</span>':'<span class="badge badge-success">Paga</span>'}</td>
                                                <td class="align-middle" style="text-align: right">
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

                                $("#id_cost_center").html(``);
                                $("#id_cost_center").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_cost_center").append(`
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

    $("#date").on("change", function(){
        loadExpenses();
    });


});