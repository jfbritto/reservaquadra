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
                    $.get(window.location.origin + "/funcionarios/listar", {
                        
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
                                            <td class="align-middle just-pc">${item.email}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Abrir" href="/alunos/exibir/${item.id}" class="btn btn-info open-employee display-none"><i style="color: white" class="fas fa-eye"></i></a>
                                                <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" data-birth="${item.birth}" data-cpf="${item.cpf}" data-rg="${item.rg}" data-civil_status="${item.civil_status}" data-profession="${item.profession}" data-zip_code="${item.zip_code}" data-uf="${item.uf}" data-city="${item.city}" data-neighborhood="${item.neighborhood}" data-address="${item.address}" data-address_number="${item.address_number}" data-complement="${item.complement}" data-start_date="${item.start_date}" data-health_plan="${item.health_plan}" data-how_met="${item.how_met}" data-group="${item.group}" href="#" class="btn btn-warning edit-employee"><i style="color: white" class="fas fa-edit"></i></a>
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
                        birth: $("#birth").val(),
                        cpf: $("#cpf").val(),
                        rg: $("#rg").val(),
                        civil_status: $("#civil_status option:selected").val(),
                        profession: $("#profession").val(),
                        zip_code: $("#zip_code").val(),
                        uf: $("#uf").val(),
                        city: $("#city").val(),
                        neighborhood: $("#neighborhood").val(),
                        address: $("#address").val(),
                        address_number: $("#address_number").val(),
                        complement: $("#complement").val(),
                        start_date: $("#start_date").val(),
                        health_plan: $("#health_plan").val(),
                        how_met: $("#how_met option:selected").val(),
                        group: $("#group option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreEmployee").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalStoreEmployee").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadEmployees)
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

        $("#id_edit").val(id);

        $("#name_edit").val($(this).data('name'));
        $("#email_edit").val($(this).data('email'));
        $("#birth_edit").val($(this).data('birth'));
        $("#cpf_edit").val($(this).data('cpf'));
        $("#rg_edit").val($(this).data('rg'));
        $("#civil_status_edit").val($(this).data('civil_status')).change();
        $("#profession_edit").val($(this).data('profession'));
        $("#zip_code_edit").val($(this).data('zip_code'));
        $("#uf_edit").val($(this).data('uf'));
        $("#city_edit").val($(this).data('city'));
        $("#neighborhood_edit").val($(this).data('neighborhood'));
        $("#address_edit").val($(this).data('address'));
        $("#address_number_edit").val($(this).data('address_number'));
        $("#complement_edit").val($(this).data('complement'));
        $("#start_date_edit").val($(this).data('start_date'));
        $("#health_plan_edit").val($(this).data('health_plan'));
        $("#how_met_edit").val($(this).data('how_met')).change();
        $("#group_edit").val($(this).data('group')).change();

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
                        birth: $("#birth_edit").val(),
                        cpf: $("#cpf_edit").val(),
                        rg: $("#rg_edit").val(),
                        civil_status: $("#civil_status_edit option:selected").val(),
                        profession: $("#profession_edit").val(),
                        zip_code: $("#zip_code_edit").val(),
                        uf: $("#uf_edit").val(),
                        city: $("#city_edit").val(),
                        neighborhood: $("#neighborhood_edit").val(),
                        address: $("#address_edit").val(),
                        address_number: $("#address_number_edit").val(),
                        complement: $("#complement_edit").val(),
                        start_date: $("#start_date_edit").val(),
                        health_plan: $("#health_plan_edit").val(),
                        how_met: $("#how_met_edit option:selected").val(),
                        group: $("#group_edit option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditEmployee").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditEmployee").modal("hide");

                                showSuccess("Edição efetuada!", null, loadEmployees)
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
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadEmployees)
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