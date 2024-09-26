 <?php
 include("config.php");
class InscritoService {
    private $conexao;
    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    public function RegistrarInscrito($inscricao) {
        $sql = "INSERT INTO inscritos (usuario_id, evento_id, data_inscrito, presenca) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        
        if ($stmt === false) {
            die(json_encode("Erro no SQL: " . $this->conexao->error));
        }
        
        $data_inscrito = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        $data_inscrito = $data_inscrito->format("Y-m-d H:i:s");
        
        $usuario_id = $inscricao['usuario_id'];
        $evento_id = $inscricao['evento_id'];
        $presenca = $inscricao['presenca'];
    
        if (!$stmt->bind_param("iisi", 
            $usuario_id, 
            $evento_id, 
            $data_inscrito, 
            $presenca
        )) {
            die(json_encode("Erro no bind_param: " . $stmt->error));
        }
        
        if ($stmt->execute() === true) {
            return json_encode(["success" => true, "message" => "Inscrição realizada com sucesso."]);
        } else {
            return json_encode("Erro na execução do SQL: " . $stmt->error);
        }
    
        $stmt->close();
    }    
}
$inscritoService = new InscritoService($conexao);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_data = file_get_contents("php://input");
    $inscricao = json_decode($json_data, true);
    echo $inscritoService->registrarInscrito($inscricao);
}
?>