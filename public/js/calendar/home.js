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
                            let kk = 0;
                            let str = 0;
                            let date = data.data.data_inicio.split('-');
                            let day = ``;
                            let day_week = ``;

                            actual_day = new Date();

                            for (let i = 0; i < data.data.linhas; i++) {
                                table += `<tr>`;
                                
                                for (let d = 0; d < 7; d++) {
                                    
                                    kk = i*7;
                                    str = d+kk;
                                    
                                    day = new Date(parseInt(date[0]), parseInt(date[1]), parseInt(date[2]));
                                    
                                    day.setDate(day.getDate() + str);

                                    day_week = parseInt(day.getDate());

                                    if(day_week <= 9)
                                        day_week = '0'+day_week

                                    if(actual_day.getDate() > day.getDate()){

                                        table += `<td>${day_week}/${monthDescription(day.getMonth())}<br>Indisponível</td>`;
                                    }else{
                                        table += `<td>${day_week}/${monthDescription(day.getMonth())}</td>`;
                                        
                                    }



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