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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="<?php echo VIEWS_URL; ?>css/main.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?php echo VIEWS_URL; ?>js/notify.js"></script>
    </head>
    <body>
        <div class="notify" id="notify" ></div>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">ProsperFlow</a>
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
        <main class="container containerII">
            <h1 class="text-center">User List</h1>
            <?php if (!empty($propects)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>WhatsApp</th>
                            <th>Facebook</th>
                            <th>Celular</th>
                            <th>Ações</th>
                            <!-- Add other columns as needed cod_prospect -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($propects as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['nome']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['whatsapp']); ?></td>
                                <td><?php echo htmlspecialchars($user['facebook']); ?></td>
                                <td><?php echo htmlspecialchars($user['celular']); ?></td>
                                <td>
                                    <div class="Action">
                                        <a class="fa-solid fa-pen-to-square" href="<?php echo VIEWS_URL; ?>prospect/edit_prospect.php?cod_prospect=<?php echo $user['cod_prospect']; ?>"></a>
                                        <a class="fa-solid fa-trash" href="<?php echo CONTROLLERS_URL; ?>delete_prospect.php?cod_prospect=<?php echo $user['cod_prospect']; ?>"></a>
                                    </div>
                                </td>
                                <!-- Add other columns as needed -->
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
                <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>
        </main>
        <script>
            <?php
                if (isset($_SESSION['messages'])) {
                    // Codifica as mensagens em JSON para passá-las ao JavaScript
                    $messages = json_encode($_SESSION['messages']);
                    // Limpa as mensagens da sessão
                    echo "let message = $messages;";
                    echo "addNotify(message[0].text,message[0].type);";
                    unset($_SESSION['messages']);
                } 
            ?>
        </script>
    </body>
</html>
