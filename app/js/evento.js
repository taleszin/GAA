
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


function inscreverUsuario() {
    var modalHtml = `
        <div class="modal fade" id="inscricaoModal" tabindex="-1" role="dialog" aria-labelledby="inscricaoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inscricaoModalLabel">Confirmação de Inscrição</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Você realmente deseja se inscrever neste evento?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="confirmarInscricao">Sim, inscrever-me</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    $('body').append(modalHtml);
    $('#inscricaoModal').modal('show');

    $('#confirmarInscricao').on('click', function() {
        alert("Usuário inscrito com sucesso!");
        $('#inscricaoModal').modal('hide');
        $('#inscricaoModal').on('hidden.bs.modal', function () {
            $(this).remove();
        });
    });
}


