$(document).ready(function () {

    loadPlans();

    // LISTAR PLANOS
    function loadPlans()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planos/listar", {
                        
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
                                                <td class="align-middle">${item.months}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-months="${item.months}" href="#" class="btn btn-warning edit-court"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-court"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="3">Nenhum plano cadastrado</td>
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


    // CADASTRAR PLANO
    $("#formStorePlan").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/planos/cadastrar", {
                        name: $("#name").val(),
                        months: $("#months").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStorePlan").each(function () {
                                    this.reset();
                                });
                                
                                loadPlans();
                                $("#modalStorePlan").modal("hide");

                                showSuccess("Cadastro efetuado!")
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // EDITAR PLANO
    $("#list").on("click", ".edit-court", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let months = $(this).data('months');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#months_edit").val(months);

        $("#modalEditPlan").modal("show");
    });

    $("#formEditPlan").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/planos/editar", {
                        id: $("#id_edit").val(),
                        name: $("#name_edit").val(),
                        months: $("#months_edit").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditPlan").each(function () {
                                    this.reset();
                                });
                                
                                loadPlans();
                                $("#modalEditPlan").modal("hide");

                                showSuccess("Edição efetuada!")
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" PLANO
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
                console.log(result)
                if (result.value) {

                    Swal.queue([
                        {
                            title: "Carregando...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onOpen: () => {
                                Swal.showLoading();
                                $.post(window.location.origin + "/quadra/deletar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            loadPlans();
            
                                            showSuccess("Deletado com sucesso!")
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
    

    // CADASTRAR DATA DISPONÍVEL
    $("#formAddAvailableDate").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/datas-disponiveis/cadastrar", {
                        id_court: $("#id_court_add").val(),
                        week_day: $("#week_day").val(),
                        start_time: $("#start_time").val(),
                        end_time: $("#end_time").val(),
                        price: $("#price").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formAddAvailableDate").each(function () {
                                    this.reset();
                                });

                                listAvailableDates($("#id_court_add").val())
                                
                                $("#modalAddAvailableDate").modal("hide");

                                showSuccess("Cadastro efetuado!")
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // LISTAR DATAS DISPONÍVEIS
    $("#list").on("click", ".list-dates", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $("#title-court").html(name);
        $("#id_court_add").val(id);

        listAvailableDates(id);
    });

    function listAvailableDates(id)
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + `/datas-disponiveis/listar/${id}`, {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                
                                $("#list-dates").html(``);

                                let wd = ""

                                if(data.data.length > 0){

                                    data.data.forEach(item => {
                                        
                                        if(wd != item.week_day)
                                        $("#list-dates").append(`
                                            <tr class="table-active">
                                                <td colspan="4" class="align-middle font-weight-bold">${week_day_description[item.week_day]}</td>
                                            </tr>
                                        `);

                                        wd = item.week_day;

                                        $("#list-dates").append(`
                                            <tr>
                                                <td class="align-middle">${item.start_time}</td>
                                                <td class="align-middle">${item.end_time}</td>
                                                <td class="align-middle">R$ ${moneyFormat(item.price)}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Deletar" data-id="${item.id}" data-id_court="${item.id_court}" href="#" class="btn btn-danger delete-available-date"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);
                                        
                                    });

                                }else{

                                    $("#list-dates").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="5">Nenhuma hora disponível cadastrada</td>
                                        </tr>
                                    `);

                                }

                                $("#modalAvailableDates").modal("show");

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }


    // "DELETAR" QUADRA
    $("#list-dates").on("click", ".delete-available-date", function(){
        
        let id = $(this).data('id');
        let id_court = $(this).data('id_court');

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
                                $.post(window.location.origin + "/datas-disponiveis/deletar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            listAvailableDates(id_court);
            
                                            showSuccess("Deletada com sucesso!")
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

});