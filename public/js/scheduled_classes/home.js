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
                                                <td class="align-middle">${item.status=="P"?`<span class="badge badge-success">Presente</span>`:`<span class="badge badge-warning">Pendente</span>`}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    ${item.status==null?`
                                                        <a title="Realizada" data-id="${item.id}" href="#" class="btn btn-success mark-presence"><i class="fas fa-check"></i></a>
                                                    `:``}
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

    $("#list").on("click",".mark-presence", function(){

        let id = $(this).data('id');
        let date = $("#date").val();

        Swal.fire({
            title: 'Atenção!',
            text: "O aluno realizou a aula?",
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
                                $.post(window.location.origin + "/aulas-programadas-resultado/cadastrar", {
                                    id: id,
                                    date: date
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {
                                                        
                                            showSuccess("Presença confirmada!", null, loadScheduledClasses)
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

    $("#date").on("change", function(){
        loadScheduledClasses();
    });

});