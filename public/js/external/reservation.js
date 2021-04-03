$(document).ready(function () {
    loadCourts();

    function resetScreen() {
        $("#reset").hide(``);
        $("#list-courts").html(``);
        $("#list-available-week-days").html(``);
        $("#list-available-times").html(``);
    }

    function loadCourts() {
        $.post(window.location.origin + "/listar-quadras", {})
            .then(function (data) {
                if (data.status == "success") {
                    
                    if (data.data.length > 0) {
                        
                        // let count = Math.round(12/(data.data.length));

                        // if(count < 3 || count == 12)
                            count = 3;

                        $("#list-courts").append(`
                            <div class="col-12">
                                <h4>Primeiro, escolha a quadra!</h4>
                            </div>
                        `); 

                        data.data.forEach(item => {

                            // <img class="card-img-top" src="https://www.rioquente.com.br/images/attractions/0011/01.jpg" alt="Card image cap"></img>
                            // <div class="col-6">
                            //     <button class="btn btn-primary btn-block details-court" data-id_court="${item.id}">Detalhes</button>
                            // </div>
                            $("#list-courts").append(`
                                <div class="col-md-${count} col-sm-6">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p class="card-text h4">${item.name}</p>
                                            <p class="card-text">${item.neighborhood}, ${item.city} <br> ${item.reference}</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button class="btn btn-success btn-block reserve-court" data-id_court="${item.id}" data-name="${item.name}"><i class="fas fa-thumbs-up"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);       
                        });

                    }
                
                }
            })
            .catch();
    }


    $("#list-courts").on("click", ".reserve-court", function(){

        let id_court = $(this).data('id_court');
        let name = $(this).data('name');

        $("#court-chosen").html(name);

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + `/listar-dias-disponiveis/${id_court}`, {
                        
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            $("#list-available-week-days").html(``);

                            if(data.data.length > 0){

                                // let count = Math. round(12/(data.data.length));

                                // if(count < 3)
                                    count = 2;

                                $("#list-available-week-days").append(`
                                    <div class="col-12">
                                        <h4>Agora, escolha o dia!</h4>
                                    </div>
                                `); 

                                data.data.forEach(item => {

                                    $("#list-available-week-days").append(`
                                        <div class="col-sm-4 col-md-${count} col-6">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <p class="card-text h4">${week_day_description[item.week_day]}</p>
                                                    <p class="card-text">${dateFormat(item.day)}</p>
                                                    <button title="${item.available==0?`Indisponível`:`Escolher`}" class="btn btn-${item.available==0?`danger`:`success`} btn-block reserve-day" data-id_court="${id_court}" data-week_day="${item.week_day}" data-day="${item.day}" ${item.available==0?`disabled`:``}>${item.available==0?`<i class="fas fa-ban"></i>`:`<i class="fas fa-thumbs-up"></i>`}</button>    
                                                </div>
                                            </div>
                                        </div>
                                    `);
     
                                });

                                $("#reset").show();

                                $("#list-courts").html(`
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <strong>Quadra escolhida: </strong> ${name}
                                            </div>
                                        </div>
                                    </div>
                                `);

                                $("html, body").animate({ scrollTop: (($("#list-available-week-days").offset().top) -12) }, 800);

                            }else{


                            }


                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch();
                },
            },
        ]);

    });


    $("#list-available-week-days").on("click", ".reserve-day", function(){

        let id_court = $(this).data('id_court');
        let week_day = $(this).data('week_day');
        let day = $(this).data('day');

        $("#available-day-chosen").html(`${week_day_description[week_day]}, ${dateFormat(day)}`);
        $("#reservation_date").val(day)
        
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + `/listar-horarios-disponiveis/${id_court}/${week_day}/${day}`, {
                        
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            $("#list-available-times").html(``);

                            if(data.data.length > 0){

                                let count = Math. round(12/(data.data.length));

                                if(count < 3)
                                    count = 3;

                                $("#list-available-times").append(`
                                    <div class="col-12">
                                        <h4>Por fim, escolha o horário!</h4>
                                    </div>
                                `); 

                                data.data.forEach(item => {

                                    $("#list-available-times").append(`
                                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                            <span>De <b>${item.start_time}</b> às <b>${item.end_time}</b></span>
                                            <span class="badge badge-success badge-pill">R$ ${moneyFormat(item.price)}</span>
                                            ${item.reserved == null?`
                                                <button class="btn btn-success btn-sm chose-time" data-id="${item.id}" data-start_time="${item.start_time}" data-end_time="${item.end_time}" data-price="${item.price}" title="Reservar"><i class="fas fa-thumbs-up"></i></button>
                                            `:`<button title="Indisponível" class="btn btn-warning btn-sm" disabled ><i class="fas fa-ban"></i></button>`}
                                        </li>
                                    `);
     
                                });

                                $("#list-available-week-days").html(`
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <strong>Dia escolhido: </strong> ${week_day_description[week_day]}, ${dateFormat(day)}
                                            </div>
                                        </div>
                                    </div>
                                `);

                                $("html, body").animate({ scrollTop: (($("#list-available-times").offset().top) -12) }, 800);

                            }else{


                            }


                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch();
                },
            },
        ]);

    });


    $("#list-available-times").on("click", ".chose-time", function(){

        let id = $(this).data('id');
        let start_time = $(this).data('start_time');
        let end_time = $(this).data('end_time');
        let price = $(this).data('price');

        $("#time-chosen").html(`<span>De <b>${start_time}</b> às <b>${end_time}</b></span>`);
        $("#price-chosen").html(`R$ ${moneyFormat(price)}`);
        $("#id_available_date").val(id);

        $("#modalReservation").modal("show");

    });


    // CADASTRAR RESERVA
    $("#formReservation").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/reservar-horario", {
                        name_reserved: $("#name_reserved").val(),
                        phone_reserved: $("#phone_reserved").val(),
                        id_available_date: $("#id_available_date").val(),
                        reservation_date: $("#reservation_date").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formReservation").each(function () {
                                    this.reset();
                                });

                                $("#modalReservation").modal("hide");

                                showSuccess("Reserva efetuada!", null, ResetAndloadCourts)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });

    $("#reset").on("click", function(){

        ResetAndloadCourts();

    })

    function ResetAndloadCourts()
    {
        resetScreen();
        loadCourts();
    }
    

});