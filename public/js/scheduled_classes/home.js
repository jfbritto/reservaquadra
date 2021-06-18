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

                                Swal.close();
                                $("#list").html(``);
                                $("#list-rm").html(``);

                                if(data.data.response.length > 0){
                                    
                                    data.data.response.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.user_name}</td>
                                                <td class="align-middle">${item.court_name}</td>
                                                <td class="align-middle">${item.start_time} às ${item.end_time}</td>
                                                <td class="align-middle">${item.result==null?`<span class="badge badge-warning">Pendente</span>`:`<span class="badge badge-${scheduledClassResultStatusClass(item.result)}">${scheduledClassResultStatus(item.result)}</span>`}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    ${item.result==null?`
                                                        <a title="Realizada" data-id="${item.id}" data-id_origin="" href="#" class="btn btn-success mark-presence"><i class="fas fa-check"></i></a>
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

                                // tabela de aulas remarcadas

                                if(data.data.response_rm.length > 0){

                                    $("#box-remarkeds").show()
                                    
                                    data.data.response_rm.forEach(item => {

                                        $("#list-rm").append(`
                                            <tr>
                                                <td class="align-middle">${item.user_name}</td>
                                                <td class="align-middle">${item.court_name}</td>
                                                <td class="align-middle">${item.start_time_remarked} às ${item.end_time_remarked}</td>
                                                <td class="align-middle">${item.result==null?`<span class="badge badge-warning">Pendente</span>`:`<span class="badge badge-${scheduledClassResultStatusClass(item.result)}">${scheduledClassResultStatus(item.result)}</span>`}</td>
                                                <td class="align-middle">${item.result_rm==null?`<span class="badge badge-warning">Pendente</span>`:`<span class="badge badge-${scheduledClassResultStatusClass(item.result_rm)}">${scheduledClassResultStatus(item.result_rm)}</span>`}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    ${item.result_rm==null?`
                                                        <a title="Realizada" data-id="${item.id}" data-id_origin="${item.id_origin}" href="#" class="btn btn-success mark-presence"><i class="fas fa-check"></i></a>
                                                    `:``}
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#box-remarkeds").hide()

                                    $("#list-rm").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="6">Nenhuma aula remarcada encontrada</td>
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
    $("#list, #list-rm").on("click",".mark-presence", function(){
        $("#id_scheduled_classes").val($(this).data('id'));
        $("#id_scheduled_classes_result_remarked").val($(this).data('id_origin'));
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
                        result: $("#result option:selected").val(),
                        id_teacher: $("#id_teacher option:selected").val(),
                        observation: $("#observation").val(),
                        date: $("#date").val(),
                        id_scheduled_classes: $("#id_scheduled_classes").val(),
                        date_remarked: $("#date_remarked").val(),
                        start_time_remarked: $("#start_time_remarked").val(),
                        end_time_remarked: $("#end_time_remarked").val(),
                        id_scheduled_classes_result_remarked: $("#id_scheduled_classes_result_remarked").val(),
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

    $("#result").on("change", function(){

        $("#remark").val("N").change();
        $("#date_remarked").val("");
        $("#start_time_remarked").val("");
        $("#end_time_remarked").val("");
        $(".box-date-remarked").hide();
        $("#date_remarked").prop("required", false)
        $("#start_time_remarked").prop("required", false)
        $("#end_time_remarked").prop("required", false)

        if($("#result option:selected").val() == "P"){
            $("#id_teacher").prop("required", true)
            $("#observation").prop("required", true)

            $("#box-remark").hide();
        }else{
            $("#id_teacher").prop("required", false)
            $("#observation").prop("required", false)

            $("#box-remark").show();
        }

    });

    $("#remark").on("change", function(){
        let selected = $("#remark option:selected").val();

        if(selected == "S"){
            $(".box-date-remarked").show();
            $("#date_remarked").prop("required", true)
            $("#start_time_remarked").prop("required", true)
            $("#end_time_remarked").prop("required", true)
        }else{
            $(".box-date-remarked").hide();
            $("#date_remarked").prop("required", false)
            $("#start_time_remarked").prop("required", false)
            $("#end_time_remarked").prop("required", false)
        }
        
        $("#date_remarked").val("");
        $("#start_time_remarked").val("");
        $("#end_time_remarked").val("");

    });


    $("#date").on("change", function(){
        loadScheduledClasses();
    });

});