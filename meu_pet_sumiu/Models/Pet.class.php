<?php
    class Pet {
        public function __construct(private int $id_pet = 0, private string $nome = "", 
        private string $idade = "", private string $raca = "", private string $porte = "", 
        private string $local = "", private string $data = "", private string $imagem = "",
        private string $cor_olhos = "", private string $cor = "", private string $obs = "", 
        private string $situacao = "", private Usuarios $usuario = new Usuario()) {} 

        public function getId_pet() {
            return $this->id_pet;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getIdade() {
            return $this->idade;
        }

        public function getRaca() {
            return $this->raca;
        }

        public function getPorte() {
            return $this->porte;
        }

        public function getLocal() {
            return $this->local;
        }

        public function getData() {
            return $this->data;
        }

        public function getImagem() {
            return $this->imagem;
        }

        public function getCor_olhos() {
            return $this->cor_olhos;
        }

        public function getCor() {
            return $this->cor;
        }

        public function getObs() {
            return $this->obs;
        }

        public function getSituacao() {
            return $this->situacao;
        }

        public function getUsuario() {
            return $this->usuario;
        }

        
    }   
?>