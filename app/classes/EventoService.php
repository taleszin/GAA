<?php
include("config.php");

class EventoService {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function verificarInscricao($usuario_id, $evento_id) {
        $sql = "SELECT COUNT(*) FROM inscritos WHERE usuario_id = ? AND evento_id = ?";
        $stmt = $this->conexao->prepare($sql);
        if ($stmt === false) {
            die(json_encode("deu erro no SQL colega"));
        }
        $stmt->bind_param("ii", $usuario_id, $evento_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0; 
    }

    public function registrarEvento($evento) {
        $sql = "INSERT INTO eventos (titulo, descricao, data_evento, hora_inicio, horas_complementares, localizacao, vagas, usuario_id, data_criacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        if ($stmt === false) {
            die(json_encode("Erro no SQL: " . $this->conexao->error));
        }
        
        $data_criacao = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        $data_criacao = $data_criacao->format("Y-m-d H:i:s");
        
        if (!$stmt->bind_param("sssssdsis", 
            $evento['titulo'], 
            $evento['descricao'], 
            $evento['data_evento'], 
            $evento['hora_inicio'], 
            $evento['horas_complementares'], 
            $evento['local'], 
            $evento['vagas'], 
            $evento['usuario_id'], 
            $data_criacao)) {
            die(json_encode("Erro no bind_param: " . $stmt->error));
        }
        
        if ($stmt->execute() === true) {
            return json_encode(["success" => true, "message" => "Evento criado com sucesso."]);
        } else {
            return json_encode("Erro na execução do SQL: " . $stmt->error);
        }
        
        $stmt->close();
    }

    public function getEventos() {
        $sql = "SELECT id, titulo, descricao, data_evento, hora_inicio, vagas, usuario_id, data_criacao, imagem FROM eventos WHERE data_evento >= CURDATE() ORDER BY data_evento ASC";
        $result = $this->conexao->query($sql);
        if ($result === false) {
            die(json_encode("deu erro no SQL colega"));
        }
        $eventos = [];
        while ($row = $result->fetch_assoc()) {
            $eventos[] = $row;
        }
        return $eventos;
    }

    public function detalharEvento($evento_id) {
        $sql = "SELECT id, titulo, descricao, data_evento, hora_inicio, horas_complementares, vagas, usuario_id, data_criacao, imagem FROM eventos WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        if ($stmt === false) {
            die(json_encode("deu erro no SQL colega"));
        }
        $stmt->bind_param("i", $evento_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $evento = $resultado->fetch_assoc();
        } else {
            return json_encode("Evento não encontrado.");
        }
        $stmt->close();
        return $evento;
    }

    public function inscreverUsuario($usuario_id, $evento_id) {
        if ($this->verificarInscricao($usuario_id, $evento_id)) {
            return json_encode(["success" => false, "message" => "Usuário já inscrito neste evento."]);
        }
        $sql = "INSERT INTO inscritos (usuario_id, evento_id) VALUES (?, ?)";
        $stmt = $this->conexao->prepare($sql);
        if ($stmt === false) {
            die(json_encode("Erro no SQL: " . $this->conexao->error));
        }
        $stmt->bind_param("ii", $usuario_id, $evento_id);
        if ($stmt->execute() === true) {
            return json_encode(["success" => true, "message" => "Inscrição realizada com sucesso."]);
        } else {
            return json_encode("Erro na execução do SQL: " . $stmt->error);
        }
        $stmt->close();
    }
}

$eventoService = new EventoService($conexao);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_data = file_get_contents("php://input");
    $evento = json_decode($json_data, true);
    echo $eventoService->registrarEvento($evento);
}

$eventos = $eventoService->getEventos();
?>
