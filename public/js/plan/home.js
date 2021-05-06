$(document).ready(function () {

    loadPlans();

    // LISTAR PLANOS
    function loadPlans()
    {
        $(".year-plan").hide();
        $("#price_label").html("Valor mensal");
        
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
                                                <td class="align-middle">${getAgeRange(item.age_range)}</td>
                                                <td class="align-middle">${getDayPeriod(item.day_period)}</td>
                                                <td class="align-middle">${item.lessons_per_week}</td>
                                                <td class="align-middle">${periodContractedDescription(item.months)}</td>
                                                <td class="align-middle">${moneyFormat(item.price)}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-months="${item.months}" data-age_range="${item.age_range}" data-day_period="${item.day_period}" data-lessons_per_week="${item.lessons_per_week}" data-annual_contract="${item.annual_contract}" data-price="${item.price}" data-price_march="${item.price_march}" data-price_april="${item.price_april}" data-price_may="${item.price_may}" data-price_june="${item.price_june}" data-price_july="${item.price_july}" data-price_august="${item.price_august}" data-price_september="${item.price_september}" data-price_october="${item.price_october}" data-price_november="${item.price_november}" data-price_december="${item.price_december}"  href="#" class="btn btn-warning edit-court"><i style="color: white" class="fas fa-edit"></i></a>
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
                        price_march: $("#price_march").val(),
                        price_april: $("#price_april").val(),
                        price_may: $("#price_may").val(),
                        price_june: $("#price_june").val(),
                        price_july: $("#price_july").val(),
                        price_august: $("#price_august").val(),
                        price_september: $("#price_september").val(),
                        price_october: $("#price_october").val(),
                        price_november: $("#price_november").val(),
                        price_december: $("#price_december").val(),
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

        $("#id_edit").val($(this).data('id'));
        $("#name_edit").val($(this).data('name'));
        $("#months_edit").val($(this).data('months')).change();
        $("#age_range_edit").val($(this).data('age_range')).change();
        $("#day_period_edit").val($(this).data('day_period')).change();
        $("#lessons_per_week_edit").val($(this).data('lessons_per_week')).change();
        $("#price_edit").val(moneyFormat($(this).data('price')));
        $("#price_march_edit").val(moneyFormat($(this).data('price_march')));
        $("#price_april_edit").val(moneyFormat($(this).data('price_april')));
        $("#price_may_edit").val(moneyFormat($(this).data('price_may')));
        $("#price_june_edit").val(moneyFormat($(this).data('price_june')));
        $("#price_july_edit").val(moneyFormat($(this).data('price_july')));
        $("#price_august_edit").val(moneyFormat($(this).data('price_august')));
        $("#price_september_edit").val(moneyFormat($(this).data('price_september')));
        $("#price_october_edit").val(moneyFormat($(this).data('price_october')));
        $("#price_november_edit").val(moneyFormat($(this).data('price_november')));
        $("#price_december_edit").val(moneyFormat($(this).data('price_december')));

        if($(this).data('months') > 12)
            $(".year-plan-edit").show();
        else
            $(".year-plan-edit").hide();

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
                    $.ajax({
                        url: window.location.origin + "/planos/editar",
                        type: 'PUT',
                        data: {
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                            age_range: $("#age_range_edit option:selected").val(),
                            day_period: $("#day_period_edit option:selected").val(),
                            lessons_per_week: $("#lessons_per_week_edit option:selected").val(),
                            annual_contract: $("#annual_contract_edit option:selected").val(),
                            months: $("#months_edit option:selected").val(),
                            price: $("#price_edit").val(),
                            price_march: $("#price_march_edit").val(),
                            price_april: $("#price_april_edit").val(),
                            price_may: $("#price_may_edit").val(),
                            price_june: $("#price_june_edit").val(),
                            price_july: $("#price_july_edit").val(),
                            price_august: $("#price_august_edit").val(),
                            price_september: $("#price_september_edit").val(),
                            price_october: $("#price_october_edit").val(),
                            price_november: $("#price_november_edit").val(),
                            price_december: $("#price_december_edit").val(),
                        }
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
                                $.ajax({
                                    url: window.location.origin + "/planos/deletar",
                                    type: 'DELETE',
                                    data: {id}
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
        
        if(option == 13){
            $("#price_label").html("Valor anual padrão (entrando em fevereiro)");
            $(".year-plan").show();
        }else{
            $("#price_label").html("Valor mensal");
            $(".year-plan").hide();
        }
    });

    $("#months_edit").on("change", function(){
        let option = $("#months_edit option:selected").val();
        
        if(option == 13){
            $("#price_edit_label").html("Valor anual padrão (entrando em fevereiro)");
            $(".year-plan-edit").show();
        }else{
            $("#price_edit_label").html("Valor mensal");
            $(".year-plan-edit").hide();
        }
    });

});