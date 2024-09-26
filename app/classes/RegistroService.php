<?php
// Inclui o arquivo de configuração do banco de dados
include("config.php");
include("LogService.php");
// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados JSON enviados pelo JavaScript
    $json_data = file_get_contents("php://input");

    $usuario = json_decode($json_data, true);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

    // Prepara a declaração
    $stmt = $conexao->prepare($sql);

    // Verifica se houve algum erro na preparação da declaração
    if ($stmt === false) {
        die("Erro na preparação da declaração SQL: " . $conexao->error);
    }

    // Hash da senha fornecida pelo usuário
    $senha_hash = password_hash($usuario['senha'], PASSWORD_DEFAULT);

    // Vincula os parâmetros da declaração SQL
    $stmt->bind_param("sss", $usuario['nome'], $usuario['email'], $senha_hash);

    // Executa a declaração
    if ($stmt->execute() === true) {
        // Se a execução for bem-sucedida, envia uma resposta de sucesso
        echo "Usuário registrado com sucesso.";
    } else {
        
    }

    // Fecha a declaração
    $stmt->close();
}
?>
