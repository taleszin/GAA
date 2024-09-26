
function gerarRelatorio() {

    var dados = {
    };

    var jsonData = JSON.stringify(dados);

    $.ajax({
        url: '../classes/RelatorioService.php',
        type: 'POST',
        contentType: 'application/json',
        data: jsonData,
        success: function(response) {
            console.log("Relatório gerado com sucesso.");
        },
        error: function(xhr, status, error) {
            console.error("Erro ao gerar relatório:", error);
        }
    });
}

