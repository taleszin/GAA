<?php
include("config.php");
    $json_data = file_get_contents("php://input");
    $usuario = json_decode($json_data, true);
    if (isset($usuario['nova_senha'])) {
        $sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        if ($stmt === false) {
            die("Erro na preparação da declaração SQL: " . $conexao->error);
        }
        $senha_hash = password_hash($usuario['nova_senha'], PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $senha_hash, $usuario['email']);

        if ($stmt->execute() === true) {
            echo json_encode(["message" => "Senha atualizada com sucesso"]);
        } else {
            echo json_encode(["error" => "Erro ao atualizar a senha: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Nova senha não recebida"]);
    }
?>
