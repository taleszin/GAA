<?php 
include("../classes/EventoService.php");
include("../classes/LoginService.php");
include("header.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit(); 
}

$eventoService = new EventoService($conexao);
$id_usuario = $_SESSION['id_usuario'];
$tipo_usuario = $_SESSION['tipo'];

if ($tipo_usuario === 'professor'): ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Atividades Complementares</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/comum.css">
        <link rel="stylesheet" href="../css/inicio.css">
    </head>
    <body>
        <div class="container content-wrapper mt-4">
            <h3>Criar Evento</h3>
            <form action="processar_criacao_evento.php" method="POST">
                <div class="form-group">
                    <label for="titulo">Título do Evento:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea class="form-control" id="descricao" name="descricao" required></textarea>
                </div>
                <div class="form-group">
                    <label for="data_evento">Data do Evento:</label>
                    <input type="date" class="form-control" id="data_evento" name="data_evento" required>
                </div>
                <div class="form-group">
                    <label for="hora_inicio">Hora de Início:</label>
                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                </div>
                <div class="form-group">
                    <label for="duracao">Duração (em horas):</label>
                    <input type="number" class="form-control" id="duracao" name="duracao" required>
                </div>
                <div class="form-group">
                    <label for="local">Local (sala):</label>
                    <input type="text" class="form-control" id="local" name="local" required>
                </div>
                <div class="form-group">
                    <label for="vagas">Número de Vagas:</label>
                    <input type="number" class="form-control" id="vagas" name="vagas" required>
                </div>
                <button type="button" class="btn btn-custom mt-3" onclick="criarEvento(<?= $id_usuario ?>)">Cadastrar Evento</button>
            </form>
        </div>
    </body>
    </html>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/evento.js"></script>
<?php 
elseif ($tipo_usuario === 'aluno'): ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eventos - Inscrição</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/comum.css">
        <link rel="stylesheet" href="../css/inicio.css">
    </head>
    <body>
        <div class="container content-wrapper mt-4">
            <h3>Próximos Eventos</h3>
            <div class="row">
                <?php foreach ($eventos as $evento): ?>
                    <div class="col-md-4 mb-4">
                        <a href="eventoAluno.php?id=<?= $evento['id'] ?>" class="text-decoration-none">
                            <div class="card card-custom">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $evento['titulo'] ?></h5>
                                    <p class="card-text"><?= date('d/m/Y', strtotime($evento['data_evento'])) ?> - <?= date('H:i', strtotime($evento['hora_inicio'])) ?></p>
                                    <p class="card-text">Vagas: <?= $evento['vagas'] ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
    </html>
<?php 
else: ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Easter Egg</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/comum.css">
        <link rel="stylesheet" href="../css/inicio.css">
    </head>
    <body>
        <div class="container">
            <h3 class="message">Ops, parece que você não é aluno nem professor :)</h3>
        </div>
    </body>
    </html>
<?php endif; ?>
<?php include('footer.php'); ?>
