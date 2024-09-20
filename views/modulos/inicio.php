<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Página Principal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Página Principal</li>
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
          <?php

          if($_SESSION['perfil'] == 1){

          ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">

                <?php
                
                  $respuestaCompras = InicioController::ctrMostrarCantidades();

                  echo '<h3>Q. '.number_format($respuestaCompras['total'], 2).'</h3>'

                ?>

                <p>Total de Compras</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="compras" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php

                  $respuestaInventarios = InicioController::ctrMostrarInventarios();

                  if($respuestaInventarios < 0){

                    echo '<h3>Q. 0.00</h3>';
                  }else{

                    echo '<h3>Q. '.number_format($respuestaInventarios,2).'</h3>';
                  }

                  

                ?>

                <p>Total de Inventario</p>
              </div>
              <div class="icon">
                <i class="fas fa-warehouse"></i>
              </div>
              <a href="inventario" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php

                $respuestCheques = InicioController::ctrMostrarTotalCheques();

                echo '<h3>'.$respuestCheques["total"].'</h3>'

                ?>

                <p>Pagos realizados</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-check"></i>
              </div>
              <a href="cheques" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php

                $respuestaVentas = InicioController::ctrMostrarTotalVentas();

                echo '<h3>Q. '.number_format($respuestaVentas["total"], 2).'</h3>'

                ?>

                <p>Total de ventas</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <?php

          }

          ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">

                <?php
                
                  $respuestaVentas1 = InicioController::ctrMostrarTotalesVentas();

                  echo '<h3>'.$respuestaVentas1["total"].'</h3>'

                ?>

                <p>Ventas realizadas</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="vetas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php

                $respuestaCotizaciones = InicioController::ctrMostrarTotalCotizaciones();

                echo '<h3>'.$respuestaCotizaciones["total"].'</h3>'

                ?>

                <p>Cotizaciones realizadas</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
              <a href="cotizaciones" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php

                $respuestaPedidos = InicioController::ctrMostrarTotalPedidos();

                echo '<h3>'.$respuestaPedidos["total"].'</h3>'

                ?>

                <p>Pedidos realizados</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard-check"></i>
              </div>
              <a href="pedidos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php

                  $respuestaProductos = InicioController::ctrMostrarTotalProductos();

                  echo '<h3>'.$respuestaProductos["total"].'</h3>'

                ?>

                <p>Productos</p>
              </div>
              <div class="icon">
                <i class="fas fa-box"></i>
              </div>
              <a href="productos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Pedidos Recientes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>No. Pedido</th>
                      <th>Cliente</th>
                      <th>Total</th>
                      <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                      $respuestaPedidos1 = PedidosController::ctrMostrarPedidosInicio();

                      foreach($respuestaPedidos1 as $key => $value){

                        $itemCliente = "idCliente";
                        $valorCliente = $value["cliente"];
                        $respuestaCliente1 = ClientesController::ctrMostrarClientes($itemCliente, $valorCliente);

                        echo '
                        <tr>
                          <td>'.$value["noPedido"].'</td>
                          <td>'.$respuestaCliente1[0]["nombre"].'</td>
                          <td>Q. '.number_format($value["total"],2).'</td>
                          <td>'.$value["fechaCreacion"].'</td>
                        </tr>
                        ';

                      }
                    
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="crearpedido" class="btn btn-sm btn-info float-left">Nuevo Pedido</a>
                <a href="pedidos" class="btn btn-sm btn-secondary float-right">Ver todos los pedidos</a>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Ultimas Ventas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>No. Venta</th>
                      <th>Cliente</th>
                      <th>Total</th>
                      <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                      $respuestaVentas1 = VentasController::ctrMostrarVentasInicio();

                      foreach($respuestaVentas1 as $key => $value){

                        $itemCliente1 = "idCliente";
                        $valorCliente1 = $value["cliente"];
                        $respuestaCliente2 = ClientesController::ctrMostrarClientes($itemCliente1, $valorCliente1);
                        echo '
                        <tr>
                          <td>'.$value["noFactura"].'</td>
                          <td>'.$respuestaCliente2[0]["nombre"].'</td>
                          <td>Q. '.number_format($value["total"],2).'</td>
                          <td>'.$value["fecha"].'</td>
                        </tr>
                        ';

                      }
                    
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="crearventas" class="btn btn-sm btn-info float-left">Nueva venta</a>
                <a href="ventas" class="btn btn-sm btn-secondary float-right">Ver todas las ventas</a>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->