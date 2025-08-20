<?php
    // include "usario.class.php";
    // include_once "usuario.class.php";
    // require "usuario.class.php";
    require_once "usuario.class.php";

    // Criando um objeto
    // Não é possivel usar o comando echo para mostrar um objeto
    $usuario1 = new Usuario("Maria",
    "maria@gmail.com",
    "m123");

    $usuario2 = new Usuario("",
    "lucas@gmail.com",
    "l123");

    $usuario3 = new Usuario(senha:"m123", email:"joao@gmail.com");


    /* echo "<pre>";
    var_dump($usuario3);
    echo "</pre>";*/

    echo "Nome: {$usuario1->getNome()}<br>";
    echo "E-Mail: {$usuario1->getEmail()}<br>";
    echo "Senha: {$usuario1->getSenha()}<br>";

    // Modificando objeto
    $usuario1->setNome("Maria da Silva");
    echo "Nome: {$usuario1->getNome()}<br>";
?>
