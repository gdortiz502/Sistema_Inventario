<?php

  $respuestaInsitucion = InstitucionController::ctrMostrarInstitucion();

  if($respuestaInsitucion["logotipo"] != null){

    $imagen = $respuestaInsitucion["logotipo"];

  }else{

    $imagen = "views/img/logotipo/default_logo.png";

  }

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio" class="brand-link">
      <img src="<?php echo $imagen ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $respuestaInsitucion["nombre"] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
            if($_SESSION["foto"] != "") {
              echo '<img src="'.$_SESSION["foto"].'" class="img-circle elevation-2" alt="User Image">';
            }else{
              echo '<img src="views/img/users/user_default.jpg" class="img-circle elevation-2" alt="User Image">';
            }
          
          ?>
          
        </div>
        <div class="info">
          <a href="perfil" class="d-block"><?php echo $_SESSION["nombre"] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column navegacion" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="inicio" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="categorias" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categorias
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="proveedores" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Proveedores
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="clientes" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="productos" class="nav-link">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Productos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="inventario" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Inventario
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Cotizaciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cotizaciones" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administrar Cotizaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crearcotizacion" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Cotización</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Pedidos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pedidos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administrar Pedidos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crearpedido" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Pedido</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ventas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administrar Ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crearventa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Venta</p>
                </a>
              </li>
            </ul>
          </li>
          <?php

            if($_SESSION['perfil'] == 1){
              echo '<li class="nav-item">
            <a href="compras" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Compras
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cheques" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Control de cheques
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="usuarios" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="configuracion" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Configuración
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="historial" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Historial
              </p>
            </a>
          </li>';
            }

          ?>
          <li class="nav-item">
            <a href="perfil" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Perfil
                <!--<span class="right badge badge-danger">Nuevo</span>-->
              </p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="novedades" class="nav-link">
              <i class="nav-icon fas fa-certificate"></i>
              <p>
                Novedades
                <span class="right badge badge-danger">Nuevo</span>
              </p>
            </a>
          </li>-->
          <li class="nav-item">
            <a href="salir" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Cerrar Sesión
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>