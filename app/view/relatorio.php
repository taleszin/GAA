<?php
session_start();
if(isset($_SESSION['id_usuario']) && isset($_SESSION['email'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $email = $_SESSION['email'];
} else {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit; 
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios Financeiros - Sistema de Gastos Pessoais</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <input type="hidden" id="id_usuario" value="<?= $id_usuario ?>">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Gastos Pessoais</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="inicio.php">Página Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#transactions">Transações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Relatórios Financeiros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Configurações</a>
                    </li>
                </ul>         
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="button">Sair</button>
            </div>
        </nav>
    </header>

    <main role="main" class="container mt-5">
        <div class="jumbotron" id="reports">
            <h2 class="display-4">Relatórios Financeiros</h2>
            <p class="lead">Esta seção oferece uma análise detalhada de suas finanças, incluindo despesas, receitas e tendências ao longo do tempo.</p>
            <hr class="my-4">
            <h3>Opções de Relatórios:</h3>
            <ul>
                <li><a href="#" onclick="gerarPlanilha()">Gerar Planilha de Gastos</a></li>
                <li><a href="#" onclick="gerarRelatorio()">Gerar Relatório de Últimas Transações</a></li>
                <li><a href="#" onclick="visualizarTendencias()">Visualizar Tendências de Gastos</a></li>
            </ul>
            <p>Escolha uma das opções acima para gerar o relatório desejado.</p>
        </div>
    </main>

    <footer class="footer bg-light text-center py-3">
        <div class="container">
            <span class="text-muted">&copy; <?php echo date("Y"); ?> Sistema de Gastos Pessoais. Todos os direitos reservados.</span>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/relatorio.js"></script>
</body>
</html>
