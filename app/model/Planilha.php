<?php

namespace App\model;
use App\config\Config;
use App\controller\AvisoController;

class Planilha{

    private array $planilha;
    private $cabecalhos = ['EAN', 'NOME PRODUTO', 'PREÇO', 'ESTOQUE', 'DATA FABRICAÇÃO'];

    function __construct(array $planilha)
    {
        $this->planilha = $planilha;
    }

    /*=================================================================================*/
    #Função callback para validar valores do cabeçalho
    public function compara($a = null,$b = null)
    {
        if ($a===$b){
        return 0;
        }
        return ($a!=$b)?1:-1;
    }
    
    /*=================================================================================*/
    public function validacabecalho()
    {
        $cabecalhoplanilha = $this->planilha[0];
        $valores = array_slice($cabecalhoplanilha, 0, 5);
        $result = array_udiff($valores, $this->cabecalhos, array($this, 'compara'));
        if(count($result) >= 1){
            $mes = "planilha errada: Verifique os cabeçalhos";
            AvisoController::acessar($mes);
            exit();
        }
    }

    /*=================================================================================*/
    public function validaregistros()
    {
        $numregistro = count($this->planilha);
        $chaves = [];

        echo "<pre>";
        for ($i=1; $i < $numregistro; $i++) { 
            $ean = strval($this->planilha[$i][0]);
            $nomeproduto = $this->planilha[$i][1];
            $data = substr($this->planilha[$i][4],0 ,10);
            $linha = $i + 1;
            $chaves[] = $ean;

            if (strlen($nomeproduto) == 0 or $nomeproduto == " ") {
                $mes = "erro no campo NOME PRODUTO | linha da planilha com erro: $linha";
                AvisoController::acessar($mes);
                exit();
            }

            if(!is_string($this->planilha[$i][2])){
                $preco = $this->planilha[$i][2];
            }else{
                $mes = "Erro na linha: $linha da planilha | Verifique campo PREÇO";
                AvisoController::acessar($mes);
                exit();
            }

            if(!is_string($this->planilha[$i][3])){
                $estoque = $this->planilha[$i][3];
            }else{
                $mes = "Erro na linha: $linha da planilha | Verifique campo ESTOQUE";
                AvisoController::acessar($mes);
                exit();
            }

            try {
                $produto = new Produto($ean, $nomeproduto, $preco, $estoque, $data);
            } catch (\Throwable $th) {
                $mes = "Erro na linha: $linha da planilha | Verifique se digitou todos os dados corretamente";
                AvisoController::acessar($mes);
                exit();
            }
            
            if ($produto->validarean() == false) {
                $mes = "erro no campo EAN, verifique o padão do código | linha da planilha com erro: $linha";
                AvisoController::acessar($mes);
                exit();
            }

            if (strlen($data) > 0 and $produto->validardata() == false) {
                $mes = "erro no campo DATA DE FRABRICAÇÃO | linha da planilha com erro: $linha";
                AvisoController::acessar($mes);
                exit();
            }
        }
        
        $copia = array_unique($chaves);
        if ($chaves !== $copia) {
            $mes =  "Existem códigos EAN duplicados na planilha";
            AvisoController::acessar($mes);
            exit();
        }
    }

    /*=================================================================================*/
    public function cadastraregistros()
    {
        $numregistro = count($this->planilha);
        try {
            $pdoCon = new Conpdo(Config::USER,Config::SENHA,Config::HOST,Config::BANCO);
        } catch (\Throwable $th) {
            echo $th;
            exit();
        }
        
        for ($i=1; $i < $numregistro; $i++) { 
            $ean = str_pad(strval(strval($this->planilha[$i][0])), 6, "0", STR_PAD_LEFT);;
            $nomeproduto = $this->planilha[$i][1];
            $data = substr($this->planilha[$i][4],0 ,10);
            $preco = $this->planilha[$i][2];
            $estoque = $this->planilha[$i][3];

            $produto = new Produto($ean, $nomeproduto, $preco, $estoque, $data);
            try {
                $seexiste = $pdoCon->con()
                ->prepare("SELECT * FROM produtos WHERE ean = ?");
                $seexiste->execute([$produto->getEan()]);
        
                foreach ($seexiste->fetchAll(\PDO::FETCH_COLUMN,0) as $pk) {
                    if ($pk === $produto->getEan()) {
                        $atualizar = $pdoCon->con()
                        ->prepare("UPDATE produtos SET nomeproduto = ?,preco = ?,estoque = ?,datafabricacao = ? WHERE ean = ?");
                        $atualizar->execute([$produto->getNome(), $produto->getPreco(), $produto->getEstoque(), $produto->getData(), $produto->getEan()]);
                    }
                }

                $registro = $pdoCon->con()->prepare("INSERT INTO produtos values(?,?,?,?,?)");
                $registro->execute([$produto->getEan(), $produto->getNome(), $produto->getPreco(), $produto->getEstoque(), $produto->getData()]);

            } catch (\Throwable $th) {
                echo $th;
            }
        }
        header("Location: /");
    }

}