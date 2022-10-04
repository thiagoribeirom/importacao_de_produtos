<?php
if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['meslogin'])){
    echo "<script>alert('Email ou senha invalidos')</script>";
    $_SESSION['meslogin'] = 0;
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-7">
            <h3>Sistema de Importação de Produtos</h3>
            <p>Aplicação onde é possível importar dados de Planilha excel para um
              banco de dados relacional.
            </p>
            <p>
                Efetue o acesso através de suas credenciais.
            </p>
        </div>

        <div class="col-5">
            <form method="POST" action="/verificalogin">
                <div class="mb-3">
                    <label for="usuario" class="form-label"><strong>Nome de Usuário</strong></label>
                    <input type="text" class="form-control" id="usuario" name="user">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label"><strong>Senha</strong></label>
                    <input type="password" class="form-control" id="senha" name="pass">
                </div>
                <button type="submit" class="btn btn-primary">Logar</button>
            </form>
        </div>
    </div>
</div>
