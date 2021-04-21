$(document).ready(function () {

    loadScheduledClasses();

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
                                                <td class="align-middle"><span class="badge badge-warning">Pendente</span></td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Realizada" data-id="${item.id}" href="#" class="btn btn-success delete-court"><i class="fas fa-check"></i></a>
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

    $("#date").on("change", function(){
        loadScheduledClasses();
    });

});