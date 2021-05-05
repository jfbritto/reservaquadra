$(document).ready(function () {

    loadEntries();

    // LISTAR PLANOS
    function loadEntries()
    {
        let date = $("#date").val();
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/faturas/listar-entradas-por-mes", {
                        date
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                let tot_entry = 0;

                                if(data.data.length > 0){
                                    
                                    data.data.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${dateFormat(item.due_date)}</td>
                                                <td class="align-middle">R$ ${moneyFormat(item.paid_price)}</td>
                                                <td class="align-middle">${item.payment_method}</td>
                                                <td class="align-middle">${item.payment_method_subtype}</td>
                                                <td class="align-middle">${item.cliente}</td>
                                            </tr>
                                        `);       

                                        if(item.status == 'R')
                                            tot_entry += parseFloat(item.paid_price);

                                    });


                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="8">Nenhuma entrada encontrada</td>
                                        </tr>
                                    `);  

                                }

                                $("#tot-entry").html("R$ "+moneyFormat(tot_entry));


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
        loadEntries();
    });



});