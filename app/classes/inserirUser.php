<?php
include("config.php");
include("UsuarioService.php");

session_start();
$usuarioService = new UsuarioService($conexao);

// Dados do usuário a serem inseridos
$email = "aldeci@uece.br";
$senha = "mudar123"; // Senha em texto claro
$tipo = "professor"; // Tipo de usuário
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);


$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["success" => false, "error" => "Usuário já existe."]);
    exit();
}

// Inserir novo usuário no banco de dados
$sql_insert = "INSERT INTO usuarios (email, senha, tipo) VALUES (?, ?, ?)";
$stmt_insert = $conexao->prepare($sql_insert);
$stmt_insert->bind_param("sss", $email, $senha_criptografada, $tipo);

if ($stmt_insert->execute()) {
    echo json_encode(["success" => true, "message" => "Usuário criado com sucesso."]);
} else {
    echo json_encode(["success" => false, "error" => "Erro ao criar usuário."]);
}

$stmt_insert->close();
$stmt->close();
$conexao->close();
?>
