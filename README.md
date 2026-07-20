# 🩺 MediConsult

Sistema de Orientación Médica Inteligente — Laravel 12 + Livewire + SQLite.

---

## 📋 Requisitos

| Herramienta | Versión |
|-------------|---------|
| PHP         | 8.2+    |
| Composer    | 2.x     |
| Node.js     | 20+     |
| NPM         | 9+      |

---

## 🚀 Instalación y Ejecución

### 1. Clonar e instalar dependencias

```bash
cd C:\Users\Acer\Videos\MediConsult
composer install
npm install
```

### 2. Configurar entorno

El archivo `.env` ya está configurado con SQLite.  
Verificar que contenga:

```env
DB_CONNECTION=sqlite
DB_DATABASE=C:\Users\Acer\Videos\MediConsult\database\database.sqlite
```

### 3. Migrar base de datos y seeders

```bash
php artisan migrate:fresh --seed
```

Esto crea las tablas y carga datos iniciales:
- **10 alergias** (Penicilina, Ibuprofeno, Sulfas, etc.)
- **10 enfermedades** (Diabetes, Hipertensión, Asma, etc.)
- **10 medicamentos** (Paracetamol, Ibuprofeno, Amoxicilina, etc.)
- **20 síntomas** (Fiebre, Tos, Dolor de cabeza, etc.)
- **1 usuario administrador**

### 4. Compilar assets del frontend

```bash
npm run build
```

### 5. Iniciar servidor

```bash
php artisan serve
```

Visitar: **http://127.0.0.1:8000**

---

## 🔐 Credenciales de Prueba

| Rol      | Correo                   | Contraseña |
|----------|--------------------------|------------|
| Admin    | admin@mediconsult.com    | admin123   |

---

## 🧭 Módulos del Sistema

### Módulo 1 — Gestión de Usuarios
- **Registro** con DNI, nombres, apellidos, teléfono
- **Inicio de sesión**
- **Perfil de Salud**: datos personales, físicos, alergias, enfermedades, medicamentos actuales, situaciones especiales (embarazo/lactancia)

### Módulo 2 — Orientación Médica Inteligente
- **Chat IA**: describe síntomas, el sistema hace preguntas, analiza riesgo y genera recomendaciones
- **Consulta Guiada**: selección por botones (ideal para adultos mayores)
- **Resultado**: nivel de riesgo (🟢/🟡/🔴), posibles causas, recomendaciones

### Módulo 3 — Gestión Farmacológica
- **Verificador de Medicamentos**: busca y consulta indicaciones, contraindicaciones, efectos secundarios
- **Compatibilidad con perfil**: detecta alergias y contraindicaciones del usuario
- **Comparador de Medicamentos**: tabla comparativa (Paracetamol vs Ibuprofeno, etc.)
- **Biblioteca de Medicamentos**: catálogo paginado

### Módulo 4 — Atención y Seguimiento
- **Historial Clínico**: todas las consultas con nivel de riesgo
- **Seguimiento de Síntomas**: registra evolución (mejor/igual/peor)
- **Centro de Alertas**: interacciones, contraindicaciones, seguimiento

### Módulo 5 — Información
- **Biblioteca de Enfermedades**: qué es, síntomas, prevención, cuándo acudir al médico

### Administración
- **CRUD de Medicamentos**: crear, editar, eliminar
- **CRUD de Enfermedades**: crear, editar, eliminar
- **Panel IA**: estadísticas, tendencias, distribución de riesgos, predicciones

---

## 🗂️ Estructura del Proyecto

```
MediConsult/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # AdminController, ConsultaController, SeguimientoController
│   │   └── Middleware/         # AdminMiddleware
│   ├── Livewire/               # ChatConsulta, ConsultaGuiada, PerfilSalud
│   └── Models/                 # User, AlergiaCatalogo, EnfermedadCatalogo,
│                                 MedicamentoCatalogo, SintomaCatalogo, Consulta,
│                                 ConsultaSintoma, Alerta, Seguimiento, UserSituacion
├── database/
│   ├── migrations/             # 13 migraciones
│   └── seeders/                # DatabaseSeeder con datos iniciales
├── resources/
│   └── views/
│       ├── layouts/            # mediconsult.blade.php (sidebar layout)
│       ├── livewire/           # Componentes Livewire + Volt
│       ├── components/         # nav-link, guest-layout
│       ├── consulta/           # chat, guiada, resultado
│       ├── medicamentos/       # verificador, comparador, biblioteca
│       ├── enfermedades/       # biblioteca
│       ├── admin/              # medicamentos CRUD, enfermedades CRUD
│       └── *.blade.php         # dashboard, historial, seguimiento, alertas,
│                                 perfil-salud, panel-ia, welcome
├── routes/
│   └── web.php                 # Todas las rutas del sistema
└── README.md
```

---

## 🛠️ Comandos Útiles

```bash
# Resetear base de datos con datos de prueba
php artisan migrate:fresh --seed

# Compilar assets (después de cambios en CSS/JS)
npm run build

# Desarrollo con recarga en vivo
npm run dev
```

---

## ⚠️ Aviso Legal

**Este sistema no reemplaza a un médico.**  
La información proporcionada es orientativa y no sustituye el diagnóstico o tratamiento profesional.  
Ante cualquier emergencia, acuda al centro de salud más cercano.
