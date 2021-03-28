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
                                                <td class="align-middle just-pc">${item.phone_reserved}</td>
                                                <td class="align-middle">${dateFormat(item.reservation_date)}</td>
                                                <td class="align-middle just-pc">${week_day_description[item.week_day]}</td>
                                                <td class="align-middle just-pc">${item.start_time}</td>
                                                <td class="align-middle just-pc">${item.end_time}</td>
                                                <td class="align-middle just-pc">${moneyFormat(item.price)}</td>
                                                <td class="align-middle">
                                                    <div class="float-right">
                                                    ${item.status=='A'?``:`<a title="Confirmar" data-id="${item.id}" data-status="A" href="#" class="btn btn-success btn-sm confirm-reservation"><i class="fas fa-check"></i></a>`}
                                                    <a title="Informações" data-id="${item.id}" data-name_reserved="${item.name_reserved}" data-phone_reserved="${item.phone_reserved}" data-reservation_date="${item.reservation_date}" data-week_day="${item.week_day}" data-start_time="${item.start_time}" data-end_time="${item.end_time}" data-price="${item.price}" href="#" class="btn btn-info btn-sm just-cel show-info"><i class="fas fa-info-circle"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        `);       
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="8">Nenhuma reserva efetuada</td>
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

    $("#list").on("click", ".confirm-reservation", function(){

        let id = $(this).data('id');
        let status = $(this).data('status');



        Swal.fire({
            title: 'Atenção!',
            text: "Confirma a reserva?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Sim',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não'
            }).then((result) => {
                console.log(result)
                if (result.value) {

                    Swal.queue([
                        {
                            title: "Carregando...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onOpen: () => {
                                Swal.showLoading();
                                $.post(window.location.origin + "/reservas/change-status", {
                                    id, status
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
            
                                            Swal.close();
                                            loadReservations();
            
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
            })


    });

    $("#list").on("click", ".show-info", function(){

        let id = $(this).data('id');
        let name_reserved = $(this).data('name_reserved');
        let phone_reserved = $(this).data('phone_reserved');
        let reservation_date = $(this).data('reservation_date');
        let week_day = $(this).data('week_day');
        let start_time = $(this).data('start_time');
        let end_time = $(this).data('end_time');
        let price = $(this).data('price');

        $("#show-name_reserved").html(name_reserved);
        $("#show-phone_reserved").html(phone_reserved);
        $("#show-reservation_date").html(`${week_day_description[week_day]}, ${dateFormat(reservation_date)}`);
        $("#show-hora").html(`${start_time} às ${end_time}`);
        $("#show-price").html(`R$ ${moneyFormat(price)}`);

        $("#modalShowReservation").modal("show")
    });

});