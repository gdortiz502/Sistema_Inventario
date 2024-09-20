<?php

        if($_SESSION['perfil'] != 1){
            echo '<script>window.location = "inicio"</script>';
        }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Historial</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Historial</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped tablas">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php

                                $respuesta = HistorialController::ctrMostrarHistorial();

                                foreach ($respuesta as $key => $value) {

                                    $itemUsuario = "idUsuario";

                                    $valorUsuario = $value["usuario"];

                                    $respuestaUsuario = UsuariosController::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                                    echo '
                                    <tr>
                                        <td>'.($key + 1 ).'</td>
                                        <td>'.$value["descripcion"].'</td>
                                        <td>'.$respuestaUsuario["nombre"].'</td>
                                        <td>'.$value["fecha"].'</td>
                                    </tr>
                                    ';

                                }

                            ?>
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->