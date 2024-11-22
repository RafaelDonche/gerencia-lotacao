## Sobre o sistema

Este sistema é uma interface de gerenciamento de lotação das salas e espaços de café que ocorrerão o treinamento. Tecnologias utilizadas:

- PHP;
- Laravel;
- MySQL;
- HTML, CSS, Bootstrap 4;
- Javascript, Jquery;
- Chart.js, Datatable Responsive, Select2.

Neste sistema possui:

- CRUD das entidades Sala, EspacoCafe e Pessoa;
- Dashboard de informações;
- API REST do CRUD das entidades;
- Persistência em banco de dados;
- Testes unitários;
- Laravel Sail para ambiente virtualizado em docker.

Este é um sistema protótipo.

Para receber um sistema com ambiente docker é importante saber que a máquina deve estar configurada para receber o projeto.
Neste caso, o servidor deve ter PHP e composer. Leia a documentação do Laravel Sail para mais informações.

## Manual de instalação

- Passo 1 -> Clone o repositório

```bash
git clone https://github.com/RafaelDonche/gerencia-lotacao.git
```

- Passo 2 -> Crie o arquivo .env e gere a chave de acesso

```bash
cp .env.example .env

php artisan key:generate
```

Configure as variáveis de ambiente do seu bando de dados (MySQL).

Adicione os atributos APP_PORT e FORWARD_DB_PORT referente ao docker.

- Passo 3 -> Instale a aplicação

```bash
composer update
```

- Passo 4 -> Inicie os containers

```bash
./vendor/bin/sail up -d
```

- Passo 5 -> Rode as migrations e seeders

```bash
php artisan migrate --seed
```
