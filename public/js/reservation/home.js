$(document).ready(function () {

    loadReservations();

    // LISTAR RESERVAS
    function loadReservations()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/reservas/listar", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                if(data.data.length > 0){
                                    
                                    data.data.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.name_reserved}</td>
                                                <td class="align-middle">${item.phone_reserved}</td>
                                                <td class="align-middle">${dateFormat(item.reservation_date)}</td>
                                                <td class="align-middle">${week_day_description[item.week_day]}</td>
                                                <td class="align-middle">${item.start_time}</td>
                                                <td class="align-middle">${item.end_time}</td>
                                                <td class="align-middle">${moneyFormat(item.price)}</td>
                                                <td class="align-middle">
                                                    <a title="Confirmar" data-id="${item.id}" href="#" class="btn btn-success btn-sm confirm-reservation"><i class="fas fa-check"></i></a>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="4">Nenhuma reserva efetuada</td>
                                        </tr>
                                    `);  

                                }


                            } else if (data.status == "error") {
                                // showError(data.message);
                                Swal.fire({
                                    icon: "error",
                                    text: data.message,
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: "OK",
                                    onClose: () => {},
                                });
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

});