<?php 
    require_once "Models/usuarios.class.php";
    class usuarioController {
        public function login() {
            // Require para o Views no formulario de login
            if($_POST) {
                // Verificar os dados
                // Verificar no banco de dados se o usuario existe
            }
        }

        public function inserir(){
            $msg = array("", "", "", "");
            $erro = false;
            if($_POST) {
                // empty é uma propriedade do PHP onde mostra se algo não foi preenchido
                if(empty($_POST["nome"])) {
                    $msg[0] = "Preencha o nome";
                    $erro = true;
                }

                if(empty($_POST["email"])) {
                    $msg[1] = "Preencha o email";
                    $erro = true;
                } else {
                    // Verificar se já não tem um usuário com esse email cadastrado
                    $usuario = new Usuarios(email: $_POST["email"]);
                }

                if(empty($_POST["senha"])) {
                    $msg[2] = "Preencha a senha";
                    $erro = true;
                }

                if(empty($_POST["celular"])) {
                    $msg[3] = "Preencha o celular";
                    $erro = true;
                }

                if(!$erro) {
                    // o que esta dentro dos [] tem que ser igula o que esta no name do form
                    $usuario = new Usuarios(0, $_POST["nome"], $_POST["email"],
                     $_POST["senha"], $_POST["celular"]);
                    // Cadastrar no banco de dados
                }
            } 

            require_once "Views/form_usuario.php";
        }
    } // Fim da classe
?>