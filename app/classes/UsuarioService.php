<?php
include("config.php");

class UsuarioService {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getUsuario($id) {
        $sql = "SELECT curso, email, nome, tipo, horas FROM usuarios WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);

        if ($stmt === false) {
            die(json_encode("Erro: " . $this->conexao->error));
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->num_rows > 0 ? $resultado->fetch_assoc() : null;
    }
}

$usuarioService = new UsuarioService($conexao);

$input = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($input['usuario_id'])) {
    $usuario_id = intval($input['usuario_id']);
    $usuario = $usuarioService->getUsuario($usuario_id);
    
    echo json_encode($usuario ? $usuario : "Usuário não encontrado.");
}
?>
