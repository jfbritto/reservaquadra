$(document).ready(function(){

    $("#formAuthenticate").on("submit", function(e){
        e.preventDefault();

        let email = $("#email").val(); 
        let password = $("#password").val();

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onOpen: () => {
                Swal.showLoading();
                $.post("/login", {email, password}, function(data) {
                    if(data.status) {
                        Swal.fire({
                            type: 'success',
                            title: 'Bem vindo!',
                            text: 'Login realizado com sucesso',
                            showConfirmButton: false,
                            timer: 1500
                          })
    
                        setTimeout(function() {
                            window.location = "/home";
                        }, 1000);
                    }else{

                        showError(data.mensagem)

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
                        showSuccess("Cadastro realizado com sucesso!")
    
                        setTimeout(function() {
                            window.location = "/";
                        }, 1000);
                    }else{

                        showError(data.mensagem)

                    }
                }, 'json');
            }
        }]);

    });

});