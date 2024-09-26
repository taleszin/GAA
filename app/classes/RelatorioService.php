<?php
include("config.php");
include("LogService.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['id'])) {
        $ID = $_GET['id'];
        $sql_select = "SELECT * FROM money.gastos WHERE UserID = ?";
        $stmt_select = $conexao->prepare($sql_select);
        $stmt_select->bind_param("i", $ID);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $filename = 'relatorio.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'Descrição', 'Valor', 'Data'));
        while ($row = $result->fetch_assoc()) {
            $data = date('d/m/Y', strtotime($row['data']));
            fputcsv($output, array($row['id'], $row['descricao'], $row['valor'], $data));
        }
        fclose($output);
        exit();
    } else {
        $output = "deu ruim";
        echo json_encode($output, true);
    }
}
 ?>