<?php

    require_once 'controllers/plantilla.controller.php';
    require_once 'controllers/inicio.controller.php';
    require_once 'controllers/institucion.controller.php';
    require_once 'controllers/categorias.controller.php';
    require_once 'controllers/proveedores.controller.php';
    require_once 'controllers/clientes.controller.php';
    require_once 'controllers/productos.controller.php';
    require_once 'controllers/inventarios.controller.php';
    require_once 'controllers/cotizaciones.controller.php';
    require_once 'controllers/pedidos.controller.php';
    require_once 'controllers/ventas.controller.php';
    require_once 'controllers/historial.controller.php';
    require_once 'controllers/compras.controller.php';
    require_once 'controllers/cheques.controller.php';
    require_once 'controllers/usuarios.controller.php';
    require_once 'controllers/reportes.controller.php';

    require_once 'models/institucion.model.php';
    require_once 'models/inicio.model.php';
    require_once 'models/categorias.model.php';
    require_once 'models/proveedores.model.php';
    require_once 'models/clientes.model.php';
    require_once 'models/productos.model.php';
    require_once 'models/inventarios.model.php';
    require_once 'models/cotizaciones.model.php';
    require_once 'models/pedidos.model.php';
    require_once 'models/ventas.model.php';
    require_once 'models/historial.model.php';
    require_once 'models/compras.model.php';
    require_once 'models/cheques.model.php';
    require_once 'models/usuarios.model.php';
    require_once 'models/reportes.model.php';

    $plantilla = new PlantillaController();
    $plantilla -> ctrMostrarPlantilla();