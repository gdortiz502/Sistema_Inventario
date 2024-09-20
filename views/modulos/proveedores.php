<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Proveedores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Proveedores</li>
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
                    <?php

                    if($_SESSION['perfil'] == 1){
                        echo '<div class="card-header">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalInsertarProveedor">
                        <i class="fas fa-plus"></i>
                        Agregar
                        </button>
                    </div>';
                    }

                    ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped tablas">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>NIT</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Dirección</th>
                            <th>Estatus</th>
                            <?php

                                if($_SESSION['perfil'] == 1){
                                    echo '<th>Acciones</th>';
                                }

                            ?>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                $item = null;

                                $valor = null;

                                $respuesta = ProveedoresController::ctrMostrarProveedores($item, $valor);

                                foreach ($respuesta as $key => $value) {

                                    if($value["estatus"] == 1){
                                        $estatus = '<span style="cursor:context-menu" class="btn btn-xs btn-success">Activado</span>';
                                    }else{
                                        $estatus = '<span style="cursor:context-menu" class="btn btn-xs btn-danger">Desactivado</span>';
                                    }

                                    echo '
                                    <tr>
                                        <td>'.($key + 1 ).'</td>
                                        <td>'.$value["codigo"].'</td>
                                        <td>'.$value["nit"].'</td>
                                        <td>'.$value["nombre"].'</td>
                                        <td>'.$value["telefono"].'</td>
                                        <td>'.$value["correo"].'</td>
                                        <td>'.$value["direccion"].'</td>
                                        <td>'.$estatus.'</td>';
                                        if($_SESSION['perfil'] == 1){
                                            echo '<td>
                                            <button type="button" class="btn btn-warning btn-xs btnEditarProveedor" idProveedor="'.$value["idProveedor"].'" data-toggle="modal" data-target="#modalEditarProveedor"><i class="fas fa-edit"></i></button>';
                                            if($value["estatus"] == 1){
                                                echo '<button type="button" class="btn btn-danger btn-xs btnEliminarProveedor" idProveedor="'.$value["idProveedor"].'"><i class="fas fa-power-off"></i></button>';
                                            }else{
                                                echo '<button type="button" class="btn btn-success btn-xs btnActivarProveedor" idProveedor="'.$value["idProveedor"].'"><i class="fas fa-power-off"></i></button>';
                                            }
                                        echo '</td>';
                                        }
                                    echo '</tr>
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

    <div class="modal fade" id="modalInsertarProveedor">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header" style="color: white; background-color:#0069d9">
                        <h4 class="modal-title">Nuevo Proveedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoCodigoProveedor">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el código" name="nuevoCodigoProveedor" id="nuevoCodigoProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoNitProveedor">NIT</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-th"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nit" name="nuevoNitProveedor" id="nuevoNitProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevoNombreProveedor">Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre" name="nuevoNombreProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="nuevoTelefonoProveedor">Teléfono</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de teléfono" name="nuevoTelefonoProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nuevoCorreoProveedor">Correo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el correo" name="nuevoCorreoProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDireccionProveedor">Dirección</label>
                                    <div class="input-group mb-3">
                                        <textarea rows="3" class="form-control" name="nuevaDireccionProveedor" placeholder="Ingrese la dirección"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>

                    <?php
                    
                        $insertarProveedor = new ProveedoresController();
                        $insertarProveedor -> ctrInsertarProveedores();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalEditarProveedor">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header" style="color: white; background-color:#ffc107">
                        <h4 class="modal-title">Editar Proveedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoCodigoProveedor">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" readonly name="nuevoCodigoProveedor" id="editarCodigoProveedor">
                                        <input type="hidden" name="editarIdProveedor" id="editarIdProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoNitProveedor">NIT</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-th"></i></span>
                                        </div>
                                        <input type="text" class="form-control" readonly placeholder="Ingrese el nit" name="nuevoNitProveedor" id="editarNitProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevoNombreProveedor">Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre" name="editarNombreProveedor" id="editarNombreProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="nuevoTelefonoProveedor">Teléfono</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de teléfono" name="editarTelefonoProveedor" id="editarTelefonoProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nuevoCorreoProveedor">Correo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el correo" name="editarCorreoProveedor" id="editarCorreoProveedor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDireccionProveedor">Dirección</label>
                                    <div class="input-group mb-3">
                                        <textarea rows="3" class="form-control" name="editarDireccionProveedor" id="editarDireccionProveedor"  placeholder="Ingrese la dirección"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>
                    <?php

                        $editarProveedor = new ProveedoresController();
                        $editarProveedor -> ctrEditarProveedores();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php
    
        $eliminarProveedor = new ProveedoresController();
        $eliminarProveedor -> ctrActualizarProveedores();

    ?>