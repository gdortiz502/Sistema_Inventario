Sistema de Inventario

**Personas Involucradas
-Gerson Ortiz
-Leandro Guerra

Funcionalidades
1. Gestión de Bodegas
- Crear, editar y eliminar bodegas.
- Visualizar el inventario disponible en cada bodega.
- Traslado de productos entre bodegas.
2. Gestión de Inventarios
- Registro de productos en el inventario.
- Control de entradas y salidas de productos.
- Alertas para inventarios bajos.
- Auditoría de movimientos de inventario.
- Generación de reportes de stock en tiempo real.
3. Gestión de Clientes
- Creación y gestión de perfiles de clientes.
- Historial de compras de los clientes.
- Facturación y administración de cuentas por cobrar.
4. Gestión de Proveedores
- Registro y gestión de proveedores.
- Historial de compras a proveedores.
- Administración de cuentas por pagar.
- Control de órdenes de compra y recepción de mercancía.
5. Gestión de Categorías
- Clasificación de productos en categorías.
- Crear, editar y eliminar categorías.
- Visualización del inventario por categorías.
Requisitos del Sistema
- Lenguaje de programación: PHP 7.4 o superior.
- Base de datos: MySQL.
- Servidor web: Apache o Nginx con soporte para PHP.
- Extensiones requeridas: PDO_MySQL.
- Navegador web: Últimas versiones de Chrome, Firefox, Edge.
Instalación
1. Clona el repositorio en tu máquina local:
   git clone https://github.com/tuusuario/sistema-inventario-php.git
2. Configura la base de datos:
   - Crea una base de datos en MySQL o MariaDB.
   - Ejecuta el script `database.sql` que se encuentra en la carpeta `sql-scripts` para crear las tablas necesarias.
3. Configura el acceso a la base de datos:
   - Abre el archivo `config/database.php` y actualiza la información de conexión:
     $host = "TU_HOST";
     $dbname = "TU_BASE_DE_DATOS";
     $username = "TU_USUARIO";
     $password = "TU_CONTRASEÑA";
4. Asegúrate de que tu servidor web esté configurado para servir archivos PHP.
5. Accede al proyecto desde el navegador para iniciar la configuración inicial:
   http://localhost/sistema-inventario
Uso del Sistema
1. Login: Inicia sesión con tus credenciales.
2. Panel Principal: Accede a los módulos de gestión de bodegas, inventarios, clientes, proveedores y categorías.
3. Reportes: Genera reportes detallados sobre stock, ventas, compras, cuentas por cobrar y pagar.
Estructura del Proyecto
- /config: Archivos de configuración como la conexión a la base de datos.
- /public: Carpeta pública accesible desde el navegador (CSS, JavaScript).
- /src: Código fuente principal del sistema (controladores, modelos, vistas).
- /sql-scripts: Scripts SQL para la creación de tablas y datos iniciales.
- /vendor: Librerías externas instaladas vía Composer.
Contribución
Si deseas contribuir a este proyecto, por favor sigue estos pasos:
1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza los cambios necesarios y haz commit (`git commit -m "Agregar nueva funcionalidad"`).
4. Envía los cambios a tu fork (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.
Licencia
Este proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.
