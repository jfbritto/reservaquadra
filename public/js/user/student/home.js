$(document).ready(function () {

    const tabela = $('#table').DataTable({
        "paging":   true,
        "ordering": true,
        "order": [],
        "info":     true,
        "searching":false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
        }
    } );

    loadStudents();
    loadTotalStudents();

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

    // TOTAIS ALUNOS
    function loadTotalStudents()
    {

        $.get(window.location.origin + "/alunos/listar-totais", {

        })
        .then(function (data) {
            if (data.status == "success") {

                Swal.close();
                $("#tot-students-active").html(data.data[0].ativos);
                $("#tot-students-inactive").html(data.data[0].inativos);

            } else if (data.status == "error") {
                showError(data.message)
            }
        })
        .catch();
           
    }

    function mountTable(data){

        tabela.clear().draw();
        
        if(data.data.length > 0){

            data.data.forEach(item => {

                let status = item.status=='A'?`danger`:`success`;
                let txt_status = item.status=='A'?`Inativar aluno`:`Ativar aluno`;

                tabela.row.add( [
                    item.name,
                    item.age, 
                    item.email, 
                    `${item.status=='A'?`<span class="badge badge-success">Ativo</span>`:`<span class="badge badge-danger">Inativo</span>`}`, 
                    `<a title="Abrir" href="/alunos/exibir/${item.id}" class="btn btn-primary open-student"><i style="color: white" class="fas fa-arrow-right"></i></a>`,
                ]).draw();

            });

            $("#table tbody tr").each(function() {
                $(this).find('td:eq(4)').css('text-align','right');
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


    $("#list").on("click", ".edit-status-student", function(){

        let id = $(this).data("id");
        let status = $(this).data("status");
        
        let txt_status = status=='A'?`inativar`:`ativar`;
        let txt_status_resposta = status=='A'?`Inativado`:`Ativado`;

        if(status == "A")
            status = "I";
        else if(status == "I")
            status = "A";
        

        Swal.fire({
            title: 'Atenção!',
            text: `Deseja realmente ${txt_status} o aluno?`,
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
                                    url: window.location.origin + "/alunos/mudar-status",
                                    type: 'PUT',
                                    data: {id,status}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess(`${txt_status_resposta} com sucesso!`, null, loadStudents)
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