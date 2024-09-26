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

if ($tipo_usuario === 'professor') {
    $limite = 10; // Número de alunos por página
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $offset = ($pagina - 1) * $limite;

    // Contagem total de alunos
    $sqlCount = "SELECT COUNT(*) AS total FROM usuarios WHERE tipo = 'aluno'";
    $resultCount = $conexao->query($sqlCount);
    $totalAlunos = $resultCount->fetch_assoc()['total'];
    $totalPaginas = ceil($totalAlunos / $limite);

    // Consulta com limite e offset
    $sql = "SELECT id, nome, email FROM usuarios WHERE tipo = 'aluno' LIMIT $limite OFFSET $offset";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        echo '
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Confirmar Presença - Alunos</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/comum.css">
            <link rel="stylesheet" href="../css/inicio.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </head>
        <body>
            <div class="container content-wrapper mt-4">
                <h3>Confirmar Presença dos Alunos</h3>
                <div id="alertSuccess" class="alert alert-success alert-dismissible fade" role="alert" style="display:none;">
                    <strong>Sucesso!</strong> As presenças foram confirmadas com sucesso.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="confirmarPresencaForm" action="confirmar_presenca.php" method="POST">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome do Aluno</th>
                                <th>Email</th>
                                <th>Confirmar Presença</th>
                            </tr>
                        </thead>
                        <tbody>';
                        
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['nome']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>
                                        <input type='checkbox' name='presenca[]' value='" . $row['id'] . "'>
                                    </td>
                                  </tr>";
                        }
                        
                        echo '
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success" id="btnConfirmar">Confirmar Presenças Selecionadas</button>
                </form>';

                // Links de paginação
                echo '<nav aria-label="Page navigation">
                    <ul class="pagination">';
                    if ($pagina > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pagina-1).'">Anterior</a></li>';
                    }
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        $active = ($i == $pagina) ? 'active' : '';
                        echo '<li class="page-item '.$active.'"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                    }
                    if ($pagina < $totalPaginas) {
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pagina+1).'">Próxima</a></li>';
                    }
                echo '</ul>
                </nav>';
                
                echo '
            </div>

            <script>
                $(document).ready(function() {
                    $("#confirmarPresencaForm").on("submit", function(event) {
                        event.preventDefault();

                        $("#alertSuccess").fadeIn().addClass("show");

                        setTimeout(function() {
                            $("#alertSuccess").fadeOut();
                        }, 3000);
                    });
                });
            </script>
        </body>
        </html>';
    } else {
        echo "<div class='alert alert-info'>Nenhum aluno encontrado.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Você não tem permissão para acessar esta página.</div>";
}
?>
