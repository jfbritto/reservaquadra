$(document).ready(function () {

    loadStudents();

    // LISTAR ALUNOS
    function loadStudents()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/alunos/listar", {
                        
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
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" href="#" class="btn btn-warning edit-student"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-student"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="4">Nenhum aluno cadastrado</td>
                                        </tr>
                                    `);  

                                }


                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            }
                        })
                        .catch();
                },
            },
        ]);
    }


    // CADASTRAR ALUNO
    $("#formStoreStudent").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/alunos/cadastrar", {
                        name: $("#name").val(),
                        email: $("#email").val()
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreStudent").each(function () {
                                    this.reset();
                                });
                                
                                loadStudents();
                                $("#modalStoreStudent").modal("hide");

                                Swal.fire({
                                    icon: "success",
                                    text: "Cadastro efetuado!",
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // EDITAR ALUNO
    $("#list").on("click", ".edit-student", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#email_edit").val(email);

        $("#modalEditStudent").modal("show");
    });

    $("#formEditStudent").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/alunos/editar", {
                        id: $("#id_edit").val(),
                        name: $("#name_edit").val(),
                        email: $("#email_edit").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditStudent").each(function () {
                                    this.reset();
                                });
                                
                                loadStudents();
                                $("#modalEditStudent").modal("hide");

                                Swal.fire({
                                    icon: "success",
                                    text: "Cadastro efetuado!",
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" ALUNO
    $("#list").on("click", ".delete-student", function(){
        
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
                                $.post(window.location.origin + "/alunos/deletar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            loadStudents();
            
                                            Swal.fire({
                                                icon: "success",
                                                text: "Deletado com sucesso!",
                                                showConfirmButton: false,
                                                showCancelButton: true,
                                                cancelButtonText: "OK",
                                                onClose: () => {},
                                            });
                                        } else if (data.status == "error") {
                                            // showError(data.message);
                                            Swal.fire({
                                                icon: "error",
                                                text: data.message,
                                                showConfirmButton: false,
                                                showCancelButton: true,
                                                cancelButtonText: "OK",
                                                onClose: () => {},
                                            });
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