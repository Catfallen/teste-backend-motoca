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

# 3. Configurar ambiente
cp .env.example .env
php artisan key:generate

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

POST

/api/leads

Criar lead

GET

/api/vehicles

Listar veículos

GET

/api/vehicles/{id}

Ver veículo

GET

/api/vehicles/{id}/leads

Leads do veículo

🔐 Protegidas (JWT)
Método

Endpoint

Descrição

POST

/api/vehicles

Criar veículo

PUT

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
