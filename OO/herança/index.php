<?php
    // O require da classe pai tem que estar primeiro do que as filhas!!!
    require_once "Pessoa.class.php";
    require_once "PFisica.class.php";
    require_once "PJuridica.class.php";

    $pessoaFisica = new PFisica("44433322252", "João Pedro", "14999888940", "Rua Anderson Silva, 95");

    echo "<pre>";
    var_dump($pessoaFisica);
    echo "</pre>";

    echo $pessoaFisica->inserir($pessoaFisica);
    
    $pessoaJuridica = new PJuridica("123.123.123/0001-52", "Lucas", "16666091832", "Rua Neymar Junior Pai");
    echo "<pre>";
    var_dump($pessoaJuridica);
    echo "</pre>";

    echo $pessoaJuridica->validarCNPJ($pessoaJuridica);

    $pessoa = new Pessoa("Maria", "999999999", "Rua tararar");
    ?>