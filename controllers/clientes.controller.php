<?php

    class ClientesController{

        public static function ctrMostrarClientes($item, $valor){

            $tabla = "clientes";

            $respuesta = ClientesModel::mdlMostrarClientes($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrBuscarCiente($item1, $valor1, $item2, $valor2){

            $tabla = "clientes";

            $respuesta = ClientesModel::mdlBuscarClientes($tabla, $item1, $valor1, $item2, $valor2);

            return $respuesta;

        }

        public static function ctrMostrarNombreClientes($item, $valor){

            $tabla = "clientes";

            $respuesta = ClientesModel::mdlMostrarNombreClientes($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrInsertarClientes(){

            if(isset($_POST["nuevoCodigoCliente"])){

                if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["nuevoCodigoCliente"]) ||
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoNitCliente"]) ||
                   preg_match('/^[a-zA-ZáéíúóÁÉÍÓÚ ]+$/', $_POST["nuevoNombreCliente"]) ||
                   preg_match('/^[0-9]+$/', $_POST["nuevoTelefonoCliente"]) ||
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoCorreoCliente"]) ||
                   preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]+$/', $_POST["nuevaDireccionCliente"])){

                    $tabla = "clientes";
    
                    $datos = array(
                        "codigo" => $_POST["nuevoCodigoCliente"],
                        "nit" => $_POST["nuevoNitCliente"],
                        "nombre" => $_POST["nuevoNombreCliente"],
                        "telefono" => $_POST["nuevoTelefonoCliente"],
                        "correo" => $_POST["nuevoCorreoCliente"],
                        "direccion" => $_POST["nuevaDireccionCliente"]
                    );
    
                    $respuesta = ClientesModel::mdlInsertarClientes($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Inserción del cliente ".$_POST["nuevoNombreCliente"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El Cliente ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "clientes";
        
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
    
                                window.location = "clientes";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        public static function ctrEditarClientes(){

            if(isset($_POST["editarIdCliente"])){

                if(preg_match('/^[a-zA-ZáéíúóÁÉÍÓÚ ]+$/', $_POST["editarNombreCliente"]) ||
                   preg_match('/^[0-9]+$/', $_POST["editarTelefonoCliente"]) ||
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarCorreoCliente"]) ||
                   preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]+$/', $_POST["editarDireccionCliente"])){

                    $tabla = "clientes";
    
                    $datos = array(
                        "idCliente" => $_POST["editarIdCliente"],
                        "nombre" => $_POST["editarNombreCliente"],
                        "telefono" => $_POST["editarTelefonoCliente"],
                        "correo" => $_POST["editarCorreoCliente"],
                        "direccion" => $_POST["editarDireccionCliente"]
                    );
    
                    $respuesta = ClientesModel::mdlEditarClientes($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edición del cliente ".$_POST["editarNombreCliente"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El cliente ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "clientes";
        
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
    
                                window.location = "clientes";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        static public function ctrActualizarClientes(){

            if(isset($_GET["idCliente"])){
    
                $tabla ="clientes";
                $cliente = $_GET["nombre"];

                if($_GET["estatus"] == 1){
                    $estatus = 0;
                    $descripcion = "El cliente ".$cliente." se ha deshabilitado en la base de datos";
                }else{
                    $estatus = 1;
                    $descripcion = "El cliente ".$cliente." se ha habilitado en la base de datos";
                }

                $datos = array(
                    "idCliente" => $_GET["idCliente"],
                    "estatus" =>  $estatus
                );
    
                $respuesta = ClientesModel::mdlActualizarClientes($tabla, $datos);
    
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
                            title: "El cliente ha sido modificado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "clientes";
    
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