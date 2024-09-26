<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Atividades Acadêmicas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/comum.css">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<header class="d-flex justify-content-between align-items-center">
    <div>
        <img src="../docs/img/ueceLogo.png" alt="Logo">
        <h1>Gerenciador de Atividades Acadêmicas</h1>
    </div>
    <div class="dropdown">
        <button class="btn profile-icon" type="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="perfil.php">Perfil</a>
            <a class="dropdown-item" href="presencas.php">Meus Eventos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Sair</a>
        </div>
    </div>
</header>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
