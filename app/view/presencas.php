<?php 
include("../classes/EventoService.php");
include("../classes/InscritoService.php");
include("../classes/LoginService.php");
include("header.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit(); 
}

$eventoService = new EventoService($conexao);
$inscritoService = new InscritoService($conexao);
$id_usuario = $_SESSION['id_usuario'];
$tipo_usuario = $_SESSION['tipo'];

if ($tipo_usuario === 'professor'): ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Validar Presença - Professor</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/comum.css">
        <link rel="stylesheet" href="../css/inicio.css">
    </head>
    <body>
        <div class="container content-wrapper mt-4">
            <h3>Validar Presença dos Alunos</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome do Aluno</th>
                            <th>Presença</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $alunos = $inscritoService->getInscricoes($id_usuario);
                        foreach ($alunos as $aluno): ?>
                            <tr>
                                <td><?= htmlspecialchars($aluno['nome']) ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id_aluno" value="<?= htmlspecialchars($aluno['id']) ?>">
                                        <input type="hidden" name="id_evento" value="<?= htmlspecialchars($id_evento) ?>">
                                        <button type="submit" class="btn btn-success">Validar Presença</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>

<?php 
elseif ($tipo_usuario === 'aluno'): ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmar Presença - Aluno</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/comum.css">
        <link rel="stylesheet" href="../css/inicio.css">
    </head>
    <body>
        <div class="container content-wrapper mt-4">
            <h3>Confirmar Presença no Evento</h3>
            <form action="confirmar_presenca.php" method="POST">
                <div class="form-group">
                    <label for="codigo_evento">Código do Evento:</label>
                    <input type="text" class="form-control" id="codigo_evento" name="codigo_evento" required>
                </div>
                <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($id_usuario) ?>">
                <button type="submit" class="btn btn-success">Confirmar Presença</button>
            </form>
        </div>
    </body>
    </html>

<?php 
endif;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_aluno'])) {
    $id_aluno = $_POST['id_aluno'];
    $id_evento = $_POST['id_evento'];
    $resultado = $inscritoService->validarPresenca($id_aluno, $id_evento);

    if ($resultado) {
        echo "<div class='alert alert-success'>Presença validada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Falha ao validar presença. Tente novamente.</div>";
    }
}
?>
