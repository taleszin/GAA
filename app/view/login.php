<?php
include("../classes/LoginService.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gerenciador Financeiro Pessoal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/comum.css">
</head>
<body>
    <header>
    <img src="../docs/img/ueceLogo.png" alt="UECE">
        <h2>Gerenciador de Atividades Acadêmicas</h2>
    </header>
    <main role="main" class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-card">
                    <h3>Controle de Acesso</h3>
                    <div id="error-message" style="color: red;"></div>
                    <form id="login-form">
                        <div class="form-group">
                            <label for="email">E-mail Institucional:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                        <button type="button" class="btn btn-green btn-block" onclick="login();">Entrar</button>
                        <a href="#" class="d-block mt-2">Esqueceu a senha?</a>
                    </form>
                    <p class="text-center mt-4">Para esclarecimentos de dúvidas, contato: gaa@uece.br</p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <span>Universidade Estadual do Ceará - Bacharelado em Ciência da Computação</span>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/cadastro.js"></script>
</body>
</html>
