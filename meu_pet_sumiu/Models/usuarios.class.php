<?php
    class Usuarios {
        public function __construct(private int $id_usuario = 0, private string $nome = "",
        private string $email = "", private string $senha = "", private string $celular = "") {}
        
        public function getId_usuario() {
            return $this->id_usuario;   
        }

        public function getnome(){
            return $this->nome;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function getCelular(){
            return $this->celular;
        }

        public function setId_usuario($id_usuario){
            return $this->celular = $id_usuario;
        }

        public function setNome($nome){
            return $this->celular = $nome;
        }

        public function setSenha($senha){
            return $this->celular = $senha;
        }

        public function setCelular($celular){
            return $this->celular = $celular;
        }

    }
?>