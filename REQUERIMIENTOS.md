# Requerimientos del Proyecto - CafeteriaX

## 📋 Descripción General
Plataforma web para cafeterías que permite a los dueños gestionar sus negocios y a los clientes descubrir y explorar cafeterías, sus menús y ubicaciones.

---

## 🎯 Funcionalidades Principales

### 1. Sistema de Autenticación
- [ ] **Sin empezar** - Implementar sistema de autenticación dual (Clientes y Dueños)
- [ ] **Sin empezar** - Login para Clientes
- [ ] **Sin empezar** - Login para Dueños/Administradores de Cafeterías
- [ ] **Sin empezar** - Registro de Clientes
- [ ] **Sin empezar** - Registro de Dueños
- [ ] **Sin empezar** - Recuperación de contraseña
- [ ] **Sin empezar** - Middleware para separar permisos por rol

### 2. Módulo de Dueños/Administradores
- [ ] **Sin empezar** - Dashboard principal para dueños
- [ ] **Sin empezar** - Gestión de múltiples cafeterías por dueño
- [ ] **Sin empezar** - CRUD de cafeterías (Crear, leer, actualizar, eliminar)
- [ ] **Sin empezar** - Configuración de información de cafetería (nombre, descripción, horarios)
- [ ] **Sin empezar** - Gestión de ubicación de cafeterías
- [ ] **Sin empezar** - Subida de imágenes de cafeterías

#### 2.1. Gestión de Inventario
- [ ] **Sin empezar** - CRUD de productos/ingredientes
- [ ] **Sin empezar** - Control de stock
- [ ] **Sin empezar** - Alertas de inventario bajo
- [ ] **Sin empezar** - Categorización de productos

#### 2.2. Gestión de Menú
- [ ] **Sin empezar** - CRUD de items del menú
- [ ] **Sin empezar** - Categorización de items (Bebidas, Comidas, Postres, etc.)
- [ ] **Sin empezar** - Configuración de precios
- [ ] **Sin empezar** - Subida de imágenes de productos
- [ ] **Sin empezar** - Descripción de productos
- [ ] **Sin empezar** - Disponibilidad de productos (activo/inactivo)
- [ ] **Sin empezar** - Vincular productos del menú con inventario

### 3. Módulo de Clientes
- [ ] **Sin empezar** - Dashboard/Página principal para clientes
- [ ] **Sin empezar** - Explorador de cafeterías (lista con filtros)
- [ ] **Sin empezar** - Vista detallada de cafetería individual
- [ ] **Sin empezar** - Visualización del menú completo de cada cafetería
- [ ] **Sin empezar** - Visualización de ubicación en mapa
- [ ] **Sin empezar** - Información de contacto y horarios

#### 3.1. Sistema de Favoritos
- [ ] **Sin empezar** - Marcar/Desmarcar cafeterías como favoritas
- [ ] **Sin empezar** - Marcar/Desmarcar productos como favoritos
- [ ] **Sin empezar** - Lista de cafeterías favoritas
- [ ] **Sin empezar** - Lista de productos favoritos
- [ ] **Sin empezar** - Notificaciones de actualizaciones en favoritos (opcional)

### 4. Funcionalidades Generales
- [ ] **Sin empezar** - Diseño responsive con Bootstrap 5
- [ ] **Sin empezar** - Búsqueda de cafeterías por nombre
- [ ] **Sin empezar** - Filtros de búsqueda (ubicación, tipo de café, etc.)
- [ ] **Sin empezar** - Integración con mapas (Google Maps / OpenStreetMap)
- [ ] **Sin empezar** - Sistema de notificaciones
- [ ] **Sin empezar** - Panel de perfil de usuario
- [ ] **Sin empezar** - Política de privacidad y términos de uso

---

## 📊 Base de Datos - Modelos Principales

### Modelos a Crear:
- [x] **Completado** - User (con roles: cliente, dueño)
- [x] **Completado** - Cafeteria
- [x] **Completado** - MenuItem (Items del menú)
- [x] **Completado** - Category (Categorías de menú)
- [x] **Completado** - InventoryItem (Items de inventario)
- [x] **Completado** - Favorite (Favoritos - relación polimórfica)

---

## 🚀 Fases de Desarrollo

### Fase 1: Fundación
- [ ] **Sin empezar** - Configuración inicial del proyecto ✓
- [ ] **Sin empezar** - Diseño de base de datos
- [ ] **Sin empezar** - Sistema de autenticación básico
- [ ] **Sin empezar** - Roles y permisos

