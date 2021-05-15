$(document).ready(function () {

    const tabela = $('#table').DataTable({
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching":true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
        }
    } );

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

        tabela.clear().draw();
        
        if(data.data.length > 0){

            data.data.forEach(item => {

                tabela.row.add( [
                    item.name,
                    item.email, 
                    `<a title="Abrir" href="/alunos/exibir/${item.id}" class="btn btn-info open-student"><i style="color: white" class="fas fa-eye"></i></a>`,
                ]).draw();

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