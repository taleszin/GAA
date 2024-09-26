function login() {
    var email = $('#email').val();
    var senha = $('#senha').val();
    $('#error-message').html('');

    if (email.indexOf('@') == -1) {
        $('#error-message').html('O email deve conter um "@"');
    } else if (senha.length < 6) {
        $('#error-message').html('A senha deve ter pelo menos 6 caracteres');
    } else {
        var dados = {
            email: email,
            senha: senha
        };

        var jsonData = JSON.stringify(dados);

        $.ajax({
            url: '../classes/LoginService.php',
            type: 'POST',
            data: jsonData,
            contentType: 'application/json',
            success: function(response) {
              var data = JSON.parse(response);
                if (data.success) {
                    console.log(data);
                    window.location.href = data.redirect;
                }   else {
            console.error(data.error);
              }
            },
            error: function(xhr, status, error) {
                console.error("Erro ao realizar o login:");
            }
        });
    }
}



