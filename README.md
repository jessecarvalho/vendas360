<img height="150" src="https://github.com/jessecarvalho/tray/blob/main/public/logo.png"/>

# Tray - Desafio Técnico - Plataforma vendedor

Este é um sistema web desenvolvido para realizar o cadastro de vendedores e vendas, bem como calcular a comissão sobre as vendas realizadas.
___

## Como executar o projeto

1. Clone este repositório com o comando git clone git@github.com:jessecarvalho/tray.git
2. Acesse a pasta do projeto com o comando `cd tray`.
3. Instale as dependências do projeto com o comando `composer install`.
4. Crie um arquivo `.env` na raiz do projeto e copie o conteúdo do arquivo `.env.example` para ele.
5. Configure o arquivo `.env` com as informações do seu banco de dados.
6. Configure o arquivo `.env` com as informações de um provedor de e-mail smtp de sua preferência, está configurado para enviar e-mails com o Mailtrap.
7. Execute o comando npm install para instalar as dependências do frontend.
8. Execute npm run build para compilar os assets.
9. Execute o docker com o comando `docker-compose up -d`.
10. Caso seja necessário, execute os seeds para popular o banco de dados com dados iniciais com o comando `docker-compose exec app php artisan db:seed`.
11. Acesse a aplicação em `http://localhost:8000`.

___

## Escolhas Técnicas

<img height="25" src="https://laravel.com/img/logotype.min.svg"/>

Para o Backend optei por utilizar PHP com o framework Laravel, por ser um framework robusto com rápido setup e que fazia sentido para a vaga.

<img height="25" src="https://blade-ui-kit.com/images/logo.svg"/>

Para o frontend, optei por utilizar blade-ui-kit, por ser um framework de componentes para Laravel que facilita a criação de interfaces e obedecia aos requisitos do desafio.

<img height="50" src="https://www.mysql.com/common/logos/logo-mysql-170x115.png"/>

Para o banco de dados optei por utilizar MySQL, por ser um banco de dados relacional que tenho bastante contato e que também atende aos requisitos do desafio.

<img height="50" src="https://miro.medium.com/v2/resize:fit:512/1*JEHLmWo6_SrpHPiP4AimIw.png"/>

Também optei por utilizar o tailwind css, por ser um framework css que facilita a criação de interfaces e é uma boa escolha para projetos pequenos e com prazo curto.
___

## Requisitos do Desafio

- [x] A API deve ser capaz de Cadastrar vendedores informando nome e e-mail;
- [x] A API deve ser capaz de Cadastrar vendas informando o vendedor, o valor e a data da venda;
- [x] A API deve ser capaz de Listar todos os vendedores;
- [x] A API deve ser capaz de Listar todas as vendas;
- [x] A API deve ser capaz de Listar todas as vendas de um vendedor específico;
- [x] A Aplicação deve ser capaz de interagir com todos os endpoints da API;
- [x] A Aplicação deve ser capaz de Enviar um e-mail para cada vendedor com a quantidade de vendas realizadas no dia, o valor total das vendas e o valor total das comissões;
- [x] A Aplicação deve ser capaz de Enviar um e-mail para o administrador com a soma de todas as vendas efetuadas no dia;
- [x] A Aplicação deve ser capaz de Reenviar o e-mail de comissão para um determinado vendedor.
- [x] O projeto deverá ser desenvolvido com PHP, Vue.js ou JavaScript puro.  (PHP)
- [x] O projeto precisa obrigatoriamente ser escrita usando um dos frameworks PHP listados;. (Laravel)
- [x] O projeto precisa ser mysql ou postgresql. (MySQL)
- [x] O projeto precisa ser dockerizado. (Docker)

---

## Requisitos Extras

- [x] Implementar autenticação na API.
- [x] Implementar testes automatizados.
- [x] Implementar remoção e edição do vendedor
- [x] Implementar validação dos dados enviados



