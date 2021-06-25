$(document).ready(function () {

    loadHolidays();

    // LISTAR FERIADOS
    function loadHolidays()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/feriados/listar", {
                        
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
                                                <td class="align-middle">${item.day} de ${monthDescription(item.month)}${item.year==null?``:` de ${item.year}`}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-day="${item.day}" data-month="${item.month}" data-year="${item.year}" href="#" class="btn btn-warning edit-holiday"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-holiday"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="3">Nenhum feriado cadastrado</td>
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


    // CADASTRAR FERIADO
    $("#formStoreHoliday").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/feriados/cadastrar", {
                        name: $("#name").val(),
                        day: $("#day").val(),
                        month: $("#month").val(),
                        year: $("#year").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreHoliday").each(function () {
                                    this.reset();
                                });
                                
                                
                                $("#modalStoreHoliday").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadHolidays)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);

    });


    // EDITAR FERIADO
    $("#list").on("click", ".edit-holiday", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let day = $(this).data('day');
        let month = $(this).data('month');
        let year = $(this).data('year');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#day_edit").val(day).change();
        $("#month_edit").val(month).change();
        $("#year_edit").val(year).change();

        $("#modalEditHoliday").modal("show");
    });

    $("#formEditHoliday").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/feriados/editar",
                        type: 'PUT',
                        data: {
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                            day: $("#day_edit").val(),
                            month: $("#month_edit").val(),
                            year: $("#year_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditHoliday").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditHoliday").modal("hide");

                                showSuccess("Edição efetuada!", null, loadHolidays)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" FERIADO
    $("#list").on("click", ".delete-holiday", function(){
        
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
                                    url: window.location.origin + "/feriados/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadHolidays)
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