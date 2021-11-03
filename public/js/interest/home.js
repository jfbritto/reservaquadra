$(document).ready(function () {

    const tabela = $('#table').DataTable({
        "paging":   true,
        "ordering": true,
        "order": [],
        "info":     true,
        "searching":true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
        }
    } );

    loadInterests();

    // LISTAR INTERESSES
    function loadInterests()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/interesses/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                if(data.data.length > 0){
                                    
                                    mountTable(data);

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="13">Nenhum interesse cadastrado</td>
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

    function mountTable(data){

        tabela.clear().draw();
        
        if(data.data.length > 0){

            data.data.forEach(item => {

                tabela.row.add( [
                    item.name,
                    item.age,
                    objectiveName(item.objective), 
                    item.phone1,
                    item.mon=='1'?`<i class="far fa-check-circle color-success"></i>`:`-`, 
                    item.tue=='1'?`<i class="far fa-check-circle color-success"></i>`:`-`, 
                    item.wed=='1'?`<i class="far fa-check-circle color-success"></i>`:`-`, 
                    item.thu=='1'?`<i class="far fa-check-circle color-success"></i>`:`-`, 
                    item.fri=='1'?`<i class="far fa-check-circle color-success"></i>`:`-`, 
                    item.all_days=='1'?`<i class="far fa-check-circle color-success"></i>`:`-`, 
                    dateFormat(item.avaliation_date),
                    `<span class="badge badge-${interestStatusClass(item.status)}">${interestStatusName(item.status)}</span>`, 
                    `<a title="Marcar Avaliação" data-id="${item.id}" href="#" class="btn btn-sm btn-info avaliation-interest"><i class="fas fa-clock"></i></a> 
                     <a title="Mudar Status" data-id="${item.id}" data-status="${item.status}" data-observation="${item.observation}" href="#" class="btn btn-sm btn-primary change-status-interest"><i class="fas fa-check"></i></a> 
                     <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-phone1="${item.phone1}" data-phone2="${item.phone2}" data-objective="${item.objective}" data-age="${item.age}" data-sun="${item.sun}" data-sun_period="${item.sun_period}" data-mon="${item.mon}" data-mon_period="${item.mon_period}" data-tue="${item.tue}" data-tue_period="${item.tue_period}" data-wed="${item.wed}" data-wed_period="${item.wed_period}" data-thu="${item.thu}" data-thu_period="${item.thu_period}" data-fri="${item.fri}" data-fri_period="${item.fri_period}" data-sat="${item.sat}" data-sat_period="${item.sat_period}" data-all_days="${item.all_days}" data-all_days_period="${item.all_days_period}" href="#" class="btn btn-sm btn-warning edit-interest"><i style="color: white" class="fas fa-edit"></i></a> 
                     <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-sm btn-danger delete-interest"><i class="fas fa-trash-alt"></i></a>`,
                ]).draw();

            });

            $("#table tbody tr").each(function() {
                $(this).find('td:eq(12)').css('text-align','right').css('width','290px');
                $(this).find('td:eq(0)').css('width','300px');
                $(this).find('td:eq(3)').css('width','150px');
                $(this).find('td:eq(4)').css('width','150px');
                $(this).find('td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9)').css('text-align','center');
            });

        }

    }


    // CADASTRAR INTERESSE
    $("#formStoreInterest").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/interesses/cadastrar", {
                        name: $("#name").val(),
                        phone1: $("#phone1").val(),
                        phone2: $("#phone2").val(),
                        objective: $("#objective option:selected").val(),
                        age: $("#age").val(),
                        sun: $("#sun option:selected").val(),
                        sun_period: $("#sun_period option:selected").val(),
                        mon: $("#mon option:selected").val(),
                        mon_period: $("#mon_period option:selected").val(),
                        tue: $("#tue option:selected").val(),
                        tue_period: $("#tue_period option:selected").val(),
                        wed: $("#wed option:selected").val(),
                        wed_period: $("#wed_period option:selected").val(),
                        thu: $("#thu option:selected").val(),
                        thu_period: $("#thu_period option:selected").val(),
                        fri: $("#fri option:selected").val(),
                        fri_period: $("#fri_period option:selected").val(),
                        sat: $("#sat option:selected").val(),
                        sat_period: $("#sat_period option:selected").val(),
                        all_days: $("#all_days option:selected").val(),
                        all_days_period: $("#all_days_period option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreInterest").each(function () {
                                    this.reset();
                                });
                                
                                
                                $("#modalStoreInterest").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadInterests)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);

    });


    // EDITAR INTERESSE
    $("#list").on("click", ".edit-interest", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let phone1 = $(this).data('phone1');
        let phone2 = $(this).data('phone2');
        let objective = $(this).data('objective');
        let age = $(this).data('age');
        let sun = $(this).data('sun');
        let sun_period = $(this).data('sun_period');
        let mon = $(this).data('mon');
        let mon_period = $(this).data('mon_period');
        let tue = $(this).data('tue');
        let tue_period = $(this).data('tue_period');
        let wed = $(this).data('wed');
        let wed_period = $(this).data('wed_period');
        let thu = $(this).data('thu');
        let thu_period = $(this).data('thu_period');
        let fri = $(this).data('fri');
        let fri_period = $(this).data('fri_period');
        let sat = $(this).data('sat');
        let sat_period = $(this).data('sat_period');
        let all_days = $(this).data('all_days');
        let all_days_period = $(this).data('all_days_period');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#phone1_edit").val(phone1);
        $("#phone2_edit").val(phone2);
        $("#objective_edit").val(objective).change();
        $("#age_edit").val(age);
        $("#sun_edit").val(sun);
        $("#sun_period_edit").val(sun_period).change();
        $("#mon_edit").val(mon).change();
        $("#mon_period_edit").val(mon_period).change();
        $("#tue_edit").val(tue).change();
        $("#tue_period_edit").val(tue_period).change();
        $("#wed_edit").val(wed).change();
        $("#wed_period_edit").val(wed_period).change();
        $("#thu_edit").val(thu).change();
        $("#thu_period_edit").val(thu_period).change();
        $("#fri_edit").val(fri).change();
        $("#fri_period_edit").val(fri_period).change();
        $("#sat_edit").val(sat).change();
        $("#sat_period_edit").val(sat_period).change();
        $("#all_days_edit").val(all_days).change();
        $("#all_days_period_edit").val(all_days_period).change();

        $("#modalEditInterest").modal("show");
    });

    $("#formEditInterest").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/interesses/editar",
                        type: 'PUT',
                        data: {
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                            phone1: $("#phone1_edit").val(),
                            phone2: $("#phone2_edit").val(),
                            objective: $("#objective_edit option:selected").val(),
                            age: $("#age_edit").val(),
                            sun: $("#sun_edit option:selected").val(),
                            sun_period: $("#sun_period_edit option:selected").val(),
                            mon: $("#mon_edit option:selected").val(),
                            mon_period: $("#mon_period_edit option:selected").val(),
                            tue: $("#tue_edit option:selected").val(),
                            tue_period: $("#tue_period_edit option:selected").val(),
                            wed: $("#wed_edit option:selected").val(),
                            wed_period: $("#wed_period_edit option:selected").val(),
                            thu: $("#thu_edit option:selected").val(),
                            thu_period: $("#thu_period_edit option:selected").val(),
                            fri: $("#fri_edit option:selected").val(),
                            fri_period: $("#fri_period_edit option:selected").val(),
                            sat: $("#sat_edit option:selected").val(),
                            sat_period: $("#sat_period_edit option:selected").val(),
                            all_days: $("#all_days_edit option:selected").val(),
                            all_days_period: $("#all_days_period_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditInterest").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditInterest").modal("hide");

                                showSuccess("Edição efetuada!", null, loadInterests)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" INTERESSE
    $("#list").on("click", ".delete-interest", function(){
        
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
                                    url: window.location.origin + "/interesses/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Deletado com sucesso!", null, loadInterests)
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


    // MUDAR STATUS DE INTERESSE
    $("#list").on("click", ".change-status-interest", function(){
        
        let id = $(this).data('id');
        let status = $(this).data('status');
        let observation = $(this).data('observation');

        $("#id_edit_status").val(id);
        $("#status_interest_edit").val(status).change();
        $("#observation").val(observation);

        $("#modalEditStatusInterest").modal("show")
    });

    $("#formEditStatusInterest").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/interesses/editar-status",
                        type: 'PUT',
                        data: {
                            id: $("#id_edit_status").val(),
                            status: $("#status_interest_edit option:selected").val(),
                            observation: $("#observation").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditStatusInterest").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalEditStatusInterest").modal("hide");

                                showSuccess("Edição efetuada!", null, loadInterests)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    // MARCAR AVALIAÇÃO DE INTERESSE
    $("#list").on("click", ".avaliation-interest", function(){
    
        let id = $(this).data('id');

        $("#id_avaliation_date").val(id);

        $("#modalAvaliationInterest").modal("show")
    });

    $("#formAvaliationInterest").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/interesses/marcar-avaliacao",
                        type: 'PUT',
                        data: {
                            id: $("#id_avaliation_date").val(),
                            avaliation_date: $("#avaliation_date").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formAvaliationInterest").each(function () {
                                    this.reset();
                                });
                                
                                $("#modalAvaliationInterest").modal("hide");

                                showSuccess("Edição efetuada!", null, loadInterests)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

});