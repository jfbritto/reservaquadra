$(document).ready(function () {

    loadCourts();

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
                    $.post(window.location.origin + "/quadra/listar", {
                        
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
                                                    <a title="Horários" href="#" data-id="${item.id}" data-name="${item.name}" class="btn btn-primary list-dates"><i style="color: white" class="fas fa-clock"></i></a>
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-city="${item.city}" data-neighborhood="${item.neighborhood}" data-reference="${item.reference}" data-description="${item.description}" href="#" class="btn btn-warning edit-court"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-court"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhuma quadra cadastrada</td>
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


    // CADASTRAR QUADRA
    $("#formStoreCourt").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/quadra/cadastrar", {
                        name: $("#name").val(),
                        city: $("#city").val(),
                        neighborhood: $("#neighborhood").val(),
                        reference: $("#reference").val(),
                        description: $("#description").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreCourt").each(function () {
                                    this.reset();
                                });
                                
                                
                                $("#modalStoreCourt").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadCourts)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();

                },
            },
        ]);

    });


    // EDITAR QUADRA
    $("#list").on("click", ".edit-court", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let city = $(this).data('city');
        let neighborhood = $(this).data('neighborhood');
        let reference = $(this).data('reference');
        let description = $(this).data('description');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#city_edit").val(city);
        $("#neighborhood_edit").val(neighborhood);
        $("#reference_edit").val(reference);
        $("#description_edit").val(description);

        $("#modalEditCourt").modal("show");
    });

    $("#formEditCourt").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/quadra/editar", {
                        id: $("#id_edit").val(),
                        name: $("#name_edit").val(),
                        city: $("#city_edit").val(),
                        neighborhood: $("#neighborhood_edit").val(),
                        reference: $("#reference_edit").val(),
                        description: $("#description_edit").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditCourt").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditCourt").modal("hide");

                                showSuccess("Edição efetuada!", null, loadCourts)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" QUADRA
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
                                $.post(window.location.origin + "/quadra/deletar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadCourts)
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