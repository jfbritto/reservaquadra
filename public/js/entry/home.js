$(document).ready(function () {

    const tabela = $('#table').DataTable({
        "paging":   true,
        "ordering": true,
        "order": [],
        "info":     true,
        "searching":false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
        },
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );

    const tabela2 = $('#table2').DataTable({
        "paging":   true,
        "ordering": true,
        "order": [],
        "info":     true,
        "searching":false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json'
        },
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );

    loadEntries();

    // LISTAR PLANOS
    function loadEntries()
    {
        let date_ini = $("#date-ini").val();
        let date_end = $("#date-end").val();
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/entradas/listar", {
                        date_ini,
                        date_end
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list, #list2").html(``);

                                let tot_entry = 0;
                                let tot_billed = 0;

                                // BOLETOS PAGOS NO MÊS

                                if(data.data.response.length > 0){
                                    
                                    // data.data.response.forEach(item => {

                                    //     $("#list").append(`
                                    //         <tr>
                                    //             <td class="align-middle">${dateFormat(item.paid_date)}</td>
                                    //             <td class="align-middle">${dateFormat(item.due_date)}</td>
                                    //             <td class="align-middle">R$ ${moneyFormat(item.paid_price)}</td>
                                    //             <td class="align-middle">${item.payment_method}</td>
                                    //             <td class="align-middle">${item.payment_method_subtype}</td>
                                    //             <td class="align-middle">${item.parcelas}</td>
                                    //             <td class="align-middle">${item.fiscal_note==null?`-`:item.fiscal_note}</td>
                                    //             <td class="align-middle">${item.fiscal_note_e==null?`-`:item.fiscal_note_e}</td>
                                    //             <td class="align-middle"><a href="/alunos/exibir/${item.id_user}">${item.cliente}</a></td>
                                    //         </tr>
                                    //     `);       

                                    //     if(item.status == 'R')
                                    //         tot_entry += parseFloat(item.paid_price);

                                    // });

                                    tabela.clear().draw();
        
                                    data.data.response.forEach(item => {

                                        tabela.row.add( [
                                            dateFormat(item.paid_date),
                                            dateFormat(item.due_date), 
                                            moneyFormat(item.paid_price), 
                                            item.payment_method, 
                                            item.payment_method_subtype, 
                                            item.parcelas, 
                                            item.fiscal_note==null?`-`:item.fiscal_note, 
                                            item.fiscal_note_e==null?`-`:item.fiscal_note_e, 
                                            `<a href="/alunos/exibir/${item.id_user}">${item.cliente}</a>`,
                                        ]).draw();

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


                                // ENTRADAS NO MÊS

                                console.log(data.data)

                                if(data.data.response2.length > 0){
                                    
                                    // data.data.response2.forEach(item => {

                                    //     $("#list2").append(`
                                    //         <tr>
                                    //             <td class="align-middle">${dateFormat(item.billing_date)}</td>
                                    //             <td class="align-middle">${dateFormat(item.paid_date)}</td>
                                    //             <td class="align-middle">R$ ${moneyFormat(item.price)}</td>
                                    //             <td class="align-middle">R$ ${moneyFormat(item.tax)}</td>
                                    //             <td class="align-middle">${item.payment_method}</td>
                                    //             <td class="align-middle">${item.payment_method_subtype}</td>
                                    //             <td class="align-middle">${item.parcela_paga}/${item.total_parcelas}</td>
                                    //             <td class="align-middle">${item.fiscal_note==null?`-`:item.fiscal_note}</td>
                                    //             <td class="align-middle">${item.fiscal_note_e==null?`-`:item.fiscal_note_e}</td>
                                    //             <td class="align-middle"><a href="/alunos/exibir/${item.id_user}">${item.cliente}</a></td>
                                    //         </tr>
                                    //     `);       

                                    //     if(item.status == 'R')
                                    //         tot_billed += parseFloat(item.price);

                                    // });

                                    tabela2.clear().draw();
        
                                    data.data.response2.forEach(item => {

                                        tabela2.row.add( [
                                            dateFormat(item.billing_date),
                                            dateFormat(item.paid_date),
                                            moneyFormat(item.price),
                                            moneyFormat(item.tax),
                                            item.payment_method,
                                            item.payment_method_subtype,
                                            `${item.parcela_paga}/${item.total_parcelas}`,
                                            item.fiscal_note==null?`-`:item.fiscal_note,
                                            item.fiscal_note_e==null?`-`:item.fiscal_note_e,
                                            `<a href="/alunos/exibir/${item.id_user}">${item.cliente}</a>`,
                                        ]).draw();

                                        if(item.status == 'R')
                                            tot_billed += parseFloat(item.price);

                                    });


                                }else{

                                    $("#list2").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="9">Nenhuma entrada encontrada</td>
                                        </tr>
                                    `);  

                                }

                                console.log(`valor: ${tot_billed}`)

                                $("#tot-billed").html("R$ "+moneyFormat(tot_billed));


                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    // $("#date-ini, #date-end").on("change", function(){
    //     loadEntries();
    // });

    $("#search").on("click", function(){
        loadEntries();
    });



});