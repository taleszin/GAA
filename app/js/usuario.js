function carregarUsuario(usuarioId) {
    var dados = { usuario_id: usuarioId };
    var jsonData = JSON.stringify(dados);

    $.ajax({
        url: '../classes/UsuarioService.php',
        type: 'POST',
        data: jsonData,
        contentType: 'application/json',
        success: function(response) {
            var usuario = JSON.parse(response);
            if (usuario) {
                $('#userName').text(usuario.nome);
                $('#userEmail').text(usuario.email);
                $('#userCurso').text(usuario.curso);
                $('#userTipo').text(usuario.tipo);
                renderizarGrafico(usuario.horas);
            } else {
                alert('Usuário não encontrado.');
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro ao carregar dados do usuário:", error);
        }
    });
}

function renderizarGrafico(horasComplementares) {
    const totalHoras = 160; 

    const chartData = [
        { label: "Horas Já Entregues", value: horasComplementares, color: "#1AFF80" },
        { label: "Horas faltantes", value: totalHoras - horasComplementares, color: "#BA0B0B" }
    ];

    const chartConfig = {
        type: 'pie2d',
        renderAt: 'chart-container',
        width: '500',
        height: '300',
        dataFormat: 'json',
        dataSource: {
            chart: {
                caption: "Distribuição das Horas Complementares",
                theme: "fusion",
                decimals: 0,
                pieRadius: "45%",
            },
            data: chartData
        }
    };

    FusionCharts.ready(function() {
        var fusionChart = new FusionCharts(chartConfig);
        fusionChart.render();
    });
}
$(document).ready(function() {
    const usuarioId = $('#id_usuario').val();
    carregarUsuario(usuarioId);
});
