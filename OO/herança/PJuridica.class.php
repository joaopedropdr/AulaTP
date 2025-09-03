<?php
    class PJuridica extends Pessoa {
        public function __construct(private string $cnpj = "", string $nome = "", string $celular = "",
        string $endereco = "") {
            parent:: __construct($nome, $celular, $endereco);
        }
    
        public function getCNPJ() {
            return $this->cnpj;
        }
    
        public function setCNPJ($cnpj)  {
            $this->cnpj = $cnpj;
        }
    
        public function validarCNPJ($Pessoa) {
            echo "Validar";
        }
    }
?>