$(document).ready(function () {

    loadScheduledClasses();
    loadTeachers();

    // LISTAR PLANOS
    function loadScheduledClasses()
    {
        let date = $("#date").val();
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/aulas-programadas/buscar", {
                        date        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                console.log(data.data)

                                Swal.close();
                                $("#list").html(``);

                                if(data.data.length > 0){
                                    
                                    data.data.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.user_name}</td>
                                                <td class="align-middle">${item.court_name}</td>
                                                <td class="align-middle">${item.start_time} às ${item.end_time}</td>
                                                <td class="align-middle">${item.status==null?`<span class="badge badge-warning">Pendente</span>`:`<span class="badge badge-${scheduledClassResultStatusClass(item.status)}">${scheduledClassResultStatus(item.status)}</span>`}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    ${item.status==null?`
                                                        <a title="Realizada" data-id="${item.id}" href="#" class="btn btn-success mark-presence"><i class="fas fa-check"></i></a>
                                                    `:``}
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="5">Nenhuma aula encontrada</td>
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

    // LISTAR PROFESSORES
    function loadTeachers()
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

                                $("#id_teacher").html(``);
                                $("#id_teacher").html(`<option value="">-- Selecione --</option>`);

                                if(data.data.length > 0){

                                    data.data.forEach(item => { 
                                        $("#id_teacher").append(`
                                            <option value="${item.id}">${item.name}</option>
                                        `)
                                    });

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


    // ABRIR MODAL PARA CADASTRAR RESULTADO DA AULA
    $("#list").on("click",".mark-presence", function(){
        $("#id_scheduled_classes").val($(this).data('id'));
        $("#modalStoreScheduledClassesResult").modal("show");
    });

    // CADASTRAR RESULTADO DA AULA MARCADA
    $("#formStoreScheduledClassesResult").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/aulas-programadas-resultado/cadastrar", {
                        status: $("#status option:selected").val(),
                        id_teacher: $("#id_teacher option:selected").val(),
                        observation: $("#observation").val(),
                        date: $("#date").val(),
                        id_scheduled_classes: $("#id_scheduled_classes").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreScheduledClassesResult").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalStoreScheduledClassesResult").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadScheduledClasses)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    $("#status").on("change", function(){

        if($("#status option:selected").val() == "P"){
            $("#id_teacher").prop("required", true)
            $("#observation").prop("required", true)
        }else{
            $("#id_teacher").prop("required", false)
            $("#observation").prop("required", false)
        }

    });


    $("#date").on("change", function(){
        loadScheduledClasses();
    });

});