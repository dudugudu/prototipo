<?php
session_start();
require_once  './config.php';


?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>Cadastra Usuário</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="<?php echo VIEWS_URL; ?>css/main.css" rel="stylesheet">
        <script src="<?php echo VIEWS_URL; ?>js/notify.js"></script>
    </head>
    <body>
        <div class="notify" id="notify" ></div>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">ProsperFlow</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                </div>
            </nav>
        </header>
        <main class="container containerI">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="img">
                        <img src="<?php echo IMG_URL; ?>customer.jpg" width="80">
                    </div>
                    <h1 class="text-center">Login</h1>
                    <form action="<?php echo CONTROLLERS_URL; ?>validar_login.php" method="POST">
                        <div class="mb-3">
                            <label for="user" class="form-label">User</label>
                            <input type="text" class="form-control" name="user">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha">
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                        <a href="<?php echo VIEWS_URL; ?>user/insert_user.php" class="btn btn-secondary">Cadastrar</a>
                    </form>
                </div>
            </div>
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
