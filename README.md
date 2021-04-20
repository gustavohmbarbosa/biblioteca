<p align="center"><img src="https://res.cloudinary.com/dozt2izvj/image/upload/v1595030984/logo-lib-comp-blue_lpahno.png" width="400"></p>

<p align="center">
    🚧 ... Em Construção ... 🚧
</p>

<p align="center">
    <img alt="GitHub Language Count" src="https://img.shields.io/github/languages/count/Gustavo-HMB/biblioteca" />
    <img alt="GitHub Repository Size" src="https://img.shields.io/github/repo-size/Gustavo-HMB/biblioteca" />
    <img alt="GitHub Contributors" src="https://img.shields.io/github/contributors/Gustavo-HMB/biblioteca" />
    <img alt="GitHub Last Commit" src="https://img.shields.io/github/last-commit/Gustavo-HMB/biblioteca" />
    <img alt="GitHub License" src="https://img.shields.io/github/license/Gustavo-HMB/biblioteca">
    <img alt="GitHub Stars" src="https://img.shields.io/github/stars/Gustavo-HMB/biblioteca?style=social">
</p>

## 💻 Sobre o Projeto

**:books: Sistema da Biblioteca ETE-AVS:** é um sistema que auxilirá os bibliotecários na administração de livros, leitores e empréstimos e facilitar o acesso dos livros aos leitores.

**SPA**:

>Um SPA (Single Page Application ou Aplicação de Página Única) é uma aplicação web ou site que consiste de uma única página web com o objetivo de fornecer uma experiência do usuário similar à de um aplicativo desktop.

**API**:
> É um acrônimo de Application Programming Interface (Interface de Programação de  Aplicações). É basicamente um conjunto de rotinas e padrões estabelecidos por uma aplicação, para que outras aplicações possam utilizar as funcionalidades desta aplicação, servindo como intermediador para o acesso a informações.

## :atom: Tecnologias

- **[Laravel](https://laravel.com/)** (Framework **PHP**)
- **[VueJS](https://vuejs.org/)** (Framework **JavaScript**)

## 🛠 Ferramentas

- **[XAMPP](https://www.apachefriends.org/pt_br/index.html)** (Servidores **MySQL** e **PHP**)
- **[MySQL Front](https://mysql-front.software.informer.com/6.0/)** (SGBD)
- **[Node.js](https://nodejs.org/)** ou **[Yarn](https://classic.yarnpkg.com/pt-BR/docs/install/#windows-stable)** (Para manuseamento dos pacotes JavaScript)
- **[Composer](https://getcomposer.org/doc/00-intro.md)** (Para manuseamento dos pacotes PHP)

## 🚀 Começando

Neste tópico você irá encontrar as instruções para iniciar o projeto da maneira correta.

Primeiro clone este projeto usando os seguintes comandos no Terminal:

```bash
# Clone este repositório
$ git clone https://github.com/Gustavo-HMB/biblioteca.git
```

### 🎲 Configurando Backend

Crie o banco de dados com o seguinte comando:

```mysql
CREATE DATABASE biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Copie ou renomeie o arquivo .env.exemple para .env.

Coloque os detalhes do banco de dados no .env:

```
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=
```

Agora instale as dependências do Laravel, gere uma chave no .env para a criptografia `Illuminate`, gere uma chave JWT, execute as migrações e inicie o servidor:

```bash
# instalando as dependências
$ composer install

# Gerando a chave de criptografia
$ php artisan key:generate

# Gerando a chave JWT
$ php artisan jwt:secret

# Executando as migrações
$ php artisan migrate --seed

# Iniciando o servidor
$ php artisan serve
```

Com isso você podera acessar a API pela rota/link: **([http://127.0.0.1:8000/api/](http://127.0.0.1:8000/api/))**

### 🧭 Configurando Frontend

Entre no diretório do Frontend da aplicação com `cd web`.

Agora vamos instalar as dependências do Vue e iniciar o servidor:

```bash

# Instalando as dependências
$ npm install

# Iniciando o servidor
$ npm run serve
```
ou
```bash

# Instalando as dependências
$ yarn install

# Iniciando o servidor
$ yarn start
```

Finalmente, você poderá acessar o site pela rota/link: **([https://127.0.0.1:8080](https://127.0.0.1:8080))**

## :pencil: Licença

Este projeto esta sobe a licença MIT.

Feito com :heart: por ETE Ariano Vilar Suassuna :wave:
