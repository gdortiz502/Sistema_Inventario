<?php

    class ProductosController{

        public static function ctrMostrarProductos($item, $valor){

            $tabla = "productos";

            $respuesta = ProductosModel::mdlMostrarProductos($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrInsertarProductos(){

            if(isset($_POST["nuevoCodigoProducto"]) && isset($_POST["nuevaDescripcionProducto"])){

                if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["nuevoCodigoProducto"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcionProducto"])){

                    $tabla = "productos";

                    $ruta = "views/img/productos/default/anonymous.png";

                    if(isset($_FILES["nuevaImagenUsuario"]["tmp_name"]) && !empty($_FILES["nuevaImagenUsuario"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["nuevaImagenProducto"]["tmp_name"]);

                        $nuevoAncho = 500;
                        $nuevoAlto = 500;

                        /*=============================================
                        CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                        =============================================*/

                        $directorio = "views/img/productos/".$_POST["nuevoCodigoProducto"];

                        mkdir($directorio, 0755);

                        /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                        if($_FILES["nuevaImagenProducto"]["type"] == "image/jpeg"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/productos/".$_POST["nuevoCodigoProducto"]."/".$aleatorio.".jpg";

                            $origen = imagecreatefromjpeg($_FILES["nuevaImagenProducto"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);

                        }

                        if($_FILES["nuevaImagenProducto"]["type"] == "image/png"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/productos/".$_POST["nuevoCodigoProducto"]."/".$aleatorio.".png";

                            $origen = imagecreatefrompng($_FILES["nuevaImagenProducto"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);

                        }

                    }
    
                    $datos = array(
                        "codigo" => $_POST["nuevoCodigoProducto"],
                        "descripcion" => $_POST["nuevaDescripcionProducto"],
                        "precioCompra" => $_POST["nuevoPrecioCompraProducto"],
                        "precioVenta" => $_POST["nuevoPrecioVentaProducto"],
                        "categoria" => $_POST["nuevaCategoriaProducto"],
                        "proveedor" => $_POST["nuevoProveedorProducto"],
                        "imagen" => $ruta
                    );
    
                    $respuesta = ProductosModel::mdlInsertarProducto($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Inserción del producto ".$_POST["nuevaDescripcionProducto"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El proveedor ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "productos";
        
                                            }
                                        })
        
                            </script>';

                        }else{

                            var_dump($respuestaHistorial);

                        }
    
                    }else{
                        var_dump($respuesta);
                    }
    
    
                }else{
    
                    echo'<script>
    
                        swal.fire({
                              icon: "error",
                              title: "¡El código no puede ir vacía o llevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
    
                                window.location = "productos";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        public static function ctrEditarProductos(){

            if(isset($_POST["editarIdProducto"])){

                if(preg_match('/^[a-zA-Z0-9áéíúóÁÉÍÓÚ ]+$/', $_POST["editarDescripcionProducto"])){

                    $tabla = "productos";

                    $ruta = $_POST["imagenActualProducto"];

                    if(isset($_FILES["editarImagenProducto"]["tmp_name"]) && !empty($_FILES["editarImagenProducto"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["editarImagenProducto"]["tmp_name"]);

                        $nuevoAncho = 500;
                        $nuevoAlto = 500;

                        /*=============================================
                        CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                        =============================================*/

                        $directorio = "views/img/productos/".$_POST["editarCodigoProducto"];

                        /*=============================================
                        PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
                        =============================================*/


                        mkdir($directorio, 0755);	

                        
                        /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                        if($_FILES["editarImagenProducto"]["type"] == "image/jpeg"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/productos/".$_POST["editarCodigoProducto"]."/".$aleatorio.".jpg";

                            $origen = imagecreatefromjpeg($_FILES["editarImagenProducto"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);

                        }

                        if($_FILES["editarImagenProducto"]["type"] == "image/png"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/productos/".$_POST["editarCodigoProducto"]."/".$aleatorio.".png";

                            $origen = imagecreatefrompng($_FILES["editarImagenProducto"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);

                        }

                    }
    
                    $datos = array(
                        "idProducto" => $_POST["editarIdProducto"],
                        "descripcion" => $_POST["editarDescripcionProducto"],
                        "precioCompra" => $_POST["editarPrecioCompraProducto"],
                        "precioVenta" => $_POST["editarPrecioVentaProducto"],
                        "categoria" => $_POST["editarCategoriaProducto"],
                        "proveedor" => $_POST["editarProveedorProducto"],
                        "imagen" => $ruta
                    );
    
                    $respuesta = ProductosModel::mdlEditarProductos($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edición del producto ".$_POST["editarDescripcionProducto"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El producto ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "productos";
        
                                            }
                                        })
        
                            </script>';

                        }else{

                            var_dump($respuestaHistorial);

                        }
    
                    }else{
                        var_dump($respuesta);
                    }
    
    
                }else{
    
                    echo'<script>
    
                        swal.fire({
                              icon: "error",
                              title: "¡El código no puede ir vacía o llevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
    
                                window.location = "productos";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        static public function ctrActualizarProductos(){

            if(isset($_GET["idProducto"])){
    
                $tabla ="productos";
                $producto = $_GET["nombre"];

                if($_GET["estatus"] == 1){
                    $estatus = 0;
                    $descripcion = "El producto ".$producto." se ha deshabilitado en la base de datos";
                }else{
                    $estatus = 1;
                    $descripcion = "El producto ".$producto." se ha habilitado en la base de datos";
                }

                $datos = array(
                    "idProducto" => $_GET["idProducto"],
                    "estatus" =>  $estatus
                );
    
                $respuesta = ProductosModel::mdlActualizarProducto($tabla, $datos);
    
                if($respuesta == "ok"){
    
                    $tablaHistorial = "historial";

                    $datosHistorial = array(
                        "descripcion" => $descripcion,
                        "usuario" => $_SESSION["id"]
                    );

                    $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                    if($respuestaHistorial == "ok"){

                        echo'<script>

                        swal.fire({
                            icon: "success",
                            title: "El producto ha sido modificado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "productos";
    
                                        }
                                    })
    
                        </script>';

                    }else{

                        echo '<script>alert('.$respuesta.')</script>';

                    }
                }else{

                    echo '<script>alert('.$respuesta.')</script>';

                }
            }
            
        }

    }