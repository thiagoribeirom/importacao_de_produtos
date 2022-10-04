<?php
  require '../vendor/autoload.php';
  use App\controller\Rotas;


  if (isset($_SERVER['PATH_INFO'])) {
    $rota = $_SERVER['PATH_INFO'];
  }

  if (!isset($_SERVER['PATH_INFO'])) {
    $rota = "/";
  }
?>
<?php require_once "../app/view/layout/topo.php"; ?>

<?php Rotas::acessar($rota); ?>

<?php require_once "../app/view/layout/rodape.php"; ?>