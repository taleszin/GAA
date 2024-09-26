<?php include ("header.php"); 
include ("../classes/LoginService.php");
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit(); 
} 
$id_usuario = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/comum.css">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Perfil do Usuário</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nome: <span id="userName"></span></h5>
                <p class="card-text"><strong>Email:</strong> <span id="userEmail"></span></p>
                <p class="card-text"><strong>Curso:</strong> <span id="userCurso"></span></p>
                <p class="card-text"><strong>Tipo:</strong> <span id="userTipo"></span></p>
                <div id="chart-container">
                    <h3>Horas Complementares</h3>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="id_usuario" value="<?= $id_usuario ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/usuario.js"></script>
</body>
</html>
