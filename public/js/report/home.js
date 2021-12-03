$(document).ready(function () {

    loadEntry();
    loadExpense();

    // LISTAR ENTRADAS
    function loadEntry()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/relatorios/entradas", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                console.log(data.data.mesano)
                                console.log(data.data.total)

                                const ctx = document.getElementById('myChart').getContext('2d');
                                const myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: data.data.mesano,
                                        datasets: [{
                                            label: 'Faturamento esperado',
                                            data: data.data.total,
                                            backgroundColor: data.data.coresborda,
                                            borderColor: data.data.cores,
                                            borderWidth: 1,
                                            hoverOffset: 4
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    // LISTAR DESPESAS
    function loadExpense()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/relatorios/despesas", {
                        
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();

                                console.log(data.data.mesano)
                                console.log(data.data.total)

                                const ctx2 = document.getElementById('myChart2').getContext('2d');
                                const myChart2 = new Chart(ctx2, {
                                    type: 'bar',
                                    data: {
                                        labels: data.data.mesano,
                                        datasets: [{
                                            label: 'Despesas esperadas',
                                            data: data.data.total,
                                            backgroundColor: data.data.coresborda,
                                            borderColor: data.data.cores,
                                            borderWidth: 1,
                                            hoverOffset: 4
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });

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