<?php 
    require_once "Models/Conexao.class.php";
    require_once "Models/UsuarioDAO.class.php";
    require_once "Models/usuarios.class.php";
    class usuarioController {
        public function login() {
            $msg = array("", "", "");
            $erro = false;
            if($_POST) {
                if(empty($_POST["email"])) {
                    $msg[0] = "Preencha o email";
                    $erro = true; 
                }

                if(empty($_POST["senha"])) {
                    $msg[1] = "Preencha a senha";
                    $erro = true; 
                }

                if(!$erro) {
                    $usuario = new Usuarios(email:$_POST["email"]); 
                    $UsuarioDAO = new UsuarioDAO();
                    $retorno = $UsuarioDAO->login($usuario);
                    if(is_array($retorno)) {
                        if(count($retorno) > 0) {
                            // Verifica se a senha corresponde
                            if(password_verify($_POST["senha"], $retorno[0]->senha)) {
                                // Logar
                                $msg[2] = "Login com sucesso";
                            } else {
                                $msg[2] = "Email ou senha inválido!!!";
                            }
                        } else {
                            $msg[2] = "Email ou senha inválido!!!";
                        }
                    }
                }
            }
            // Require para o Views no formulario de login
            require_once "Views/login.php";
        } // Fim método login

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
                    $UsuarioDAO = new UsuarioDAO();
                    $retorno = $UsuarioDAO->verificar_email($usuario);
                    if(is_array($retorno)) {
                        if(count($retorno) > 0) {
                            $msg[1] = "Esse email já está cadastrado!!!";
                            $erro = true;
                        }
                    }
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
                    password_hash($_POST["senha"], PASSWORD_DEFAULT), $_POST["celular"]);
                    // Cadastrar no banco de dados
                    $UsuarioDAO = new UsuarioDAO();
                    $retorno = $UsuarioDAO->inserir($usuario);
                }
            } // Fim método inserir

            require_once "Views/form_usuario.php";
        }
    } // Fim da classe
?>