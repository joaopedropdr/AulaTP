<?php
    require __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;
    $dotenv = Dotenv:: createImmutable(__DIR__);
    $dotenv->load();
    $email_username = $_ENV["EMAIL_USERNAME"];
    $email_password = $_ENV["EMAIL_PASSWORD"];
    if($_GET) {
        // Outras rotas
        $controle = $_GET["controle"];
        $metodo = $_GET["metodo"];
        require_once "Controllers/$controle.class.php";
        $obj = new $controle(); 
        $obj->$metodo();
    } else {
        // Rota inicial
        require_once "Controllers/inicioController.class.php";
        // Criando o objeto
        $obj = new inicioController();
        // Chamando o método inicio 
        $obj->inicio();
    }

?>