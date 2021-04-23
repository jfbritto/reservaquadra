$(document).ready(function () {

    loadPlans();

    // LISTAR PLANOS
    function loadPlans()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planos/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                if(data.data.length > 0){
                                    
                                    data.data.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.id}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" href="#" class="btn btn-warning edit-court"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-court"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="8">Nenhum plano cadastrado</td>
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


    // CADASTRAR PLANO
    $("#formStorePlan").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/planos/cadastrar", {
                        name: $("#name").val(),
                        age_range: $("#age_range option:selected").val(),
                        day_period: $("#day_period option:selected").val(),
                        lessons_per_week: $("#lessons_per_week option:selected").val(),
                        months: $("#months option:selected").val(),
                        price: $("#price").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStorePlan").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalStorePlan").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadPlans)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // EDITAR PLANO
    $("#list").on("click", ".edit-court", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let months = $(this).data('months');
        let age_range = $(this).data('age_range');
        let day_period = $(this).data('day_period');
        let lessons_per_week = $(this).data('lessons_per_week');
        let price = $(this).data('price');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#months_edit").val(months).change();
        $("#age_range_edit").val(age_range).change();
        $("#day_period_edit").val(day_period).change();
        $("#lessons_per_week_edit").val(lessons_per_week).change();
        $("#price_edit").val(moneyFormat(price));

        $("#modalEditPlan").modal("show");
    });

    $("#formEditPlan").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/planos/editar", {
                        id: $("#id_edit").val(),
                        name: $("#name_edit").val(),
                        age_range: $("#age_range_edit option:selected").val(),
                        day_period: $("#day_period_edit option:selected").val(),
                        lessons_per_week: $("#lessons_per_week_edit option:selected").val(),
                        annual_contract: $("#annual_contract_edit option:selected").val(),
                        months: $("#months_edit option:selected").val(),
                        price: $("#price_edit").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditPlan").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditPlan").modal("hide");

                                showSuccess("Edição efetuada!", null, loadPlans)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" PLANO
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
                                $.post(window.location.origin + "/planos/deletar", {
                                    id: id
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadPlans)
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
    

    $("#months").on("change", function(){
        let option = $("#months option:selected").val();
        
        if(option == 13)
            $("#price_label").html("Valor anual");
        else
            $("#price_label").html("Valor mensal");
    });

    $("#months_edit").on("change", function(){
        let option = $("#months_edit option:selected").val();
        
        if(option == 13)
            $("#price_edit_label").html("Valor anual");
        else
            $("#price_edit_label").html("Valor mensal");
    });

});