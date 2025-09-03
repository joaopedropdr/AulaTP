<?php
    require_once "Conta.php";
    require_once "Poupanca.php";
    require_once "Corrente.php";

    $corrente = new Corrente(1000, "123-456", "321-0", 5000);
    echo $corrente->getSaldo();
    echo "<br>";
    $corrente->retirar(500);
    echo "<br>";
    echo $corrente->getSaldo();
    echo "<br>";

    $poupanca = new Poupanca(2, "234-5", "543-2", 10000);
    echo $poupanca->getSaldo();
    echo "<br>";
    $poupanca->retirar(5000);
    echo "<br>";
    echo $poupanca->getSaldo();

?>