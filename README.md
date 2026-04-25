# 🧪 Teste Técnico — Backend Laravel (Concessionária)

Olá! 👋
Este é o teste técnico para a vaga de **Desenvolvedor Backend Júnior**.

O objetivo é avaliar organização de código, API REST, Laravel, PostgreSQL, Docker e documentação de APIs com Postman.
=======
# 🚗 **Vehicle API - Backend**

API REST desenvolvida em **Laravel** para gerenciamento de **veículos** e **leads**, com autenticação via **JWT**.

---

## 📋 **Visão Geral**
✨ **Funcionalidades

🔧 **Recursos

✅ CRUD de veículos (admin)

🔐 Autenticação JWT

✅ Sistema público de leads

📦 Seed de admin

✅ Relacionamento Vehicle → Leads

📄 Paginação

✅ Validações completas

🛡️ Form Requests

🔐 Autenticação JWT

Copy code
Authorization: Bearer {token}
👤 Usuário Administrador
php

Copy code
// AdminUserSeeder
User::updateOrCreate(
    ['email' => env('ADMIN_EMAIL', 'admin@admin.com')],
    [
        'name' => 'Admin',
        'password' => Hash::make(env('ADMIN_PASSWORD', '123456')),
    ]
);
🔑 Credenciais padrão:


Copy code
Email: admin@admin.com
Senha: 123456
▶️ Executar seeder:

bash

Copy code
php artisan db:seed --class=AdminUserSeeder
🚀 Instalação Rápida
bash

Copy code
# 1. Clonar repositório
git clone https://github.com/Catfallen/teste-backend-motoca.git
cd teste-backend-motoca

# 2. Instalar dependências
composer install
>>>>>>> 53af721 (read me v3)

# 3. Configurar ambiente
cp .env.example .env
php artisan key:generate

<<<<<<< HEAD
# 🚗 Desafio

Desenvolver uma **API REST** para gerenciamento de:

* Veículos disponíveis para venda
* Leads (clientes interessados nos veículos)

Cenário: sistema interno de uma concessionária.
=======
# 4. Configurar banco (.env)
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=

# 5. Migrar e seed
php artisan migrate
php artisan db:seed --class=AdminUserSeeder

# 6. Iniciar servidor
php artisan serve
📡 Rotas da API
🔓 Públicas
Método

Endpoint

Descrição

POST

/api/login

Autenticação
>>>>>>> 53af721 (read me v3)

POST

<<<<<<< HEAD
# ⚙️ Tecnologias e ferramentas

O projeto deve ser desenvolvido utilizando o seguinte stack:

* PHP 8+
* Laravel
* PostgreSQL
* Docker
* Docker Compose
* Nginx
* Git
* Postman (coleção exportada)
=======
/api/leads

Criar lead

GET

/api/vehicles

Listar veículos
>>>>>>> 53af721 (read me v3)

GET

<<<<<<< HEAD
# 🐳 Ambiente de execução

A aplicação deve rodar em containers com a seguinte estrutura:

* app → PHP-FPM + Laravel
* nginx → servidor web
* postgres → banco de dados

A aplicação deve ficar acessível em:

```
http://localhost:8000
```

Após subir os containers deve ser possível executar as migrations via:

```bash
docker compose exec app php artisan migrate
```
=======
/api/vehicles/{id}

Ver veículo

GET

/api/vehicles/{id}/leads
>>>>>>> 53af721 (read me v3)

Leads do veículo

<<<<<<< HEAD
# 📦 Entidades do sistema

## Vehicles

Representa os veículos disponíveis para venda.

Campos esperados:

* id
* type → `car` ou `motorcycle`
* brand → default "Honda"
* model
* year
* price
* color
* mileage
* created_at / updated_at
=======
🔐 Protegidas (JWT)
Método

Endpoint

Descrição

POST

/api/vehicles

Criar veículo
>>>>>>> 53af721 (read me v3)

PUT

<<<<<<< HEAD
## Leads

Representa clientes interessados em veículos.

Campos esperados:

* id
* name
* email
* phone
* vehicle_id
* message (opcional)
* created_at / updated_at

Relacionamento:

* Um veículo possui vários leads.

---

# 🔐 Autenticação

Criar autenticação simples (Sanctum ou JWT).

Rota esperada:

```
POST /api/login
```

Usuários autenticados podem:

* Criar, editar e remover veículos
* Listar leads

A criação de lead deve ser pública.

---

# 🚀 Funcionalidades esperadas

## CRUD de Vehicles

```
GET    /api/vehicles
POST   /api/vehicles
GET    /api/vehicles/{id}
PUT    /api/vehicles/{id}
DELETE /api/vehicles/{id}
```

Validações:

* model obrigatório
* year ≥ 2000
* price > 0
* type deve ser `car` ou `motorcycle`

---

## Leads

Criar lead:

```
POST /api/leads
```

Listar leads:

```
GET /api/leads
GET /api/vehicles/{id}/leads
```

Validações:

* email válido
* telefone obrigatório
* vehicle_id deve existir

---

# ⭐ Diferenciais que agregam valor

Filtros:

```
GET /api/vehicles?type=car
GET /api/vehicles?max_price=80000
```

Dashboard:

```
GET /api/dashboard
```

Exemplo:

```json
{
  "total_vehicles": 30,
  "total_leads": 85,
  "most_requested_vehicle": "Honda Civic"
}
```

Outros pontos que agregam:

* Seeders
* Paginação
* Testes automatizados

---

# 📮 Como realizar o teste

## 1️⃣ Fazer um FORK do repositório

Clique em **Fork** e desenvolva no seu próprio repositório.

---

## 2️⃣ Criar uma branch

```
git checkout -b feature/teste-backend
```

---

## 3️⃣ Desenvolver a solução

---

## 4️⃣ Enviar a entrega

Abrir um Pull Request contendo:

Informar na descrição:

* Nome completo
* E-mail
* Tempo gasto para concluir
* Observações (se houver)

---

# 📬 Entregáveis

O repositório deve conter:

### ✔ Projeto Laravel funcional

Com `.env.example` configurado.

### ✔ README com:

* Como rodar o projeto
* Como subir os containers
* Como rodar migrations

### ✔ Coleção Postman exportada (.json)

Contendo:

* Login
* CRUD Vehicles
* Criar Lead
* Listar Leads
* Dashboard (se implementado)

Boa sorte 🚀
=======
/api/vehicles/{id}

Atualizar veículo

DELETE

/api/vehicles/{id}

Deletar veículo

GET

/api/leads

Listar leads

GET

/api/leads/{id}

Ver lead

PUT

/api/leads/{id}

Atualizar lead

DELETE

/api/leads/{id}

Deletar lead

🚗 Modelos
Vehicle

Copy code
id, type (car|motorcycle), brand, model, year (>=2000), 
price (>0), color, mileage
Lead

Copy code
id, name, email, phone, vehicle_id, message (opcional)
Relacionamento: Vehicle → hasMany Leads

📊 Paginação

Copy code
GET /api/vehicles?page=1&per_page=10
GET /api/leads?page=1&per_page=10
⭐ Diferenciais
✅ JWT Authentication (sem Sanctum)
✅ Seeder automático de admin
✅ Paginação nativa
✅ Relacionamentos Eloquent
✅ Validações com Form Requests
✅ Estrutura REST organizada
🧠 Observações
⚠️ IMPORTANTE: Este projeto utiliza apenas JWT, NÃO Sanctum.
