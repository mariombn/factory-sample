# Teste WEBJUMP

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

# Readme original:

# Você quer ser um desenvolvedor Backend na Web Jump?
Criamos esse teste para avaliar seus conhecimentos e habilidades como desenvolvedor backend.

# O teste
O desafio é desenvolver um sistema de gerenciamento de produtos. Esse sistema será composto de um cadastro de produtos e categorias. Os requisitos desse sistema estão listados nos tópicos abaixo.
Não existe certo ou errado, queremos saber como você se sai em situações reais como esse desafio.

# Instruções
- O foco principal do nosso teste é o backend. Para facilitar você poderá utilizar os arquivos html  disponíveis no diretório assets
- Crie essa aplicação como se fosse uma aplicação real, que seria utilizada pelo WebJump
- Não utilize nenhum Framework. 
- Fique à vontade para usar bibliotecas/componentes externos
- Seguir princípios **SOLID** 
- Utilize boas práticas de programação
- Utilize boas práticas de git
- Documentar como rodar o projeto
- Crie uma documentação simples comentando sobre as tecnologias, versões e soluções adotadas

# Requisitos
- O sistema deverá ser desenvolvido utilizando a linguagem PHP (de preferência a versão mais nova) ou outra linguagem se assim foi especificado para sua avaliação por nossa equipe.
- Você deve criar um CRUD que permita cadastrar as seguintes informações:
	- **Produto**: Nome, SKU (Código), preço, descrição, quantidade e categoria (cada produto pode conter uma ou mais categorias)
	- **Categoria**: Código e nome.
- Salvar as informações necessárias em um banco de dados (relacional ou não), de sua escolha
- Criar um importador de produtos/categorias via CLI no formato  de CSV. Importar o arquivo disponibilizado no repositório (assets/import.csv).
- Gerar logs das ações (diferencial)
- Testes automatizados com informação da cobertura de testes (diferencial)
- Como um desafio adicional você pode implementar o upload de imagem no cadastro de produtos

# O que será avaliado
- Estrutura e organização do código e dos arquivos
- Soluções adotadas
- Tecnologias utilizadas
- Qualidade
- Padrões PSR, Design Patterns
- Enfim, tudo será observado e levado em conta

# Como iniciar o desenvolvimento
- Fork esse repositório na sua conta do BitBucket.
- Crie uma branch com o nome desafio

# Como enviar seu teste
Envie um email para [carreira@webjump.com.br] com o link do seu repositório

Qualquer dúvida sobre o teste, fique a vontade para entrar em contato conosco.
