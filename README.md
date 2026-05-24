# 🛒 Mini Store API

> API REST para gerenciamento de uma loja virtual — construída com Laravel 13 e MySQL.

## 📋 Sobre o projeto

O **Mini Store API** é uma API de gerenciamento de loja virtual com cadastro de categorias, produtos, clientes e pedidos. O projeto foi desenvolvido como portfólio para demonstrar conhecimentos em arquitetura de APIs REST, relacionamentos entre tabelas, validação de dados e boas práticas de desenvolvimento back-end com Laravel.

## ✨ Funcionalidades

| Recurso | Ações |
|---|---|
| **Categorias** | Criar e listar |
| **Produtos** | CRUD completo + filtro por nome e categoria |
| **Clientes** | Criar, listar e visualizar com pedidos |
| **Pedidos** | Criar e listar com dados do cliente |

## 🛠️ Tecnologias utilizadas

- **PHP 8.5** + **Laravel 13**
- **MySQL** — banco de dados relacional
- **Eloquent ORM** — mapeamento objeto-relacional e relacionamentos
- **Form Request** — validação separada por operação
- **Database Seeder** — dados iniciais para teste
- **Laravel Sanctum** — autenticação via tokens
- **Postman** — testes de endpoints durante desenvolvimento

## 🏗️ Arquitetura

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── CategoriaController.php
│   │   ├── ProdutoController.php
│   │   ├── ClienteController.php
│   │   └── PedidoController.php
│   └── Requests/
│       ├── StoreCategoriaRequest.php
│       ├── StoreProdutoRequest.php
│       ├── UpdateProdutoRequest.php
│       ├── StoreClienteRequest.php
│       └── StorePedidoRequest.php
└── Models/
    ├── Categoria.php
    ├── Produto.php
    ├── Cliente.php
    └── Pedido.php

database/
├── migrations/
└── seeders/
```

**Relacionamentos:**

```
Categoria  →  hasMany   →  Produto
Produto    →  belongsTo →  Categoria
Cliente    →  hasMany   →  Pedido
Pedido     →  belongsTo →  Cliente
```

## 🗄️ Estrutura do banco de dados

```
categorias
├── id
├── nome
└── timestamps

produtos
├── id
├── nome
├── preco (decimal)
├── estoque
├── categoria_id (FK → categorias)
└── timestamps

clientes
├── id
├── nome
├── email (unique)
├── telefone (nullable)
├── ativo (boolean, default: true)
└── timestamps

pedidos
├── id
├── cliente_id (FK → clientes)
├── total (decimal)
├── status (enum: pendente, aprovado, cancelado)
└── timestamps
```

## 🧠 Decisões técnicas

### Por que separar em quatro Controllers?
Cada Controller tem uma responsabilidade única — gerenciar um recurso específico. Isso segue o princípio da responsabilidade única e facilita manutenção: se a lógica de pedidos mudar, só o `PedidoController` é afetado.

### Por que Form Requests separados para store e update?
As regras de validação são diferentes. Na criação, campos como `nome` e `email` são obrigatórios. Na edição de produtos, todos os campos são opcionais — o usuário pode querer atualizar só o preço. Separar em `StoreProdutoRequest` e `UpdateProdutoRequest` deixa cada classe com regras claras.

### Por que filtros como query string nos produtos?
`GET /api/produtos?categoria_id=1&nome=notebook` é o padrão REST para filtros opcionais. Isso mantém a rota limpa e permite combinar filtros sem criar rotas específicas para cada combinação.

### Por que `ativo` no model de Cliente?
Em vez de apagar um cliente que tem pedidos vinculados — o que quebraria a integridade do banco — o campo `ativo` permite desativar o cliente sem perder o histórico de pedidos. É uma prática comum em sistemas reais.

### Por que Route Model Binding?
Em vez de buscar manualmente `Produto::find($id)` em cada método, o Laravel injeta o modelo diretamente pelo parâmetro da rota. Se não existir, retorna 404 automaticamente. Menos código, mais segurança.

## 🚀 Como rodar localmente

### Pré-requisitos

- PHP 8.3+
- Composer
- MySQL

### Instalação

```bash
# 1. Clone o repositório
git clone https://github.com/felipekauan1/mini-store-api.git
cd mini-store-api

# 2. Instale as dependências
composer install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Configure o banco de dados no .env
DB_DATABASE=mini_store_api
DB_USERNAME=root
DB_PASSWORD=sua_senha

# 5. Crie o banco e rode as migrations
php artisan migrate

# 6. Popule o banco com dados de exemplo
php artisan db:seed
```

### Rodando o projeto

```bash
php artisan serve
```

Acesse `http://localhost:8000` no navegador.

## 📡 Endpoints da API

### Categorias

```
GET  /api/categorias   → lista todas as categorias
POST /api/categorias   → cria uma nova categoria
```

**POST `/api/categorias`**
```json
{
    "nome": "Informática"
}
```

### Produtos

```
GET    /api/produtos          → lista todos (filtros opcionais)
GET    /api/produtos/{id}     → exibe um produto
POST   /api/produtos          → cria um produto
PUT    /api/produtos/{id}     → atualiza um produto
DELETE /api/produtos/{id}     → remove um produto
```

**Filtros disponíveis:**
```
GET /api/produtos?categoria_id=1
GET /api/produtos?nome=notebook
GET /api/produtos?categoria_id=1&nome=notebook
```

**POST `/api/produtos`**
```json
{
    "nome": "Notebook Gamer",
    "preco": 3500.00,
    "estoque": 10,
    "categoria_id": 1
}
```

### Clientes

```
GET  /api/clientes       → lista todos os clientes
GET  /api/clientes/{id}  → exibe cliente com seus pedidos
POST /api/clientes       → cria um novo cliente
```

**POST `/api/clientes`**
```json
{
    "nome": "Felipe Kauãn",
    "email": "felipe@email.com",
    "telefone": "31999999999"
}
```

### Pedidos

```
GET  /api/pedidos       → lista todos com dados do cliente
GET  /api/pedidos/{id}  → exibe pedido com dados do cliente
POST /api/pedidos       → cria um novo pedido
```

**POST `/api/pedidos`**
```json
{
    "cliente_id": 1,
    "total": 350.00,
    "status": "pendente"
}
```

`status` é opcional — padrão: `pendente`. Valores aceitos: `pendente`, `aprovado`, `cancelado`.

## 📦 Exemplos de resposta

**GET `/api/produtos`**
```json
{
    "sucesso": true,
    "total": 2,
    "produtos": [
        {
            "id": 1,
            "nome": "Notebook Gamer",
            "preco": "3500.00",
            "estoque": 10,
            "categoria_id": 1,
            "categoria": {
                "id": 1,
                "nome": "Informática"
            }
        }
    ]
}
```

**GET `/api/clientes/{id}`**
```json
{
    "sucesso": true,
    "cliente": {
        "id": 1,
        "nome": "Felipe Kauãn",
        "email": "felipe@email.com",
        "telefone": "31999999999",
        "ativo": true,
        "pedidos": [
            {
                "id": 1,
                "total": "350.00",
                "status": "pendente"
            }
        ]
    }
}
```

## 📌 Possíveis melhorias futuras

- Autenticação completa com Laravel Sanctum
- Atualização de status do pedido com histórico
- Paginação na listagem de produtos
- Testes automatizados com PHPUnit

## 👨‍💻 Autor

Desenvolvido por **[@felipekauan1](https://github.com/felipekauan1)**

## 📄 Licença

Este projeto está sob a licença MIT.
