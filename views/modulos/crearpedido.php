<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Crear Pedido</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Crear Pedido</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-outline card-success">
      <form method="post">
        <div class="car-body">
          <div class="row p-3">
            <div class="col-4">
            <?php
                
                $respuestaInsitucion = InstitucionController::ctrMostrarInstitucion();

                if($respuestaInsitucion["logotipo"] != null){

                    $imagen = $respuestaInsitucion["logotipo"];

                }else{

                    $imagen = "views/img/logotipo/default_logo.png";

                }

                ?>
              <img src="<?php  echo $imagen ?>" width="150px" alt="">
            </div>
            <div class="col-4 text-center">
              <b><?php echo $respuestaInsitucion["razonSocial"] ?></b>
              <p style="margin:0; padding: 0"><?php echo $respuestaInsitucion["direccion"] ?></p>
            </div>
            <div class="col-4 text-center">
              <span style="display: block; font-size: 16px">Pedidos</span>
              <b style="display: block; font-size: 20px">Pedido No.</b>
              <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                  <?php
                  
                    $itemPedido = null;

                    $valorPedido = null;

                    $respuestaPedido = PedidosController::ctrMostrarPedidosSinFecha($itemPedido, $valorPedido);

                    if(!$respuestaPedido){
                      echo '<input type="text" class="form-control" name="noPedido" value="10001" readonly>';
                    }else{
                      foreach ($respuestaPedido as $key => $value) {
                        
                      }
                      $codigo = $value["noPedido"];
                      echo '<input type="text" class="form-control" name="noPedido" value="'.($codigo + 1).'" readonly>';
                    }

                  ?>
                </div>
                <div class="col-3"></div>
              </div>
            </div>
            <div class="col-12"><br></div>
            <div class="col-4">
            </div>
            <div class="col-4 text-center">
              <span style="display: block;"><b>NIT: </b><?php echo $respuestaInsitucion["nit"] ?></span>
              <span style="display: block;"><?php echo $respuestaInsitucion["razonSocial"] ?></span>
              <span style="display: block;"><?php echo $respuestaInsitucion["correo"] ?></span>
            </div>
            <div class="col-4">

            </div>
            <div class="col-12"><br></div>
            <div class="col-3 text-center"><span>Visitanos en <?php echo $respuestaInsitucion["sitioWeb"] ?></span></div>
            <div class="col-3 text-center">
            <img src="views/img/facebook.jpg" width="20px" alt="">
            <?php echo $respuestaInsitucion["nombre"] ?>
            </div>
            <div class="col-3"></div>
            <div class="col-3">
              <span>PBX: <?php echo $respuestaInsitucion["telefono"] ?></span>
            </div>
            <div class="col-12">
              <br>
            </div>
            <div class="col-4">
              <span style="display:block" class="d-flex mb-1"><b>NIT: </b> <input class="form-control form-control-sm  nitCliente" type="text" name="nitClienteCotizacion" placeholder="Ingrese el nit" required>
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalInsertarCliente">
                Agregar
              </button>
              </span>
            </div>
            <div class="col-4">
            <span style="display:block" class="d-flex mb-1"><b>Nombre: </b> <input class="form-control form-control-sm nombreCliente" type="text" name="nombreCliente" placeholder="Nombre del cliente" readonly>
            <input name="idClientePedido" type="hidden" class="idClienteCotizacion"></span>
            </div>
            <div class="col-4">
              <span style="display:block" class="d-flex mb-1"><b>Dirección: </b> <input class="form-control form-control-sm  direccionCliente" type="text" name="direcccionClienteCotizacion" placeholder="Dirección del cliente  " readonly></span>
            </div>
            <div class="col-3">
              <span style="display:block" class="d-flex mb-1"><b>Vendedor: </b> <input class="form-control form-control-sm  vendedorCotizacion" type="text" name="vendedorCotizacion" value="<?php echo $_SESSION["nombre"] ?>" readonly></span>
              <span style="display:block" class="d-flex mb-1"><input type="hidden" name="idVendedorPedido" value="<?php echo $_SESSION["id"] ?>"></span>
            </div>
            <div class="col-12">
              <div class="row">
                  <div class="col-4">
                  <span style="display:block" class="d-flex mb-1"><b class="col-5">Fecha de entrega: </b> <input required class="form-control form-control-sm" type="date" name="fechEntrega"></span>
                  </div>
              </div>
            </div>  
            <div class="col-12">
              <br>
            </div>
            <div class="col-12">
              <div class="nuevoProducto">
                <b>Detalle</b>
                <hr>
                <div class="productos">

                </div>
                <input type="hidden" id="listaProductos" name="listaProductos">
              </div>
            </div> 
            <div class="col-4">
              <label for="comentarioCotizacion">Comentario</label>
              <textarea name="comentariosPedido" id="comentarioCotizacion" class="form-control" rows="3" ></textarea>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
              <div class="d-flex pb-1">
                <b class="col-4">Sub-Total</b>
                <input type="text" id="subTotalCotizacion" readonly class="form-control form-control-sm" required>
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">IVA 12%</b>
                <input type="text" id="ivaCotizacion" readonly class="form-control form-control-sm" required>
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">Descuento %</b>
                <input type="number" id="descuentoCotizacion" class="form-control form-control-sm">
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">Envío</b>
                <input type="number" name="envioPedido" id="envioCotizacion" class="form-control form-control-sm">
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">Total</b>
                <input type="text" id="totalCotizacion" name="totalPedido" readonly class="form-control form-control-sm" required>
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">Método de Pago</b>
                <select id="metodoPagoCotizacion" name="metodoPagoPedido" class="form-control form-control-sm" required>
                  <option value="">Seleccione un metodo de pago</option>
                  <option value="efectivo">Efectivo</option>
                  <option value="deposito">Déposito</option>
                  <option value="credito">Crédito</option>
                  <option value="transferencia">Crédito</option>
                  <option value="cheque">Cheque</option>
                </select>
              </div>
              <div class="txtPagar">
              </div>
            </div>
            <div class="col-4">
            </div>
            <div class="col-4"></div>
            <div class="col-4">
              <button type="submit" class="btn btn-success float-right" disabled id="btnGuardarCotizacion"><i class="fas fa-save"></i> Guardar Pedido</button>
            </div>
          </div>
        </div>
        <?php
        
          $crearPedido = new PedidosController();
          $crearPedido -> ctrInsertarPedido();

        ?>
      </form>
    </div>

    <div class="row">
      <div class="col-12">
          <div class="card card-outline card-success">
          <div class="card-header">
            <b>Productos</b>
          </div>
            <div class="card-body">
              <table class="table table-bordered table-stripeddt-responsive tablas" id="tablaProductosVentas">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                    $itemInventario = null;
                    $valorInventario = null;

                    $respuestaInventario = InventariosController::ctrMostrarInventario($itemInventario, $valorInventario);

                    foreach($respuestaInventario as $key => $value){

                      $itemProducto = "idProducto";
                      $valorProducto = $value["producto"];

                      $respuestaProducto = ProductosController::ctrMostrarProductos($itemProducto, $valorProducto);

                      if($value["cantidad"] < 0){
                        $stock = "<span class='btn btn-xs btn-info'>En transito</span>";
                      }else{
                        $stock = $value["cantidad"];
                      }

                      echo '
                        <tr>
                          <td>'.($key + 1).'</td>
                          <td>'.$respuestaProducto[0]["codigo"].'</td>
                          <td>'.$respuestaProducto[0]["descripcion"].'</td>
                          <td>'.$stock.'</td>
                          <td><div class="btn-group"><button class="btn btn-xs btn-success agregarProducto recuperarBoton" idProducto="'.$value["idInventario"].'">Agregar</button></div></td>
                        </tr>
                      ';
                      
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal fade" id="modalInsertarCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" role="form">
        <div class="modal-header" style="background-color: #007bff; color:white">
          <h4 class="modal-title">Agregar cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="nuevoProveedor">Código</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-user-lock"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="nuevoCliente" placeholder="Ingrese el código" id="nuevoCliente" required>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="nuevoNit">NIT</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-hashtag"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="nuevoNit" id="nuevoNitCliente" placeholder="Ingrese el NIT" required>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="nuevoNombre">Nombre</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-user"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingrese el nombre" required>
                </div>
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label for="nuevoTelefono">Número de teléfono</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-mobile-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="nuevoTelefono" placeholder="Ingrese el telefono">
                </div>
              </div>
            </div>
            <div class="col-7">
              <div class="form-group">
                <label for="nuevoCorreo">Correo electrónico</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-at"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="nuevoCorreo" placeholder="Ingrese la descripción">
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="nuevaDireccion">Dirección</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-map-marker-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="nuevaDireccion" placeholder="Ingrese la descripción">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
        </div>
        <?php
        
            $crearClientes = new ClientesController();
            $crearClientes -> ctrInsertarClientes();

        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->