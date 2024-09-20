<?php

    class InstitucionController{

        public static function ctrMostrarInstitucion(){

            $tabla = "institucion";

            $respuesta = InstitucionModel::mdlMostrarInstitucion($tabla);

            return $respuesta;

        }

        public static function ctrEditarInstitucion(){

            if(isset($_POST["idInstitucion"])){

                if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreInstitucion"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["editarRazonSocialInstitucion"]) ||
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarNitInstitucion"]) ||
                   preg_match('/^[0-9]+$/', $_POST["editarTelefonoInstitucion"]) ||
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarCorreoInstitucion"]) ||
                   preg_match('/^[a-zA-Z0-9.]+$/', $_POST["editarSitioWebInstitucion"]) ||
                   preg_match('/^[0-9]+$/', $_POST["editarImpuestoInstitucion"]) || 
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["editarDireccionInstitucion"])){

                    $tabla = "institucion";

                    $ruta = $_POST["editarImagenActualInstitucion"];

                    if(isset($_FILES["editarImagenInstitucion"]["tmp_name"]) && !empty($_FILES["editarImagenInstitucion"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["editarImagenInstitucion"]["tmp_name"]);

                        $nuevoAncho = 500;
                        $nuevoAlto = 500;
                        
                        
                        /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                        if($_FILES["editarImagenInstitucion"]["type"] == "image/jpeg"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/logotipo/".$aleatorio.".jpg";

                            $origen = imagecreatefromjpeg($_FILES["editarImagenInstitucion"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);

                        }

                        if($_FILES["editarImagenInstitucion"]["type"] == "image/png"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/logotipo/".$aleatorio.".png";

                            $origen = imagecreatefrompng($_FILES["editarImagenInstitucion"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);

                        }

                    }
    
                    $datos = array(
                        "idInstitucion" => $_POST["idInstitucion"],
                        "nombre" => $_POST["editarNombreInstitucion"],
                        "razonSocial" => $_POST["editarRazonSocialInstitucion"],
                        "nit" => $_POST["editarNitInstitucion"],
                        "telefono" => $_POST["editarTelefonoInstitucion"],
                        "correo" => $_POST["editarCorreoInstitucion"],
                        "sitioWeb" => $_POST["editarSitioWebInstitucion"],
                        "direccion" => $_POST["editarDireccionInstitucion"],
                        "logotipo" => $ruta
                    );
    
                    $respuesta = InstitucionModel::mdlEditarInstitucion($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edición de la institucicion",
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "La institucion ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "configuracion";
        
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
                              title: "¡La información no puedellevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
    
                                window.location = "configuracion";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

    }