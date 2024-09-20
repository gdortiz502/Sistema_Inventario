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
            <h1 class="m-0">Compras</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Compras</li>
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
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalInsertarCompra">
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
                            <th>Descripción</th>
                            <th>No. Autorización</th>
                            <th>No. Factura</th>
                            <th>Serie</th>
                            <th>Proveedor</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Comentarios</th>
                            <th>Usuario</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                $item = null;

                                $valor = null;

                                $respuesta = ComprasController::ctrMostrarCompras($item, $valor);

                                foreach ($respuesta as $key => $value) {

                                    $itemProveedor = "idProveedor";
                                    $valorProveedor = $value["proveedor"];

                                    $respuestaProveedor = ProveedoresController::ctrMostrarProveedores($itemProveedor, $valorProveedor);

                                    $itemUsuario = "idUsuario";
                                    $valorUsuario = $value["usuario"];

                                    $respuestaUsuario = UsuariosController::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                                    if($value["estatus"] == 1){

                                        $estatus = '<button class="btn btn-xs btn-success">Creada</button>';

                                    }else{
                                        $estatus = '<button class="btn btn-xs btn-danger">Anulada</button>';
                                    }

                                    echo '
                                    <tr>
                                        <td>'.($key + 1 ).'</td>
                                        <td>'.$value["descripcion"].'</td>
                                        <td>'.$value["uuid"].'</td>
                                        <td>'.$value["noSat"].'</td>
                                        <td>'.$value["serie"].'</td>
                                        <td>'.$respuestaProveedor[0]["nombre"].'</td>
                                        <td>'.$value["total"].'</td>
                                        <td>'.$value["fecha"].'</td>
                                        <td>'.$value["comentario"].'</td>
                                        <td>'.$respuestaUsuario["nombre"].'</td>
                                        <td>'.$estatus.'</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-xs btnEditarCompra" idCompra="'.$value["idCompra"].'" data-toggle="modal" data-target="#modalEditarCompra"><i class="fas fa-edit"></i></button>
                                            ';
                                        if($value["estatus"] == 1){
                                            echo '<button type="button" class="btn btn-danger btn-xs btnEliminarCompra" idCompra="'.$value["idCompra"].'" ><i class="fas fa-trash"></i></button>';
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

    <div class="modal fade" id="modalInsertarCompra">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#0069d9">
                        <h4 class="modal-title">Nueva Compra</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoUuidCompra">UUID</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de autorización" name="nuevoUuidCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoNoFacturaCompra">No. Factura</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de factura" name="nuevoNoFacturaCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoNoSerieCompra">Serie</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de serie" name="nuevoNoSerieCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevaFechaCompra">Fecha</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control"  name="nuevaFechaCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoTotalCompra">Total</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-quora"></i></span>
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control" placeholder="Ingrese el total"  name="nuevoTotalCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoCorreoProveedor">Proveedor</label>
                                    <div class="input-group mb-3">
                                        <select name="nuevoProveedorCompra" class="form-control">
                                            <option value="">Seleccione un proveedor</option>
                                            <?php
                                            
                                            $itemDDProveedor = "estatus";
                                            $valorDDProveedor = 1;

                                            $respuestaDDProveedor = ProveedoresController::ctrMostrarProveedores($itemDDProveedor, $valorDDProveedor);

                                            foreach ($respuestaDDProveedor as $key => $value) {
                                                
                                                echo '<option value="'.$value["idProveedor"].'">'.$value["nombre"].'</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDescripcionCompra">Descripción</label>
                                    <textarea name="nuevaDescripcionCompra"  rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoComentarioCompra">Comentarios</label>
                                    <textarea name="nuevoComentarioCompra"  rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>

                    <?php
                    
                        $insertarCompra = new ComprasController();
                        $insertarCompra -> ctrInsertarCompra();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalEditarCompra">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#ffc107">
                        <h4 class="modal-title">Editar compra</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="editarUuidCompra">UUID</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de autorización" name="editarUuidCompra" id="editarUuidCompra">
                                        <input type="hidden" name="editarIdCompra" id="editarIdCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="editarNoFacturaCompra">No. Factura</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de factura" name="editarNoFacturaCompra" id="editarNoFacturaCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarNoSerieCompra">Serie</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de serie" name="editarNoSerieCompra" id="editarNoSerieCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarFechaCompra">Fecha</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control"  name="editarFechaCompra" id="editarFechaCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarTotalCompra">Total</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-quora"></i></span>
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control" placeholder="Ingrese el total"  name="editarTotalCompra" id="editarTotalCompra">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="editarProveedorCompra">Proveedor</label>
                                    <div class="input-group mb-3">
                                        <select name="editarProveedorCompra" id="editarProveedorCompra" class="form-control">
                                            <option value="">Seleccione un proveedor</option>
                                            <?php
                                            
                                            $itemDDProveedor = "estatus";
                                            $valorDDProveedor = 1;

                                            $respuestaDDProveedor = ProveedoresController::ctrMostrarProveedores($itemDDProveedor, $valorDDProveedor);

                                            foreach ($respuestaDDProveedor as $key => $value) {
                                                
                                                echo '<option value="'.$value["idProveedor"].'">'.$value["nombre"].'</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarDescripcionCompra">Descripción</label>
                                    <textarea name="editarDescripcionCompra" id="editarDescripcionCompra" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="editarComentarioCompra">Comentarios</label>
                                    <textarea name="editarComentarioCompra" id="editarComentarioCompra" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>
                    <?php

                        $editarCompra = new ComprasController();
                        $editarCompra -> ctrEditarCompra();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php
    
        $eliminarCompras = new ComprasController();
        $eliminarCompras -> ctrActualizarCompras();

    ?>