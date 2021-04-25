$(document).ready(function () {

    loadCostCenter();

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
                    $.get(window.location.origin + "/centro-de-custo/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                if(data.data.length > 0){
                                    
                                    data.data.forEach(item => {

                                        // <a title="Horários" href="#" data-id="${item.id}" data-name="${item.name}" class="btn btn-primary list-dates"><i style="color: white" class="fas fa-clock"></i></a>

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" href="#" class="btn btn-warning edit-cost-center"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-court"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhum centro de custo cadastrado</td>
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


    // CADASTRAR CENTRO DE CUSTO
    $("#formStoreCostCenter").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/centro-de-custo/cadastrar", {
                        name: $("#name").val(),
                        city: $("#city").val(),
                        neighborhood: $("#neighborhood").val(),
                        reference: $("#reference").val(),
                        description: $("#description").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreCostCenter").each(function () {
                                    this.reset();
                                });
                                
                                
                                $("#modalStoreCostCenter").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadCostCenter)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();

                },
            },
        ]);

    });


    // EDITAR CENTRO DE CUSTO
    $("#list").on("click", ".edit-cost-center", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $("#id_edit").val(id);
        $("#name_edit").val(name);

        $("#modalEditCostCenter").modal("show");
    });

    $("#formEditCostCenter").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/centro-de-custo/editar", {
                        id: $("#id_edit").val(),
                        name: $("#name_edit").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditCostCenter").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditCostCenter").modal("hide");

                                showSuccess("Edição efetuada!", null, loadCostCenter)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" CENTRO DE CUSTO
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
                                $.post(window.location.origin + "/centro-de-custo/deletar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadCostCenter)
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

                                $("#modalAddAvailableDate").modal("hide");

                                showSuccess("Cadastro efetuado!", null, listAvailableDates, $("#id_court_add").val())
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
                                                <td colspan="4" class="align-middle font-weight-bold">${weekDayDescription(item.week_day)}</td>
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
                                                        
                                            showSuccess("Deletada com sucesso!", null, listAvailableDates, id_court)
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