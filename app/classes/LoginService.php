<?php
include("config.php");
include("UsuarioService.php");

session_start();
$usuarioService = new UsuarioService($conexao); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email']) && isset($data['senha'])) {
        $email = $data['email'];
        $senha = $data['senha'];
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $ID = $row['id'];
            $tipo = $row['tipo'];
            if (password_verify($senha, $row['senha'])) {
                $_SESSION['id_usuario'] = $ID;
                $_SESSION['tipo'] = $tipo;
                echo json_encode(["success" => true, "message" => "Login realizado com sucesso", "redirect" => "../view/inicio.php"]);
                exit();
            } else {
                echo json_encode(["success" => false, "error" => "Senha incorreta."]);
                exit();
            }
        } else {
            echo json_encode(["success" => false, "error" => "Usuário inexistente."]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "error" => "Dados de entrada inválidos."]);
        exit();
    }
}
?>
