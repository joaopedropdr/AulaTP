<?php 
    require_once "Models/Conexao.class.php";
    require_once "Models/UsuarioDAO.class.php";
    require_once "Models/usuarios.class.php";
    require_once "config.php";
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
                                // Logado
                                if(!isset($_SESSION)) {
                                    session_start();
                                }
                                $_SESSION["nome"] = $retorno[0]->nome;
                                $_SESSION["id"] = $retorno[0]->id_usuario;
                                $_SESSION["email"] = $retorno[0]->email;
                                header("location:index.php");
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
            } 
            require_once "Views/form_usuario.php";
        }// Fim método inserir

        public function logout() {
            if(!isset($_SESSION)) {
                session_start();
            }
            $_SESSION = array();
            session_destroy();
            header("location:index.php");

        } // Fim método logout

        public function esqueceu_senha() {
            $msg = "";
            $link = "";
            $msg_email = "Será enviado um email para recuperar sua senha!";
            if($_POST) {
                if(empty($_POST['email'])) {
                    $msg = "Preencha o e-mail";
                } else {
                    // verificar se ele existe no banco
                    $usuario = new Usuarios(email:$_POST['email']);
                    $UsuarioDAO = new UsuarioDAO();
                    $retorno = $UsuarioDAO->verificar_email($usuario);
                    if(is_array($retorno)) {
                        if(count($retorno) > 0) {
                            // Enviar um email
                            $assunto = "Recuperação de senha - meu pet sumiu";
                            $link = "http://localhost/meu_pet_sumiu/index.php?controle=usuarioController&metodo=trocar_senha&id=" . base64_encode($retorno[0]->id_usuario);
                            $nomeDestino = $retorno[0]->nome;
                            $destino = $retorno[0]->email;
                            $remetente = "seu_email";
                            $nomeRemetente = "Meu pet sumiu";
                            $menssagem = "<h2>Senhor(a) " . $nomeDestino . "</h2><br><p>Recebemos a solicitação de recuperação de senha. 
                            Caso não tenha sido requerida por voce desconsidere essa mensagem.
                            Caso contrario click no link abaixo para informar a nova senha</p> 
                            <a href= '" . $link . "'>Clique aqui </a> <br><br> <p>atenciosamente <br>" . $nomeRemetente . "</p>";
                           /* $ret = sendMail($assunto, $mensagem, $remetente, $nomeRemetente, $destino, $nomeDestino);
                            if($ret) {
                                $msg_email = "Foi enviado um email de recuperção de senha. Verifique!!!";
                            } else {
                                $msg_email = "Problema no envio do email de recuperação! Tente mais tarde";
                            } */
                        } else {
                            $msg = "Verifique se o email está correto!";
                        }
                    } else {
                        $msg = "Verifique se o email está correto!";
                    }
                }
            }
            require_once "Views/form_email.php";
        } // Fim do método esqueceu senha

        public function trocar_senha() {
            if(isset($_GET["id"])) {
                $erro = false;
                $msg = array("", "");
                $id = base64_decode($_GET["id"]);
                if($_POST) {
                    if(empty($_POST["senha"])) {
                        $msg[0] = "Senha obrigatoria!";
                        $erro = true;  
                    }

                    if(empty($_POST["confirmar_senha"])) {
                        $msg[1] = "Preencha sua senha novamente!";
                        $erro = true;  
                    }

                    if(!$erro && $_POST["senha"] != $_POST["confirmar_senha"]) {
                        $msg[0] = "Senhas não são iguais";
                        $erro = true;
                    }
                    if(!$erro) {
                        // alterar senha no BD
                        $usuario = new Usuarios(id_usuario:$_POST["id_usuario"], senha:password_hash($_POST["senha"], PASSWORD_DEFAULT));
                        $UsuarioDAO = new UsuarioDAO();
                        $retorno = $UsuarioDAO->alterar_senha($usuario);
                        header("location:index.php?controle=usuarioController&metodo=login");
                    }
                }

                require_once "Views/trocar_senha.php";
            }
        } // fim do método trocar_senha
    } // Fim da classe
?>