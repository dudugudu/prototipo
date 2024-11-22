<?php
session_start();
require_once  './config.php';

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
            .img img{
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
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                </div>
            </nav>
        </header>
        <!-- sistema de login do sistema com a opção de cadastrar de -->
        <main class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="img">
                        <img src="<?php echo IMG_URL; ?>customer.jpg" width="80">
                    </div>
                    <h1 class="text-center">Login</h1>
                    <form action="<?php echo CONTROLLERS_URL; ?>validar_login.php" method="POST">
                        <div class="mb-3">
                            <label for="user" class="form-label">User</label>
                            <input type="text" class="form-control" name="user" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                        <a href="<?php echo VIEWS_URL; ?>user/insert_user.php" class="btn btn-secondary">Cadastrar</a>
                    </form>
                    <p class="text-center text-danger">
                        <?php
                            if(isset($_SESSION['erroLogin'])){
                                echo $_SESSION['erroLogin'];
                                unset($_SESSION['erroLogin']);
                            }
                        ?>
                    </p>
                </div>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
