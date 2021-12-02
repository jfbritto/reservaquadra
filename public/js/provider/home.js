$(document).ready(function () {

    loadProviders();

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
                                $("#list").html(``);

                                if(data.data.length > 0){
                                    
                                    data.data.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" href="#" class="btn btn-warning edit-provider"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-provider"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="3">Nenhum fornecedor cadastrado</td>
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


    // CADASTRAR FORNECEDOR
    $("#formStoreProvider").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/fornecedores/cadastrar", {
                        name: $("#name").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreProvider").each(function () {
                                    this.reset();
                                });
                                
                                
                                $("#modalStoreProvider").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadProviders)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);

    });


    // EDITAR FORNECEDOR
    $("#list").on("click", ".edit-provider", function(){

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

        $("#modalEditProvider").modal("show");
    });

    $("#formEditProvider").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/fornecedores/editar",
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

                                $("#formEditProvider").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditProvider").modal("hide");

                                showSuccess("Edição efetuada!", null, loadProviders)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" FORNECEDOR
    $("#list").on("click", ".delete-provider", function(){
        
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
                                    url: window.location.origin + "/fornecedores/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadProviders)
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