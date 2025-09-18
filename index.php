<?php
// Ativa a exibição de erros para facilitar o desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui o autoload para carregar as classes automaticamente
include 'generic/Autoload.php';

use generic\Controller;

// Define uma rota padrão caso o parâmetro não seja passado
$rota = $_GET["param"] ?? 'Usuario/listar';

$controller = new Controller();
$controller->verificarChamadas($rota);

?>