<?php
session_start(); // Inicia a sessão
require_once __DIR__ . '/../../../config.php';
require_once (SRC . 'Controllers/Propects/ControllerPropect.php'); // Inclui a classe ControllerProspects

use Controllers\ControllerPropect;

$propects = new ControllerPropect(); // Cria uma instância de ControllerPropect
if(isset($_GET['cod_prospect'])){
    
    try{
        $prospect = $propects->buscarPropect($_GET['cod_prospect']); // Lista os usuários cadastrados
    }catch(\Exception $e){
        $_SESSION['error'] = $e->getMessage(); // Atribui a mensagem de erro à variável de sessão
    }
}
    

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ProsperFlow</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- CSS only -->
        <link href="<?php echo VIEWS_URL; ?>css/main.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">ProsperFlow</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </header>
        <!-- Sistema de cadastro do sistema -->
        <main class="container containerIII">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="img">
                        <img src="<?php echo IMG_URL; ?>adduser.webp" alt="Adicionar Usuário">
                    </div>
                    <h1 class="text-center">Editar Cadastro de propects</h1>
                    <form action="<?php echo CONTROLLERS_URL; ?>crud_propect.php" method="POST">
                        <div class="mb-3">
                            <label for="cod" class="form-label">Codigo Propect</label>
                            <input type="text" class="form-control" name="cod" value="<?php echo $prospect['cod_prospect']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $prospect['nome']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control"  name="email" value="<?php echo $prospect['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Celular</label>
                            <input type="text" class="form-control"  name="cellphone" value="<?php echo $prospect['celular']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Whatsapp</label>
                            <input type="text" class="form-control"  name="whatsapp" value="<?php echo $prospect['whatsapp']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" class="form-control"  name="facebook" value="<?php echo $prospect['facebook']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <a href="<?php echo ROOT_URL; ?>index.php" class="btn btn-secondary">Voltar</a>
                    </form>
                    <p class="text-center text-danger" >
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
                    </p>
                </div>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
