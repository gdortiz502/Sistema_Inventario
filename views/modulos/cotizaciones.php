<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar cotizaciones</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar cotizaciones</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <a href="crearcotizacion" class="btn btn-default">
          <i class="fas fa-plus"></i>
          Agregar
        </a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped tablas">
          <thead>
          <tr>
            <th>#</th>
            <th>No. Cotizacion</th>
            <th>Cliente</th>
            <th>Usuario</th>
            <th>Método de Pago</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Estatus</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
            <?php
              $item = null;
              $valor = null;

              $respuesta = CotizacionesController::ctrMostrarCotizaciones($item, $valor);

              foreach ($respuesta as $key => $value) {

                $itemCliente = "idCliente";
                $valorCliente = $value["cliente"];

                $respuestaCliente = ClientesController::ctrMostrarClientes($itemCliente, $valorCliente);

                $itemUsuario = "idUsuario";
                $valorUsuario = $value["usuario"];

                $respuestaUsuario = UsuariosController::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                if($value["estatus"] ==  1){
                  $estatus = '<button type="button" class="btn btn-xs btn-success">Creado</button>';
                }else{
                  $estatus = '<button type="button" class="btn btn-xs btn-danger">Anulado</button>';
                }
                
                echo '
                  <tr>
                    <td>'.($key + 1).'</td>
                    <td>'.$value["noCotizacion"].'</td>
                    <td>'.$respuestaCliente[0]["nombre"].'</td>
                    <td>'.$respuestaUsuario["codigo"].'</td>
                    <td>'.$value["metodoPago"].'</td>
                    <td>'.$value["total"].'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>'.$estatus.'</td>
                    <td>
                      <button class="btn btn-xs btn-info btnImprimirCotizacion" idCotizacion="'.$value["noCotizacion"].'"><i class="fas fa-print"></i></button>';
                    if($_SESSION["perfil"] == 1){if($value["estatus"] == 1){
                      echo ' <button class="btn btn-xs btn-danger btnEliminarCotizacion" idCotizacion="'.$value["idCotizacion"].'"><i class="fas fa-trash"></i></button>';
                    }}
                    echo '</td>
                  </tr>
                ';
              }
            ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
  $eliminarCotizacion = new CotizacionesController();
  $eliminarCotizacion -> ctrEliminarEliminarCotizacion();
?>