<?php

require_once("./DAO/DAOUser.php"); // ajuste o caminho conforme necessário
require_once("./models/User.php");

use DAO\DAOUser;

// Captura os dados de login e senha
$login = $_POST['login'] ?? null; // substitua por dados do formulário
$senha = $_POST['senha'] ?? null;

if ($login && $senha) {
    $daoUsuario = new DAOUser();
    $user = $daoUsuario->logar($login, $senha);
    
    if ($user->status) {
        echo "Usuário logado com sucesso! <br>";
        echo "Login: " . $user->login . "<br>";
        echo "Nome: " . $user->nome . "<br>";
        echo "Email: " . $user->email . "<br>";
        echo "Celular: " . $user->celular . "<br>";
    } else {
        echo "Login ou senha incorretos!";
    }
} else {
    echo "Por favor, insira seu login e senha.";
}

?>
