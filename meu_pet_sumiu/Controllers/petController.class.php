<?php 
    class petController {
        public function listar() {
            // Buscar os dados de produtos no banco de dados
            // Fazendo uma conexão com o BD
            $parametros = "mysql:host=localhost;dbname=meupetsumiu;charset=utf8mb4";
            $conn = new PDO($parametros, "root", "");
            // Buscar os dados
            $sql = "SELECT * FROM produtos"; 
            // O prepare evita injeção SQL
            $stm = $conn->prepare($sql);
            $stm->execute();
            $conn = null;
            $resultado = $stm->fetchALL(PDO::FETCH_OBJ);

            /*echo "<pre>";
            var_dump($resultado);
            echo "</pre>";*/

            // Mostrar um view com os produtos
            require_once "Views/listaProdutos.php";
        }

    }
?>