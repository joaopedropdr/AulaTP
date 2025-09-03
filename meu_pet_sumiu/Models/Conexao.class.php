<?php
    abstract class Conexao {
        public function __construct(protected $db = null) {
            $parametros = "mysql:host=localhost;dbname=meu_pet_sumiu;charset=utf8mb4";
            // o try vai tentar instanciar o objeto, se não funcionar ele vai para o catch
            try {
                $this->db = new PDO($parametros, "root", "");
            } catch(PDOException $e) {
                echo $e->getMessage();
                echo $e->getCode();
                // O die interrompe o processo
                die("Problema na conexão");
            }

        }
    }
?>