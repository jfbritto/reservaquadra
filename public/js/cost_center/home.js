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
                    $.get(window.location.origin + "/centros-de-custo/listar", {
                        
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
                                                    <a title="Subtipos de centro de custo" href="#" data-id="${item.id}" data-name="${item.name}" class="btn btn-primary list-subtypes"><i style="color: white" class="fas fa-list"></i></a>
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

                    $.post(window.location.origin + "/centros-de-custo/cadastrar", {
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
                    $.ajax({
                        url: window.location.origin + "/centros-de-custo/editar",
                        type: 'PUT',
                        data: {
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                        }
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
                                $.ajax({
                                    url: window.location.origin + "/centros-de-custo/deletar",
                                    type: 'DELETE',
                                    data: {id}
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
    

    // CADASTRAR SUBTIPOS
    $("#formAddCostCenterSubtypes").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/subtipos-de-centros-de-custo/cadastrar", {
                        id_cost_center: $("#id_cost_center_add").val(),
                        name: $("#name_subtype").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formAddCostCenterSubtypes").each(function () {
                                    this.reset();
                                });

                                $("#modalAddCostCenterSubtypes").modal("hide");

                                showSuccess("Cadastro efetuado!", null, listSubtypes, $("#id_cost_center_add").val())
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // LISTAR SUBTIPOS
    $("#list").on("click", ".list-subtypes", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $("#title-subtype").html(name);
        $("#id_cost_center_add").val(id);

        listSubtypes(id);
    });

    function listSubtypes(id)
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + `/subtipos-de-centros-de-custo/listar`, {
                        id_cost_center:id
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list-subtypes").html(``);

                                if(data.data.length > 0){

                                    data.data.forEach(item => {

                                        $("#list-subtypes").append(`
                                            <tr>
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Deletar" data-id="${item.id}" data-id_cost_center="${item.id_cost_center}" href="#" class="btn btn-danger delete-subtype"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);
                                        
                                    });

                                }else{

                                    $("#list-subtypes").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhum subtipo cadastrado</td>
                                        </tr>
                                    `);

                                }

                                $("#modalCostCenterSubtypes").modal("show");

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }


    // "DELETAR" SUBTIPOS
    $("#list-subtypes").on("click", ".delete-subtype", function(){
        
        let id = $(this).data('id');
        let id_cost_center = $(this).data('id_cost_center');

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
                                    url: window.location.origin + "/subtipos-de-centros-de-custo/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletada com sucesso!", null, listSubtypes, id_cost_center)
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