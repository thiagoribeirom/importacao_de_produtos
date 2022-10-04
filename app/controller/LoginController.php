<?php

namespace App\controller;

use App\model\Usuario;

class LoginController
{
    public static function acessar(string $usuario, string $senha)
    {
        $usuario = new Usuario($usuario, $senha);

        if ($usuario->verificasenha() === true) {
            session_start();
            $_SESSION['logado'] = 1;
            header("Location: /");
        }else{
            session_start();
            $_SESSION['meslogin'] = 1;
            header("Location: /login");
        }
    }

    public static function finalizar()
    {
        session_start();
        session_destroy();
        header("Location: /login");
    }
}