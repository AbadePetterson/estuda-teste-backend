# Teste para Dev PHP

### Dados

Há dois arquivos do tipo JSON na pasta `/src/data`, o primeiro é o houses.json que contém os dados das casas e o segundo `people.json` que contém os moradores das casas.


### Considerações

Vamos tratar os JSON como "tabelas" ou fonte de dados, então caso seja mencionado o termo tabela, entenda que se trata do arquivo json correspondente.

### O que deve ser feito?

- Criar a model House em src/Model/House.php
- Criar a model Person em src/Model/Person.php
- As models devem ter as seguintes funções:
  - all => Função deve retornar todos os registros da model. Deve ser um array de instâncias da model.
  - find => busca pelo ID e retornar uma instância da model
- Na model House, deve ter o método "people" que retornar um lista de Person ligados ao House.
- Na model Person, deve ter um método "house" que retorna a House associada.
- Deve ser possível resgatar os atributos da instância.
- O código deve ser coberto de testes unitários.
- Arquivo index que:
  - Pessoas (people)
    - Lista as pessoas
    - Busca uma pessoa
    - Busca a casa associada a pessoa
  - Casas (houses)
    - Lista as casas
    - Busca uma casa
    - Lista as pessoas associadas a casa

### Comandos

```
vendor/bin/phpunit # rodar phpunit
```
