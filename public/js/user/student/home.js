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
                                                <td class="align-middle just-pc">${item.email}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Abrir" href="/alunos/exibir/${item.id}" class="btn btn-info open-student"><i style="color: white" class="fas fa-eye"></i></a>
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" data-birth="${item.birth}" data-cpf="${item.cpf}" data-rg="${item.rg}" data-civil_status="${item.civil_status}" data-profession="${item.profession}" data-zip_code="${item.zip_code}" data-uf="${item.uf}" data-city="${item.city}" data-neighborhood="${item.neighborhood}" data-address="${item.address}" data-address_number="${item.address_number}" data-complement="${item.complement}" data-start_date="${item.start_date}" data-health_plan="${item.health_plan}" data-how_met="${item.how_met}" href="#" class="btn btn-warning edit-student"><i style="color: white" class="fas fa-edit"></i></a>
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
                                showError(data.message)
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
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreStudent").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalStoreStudent").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadStudents)
                            } else if (data.status == "error") {
                                showError(data.message)
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
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditStudent").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditStudent").modal("hide");

                                showSuccess("Edição efetuada!", null, loadStudents)
                            } else if (data.status == "error") {
                                showError(data.message)
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
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadStudents)
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



    // BUSCA DE ENDEREÇO
    $("#zip_code, #zip_code_edit").on("keyup", function(){

        if($(this).val().length == 9){

            let type = $(this).data('type');
            let zip_code = $(this).val();

            zip_code = zip_code.replace("-","");

            Swal.queue([
                {
                    title: "Carregando...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onOpen: () => {
                        Swal.showLoading();
                        $.get(`http://viacep.com.br/ws/${zip_code}/json`, { })
                            .then(function (data) {

                                if(data.erro){
                                    showError("Cep não encontrado!")
                                    return false;
                                }

                                if(type == 'add'){
                                    
                                    $("#uf").prop("readonly", true)
                                    $("#city").prop("readonly", true)
                                    $("#neighborhood").prop("readonly", true)
                                    $("#address").prop("readonly", true)
                                    
                                    $("#uf").val(data.uf);
                                    $("#city").val(data.localidade);
                                    $("#neighborhood").val(data.bairro);
                                    $("#address").val(data.logradouro);
    
                                    if(data.uf == "")
                                        $("#uf").prop("readonly", false)
    
                                    if(data.localidade == "")
                                        $("#city").prop("readonly", false)
    
                                    if(data.bairro == "")
                                        $("#neighborhood").prop("readonly", false)
    
                                    if(data.logradouro == "")
                                        $("#address").prop("readonly", false)
                                        
                                }else{

                                    $("#uf_edit").prop("readonly", true)
                                    $("#city_edit").prop("readonly", true)
                                    $("#neighborhood_edit").prop("readonly", true)
                                    $("#address_edit").prop("readonly", true)
                                    
                                    $("#uf_edit").val(data.uf);
                                    $("#city_edit").val(data.localidade);
                                    $("#neighborhood_edit").val(data.bairro);
                                    $("#address_edit").val(data.logradouro);
    
                                    if(data.uf == "")
                                        $("#uf_edit").prop("readonly", false)
    
                                    if(data.localidade == "")
                                        $("#city_edit").prop("readonly", false)
    
                                    if(data.bairro == "")
                                        $("#neighborhood_edit").prop("readonly", false)
    
                                    if(data.logradouro == "")
                                        $("#address_edit").prop("readonly", false)
                                    
                                }

                                
                                Swal.close();

                            })
                            .catch();
                    },
                },
            ]);


        }


    })



    $("#search").on("keyup", function(){

        let search = $(this).val();

        $.post(window.location.origin + "/alunos/buscar", {
            search
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
                                    <a title="Abrir" href="/alunos/exibir/${item.id}" class="btn btn-info open-student"><i style="color: white" class="fas fa-eye"></i></a>
                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" data-birth="${item.birth}" data-cpf="${item.cpf}" data-rg="${item.rg}" data-civil_status="${item.civil_status}" data-profession="${item.profession}" data-zip_code="${item.zip_code}" data-uf="${item.uf}" data-city="${item.city}" data-neighborhood="${item.neighborhood}" data-address="${item.address}" data-address_number="${item.address_number}" data-complement="${item.complement}" data-start_date="${item.start_date}" data-health_plan="${item.health_plan}" data-how_met="${item.how_met}" href="#" class="btn btn-warning edit-student"><i style="color: white" class="fas fa-edit"></i></a>
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
                showError(data.message)
            }
        })
        .catch();

    })


});