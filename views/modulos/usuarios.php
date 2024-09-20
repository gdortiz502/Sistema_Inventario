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
            <h1 class="m-0">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
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
                    <div class="card-header">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalInsertarUsuario">
                        <i class="fas fa-plus"></i>
                        Agregar
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped tablas">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Nivel</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                $item = null;

                                $valor = null;

                                $respuesta = UsuariosController::ctrMostrarUsuarios($item, $valor);

                                foreach ($respuesta as $key => $value) {

                                    if($value["estatus"] == 1){
                                        $estatus = '<span style="cursor:context-menu" class="btn btn-xs btn-success">Activado</span>';
                                    }else{
                                        $estatus = '<span style="cursor:context-menu" class="btn btn-xs btn-danger">Desactivado</span>';
                                    }

                                    $itemNivel = "idNivel";
                                    $valorNivel = $value["nivel"];

                                    $respuestaNivel = UsuariosController::ctrMostrarNivelesUsuario($itemNivel, $valorNivel);
                                    
                                    echo '
                                    <tr>
                                        <td>'.($key + 1 ).'</td>
                                        <td><img width="50px" src="'.$value["imagen"].'"></td>
                                        <td>'.$value["codigo"].'</td>
                                        <td>'.$value["nombre"].'</td>
                                        <td>'.$value["usuario"].'</td>
                                        <td>'.$value["direccion"].'</td>
                                        <td>'.$value["telefono"].'</td>
                                        <td>'.$value["correo"].'</td>
                                        <td>'.$respuestaNivel["descripcion"].'</td>
                                        <td>'.$estatus.'</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-xs btnEditarUsuario" idUsuario="'.$value["idUsuario"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-edit"></i></button>';
                                            if($value["estatus"] == 1){
                                                echo '<button type="button" class="btn btn-danger btn-xs btnEliminarUsuario" idUsuario="'.$value["idUsuario"].'"><i class="fas fa-power-off"></i></button>';
                                            }else{
                                                echo '<button type="button" class="btn btn-success btn-xs btnActivarUsuario" idUsuario="'.$value["idUsuario"].'"><i class="fas fa-power-off"></i></button>';
                                            }
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
                <!-- /.card -->
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <div class="modal fade" id="modalInsertarUsuario">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#0069d9">
                        <h4 class="modal-title">Nuevo Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoCodigoUsuario">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el código" name="nuevoCodigoUsuario" id="nuevoCodigoUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoNombreUsuario">Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre" name="nuevoNombreUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoUsuarioUsuario">Usuario</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el usuario" name="nuevoUsuarioUsuario" id="nuevoUsuarioUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoPasswordUsuario">Contraseña</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Ingrese la contraseña" name="nuevoPasswordUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoTelefonoUsuario">Teléfono</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de teléfono" name="nuevoTelefonoUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoCorreoUsuario">Correo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el correo" name="nuevoCorreoUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDireccionUsuario">Dirección</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese la dirección" name="nuevaDireccionUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoCorreoProveedor">Nivel</label>
                                    <div class="input-group mb-3">
                                        <select name="nuevoNivelUsuario" class="form-control">
                                            <option value="">Seleccione un nivel de usuario</option>
                                            <?php
                                            
                                            $itemDDNivel = null;
                                            $valorDDNivel = null;

                                            $respuestaDDNivel = UsuariosController::ctrMostrarNivelesUsuario($itemDDNivel, $valorDDNivel);

                                            foreach ($respuestaDDNivel as $key => $value) {
                                                
                                                echo '<option value="'.$value["idNivel"].'">'.$value["descripcion"].'</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevaDireccionProveedor">Imagen</label>
                                    <hr>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="nuevaImagen" name="nuevaImagenUsuario">
                                        </div>
                                    </div>
                                    <p class="help-block">Peso máximo de la imagen 2MB</p>
                                    <img src="views/img/users/user_default.jpg" class="img-thumbnail previsualizar" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>

                    <?php
                    
                        $insertarUsuario = new UsuariosController();
                        $insertarUsuario -> ctrInsertarUsuario();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalEditarUsuario">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#ffc107">
                        <h4 class="modal-title">Editar Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarCodigoUsuario">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el código" name="editarCodigoUsuario" id="editarCodigoUsuario" readonly>
                                        <input type="hidden" name="editarIdUsuario" id="editarIdUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarNombreUsuario">Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre" name="editarNombreUsuario" id="editarNombreUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarUsuarioUsuario">Usuario</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el usuario" name="editarUsuarioUsuario" id="editarUsuarioUsuario" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarPasswordUsuario">Contraseña</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Ingrese la contraseña" name="editarPasswordUsuario" id="editarPasswordUsuario">
                                        <input type="hidden" name="passwordActual" id="passwordActual">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarTelefonoUsuario">Teléfono</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de teléfono" name="editarTelefonoUsuario" id="editarTelefonoUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarCorreoUsuario">Correo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el correo" name="editarCorreoUsuario" id="editarCorreoUsuario">
                                    </div>
                                </div>
                            </div>  
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarDireccionUsuario">Dirección</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese la dirección" name="editarDireccionUsuario" id="editarDireccionUsuario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarNivelUsuario">Nivel</label>
                                    <div class="input-group mb-3">
                                        <select name="editarNivelUsuario" id="editarNivelUsuario" class="form-control">
                                            <option value="">Seleccione un nivel de usuario</option>
                                            <?php
                                            
                                            $itemDDNivel = null;
                                            $valorDDNivel = null;

                                            $respuestaDDNivel = UsuariosController::ctrMostrarNivelesUsuario($itemDDNivel, $valorDDNivel);

                                            foreach ($respuestaDDNivel as $key => $value) {
                                                
                                                echo '<option value="'.$value["idNivel"].'">'.$value["descripcion"].'</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevaDireccionProveedor">Imagen</label>
                                    <hr>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="nuevaImagen" name="editarImagenUsuario">
                                            <input type="hidden" name="editarImagenActualUsuario" id="editarImagenActualUsuario">
                                        </div>
                                    </div>
                                    <p class="help-block">Peso máximo de la imagen 2MB</p>
                                    <img src="views/img/users/user_default.jpg" class="img-thumbnail previsualizar" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>
                    <?php

                        $editarUsuarios = new UsuariosController();
                        $editarUsuarios -> ctrEditarUsuario();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php
    
        $eliminarUsuario = new UsuariosController();
        $eliminarUsuario -> ctrActualizarUsuario();

    ?>