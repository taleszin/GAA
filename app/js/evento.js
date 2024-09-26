
function criarEvento(usuarioId) {
    var titulo = $('#titulo').val();
    var descricao = $('#descricao').val();
    var dataEvento = $('#data_evento').val();
    var horaInicio = $('#hora_inicio').val();
    var duracao = $('#duracao').val();
    var local = $('#local').val();
    var vagas = $('#vagas').val();

    var dados = {
        titulo: titulo,
        descricao: descricao,
        data_evento: dataEvento,
        hora_inicio: horaInicio,
        horas_complementares: duracao,
        localizacao: local,
        vagas: vagas,
        usuario_id: usuarioId
    };

    var jsonData = JSON.stringify(dados);

    $.ajax({
        url: '../classes/EventoService.php',
        type: 'POST',
        data: jsonData,
        contentType: 'application/json',
        success: function(response) {
            var data = JSON.parse(response);
            if (data.success) {
                alert('Evento criado com sucesso!');
            } else {
                alert('Erro ao criar evento: ' + data.error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro NA CONEXAO", error);
        }
    });
}

function mostrarDetalhes(eventId) {
    var dados = { id_evento: eventId };
    var jsonData = JSON.stringify(dados);

    $.ajax({
        url: '../classes/EventoService.php',
        type: 'POST',
        data: jsonData,
        contentType: 'application/json',
        success: function(response) {
            var evento = JSON.parse(response);
            $('#eventDetailsModal .modal-body h3').text(evento.titulo);
            $('#eventDetailsModal .modal-body p:nth-child(2)').text(`Data: ${evento.data_evento} - ${evento.hora_inicio}`);
            $('#eventDetailsModal .modal-body p:nth-child(3)').text(`Vagas: ${evento.vagas}`);
            $('#eventDetailsModal img').attr('src', evento.imagem);
            $('#eventDetailsModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error("Erro ao carregar detalhes do evento:", error);
        }
    });
}
function registrarInscricao(eventId) {
        var idUser = $('#id_usuario').val();
        var dados = { id_evento: eventId, usuario_id: idUser };
        console.log(dados);
        var jsonData = JSON.stringify(dados);
        $.ajax({
            url: '../classes/InscritoService.php',
            type: 'POST',
            data: jsonData,
            contentType: 'application/json',
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                if (data.success) {
                    alert('Você se inscreveu com sucesso!');
                } else {
                    alert('Erro ao se inscrever: ' + data.error);
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro NA CONEXAO", error);
            }
        });
}
