<?php
    # Uma final class é uma classe que não pode ter filhas
    final class PFisica extends Pessoa {
        // Passando os atributos da classe pai para a filha
        public function __construct(private string $cpf = "", string $nome = "", string $celular = "",
        string $endereco = "") {
            // Chamando o construtor da classe pai
            parent:: __construct($nome, $celular, $endereco);
        }

        public function getCPF() {
            return $this->cpf;
        }

        public function setCPF($cpf)  {
            $this->cpf = $cpf;
        }

        public function validarCPF($Pessoa) {
            echo "Validar";
        }
    }
?>