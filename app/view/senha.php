<?php
include("../classes/SenhaService.php");
session_start();
if(isset($_SESSION['id_usuario']) && isset($_SESSION['email'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $email = $_SESSION['email'];
    echo $email;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Senha - Gerenciador Financeiro Pessoal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Alteração de Senha - Gerenciador Financeiro Pessoal</h3>
                    </div>
                    <div class="card-body">
                    <div class="col-md-8">
                        <p class="h6">Usuário <?php echo $email;?></p>
                    </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="senha_atual">Senha Atual:</label>
                                <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
                            </div>
                            <div class="form-group">
                                <label for="nova_senha">Nova Senha:</label>
                                <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmar_nova_senha">Confirmar Nova Senha:</label>
                                <input type="password" class="form-control" id="confirmar_nova_senha" name="confirmar_nova_senha" required>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="trocarSenha();">Alterar Senha</button>
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                            <div id="mensagem" class="text-success mt-3" style="display: none;"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/cadastro.js"></script>
</body>
</html>
