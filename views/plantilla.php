<?php

    session_start();

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Ventas | Multiproyectos BBJ </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/9165fb6e34.js" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="views/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="views/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="views/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/css/adminlte.min.css">
    <!--TOASTR-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="views/js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="views/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="views/js/adminlte.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="views/js/jquery.dataTables.min.js"></script>
    <script src="views/js/dataTables.bootstrap4.min.js"></script>
    <script src="views/js/dataTables.responsive.min.js"></script>
    <script src="views/js/responsive.bootstrap4.min.js"></script>
    <script src="views/js/dataTables.buttons.min.js"></script>
    <script src="views/js/buttons.bootstrap4.min.js"></script>
    <script src="views/js/jszip.min.js"></script>
    <script src="views/js/pdfmake.min.js"></script>
    <script src="views/js/vfs_fonts.js"></script>
    <script src="views/js/buttons.html5.min.js"></script>
    <script src="views/js/buttons.print.min.js"></script>
    <script src="views/js/buttons.colVis.min.js"></script>
    <!--SweetAlert 2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--TOASTR-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
<?php

    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == 'ok'){

echo '<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">';

        include 'modulos/header.php';

        include 'modulos/sidebar.php';

        if(isset($_GET["ruta"])){

            if($_GET["ruta"] == "inicio" ||
               $_GET["ruta"] == "categorias" ||
               $_GET["ruta"] == "proveedores" ||
               $_GET["ruta"] == "clientes" || 
               $_GET["ruta"] == "productos" || 
               $_GET["ruta"] == "inventario" ||
               $_GET["ruta"] == "cotizaciones" ||
               $_GET["ruta"] == "crearcotizacion" ||
               $_GET["ruta"] == "pedidos" ||
               $_GET["ruta"] == "crearpedido" ||
               $_GET["ruta"] == "ventas" ||
               $_GET["ruta"] == "crearventa" ||
               $_GET["ruta"] == "compras" ||
               $_GET["ruta"] == "cheques" ||
               $_GET["ruta"] == "usuarios" ||
               $_GET["ruta"] == "reporteventas" ||
               $_GET["ruta"] == "configuracion" ||
               $_GET["ruta"] == "perfil" ||
               $_GET["ruta"] == "historial" || 
               $_GET["ruta"] == "novedades" || 
               $_GET["ruta"] == "salir"){
                

                include 'modulos/'.$_GET["ruta"].'.php';

            }else{

                include 'modulos/404.php';

            }

        }else{

            echo '<script>window.location = "inicio"</script>';

        }

        include 'modulos/footer.php';

  

  
    echo '</div>';

    }else{ 

        include 'modulos/login.php';

    } ?>

<script src="views/js/plantilla.js"></script>
<script src="views/js/categorias.js"></script>
<script src="views/js/proveedores.js"></script>
<script src="views/js/clientes.js"></script>
<script src="views/js/productos.js"></script>
<script src="views/js/inventarios.js"></script>
<script src="views/js/cotizaciones.js"></script>
<script src="views/js/pedidos.js"></script>
<script src="views/js/ventas.js"></script>
<script src="views/js/compras.js"></script>
<script src="views/js/cheques.js"></script>
<script src="views/js/reportes.js"></script>
<script src="views/js/usuarios.js"></script>

</body>
</html>
