<?php

namespace App\model;
use App\config\Config;
class Usuario
{
    private string $usuario;
    private string $senha;
    private Conpdo $pdoCon;

    function __construct(string $usuario, string $senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->pdoCon = new Conpdo(Config::USER,Config::SENHA,Config::HOST,Config::BANCO);
    }

    public function verificasenha(): bool
    {
        $user = $this->pdoCon->con()
        ->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $user->execute([$this->usuario]);

        foreach ($user->fetchAll(\PDO::FETCH_COLUMN,2) as $hash) {
            if (password_verify($this->senha, $hash)) {
                return true;
            }
        }
        return false;
    }
}