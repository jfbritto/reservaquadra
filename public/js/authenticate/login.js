$(document).ready(function(){

    $("#formAuthenticate").on("submit", function(e){
        e.preventDefault();

        let email = $("#email").val(); 
        let password = $("#password").val();
        
        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post("/login", {email, password}, function(data) {
                    if(data.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Bem vindo',
                            text: 'Login realizado com sucesso',
                            showConfirmButton: false,
                            showCancelButton: false
                        });
    
                        setTimeout(function() {
                            window.location = "/reservas";
                        }, 1000);
                    }else{

                        Swal.fire('Erro!', data.mensagem, 'error');

                    }
                }, 'json');
            }
        }]);

    });

    $("#formStoreUser").on("submit", function(e){
        e.preventDefault();

        let name = $("#name").val(); 
        let email = $("#email").val(); 
        let password = $("#password").val();
        
        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post("/register", {name, email, password}, function(data) {
                    if(data.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Bem vindo',
                            text: 'Cadastro realizado com sucesso',
                            showConfirmButton: false,
                            showCancelButton: false
                        });
    
                        setTimeout(function() {
                            window.location = "/login";
                        }, 1000);
                    }else{

                        Swal.fire('Erro!', data.mensagem, 'error');

                    }
                }, 'json');
            }
        }]);

    });

});

