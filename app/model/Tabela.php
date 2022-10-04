<?php

namespace App\model;
use App\config\Config;

class Tabela
{
    private array $registros;
    private Conpdo $pdoCon;

    public function __construct()
    {
        $this->pdoCon = new Conpdo(Config::USER,Config::SENHA,Config::HOST,Config::BANCO);
    }

    public function getRegistros(): array
    {
        $select = $this->pdoCon->con()->query("SELECT * FROM produtos");

        foreach ($select->fetchAll(\PDO::FETCH_ASSOC) as $l) {
            $this->registros[] = $l;
        }
        try {
            return $this->registros;
        } catch (\Throwable $th) {
            return $this->registros = [];
        }
        
    }

    public function deletarRegistros($ean)
    {
        $this->pdoCon->con()->prepare("DELETE FROM produtos WHERE ean = ?")->execute([$ean]);
    }
}