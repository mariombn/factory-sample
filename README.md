# Implementação do Design Patterns de Factory no PHP 7.x

## Pré-requisitos

Você vai precisar apenas ter o docker e o docker compose instalado em sua maquina para usar esta aplicação.

Passo a passo para instalar o docker em distribuições baseadas no Ubuntu:

```
sudo apt-get update
sudo apt-get install docker.io -y
sudo apt-get install docker-compose -y
```

Depois de ter instalado o docker no ubuntu, o mesmo só irá funcionar com o comando `sudo` na frente, como por exemplo: `sudo docker ps -a`. Para resolver esse problema, você pode usar o seguinte comando:
```
sudo groupadd docker
sudo gpasswd -a $USER docker
```

## Rodando a aplicação

Para rodar a aplicação, agora, basta ir para a raiz do projeto no terminal e usar o comando abaixo:

```
docker-compose up -d
```

Aguarde e a aplicação deve começar a responder pelo endereço: http://0.0.0.0:8088/dashboard.php

## Criando estrutura do banco de dados.

Para criar as tabelas necessárias, você primeiro, precisa acessar o client do mysql com o comando:

```
docker-compose exec db mysql -u root -proot
```
Depois, basta copiar e colar o conteúdo do arquvio `migrations/apply.sql` no client do MySQL.

Também será necessário crair uma cópia do arquivo `config/config.ini-dist` para apenas `config/config.ini`. Você pode usar o comando abaixo para isso:

```
cp config/config.ini-dist config/config,ini
```

Nesse momento, a aplicação já está pronta e totalmente funcional

## Importando dados

Para importar os dados do arquivo `assets/import.csv`, você só precisar rodar o comando abaixo:
```
docker-compose exec php-fpm php import.php
```
