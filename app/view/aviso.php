<?php
session_start();
if ($_SESSION['aviso'] == null) {
  header("Location: /");
  exit();
}
?>
<div class="container mt-5">
    <div class="alert alert-danger" role="alert">
        <?php
            echo $_SESSION['aviso'];
            $_SESSION['aviso'] = null;
        ?>
    </div>
    <a href="/importar" class="btn btn-light">Tente Novamente</a>
</div>
