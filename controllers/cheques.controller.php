<?php

    class ChequesController{

        public static function ctrMostrarCheques($item, $valor){

            $tabla = "controlcheques";

            $respuesta = ChequesModel::mdlMostrarCheques($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrInsertarCheque(){

            if(isset($_POST["nuevoNoCheque"])){

                if(preg_match('/^[0-9]+$/', $_POST["nuevoNoCheque"]) || 
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcionCheque"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoConceptoCheque"])){

                    $tabla = "controlcheques";
                    
                    $datos = array(
                        "descripcion" => $_POST["nuevaDescripcionCheque"],
                        "fecha" => $_POST["nuevaFechaCheque"],
                        "concepto" => $_POST["nuevoConceptoCheque"],
                        "total" => $_POST["nuevoTotalCheque"],
                        "usuario" => $_SESSION["id"], 
                        "noCheque" => $_POST["nuevoNoCheque"]
                    );

                    $respuesta = ChequesModel::mdlInsertarCheque($tabla, $datos);

                    if($respuesta == "ok"){

                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Inserción del cheque No. ".$_POST["nuevoNoCheque"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El cheque ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "cheques";
        
                                            }
                                        })
        
                            </script>';

                        }else{

                            var_dump($respuestaHistorial);

                        }
    
                    }else{
                        var_dump($respuesta);
                    }

                }

            }

        }

        public static function ctrEditarCheque(){

            if(isset($_POST["editarIdCheque"])){

                if(preg_match('/^[0-9]+$/', $_POST["editarNoCheque"]) || 
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionCheque"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["editarConceptoCheque"])){

                    $tabla = "controlcheques";
                    
                    $datos = array(
                        "descripcion" => $_POST["editarDescripcionCheque"],
                        "fecha" => $_POST["editarFechaCheque"],
                        "concepto" => $_POST["editarConceptoCheque"],
                        "total" => $_POST["editarTotalCheque"],
                        "idCheque" => $_POST["editarIdCheque"], 
                        "noCheque" => $_POST["editarNoCheque"]
                    );

                    $respuesta = ChequesModel::mdlEditarCheque($tabla, $datos);

                    if($respuesta == "ok"){

                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edicion del cheque No. ".$_POST["editarNoCheque"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El cheque ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "cheques";
        
                                            }
                                        })
        
                            </script>';

                        }else{

                            var_dump($respuestaHistorial);

                        }
    
                    }else{
                        var_dump($respuesta);
                    }

                }

            }

        }

        public static function ctrEliminarCheque(){

            if(isset($_GET["idControl"])){
    
                $tabla ="controlcheques";
                $idControl = $_GET["idControl"];
                $noCheque = $_GET["noCheque"];

                if($_GET["estatus"] == 1){
                    $estatus = 0;
                    $descripcion = "El cheque No. ".$noCheque." se ha eliminado en la base de datos";
                }else{
                    $estatus = 1;
                    $descripcion = "El cheque No. ".$noCheque." se ha eliminado en la base de datos";
                }

                $datos = $idControl;
    
                $respuesta = ChequesModel::mdlEliminarCheque($tabla, $datos);
    
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
                            title: "El cheque ha sido eliminado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "cheques";
    
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