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
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle">${getAgeRange(item.age_range)}</td>
                                                <td class="align-middle">${getDayPeriod(item.day_period)}</td>
                                                <td class="align-middle">${item.lessons_per_week}</td>
                                                <td class="align-middle">${periodContractedDescription(item.months)}</td>
                                                <td class="align-middle">${item.annual_contract==1?'Sim':'Não'}</td>
                                                <td class="align-middle">${moneyFormat(item.price)}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-months="${item.months}" data-age_range="${item.age_range}" data-day_period="${item.day_period}" data-lessons_per_week="${item.lessons_per_week}" data-annual_contract="${item.annual_contract}" data-price="${item.price}" href="#" class="btn btn-warning edit-court"><i style="color: white" class="fas fa-edit"></i></a>
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
                        annual_contract: $("#annual_contract option:selected").val(),
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
        let annual_contract = $(this).data('annual_contract');
        let price = $(this).data('price');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#months_edit").val(months).change();
        $("#age_range_edit").val(age_range).change();
        $("#day_period_edit").val(day_period).change();
        $("#lessons_per_week_edit").val(lessons_per_week).change();
        $("#annual_contract_edit").val(annual_contract).change();
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
    

});