### Fase 2: Módulo de Dueños
- [ ] **Sin empezar** - Gestión de cafeterías
- [ ] **Sin empezar** - Gestión de menú
- [ ] **Sin empezar** - Gestión de inventario

### Fase 3: Módulo de Clientes
- [ ] **Sin empezar** - Exploración de cafeterías
- [ ] **Sin empezar** - Sistema de favoritos
- [ ] **Sin empezar** - Visualización de menús

### Fase 4: Refinamiento
- [ ] **Sin empezar** - Integración de mapas
- [ ] **Sin empezar** - Optimización de UI/UX
- [ ] **Sin empezar** - Testing y corrección de bugs

---

## 📝 Notas Adicionales

### Tecnologías Utilizadas:
- ✅ Laravel 12.x
- ✅ Bootstrap 5
- ⏳ MySQL/SQLite
- ⏳ Vite
- ⏳ Blade Templates

---

## 🎨 Diseño y Experiencia de Usuario

### Paleta de Colores Principal
- **Primario:** Dorado elegante (#D4AF37, #C9A961)
- **Secundario:** Negro sofisticado (#000000, #1a1a1a)
- **Base:** Blanco puro (#FFFFFF, #F8F9FA)
- **Acentos:** Grises sutiles (#E5E5E5, #333333)

### Principios de Diseño
- ✨ **Elegancia:** Diseño minimalista y sofisticado
- 👁️ **Cómodo a la vista:** Espaciado generoso, tipografía legible
- 🎯 **Fácil de usar:** Navegación intuitiva y clara
- ✨ **Personalidad:** Detalles que hacen única la experiencia

### Componentes UI a Implementar
- [ ] **Sin empezar** - Botones con diseño premium (efectos hover, bordes dorados)
- [ ] **Sin empezar** - Cards elegantes con sombras suaves
- [ ] **Sin empezar** - Navbar con efecto glassmorphism o scroll transparente
- [ ] **Sin empezar** - Footer minimalista con información esencial
- [ ] **Sin empezar** - Formularios estilizados con validación visual
- [ ] **Sin empezar** - Badges y tags con estilo premium

### Animaciones y Microinteracciones
- [ ] **Sin empezar** - Fade-in suave al cargar elementos
- [ ] **Sin empezar** - Hover effects en cards y botones (scale, elevación)
- [ ] **Sin empezar** - Transiciones suaves entre páginas
- [ ] **Sin empezar** - Loading spinner elegante con tema dorado
- [ ] **Sin empezar** - Animación al agregar/quitar favoritos (corazón)
- [ ] **Sin empezar** - Smooth scroll en navegación
- [ ] **Sin empezar** - Parallax sutil en hero sections
- [ ] **Sin empezar** - Toast notifications elegantes
- [ ] **Sin empezar** - Skeleton loaders para carga de contenido

### Tipografía
- [ ] **Sin empezar** - Fuente principal elegante (Playfair Display, Cormorant, Montserrat)
- [ ] **Sin empezar** - Fuente secundaria para legibilidad (Inter, Poppins, Open Sans)
- [ ] **Sin empezar** - Jerarquía tipográfica clara

### Responsive Design
- [ ] **Sin empezar** - Mobile-first approach
- [ ] **Sin empezar** - Breakpoints optimizados para móvil, tablet, desktop
- [ ] **Sin empezar** - Menú hamburguesa elegante para móvil
- [ ] **Sin empezar** - Imágenes optimizadas y responsive

### Assets Visuales
- [ ] **Sin empezar** - Iconos personalizados o Font Awesome Pro
- [ ] **Sin empezar** - Ilustraciones SVG para secciones vacías
- [ ] **Sin empezar** - Imágenes placeholder elegantes
- [ ] **Sin empezar** - Logo del proyecto con versiones dark/light

---

## 📦 Librerías UI Adicionales (Opcionales)
- [ ] **Sin empezar** - AOS (Animate On Scroll) para animaciones
- [ ] **Sin empezar** - Swiper.js para carruseles elegantes
- [ ] **Sin empezar** - SweetAlert2 para modales premium
- [ ] **Sin empezar** - Particles.js para efectos de fondo sutiles
- [ ] **Sin empezar** - Typed.js para efectos de texto animado

### Convenciones:
- ✅ **Completado** - Funcionalidad implementada y probada
- 🔄 **En curso** - Actualmente en desarrollo
- ⏳ **Sin empezar** - Pendiente de iniciar

---

**Última actualización:** 5 de diciembre de 2025
**Versión:** 0.1.0
