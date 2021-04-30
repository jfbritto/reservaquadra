$(document).ready(function () {

    loadStudents();

    // LISTAR ALUNOS
    function loadStudents()
    {
        resetReadOnly();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/alunos/listar", {

                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                mountTable(data);


                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    function mountTable(data){
        
        if(data.data.length > 0){

            data.data.forEach(item => {

                $("#list").append(`
                    <tr>
                        <td class="align-middle">${item.name}</td>
                        <td class="align-middle just-pc">${item.email}</td>
                        <td class="align-middle" style="text-align: right">
                            <a title="Abrir" href="/alunos/exibir/${item.id}" class="btn btn-info open-student"><i style="color: white" class="fas fa-eye"></i></a>
                            <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" data-birth="${item.birth}" data-cpf="${item.cpf}" data-rg="${item.rg}" data-civil_status="${item.civil_status}" data-profession="${item.profession}" data-zip_code="${item.zip_code}" data-uf="${item.uf}" data-city="${item.city}" data-neighborhood="${item.neighborhood}" data-address="${item.address}" data-address_number="${item.address_number}" data-complement="${item.complement}" data-start_date="${item.start_date}" data-health_plan="${item.health_plan}" data-how_met="${item.how_met}" href="#" class="btn btn-warning edit-student display-none"><i style="color: white" class="fas fa-edit"></i></a>
                            <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-student display-none"><i class="fas fa-trash-alt"></i></a>
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

    }


    // CADASTRAR ALUNO
    $("#formStoreStudent").submit(function (e) {
        e.preventDefault();

        let phones = $(".phone_add");
        let phone_array = [];
        for (const key in phones) {
            if (Object.hasOwnProperty.call(phones, key)) {
                const element = $(phones[key]).data("type");
                if(element == "phone")
                    phone_array.push($(phones[key]).html())
            }
        }

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
                        phones:phone_array
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


    // ABRIR MODAL PARA EDITAR ALUNO
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

    // EDITAR ALUNO
    $("#formEditStudent").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/alunos/editar",
                        type: 'PUT',
                        data: {
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
                        }
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
                                $.ajax({
                                    url: window.location.origin + "/alunos/deletar",
                                    type: 'DELETE',
                                    data: {id}
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

    // BUSCAR ALUNO
    $("#search").on("keyup", function(){

        let search = $(this).val();

        $.get(window.location.origin + "/alunos/buscar", {
            search
        })
        .then(function (data) {
            if (data.status == "success") {

                Swal.close();
                $("#list").html(``);

                mountTable(data);

            } else if (data.status == "error") {
                showError(data.message)
            }
        })
        .catch();
    })

    $("#btn-add-phone").on("click", function(){

        let number = $("#phone_number").val();
        let random = Math.floor(Math.random() * 100000);

        $("#box-phones").append(`
            <div class="col-sm-2 random${random}">
                <div class="alert alert-light">
                    <span class="phone_add" data-type="phone">${number}</span>
                    <button type="button" class="close close-alert" data-class_alert="random${random}" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        `);

        $("#modalAddPhone").modal("hide");
        $("#phone_number").val("");

    });

    $("#box-phones").on("click", ".close-alert", function(){
        let class_alert = $(this).data("class_alert");
        $(`.${class_alert}`).remove()
    });

});