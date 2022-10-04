<?php
if(!isset($_SESSION)){
  session_start();
}

if (!isset($_SESSION['logado'])) {
  header("Location: /login");
  exit();
}
?>
<div class="container mt-5">
  <h1>Importar Produtos</h1>
  <form method="POST" action="/processararquivo" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Selecione a Planilha</label>
      <input type="file" class="form-control" id="arquivo" name="arquivo" accept=".xlsx" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
</div>