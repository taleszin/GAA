<?php
include("config.php");

class InscritoService {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function verificarInscricao($usuario_id, $evento_id) {
        $sql = "SELECT COUNT(*) FROM inscritos WHERE usuario_id = ? AND evento_id = ?";
        $stmt = $this->conexao->prepare($sql);
        if ($stmt === false) {
            die(json_encode("Erro no SQL colega"));
        }
        $stmt->bind_param("ii", $usuario_id, $evento_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0; 
    }

    public function marcarPresenca($usuario_id, $evento_id) {
        $sql = "UPDATE inscritos SET presenca = 1 WHERE usuario_id = ? AND evento_id = ?";
        $stmt = $this->conexao->prepare($sql);
        if ($stmt === false) {
            die(json_encode("Erro no SQL colega"));
        }

        $stmt->bind_param("ii", $usuario_id, $evento_id);
        if ($stmt->execute()) {
            return json_encode("Presença registrada com sucesso.");
        } else {
            return json_encode("Erro ao registrar presença.");
        }

        $stmt->close();
    }

    public function registrarInscricao($inscricao) {
        $sql = "INSERT INTO inscritos (usuario_id, evento_id, data_inscrito, presenca) VALUES (?, ?, NOW(), 0)";
        $stmt = $this->conexao->prepare($sql);
        if ($stmt === false) {
            die(json_encode("Erro no SQL: " . $this->conexao->error));
        }
    
        if (!$stmt->bind_param("ii", 
            $inscricao['usuario_id'], 
            $inscricao['evento_id'])) {
            die(json_encode("Erro no bind_param: " . $stmt->error));
        }
    
        if ($stmt->execute() === true) {
            return json_encode(["success" => true, "message" => "Inscrição registrada com sucesso."]);
        } else {
            return json_encode("Erro na execução do SQL: " . $stmt->error);
        }
    
        $stmt->close();
    }    


    public function getInscricoes($usuario_id) {
        $sql = "SELECT u.nome AS nome, i.evento_id, i.data_inscrito, i.presenca 
                FROM inscritos i 
                JOIN usuarios u ON i.usuario_id = u.id 
                WHERE i.usuario_id = ?";
        $stmt = $this->conexao->prepare($sql);
        if ($stmt === false) {
            die(json_encode("Erro no SQL colega"));
        }

        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();

        echo '<div class="table-responsive">';
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nome do Aluno</th>';
        echo '<th>Presença</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($aluno = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($aluno['nome']) . '</td>';
            echo '<td>';
            echo '<form action="" method="POST">';
            echo '<input type="hidden" name="id_aluno" value="' . htmlspecialchars($aluno['usuario_id']) . '">';
            echo '<input type="hidden" name="id_evento" value="' . htmlspecialchars($aluno['evento_id']) . '">';
            echo '<button type="submit" class="btn btn-success">Validar Presença</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';

        $stmt->close();
    }
}

$inscritoService = new InscritoService($conexao);
?>
