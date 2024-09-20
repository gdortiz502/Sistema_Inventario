<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Inventario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Inventario</li>
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
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                $item = null;

                                $valor = null;

                                $respuesta = InventariosController::ctrMostrarInventario($item, $valor);

                                foreach ($respuesta as $key => $value) {

                                    $itemProducto = "idProducto";
                                    $valorProducto = $value["producto"];

                                    $respuestaProducto = ProductosController::ctrMostrarProductos($itemProducto, $valorProducto);
                                    

                                    if($value["cantidad"] < 0){
                                        $cantidad = "<span class='btn btn-info btn-xs' title='".abs($value["cantidad"])."'>En transito</span>";
                                        $total = 0;
                                    }else{
                                        $cantidad = $value["cantidad"];
                                        $total = $respuestaProducto[0]["precioVenta"] * $value["cantidad"];
                                    }

                                    if($respuestaProducto[0]["estatus"] != 0){
                                        echo '
                                        <tr>
                                            <td>'.($key + 1 ).'</td>
                                            <td><img width="50px" src="'.$respuestaProducto[0]["imagen"].'"></td>
                                            <td>'.$respuestaProducto[0]["codigo"].'</td>
                                            <td>'.$respuestaProducto[0]["descripcion"].'</td>
                                            <td>'.$respuestaProducto[0]["precioVenta"].'</td>
                                            <td>'.$cantidad.'</td>
                                            <td>'.number_format($total,2).'</td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-xs btnAgregarInventario" idInventario="'.$value["idInventario"].'" data-toggle="modal" data-target="#modalAgregarInventario"><i class="fas fa-plus"></i></button>';
                                                if($value["cantidad"] > 0){
                                                    echo '<button type="button" class="btn btn-warning btn-xs btnRestarInventario" idInventario="'.$value["idInventario"].'" data-toggle="modal" data-target="#modalRestarInventario"><i class="fas fa-minus"></i></button>';
                                                }

                                            echo '
                                            </td>
                                        </tr>
                                        ';
                                    }
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

    <div class="modal fade" id="modalAgregarInventario">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#28a745">
                        <h4 class="modal-title">Agregar Inventario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevoCodigoProductoInventario">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="nuevoCodigoProductoInventario" readonly id="nuevoCodigoProductoInventario">
                                        <input type="hidden" name="idInventarioAgregar" id="idInventarioAgregar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDescripcionProductoInventario">Descripción</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <input type="text" class="form-control" readonly name="nuevaDescripcionProductoInventario" id="nuevaDescripcionProductoInventario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaCantidadActualProductoInventario">Stock Actual</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="nuevaCantidadActualProductoInventario" readonly id="nuevaCantidadActualProductoInventario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaCantidadProductoInventario">Stock a Agregar</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="number" step="1" min="0" class="form-control" placeholder="Ingrese la cantidad a agregar" name="nuevaCantidadProductoInventario" id="nuevoCodigoProducto">
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
                    
                        $agregarInventario = new InventariosController();
                        $agregarInventario -> ctrAgregarInventario();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalRestarInventario">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#ffc107">
                        <h4 class="modal-title">Quitar inventario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarCodigoProductoInventario">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="editarCodigoProductoInventario" readonly id="editarCodigoProductoInventario">
                                        <input type="hidden" name="idInventarioRestar" id="idInventarioRestar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarDescripcionProductoInventario">Descripción</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <input type="text" class="form-control" readonly name="editarDescripcionProductoInventario" id="editarDescripcionProductoInventario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarCantidadActualProductoInventario">Stock Actual</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="editarCantidadActualProductoInventario" readonly id="editarCantidadActualProductoInventario">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarCantidadProductoInventario">Stock a restar</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="number" step="1" min="0" class="form-control" placeholder="Ingrese la cantidad a restar" name="editarCantidadProductoInventario" id="editarCantidadProductoInventario">
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

                        $restarInventario = new InventariosController();
                        $restarInventario -> ctrRestarInventario();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
