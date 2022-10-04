<?php

namespace App\controller;

use App\model\Tabela;

class TabelaController
{
    public static function acessar()
    {
        $t = new Tabela();
        $valores = $t->getRegistros();
        include "../app/view/tabela.php";
    }

    public static function deletar($ean)
    {
        if (!isset($_SESSION['logado'])) {
            header("Location: /login");
            exit();
          }
        $t = new Tabela();
        $t->deletarRegistros($ean);
        header("Location: /");
    }
}