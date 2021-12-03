$(document).ready(function () {

    const tabela = $('#table').DataTable({
        "paging":   true,
        "ordering": true,
        "order": [],
        "info":     true,
        "searching":false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
        },
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );

    loadExpenses();
    loadProviders();
    loadCostCenter();

    // LISTAR DESPESAS
    function loadExpenses()
    {
        let date_ini = $("#date-ini").val();
        let date_end = $("#date-end").val();
        let provider_search = $("#provider_search").val();
        let cost_center_search = $("#cost_center_search").val();
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/despesas/listar", {
                        date_ini,
                        date_end,
                        provider_search,
                        cost_center_search,
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                let tot_expenses_paid = 0;
                                let tot_expenses_pendent = 0;

                                if(data.data.length > 0){
                                    
                                    // data.data.forEach(item => {

                                    //     $("#list").append(`
                                    //         <tr>
                                    //             <td class="align-middle">${dateFormat(item.due_date)}</td>
                                    //             <td class="align-middle">${dateFormat(item.paid_date)}</td>
                                    //             <td class="align-middle">${item.provider_name!=null?item.provider_name:''}</td>
                                    //             <td class="align-middle">${item.name_cost_center}</td>
                                    //             <td class="align-middle">${item.name_cost_center_subtype}</td>
                                    //             <td class="align-middle">R$ ${moneyFormat(item.price)}</td>
                                    //             <td class="align-middle">${item.observation}</td>
                                    //             <td class="align-middle">${item.status=='P'?'<span class="badge badge-warning">Pendente</span>':'<span class="badge badge-success">Paga</span>'}</td>
                                    //             <td class="align-middle" style="text-align: right">
                                    //                 <a title="Editar" data-id="${item.id}" data-id_provider="${item.id_provider}" data-price="${item.price}" data-due_date="${item.due_date}" data-id_cost_center="${item.id_cost_center}" data-id_cost_center_subtype="${item.id_cost_center_subtype}" data-subtype_name="${item.subtype_name}" data-observation="${item.observation}" href="#" class="btn btn-warning edit-expense"><i class="fas fa-pencil-alt"></i></a>
                                    //                 ${item.status=='P'?`<a title="Informar pagamento" data-id="${item.id}" href="#" class="btn btn-success pay-expense"><i class="fas fa-comment-dollar"></i></a>`:''}
                                    //                 <a title="Duplicar despesa" data-id="${item.id}" data-next_month="${item.next_month}" data-id_provider="${item.id_provider}" data-price="${item.price}" data-id_cost_center="${item.id_cost_center}" data-id_cost_center_subtype="${item.id_cost_center_subtype}" data-subtype_name="${item.subtype_name}" data-observation="${item.observation}" href="#" class="btn btn-primary duplicate-expense"><i class="fas fa-copy"></i></a>
                                    //                 <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-expense"><i class="fas fa-trash-alt"></i></a>
                                    //             </td>
                                    //         </tr>
                                    //     `);       
                                        

                                    //     if(item.status == 'R')
                                    //         tot_expenses_paid += parseFloat(item.price);

                                    //     if(item.status == 'P')
                                    //         tot_expenses_pendent += parseFloat(item.price);
                                    // });

                                    tabela.clear().draw();
        
                                    data.data.forEach(item => {

                                        tabela.row.add( [
                                            dateFormat(item.due_date), 
                                            dateFormat(item.paid_date), 
                                            item.provider_name!=null?item.provider_name:'', 
                                            item.name_cost_center, 
                                            item.name_cost_center_subtype, 
                                            moneyFormat(item.price), 
                                            item.observation, 
                                            item.status=='P'?'<span class="badge badge-warning">Pendente</span>':'<span class="badge badge-success">Paga</span>', 
                                            `<a title="Editar" data-id="${item.id}" data-id_provider="${item.id_provider}" data-price="${item.price}" data-due_date="${item.due_date}" data-id_cost_center="${item.id_cost_center}" data-id_cost_center_subtype="${item.id_cost_center_subtype}" data-subtype_name="${item.subtype_name}" data-observation="${item.observation}" href="#" class="btn btn-warning edit-expense"><i class="fas fa-pencil-alt"></i></a>
                                            ${item.status=='P'?`<a title="Informar pagamento" data-id="${item.id}" href="#" class="btn btn-success pay-expense"><i class="fas fa-comment-dollar"></i></a>`:''}
                                            <a title="Duplicar despesa" data-id="${item.id}" data-next_month="${item.next_month}" data-id_provider="${item.id_provider}" data-price="${item.price}" data-id_cost_center="${item.id_cost_center}" data-id_cost_center_subtype="${item.id_cost_center_subtype}" data-subtype_name="${item.subtype_name}" data-observation="${item.observation}" href="#" class="btn btn-primary duplicate-expense"><i class="fas fa-copy"></i></a>
                                            <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-expense"><i class="fas fa-trash-alt"></i></a>`, 
                                        ]).draw();

                                        if(item.status == 'R')
                                            tot_expenses_paid += parseFloat(item.price);

                                        if(item.status == 'P')
                                            tot_expenses_pendent += parseFloat(item.price);

                                    });

                                    $("#table tbody tr").each(function() {
                                        $(this).find('td:eq(3)').css('width','200px');
                                        $(this).find('td:eq(4)').css('width','200px');
                                        $(this).find('td:eq(5)').css('width','100px');
                                        $(this).find('td:eq(6)').css('width','250px');
                                        $(this).find('td:eq(8)').css('width','250px');
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="9">Nenhuma despesa encontrada</td>
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

    // LISTAR FORNECEDORES
    function loadProviders()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/fornecedores/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_provider, #id_provider_edit, #id_provider_duplicate").html(``);
                                $("#id_provider, #id_provider_edit, #id_provider_duplicate").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_provider, #id_provider_edit, #id_provider_duplicate").append(`
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

                                $("#id_cost_center, #id_cost_center_duplicate, #id_cost_center_edit").html(``);
                                $("#id_cost_center, #id_cost_center_duplicate, #id_cost_center_edit").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_cost_center, #id_cost_center_duplicate, #id_cost_center_edit").append(`
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

    // LISTAR SUBTIPOS DE CENTRO DE CUSTO - DUPLICAÇÃO
    $("#id_cost_center_edit").on("change", function(){
        
        let id_cost_center_edit = $("#id_cost_center_edit option:selected").val();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/subtipos-de-centros-de-custo/listar", {
                        id_cost_center:id_cost_center_edit
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                $("#id_cost_center_subtype_edit").html(``);
                                $("#id_cost_center_subtype_edit").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_cost_center_subtype_edit").append(`
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
                        id_provider: $("#id_provider option:selected").val(),
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
                        id_provider: $("#id_provider_duplicate option:selected").val(),
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


    // EDITAR DESPESA
    $("#list").on("click", ".edit-expense", function(){

        let id = $(this).data('id');
        let due_date = $(this).data('due_date');
        let price = $(this).data('price');
        let id_provider = $(this).data('id_provider');
        let id_cost_center = $(this).data('id_cost_center');
        let id_cost_center_subtype = $(this).data('id_cost_center_subtype');
        let observation = $(this).data('observation');

        $("#id_edit").val(id);
        $("#due_date_edit").val(due_date);
        $("#price_edit").val(moneyFormat(price));
        $("#id_provider_edit").val(id_provider).change();
        $("#id_cost_center_edit").val(id_cost_center).change();
        setTimeout(() => {
            $("#id_cost_center_subtype_edit").val(id_cost_center_subtype).change();
        }, 1000);
        $("#observation_edit").val(observation).change();

        $("#modalEditExpense").modal("show");
    });

    $("#formEditExpense").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/despesas/editar", 
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            due_date: $("#due_date_edit").val(),
                            price: $("#price_edit").val(),
                            id_provider: $("#id_provider_edit option:selected").val(),
                            id_cost_center: $("#id_cost_center_edit option:selected").val(),
                            id_cost_center_subtype: $("#id_cost_center_subtype_edit option:selected").val(),
                            observation: $("#observation_edit").val(),
                        }
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formEditExpense").each(function () {
                                this.reset();
                            });
                            
                            $("#modalEditExpense").modal("hide");

                            showSuccess("Edição efetuada!", null, loadExpenses)
                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch();
                },
            },
        ]);
    });


    // "DELETAR" DESPESA
    $("#list").on("click", ".delete-expense", function(){
        
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
        let id_provider = $(this).data('id_provider');
        let id_cost_center = $(this).data('id_cost_center');
        let id_cost_center_subtype = $(this).data('id_cost_center_subtype');
        let subtype_name = $(this).data('subtype_name');
        let observation = $(this).data('observation');

        $("#due_date_duplicate").val(next_month);
        $("#price_duplicate").val(moneyFormat(price));
        $("#id_provider_duplicate").val(id_provider).change();
        $("#id_cost_center_duplicate").val(id_cost_center).change();
        setTimeout(() => {
            $("#id_cost_center_subtype_duplicate").val(id_cost_center_subtype).change();
        }, 1000);
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

    // $("#date-ini, #date-end").on("change", function(){
    //     loadExpenses();
    // });

    // $("#provider_search, #cost_center_search").on("keyup", function(){
    //     loadExpenses();
    // });

    $("#search").on("click", function(){
        loadExpenses();
    });


});