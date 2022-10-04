<?php

namespace App\model;

class Produto
{
    private string $ean;
    private string $nomeproduto;
    private float $preco;
    private int $estoque;
    private $data;

    public function __construct(string $ean, string $nomeproduto, float $preco, int $estoque, $data)
    {
        $this->ean = $ean;
        $this->nomeproduto = $nomeproduto;
        $this->preco = $preco;
        $this->estoque = $estoque;
        $this->data = $data;
    }

    public function validarean(): bool
    {   
        $ean = $this->ean;
        if (strlen($ean) and !preg_match('/\D/', $ean)) {
            $this->ean = str_pad(strval($ean), 6, "0", STR_PAD_LEFT);
            return true;
        }else{
            return false;
        }
    }

    public function validardata(): bool
    {   
        $data = $this->data;
        $arrdata = explode('-', $data);
        if (checkdate($arrdata[1], $arrdata[2], $arrdata[0])) {
            return true;
        }else{
            return false;
        }
    }

    public function getEan(){
        return $this->ean;
    }

    public function getNome(){
        return $this->nomeproduto;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function getEstoque(){
        return $this->estoque;
    }

    public function getData(){
        if(strlen($this->data) == 0){
            $this->data = null;
        }
        return $this->data;
    }
    public function __toString(){
        return "$this->ean - $this->nomeproduto - $this->preco - $this->estoque - $this->data";
    }
}