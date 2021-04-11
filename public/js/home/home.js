$(document).ready(function () {

    loadAll();

    // LISTAR PLANOS
    function loadAll()
    {

        $.get(window.location.origin + "/home/all", {
            
        })
            .then(function (data) {
                if (data.status == "success") {

                    $("#tot-students").html(data.data.students);
                    $("#tot-classes").html(data.data.scheduledClasses);
                    $("#tot-reservations").html(data.data.reservations);
                    $("#tot-debts").html(data.data.debts);

                } else if (data.status == "error") {
                    showError(data.message)
                }
            })
            .catch();

    }

});