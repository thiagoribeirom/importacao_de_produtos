<?php

namespace App\model;

Class Conpdo
{   
    private string $user;
    private string $pass;
    private string $host;
    private string $dbname;
    private \PDO $con;

    public function __construct($user, $pass, $host, $dbname)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->host = $host;
        $this->dbname = $dbname;
        $this->con = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        
    }

    public function con(): \PDO
    {
        return $this->con;
    }
}