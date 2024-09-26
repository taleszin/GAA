<?php
include("config.php");

// Função para inserir um novo registro de log
function gravaEntrada($email, $ID) {
    global $conexao; // Conexão com o banco de dados

    // Verifica se a conexão com o banco de dados está estabelecida
    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    // Prepara a consulta SQL para inserir o log na tabela logusuarios
    $sql = "INSERT INTO logusuarios (UserID, LoginDateTime, emailUsuario) VALUES (?, NOW(), ?)";
    $stmt = $conexao->prepare($sql);

    // Verifica se a preparação da consulta foi bem-sucedida
    if (!$stmt) {
        echo "Erro ao preparar a consulta: " . $conexao->error;
        return;
    }

    // Vincula os parâmetros e executa a consulta
    $stmt->bind_param("is", $ID, $email); // Aqui ajustamos para dois parâmetros, i.e., "is"
    $stmt->execute();
    $stmt->close();
}
function gravaRegistro($email, $ID) {
    global $conexao; // Conexão com o banco de dados

    // Verifica se a conexão com o banco de dados está estabelecida
    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    // Prepara a consulta SQL para inserir o log na tabela logusuarios
    $sql = "INSERT INTO logusuarios (UserID, LoginDateTime, emailUsuario) VALUES (?, NOW(), ?)";
    $stmt = $conexao->prepare($sql);

    // Verifica se a preparação da consulta foi bem-sucedida
    if (!$stmt) {
        echo "Erro ao preparar a consulta: " . $conexao->error;
        return;
    }

    // Vincula os parâmetros e executa a consulta
    $stmt->bind_param("is", $ID, $email); // Aqui ajustamos para dois parâmetros, i.e., "is"
    $stmt->execute();
    $stmt->close();
}
?>
