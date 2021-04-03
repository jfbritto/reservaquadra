$(document).ready(function () {

    loadEmployees();

    // LISTAR FUNCIONÁRIOS
    function loadEmployees()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/funcionarios/listar", {
                        
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
                                                <td class="align-middle">${item.email}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" data-group="${item.group}" href="#" class="btn btn-warning edit-employee"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-employee"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="4">Nenhum funcionário cadastrado</td>
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


    // CADASTRAR FUNCIONÁRIO
    $("#formStoreEmployee").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/funcionarios/cadastrar", {
                        name: $("#name").val(),
                        email: $("#email").val(),
                        group: $("#group option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreEmployee").each(function () {
                                    this.reset();
                                });
                                
                                loadEmployees();
                                $("#modalStoreEmployee").modal("hide");

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


    // EDITAR FUNCIONÁRIO
    $("#list").on("click", ".edit-employee", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let group = $(this).data('group');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#email_edit").val(email);
        $("#group_edit").val(group).change();

        $("#modalEditEmployee").modal("show");
    });

    $("#formEditEmployee").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/funcionarios/editar", {
                        id: $("#id_edit").val(),
                        name: $("#name_edit").val(),
                        email: $("#email_edit").val(),
                        group: $("#group_edit option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditEmployee").each(function () {
                                    this.reset();
                                });
                                
                                loadEmployees();
                                $("#modalEditEmployee").modal("hide");

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


    // "DELETAR" FUNCIONARIO
    $("#list").on("click", ".delete-employee", function(){
        
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
                                $.post(window.location.origin + "/funcionarios/deletar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            loadEmployees();
            
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
    


});