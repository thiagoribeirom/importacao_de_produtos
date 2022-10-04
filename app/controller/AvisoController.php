<?php

namespace App\controller;


class AvisoController
{
    #criar variável com mesagem de erro para carregar para o usuário
    public static function acessar(string $mes)
    {
        session_start();
        $_SESSION['aviso'] = $mes;
        header("Location: /aviso");
    }

}