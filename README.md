<p align="center">
  <a href="http://nestjs.com/" target="blank"><img src="http://maratona.fullcycle.com.br/public/img/logo-maratona.png"/></a>
</p>

## Descrição

Microsserviço de catálogo

## Rodar a aplicação

#### Crie os containers com Docker

```bash
$ docker-compose up
```

#### Accesse no browser

```
http://localhost:8000
```


## Executando testes

````bash
vendor/bin/phpunit
````

Executando os testes individualmente:
````bash
vendor/bin/phpunit --filter CategoryTest
````

Executando os testes em métodos individualemente:

````bash
vendor/bin/phpunit --filter CategoryTest::testExample
````

Executando os tests em classes especificas com o Namespaces
````bash
vendor/bin/phpunit --filter  'Tests\\Feature\\Models\\GenreTest'
````
