<?php
include("../classes/EventoService.php");
include("../classes/LoginService.php");
include("header.php");
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit(); 
}
$eventoService = new EventoService($conexao);

$id = $_GET['id'];
$evento = $eventoService->detalharEvento($id);

if (!$evento) {
    echo "Evento não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $evento['titulo'] ?> - Detalhes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/comum.css">
</head>
<body>

<div class="container content-wrapper mt-4">
    <div class="card">
        <img src="<?= $evento['imagem'] ?>.jpeg" class="card-img-top" alt="<?= $evento['titulo'] ?>">
        <div class="card-body">
            <h3 class="card-title"><?= $evento['titulo'] ?></h3>
            <p class="card-text"><strong>Data:</strong> <?= date('d/m/Y', strtotime($evento['data_evento'])) ?></p>
            <p class="card-text"><strong>Horário:</strong> <?= $evento['hora_inicio'] ?></p>
            <p class="card-text"><strong>Vagas:</strong> <?= $evento['vagas'] ?></p>
            <p class="card-text"><strong>Carga horária:</strong> <?= number_format($evento['horas_complementares'], 1) ?> Horas</p>
            <p class="card-text"><?= $evento['descricao'] ?></p>
            <input type="hidden" id="id_usuario" value="<?=$_SESSION['id_usuario']?>">
            <button type="button" class="btn btn-success" onclick="registrarInscricao(<?=$evento['id']?>);">Se inscrever no evento</button>
        </div>
    </div>
</div>
<div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventDetailsModalLabel">Detalhes do Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3></h3>
                <p></p>
                <p></p>
                <img src="" alt="Imagem do evento" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/evento.js"></script>
<?php include('footer.php'); ?>
</body>
</html>
