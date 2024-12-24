## Sobre o sistema

Este sistema é uma interface de gerenciamento de lotação das salas e espaços de café que ocorrerão o treinamento.

### Tecnologias utilizadas:

- PHP;
- Laravel;
- MySQL;
- HTML, CSS, Bootstrap 4;
- Javascript, Jquery;
- Chart.js, Datatable Responsive, Select2.

### Neste sistema possui:

- CRUD das entidades Sala, EspacoCafe e Pessoa;
- Regras para impedir a superlotação das salas e espaços de café;
- Layout responsivo e dinâmico;
- Dashboard de informações;
- API REST do CRUD das entidades;
- Persistência em banco de dados;
- Testes unitários.

Este é um sistema protótipo.

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

- Passo 3 -> Instale a aplicação

```bash
composer update
```

- Passo 4 -> Rode as migrations e seeders

```bash
php artisan migrate --seed
```
