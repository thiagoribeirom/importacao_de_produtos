<?php

namespace App\controller;

class Rotas
{
    public static function acessar(string $rota)
    {
        switch ($rota) {
            case '/':
                TabelaController::acessar();
                break;
        
            case '/login':
                include "../app/view/formlogin.php";
                break;

            case '/importar':
                include "../app/view/importar.php";
                break;

            case '/verificalogin':
                LoginController::acessar($_POST['user'], $_POST['pass']);
                break;

            case '/processararquivo':
                $planilha = $_FILES['arquivo'];
                ProcessarArquivoController::acessar($planilha);
                break;

            case '/sair':
                LoginController::finalizar();
                break;

            case '/deletar':
                TabelaController::deletar($_GET['eand']);
                break;

            case '/aviso':
                include "../app/view/aviso.php";
                break;
            default:
                echo "404";
                break;
        }
    }
}