# importacaoprodutos

## Requisitos
Desenvolver um pequeno sistema que importe dados de um excel (anexo) para uma tabela no banco de dados. A aplicação deverá ser composta pelas seguintes telas:

### Login
O usuário deve se autenticar com um e-mail e uma senha (salvos previamente no banco).

### Importação
Nesta tela o usuário deverá ser capaz de importar o arquivo excel, assim como visualizar os dados atuais presentes no banco de dados (no formato de tabela). Além disso o usuário deve poder excluir registros desta tabela, assim como fazer o logout da aplicação.

### Regras
Notas importantes sobre a importação do arquivo:
- Caso ocorra algum erro na hora de validação dos dados em qualquer linha do excel, nenhuma informação deve ser salva no banco de dados.
- A coluna que receberá o código “EAN” do produto não pode conter valores repetidos.
- Todas as colunas são de preenchimento obrigatório, exceto a coluna “DATA FABRICAÇÃO”.
- O cabeçalho do excel deve ser validado e deve conter a seguinte sequência de nomes (em letras maiúsculas): EAN, NOME PRODUTO, PREÇO, ESTOQUE e DATA FABRICAÇÃO.
- Caso o arquivo seja importado com sucesso, a tabela que exibe os dados para o usuário deve ser atualizada.
- Esta tela não poderá ser acessada se o usuário não estiver autenticado.
    

## Procedimentos para rodar a aplicação
- Importe o banco de dados, tabela, e usuário com senha 'argon2' que estão na pasta sql
- Crie um diretorio config em app com a seguinte class

```sh
<?php
namespace App\config;
class Config{
    const USER = "";
    const SENHA = "";
    const HOST = "127.0.0.1";
    const BANCO = "db_produtos";
}

```
- rode o comando:
```sh
composer dump-autoload
```

- Execute:
```sh
compser install
```

- Executar servidor PHP:
```sh
php -S localhost:8080 -t public
```
