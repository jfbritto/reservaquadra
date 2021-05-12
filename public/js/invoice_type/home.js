$(document).ready(function () {

    loadInvoiceTypes();

    // LISTAR TIPOS DE FATURA
    function loadInvoiceTypes()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/tipos-faturas/listar", {
                        
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
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" href="#" class="btn btn-warning edit-tipo-fatura"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-tipo-fatura"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhum tipo de fatura cadastrado</td>
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


    // CADASTRAR TIPOS DE FATURA
    $("#formStoreInvoiceType").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/tipos-faturas/cadastrar", {
                        name: $("#name").val(),
                        city: $("#city").val(),
                        neighborhood: $("#neighborhood").val(),
                        reference: $("#reference").val(),
                        description: $("#description").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreInvoiceType").each(function () {
                                    this.reset();
                                });
                                
                                
                                $("#modalStoreInvoiceType").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadInvoiceTypes)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();

                },
            },
        ]);

    });


    // EDITAR TIPOS DE FATURA
    $("#list").on("click", ".edit-tipo-fatura", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $("#id_edit").val(id);
        $("#name_edit").val(name);

        $("#modalEditInvoiceType").modal("show");
    });

    $("#formEditInvoiceType").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/tipos-faturas/editar",
                        type: 'PUT',
                        data: {
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditInvoiceType").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditInvoiceType").modal("hide");

                                showSuccess("Edição efetuada!", null, loadInvoiceTypes)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" TIPOS DE FATURA
    $("#list").on("click", ".delete-tipo-fatura", function(){
        
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
                                    url: window.location.origin + "/tipos-faturas/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadInvoiceTypes)
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