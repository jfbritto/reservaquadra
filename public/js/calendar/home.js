$(document).ready(function () {

    loadCalendar();

    // LISTAR QUADRAS
    function loadCalendar()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/calendario/carregar", {
                        
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            $("#list").html(``);

                            let table = ``;
                            let day_obj = ``;
                            let day_week = ``;
                            let date = data.data.data_inicio.split('-');
                            let actual_day = new Date();

                            let class_bloq = ``;

                            for (let linha = 0; linha < data.data.linhas; linha++) {
                                table += `<tr>`;
                                
                                for (let coluna = 0; coluna < 7; coluna++) {
                                    
                                    // inicializando o objeto date com a data inicial do calendário
                                    day_obj = new Date(parseInt(date[0]), parseInt(date[1]), parseInt(date[2]));
                                    // adicionando a soma de dias à data inicial para montagem das celulas do calendário
                                    day_obj.setDate(day_obj.getDate() + (coluna+(linha*7)));
                                    
                                    day_week = parseInt(day_obj.getDate());

                                    if(actual_day.getDate() > day_obj.getDate()){
                                        class_bloq = `class_bloq`;
                                    }else{
                                        class_bloq = ``;
                                    }
                                    
                                    table += `<td>
                                                <div class="box-cel">
                                                <div class="title-cel"><span class="badge badge-dark ${class_bloq}">${day_week<=9?`0${day_week}`:`${day_week}`}</span></div>`;

                                    for (let index = 0; index < data.data.week_day.length; index++) {
                                        const element_week_day = data.data.week_day[index];
                                        const element_interval = data.data.interval[index];
                                        const element_all = data.data.all[index];

                                        if(day_obj.getDay() == week_dayPhpToJs(element_week_day)){
                                            table += `<div><span data-id_user="${element_all.id_user}" data-user_name="${element_all.user_name}" data-court_name="${element_all.court_name}" data-start_time="${element_all.start_time}" data-end_time="${element_all.end_time}" class="item-cel badge badge-pill badge-success ${class_bloq} btn-detail" style="width: 100%;">${element_interval}</span></div>`;
                                        }

                                        
                                    }

                                                
                                    table += `<div>
                                              </td>`;
                                }

                                
                                table += `</tr>`;
                            }

                            $("#list").html(table);


                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch();
                },
            },
        ]);
    }

    $("#list").on("click", ".btn-detail", function(){
        $("#info-student").html($(this).data('user_name'));
        $("#info-court").html($(this).data('court_name'));
        $("#info-start_time").html($(this).data('start_time'));
        $("#info-end_time").html($(this).data('end_time'));

        $("#modalInfoCalendar").modal("show");
    });


});