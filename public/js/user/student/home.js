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

                let ativos = 0;
                if(data.data[0].ativos > 0)
                    ativos = data.data[0].ativos;

                let inativos = 0;
                if(data.data[0].inativos > 0)
                    inativos = data.data[0].inativos;

                Swal.close();
                $("#tot-students-active").html(ativos);
                $("#tot-students-inactive").html(inativos);

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
                    `${item.active_contracts>0?`<span class="badge badge-success">Sim</span>`:`<span class="badge badge-danger">Não</span>`}`, 
                    `${item.status=='A'?`<span class="badge badge-success">Ativo</span>`:`<span class="badge badge-danger">Inativo</span>`}`, 
                    `<a title="Abrir" href="/alunos/exibir/${item.id}" class="btn btn-primary open-student"><i style="color: white" class="fas fa-arrow-right"></i></a>`,
                ]).draw();

            });

            $("#table tbody tr").each(function() {
                $(this).find('td:eq(4)').css('text-align','right');
            });

        }

    }


    // CADASTRAR ALUNO
    $("#formStoreStudent").submit(function (e) {
        e.preventDefault();

        let phones = $(".phone_add");
        let phone_array = [];
        let phone_is_responsible_number_array = [];
        let phone_is_emergency_array = [];
        for (const key in phones) {
            if (Object.hasOwnProperty.call(phones, key)) {
                const element = $(phones[key]).data("type");
                let is_responsible_number = $(phones[key]).data("is_responsible_number");
                let is_emergency = $(phones[key]).data("is_emergency");
                if(element == "phone")
                    phone_array.push($(phones[key]).html())
                    phone_is_responsible_number_array.push(is_responsible_number)
                    phone_is_emergency_array.push(is_emergency)
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
                        
                        registration_type: $("#registration_type option:selected").val(),
                        
                        gender: $("#gender").val(),
                        special_care: $("#special_care").val(),
                        objective: $("#objective option:selected").val(),
                        
                        responsible_name: $("#responsible_name").val(),
                        responsible_cpf: $("#responsible_cpf").val(),
                        responsible_rg: $("#responsible_rg").val(),
                        responsible_civil_status: $("#responsible_civil_status option:selected").val(),
                        responsible_profession: $("#responsible_profession").val(),

                        responsible_zip_code: $("#responsible_zip_code").val(),
                        responsible_uf: $("#responsible_uf").val(),
                        responsible_city: $("#responsible_city").val(),
                        responsible_neighborhood: $("#responsible_neighborhood").val(),
                        responsible_address: $("#responsible_address").val(),
                        responsible_address_number: $("#responsible_address_number").val(),
                        responsible_complement: $("#responsible_complement").val(),

                        phones:phone_array,
                        phone_is_responsible_number:phone_is_responsible_number_array,
                        phone_is_emergency:phone_is_emergency_array
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreStudent").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalStoreStudent").modal("hide");

                                $("#box-phones").html("");

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
        let is_responsible_number = $("#is_responsible_number option:selected").val();
        let is_emergency = $("#is_emergency option:selected").val();
        let random = Math.floor(Math.random() * 100000);

        let class_alert = is_emergency==0?`light`:`warning`;

        $("#box-phones").append(`
            <div class="col-sm-2 random${random}">
                <div class="alert alert-${class_alert}">
                    <span class="phone_add" data-type="phone" data-is_responsible_number="${is_responsible_number}" data-is_emergency="${is_emergency}" >${number}</span>
                    <button type="button" class="close close-alert" data-class_alert="random${random}" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        `);

        $("#modalAddPhone").modal("hide");
        $("#phone_number").val("");
        $("#is_responsible_number").val("0").change();
        $("#is_emergency").val("0").change();

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

    $("#registration_type").on("change", function(){

        let type = $("#registration_type option:selected").val();

        if(type == 'A'){
            $(".adulto").show()
            $(".infantil").hide()

            $(".phone-class").removeClass("col-md-4").addClass("col-md-6")
        }else{
            $(".infantil").show()
            $(".adulto").hide()

            $(".phone-class").removeClass("col-md-6").addClass("col-md-4")
        }

    });

});