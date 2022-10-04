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
  <h1>Produtos</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">EAN</th>
        <th scope="col">NOME DO PRODUTO</th>
        <th scope="col">PREÇO</th>
        <th scope="col">ESTOQUE</th>
        <th scope="col">DATA DE FABRICAÇÃO</th>
        <th scope="col">AÇÕES</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach($valores as $t):
          $data = date('d/m/Y', $t['datafabricacao'] != 0 ? strtotime($t['datafabricacao']) : " "); 
          $preco = number_format($t['preco'], 2, ',', '.');

          echo <<< _END
          <tr>
            <th scope='row'> $t[ean] </th>
            <td> $t[nomeproduto] </td>
            <td> R$ $preco</td>
            <td> $t[estoque] </td>
            <td>$data</td>
            <td>
              <button value = "$t[ean]"  class='btn btn-danger del' data-bs-toggle='modal' data-bs-target='#exampleModal'>Deletar</button>
            </td>
          </tr>
          _END;
        endforeach;
      ?>
      <tr>
    </tbody>
  </table>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deletar Produto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Tem certeza?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a href='' id="delmodal" class='btn btn-danger'>Confirmar</a></td>
        </div>
        <script>
            v = document.getElementsByClassName("del");
            console.log(v);
            function get(){
              
              link = "/deletar?eand="+ this.value +"";
              console.log(link);

              document.getElementById("delmodal").href = link;
            }

            for (var i = 0; i < v.length; i++) {
                v[i].addEventListener("click", get, false);
            }
          </script>
      </div>
    </div>
  </div>
</div>