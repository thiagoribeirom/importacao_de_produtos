<?php

namespace App\controller;

use Shuchkin\SimpleXLSX;
use App\model\Planilha;

class ProcessarArquivoController
{
    #gerar planilha para valição e cadastro
    public static function acessar($planilha)
    {
        session_start();
        if (!isset($_SESSION['logado'])) {
        header("Location: /login");
        exit();
        }
        
        $xls = SimpleXLSX::parseFile($planilha['tmp_name']);
        $planilha = $xls->rows();

        $p = new Planilha($planilha);
        
        $p->validacabecalho();
        $p->validaregistros();
        $p->cadastraregistros();
    }
}