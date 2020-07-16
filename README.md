<p align="center"><img src="https://res.cloudinary.com/dozt2izvj/image/upload/v1594875744/logo-lib-comp-orange_ttkmpy.png" width="400"></p>

Este repositório será utilizado para salvar os arquivos do projeto do ***Sistema da Biblioteca ETE-AVS*** que servirá para auxiliar os bibliotecários na administração de livros, leitores e empréstimos e facilitar o acesso dos livros aos leitores.

**Pré-requisitos:**
- XAMPP (Para iniciar os servidores MySQL e Apache)
- PHP (Configurado com variável Path)
- MySQL Front (Opcional)
- Node.js ou Yarn (Para manuseamento dos pacotes JavaScript)
- Composer (Para manuseamento dos pacotes PHP)

## Sobre o Projeto

Neste projeto, utilizaremos no Backend o Framework PHP **Laravel** como API e **Vue JS** SPA no Frontend.

**SPA**:

>Um SPA (Single Page Application ou Aplicação de Página Única) é uma aplicação web ou site que consiste de uma única página web com o objetivo de fornecer uma experiência do usuário similar à de um aplicativo desktop.

**API**:
>API é um conjunto de rotinas e padrões de programação para acesso a um aplicativo de software ou plataforma baseado na Web. A sigla API refere-se ao termo em inglês "Application Programming Interface" que significa em tradução para o português "Interface de Programação de Aplicativos".

## Começando

Neste tópico você irá encontrar as instruções para iniciar o projeto da maneira correta.

Primeiro clone este projeto usando os seguintes comandos:

```
git clone https://github.com/Gustavo-HMB/biblioteca.git
cd biblioteca
```

### Configurando Backend

Entre no diretório do Backend da aplicação com `cd biblioteca`.

Crie o banco de dados com o seguinte comando:

```mysql
CREATE DATABASE biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Agora instale as dependências do Laravel, execute as migrações e inicie o servidor:

```
composer install
php artisan migrate
php artisan serve
```
Com isso você podera acessar a API pela rota/link [http://127.0.0.1:8000/api/](http://127.0.0.1:8000/api/).

### Configurando Frontend

Entre no diretório do Frontend da aplicação com `cd biblioteca-client-vue`.

Agora vamos instalar as dependências do Vue e iniciar o servidor :

```
npm install
npm run serve
```
ou
```
yarn install
yarn run serve
```

Finalmente, você poderá acessar o site pela rota/link [https://127.0.0.1:8080](https://127.0.0.1:8080).