<?php
session_start(); // Inicia a sessão
require_once __DIR__ . '/../../config.php';

require_once (SRC . 'Controllers/Propects/ControllerPropect.php'); // Inclui a classe ControllerProspects

use Controllers\ControllerPropect;

$users = new ControllerPropect(); // Cria uma instância de ControllerPropect



try{
    $propects = $users->listarPropects(); // Lista os usuários cadastrados
}catch(\Exception $e){
    $_SESSION['error'] = $e->getMessage(); // Atribui a mensagem de erro à variável de sessão
}

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastra Usuário</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- CSS only -->
        <style>
            header {
                height: 56px;
            }
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: calc(100vh - 56px);
            }
            .container .row {
                width: 100%;
                height: 400px;
            }
            .img img {
                width: 100px;
                margin: 10px calc(50% - 50px);
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">ProsperFlow</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            
                        </ul>
                        <form class="d-flex" role="search">
                            <a  href="<?php echo VIEWS_URL; ?>prospect/insert_prospect.php" class="btn btn-outline-success" type="submit">Incluir Prospect</a>
                        </form>
                    </div>
                   
                    <!-- Fim da adição -->
                </div>
            </nav>
        </header>
        <!-- sistema de login do sistema com a opção de cadastrar de -->
        <main class="container">
            <h1 class="text-center">User List</h1>
            <?php if (!empty($propects)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <!-- Add other columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($propects as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['cod_prospect']); ?></td>
                                <td><?php echo htmlspecialchars($user['nome']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <!-- Add other columns as needed -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
