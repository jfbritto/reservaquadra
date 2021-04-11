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
                            
                            console.log(data.data)

                            let table = ``;
                            let day_obj = ``;
                            let day_week = ``;
                            let date = data.data.data_inicio.split('-');
                            let actual_day = new Date();

                            let class_bloq = ``;

                            console.log(actual_day.getDay())
                            console.log(data.data.classes)

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

                                    for (let index = 0; index < data.data.classes.length; index++) {
                                        const element = data.data.classes[index];

                                        if((day_obj.getDay()==0?7:day_obj.getDay()) == element){
                                            table += `<div><span class="item-cel badge badge-pill badge-success ${class_bloq}" style="width: 100%;">${element}</span></div>`;
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


});