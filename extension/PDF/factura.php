<?php

    require ('../../controllers/institucion.controller.php');
    require ('../../models/institucion.model.php');

    require ('../../controllers/ventas.controller.php');
    require ('../../models/ventas.model.php');

    require ('../../controllers/clientes.controller.php');
    require ('../../models/clientes.model.php');


    $reponseInstitucion = InstitucionController::ctrMostrarInstitucion(null, null);

    $factura = $_GET["codigo"];
    $item = 'noFactura';

    $responseFactura = VentasController::ctrMostrarVentas($item, $factura);

    $itemCliente = 'idCliente';
    $valueCliente = $responseFactura["cliente"];

    $responseCliente = ClientesController::ctrMostrarClientes($itemCliente, $valueCliente);

    $itemDetalle = "factura";
    $valueDetalle = $responseFactura["noFactura"];

    $responseDetalle = VentasController::ctrMostrarDetalleVenta($itemDetalle, $factura);

    $total = 0;

	# Incluyendo librerias necesarias #
	require "fpdf.php";

	$pdf = new FPDF('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();

	# Logo de la empresa formato png #
	$pdf->Image('../../'.$reponseInstitucion["logotipo"],165,12,35,35,'JPG');

	# Encabezado y datos de la empresa #
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTextColor(32,100,210);
	$pdf->Cell(150,10,iconv("UTF-8", "ISO-8859-1",strtoupper($reponseInstitucion["razonSocial"])),0,0,'L');

	$pdf->Ln(9);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","NIT: ".$reponseInstitucion["nit"]),0,0,'L');

	$pdf->Ln(10);

    $pdf->MultiCell(100, 5, iconv("UTF-8", "ISO-8859-1",$reponseInstitucion["direccion"]), 0, 'L');
	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Teléfono: ".$reponseInstitucion["telefono"]),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Email: ". $reponseInstitucion["correo"]),0,0,'L');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,7,iconv("UTF-8", "ISO-8859-1","Fecha de emisión:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,iconv("UTF-8", "ISO-8859-1",date("d/m/Y", strtotime($responseFactura["fecha"]))),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",strtoupper("Factura Nro.")),0,0,'C');

	$pdf->Ln(7);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(12,7,iconv("UTF-8", "ISO-8859-1","Cajero:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(134,7,iconv("UTF-8", "ISO-8859-1","Carlos Alfaro"),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",strtoupper($responseFactura["noFactura"])),0,0,'C');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(13,7,iconv("UTF-8", "ISO-8859-1","Cliente:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1",$responseCliente[0]["nombre"]),0,1,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(8,7,iconv("UTF-8", "ISO-8859-1","NIT: "),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1",$responseCliente[0]["nit"]),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(7,7,iconv("UTF-8", "ISO-8859-1","Tel:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",$responseCliente[0]["telefono"]),0,0);
	$pdf->SetTextColor(39,39,51);

	$pdf->Ln(7);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(6,7,iconv("UTF-8", "ISO-8859-1","Direccion:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(109,7,iconv("UTF-8", "ISO-8859-1",$responseCliente[0]["direccion"]),0,0);

	$pdf->Ln(9);

	# Tabla de productos #
	$pdf->SetFont('Arial','',8);
	$pdf->SetFillColor(23,83,201);
	$pdf->SetDrawColor(23,83,201);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(90,8,iconv("UTF-8", "ISO-8859-1","Descripción"),1,0,'C',true);
	$pdf->Cell(15,8,iconv("UTF-8", "ISO-8859-1","Cant."),1,0,'C',true);
	$pdf->Cell(25,8,iconv("UTF-8", "ISO-8859-1","Precio"),1,0,'C',true);
	$pdf->Cell(19,8,iconv("UTF-8", "ISO-8859-1","Desc."),1,0,'C',true);
	$pdf->Cell(32,8,iconv("UTF-8", "ISO-8859-1","Subtotal"),1,0,'C',true);

	$pdf->Ln(8);

	
	$pdf->SetTextColor(39,39,51);



	/*----------  Detalles de la tabla  ----------*/
    foreach ($responseDetalle as $key => $value) {
        $pdf->Cell(90,7,iconv("UTF-8", "ISO-8859-1",$value["producto"]),'L',0,'C');
        $pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",$value["cantidad"]),'L',0,'C');
        $pdf->Cell(25,7,iconv("UTF-8", "ISO-8859-1",$value["precio"]),'L',0,'C');
        $pdf->Cell(19,7,iconv("UTF-8", "ISO-8859-1",$value["total"]),'L',0,'C');
        $pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1",$value["codigo"]),'LR',0,'C');
        $pdf->Ln(7);

        $total += $value["precio"];
    }

	
	/*----------  Fin Detalles de la tabla  ----------*/


	
	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #
	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),'T',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1",$total / 1.12),'T',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","IVA (12%)"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1",$total / 1.12 * .12),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');


	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),'T',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1",$total),'T',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","TOTAL PAGADO"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1", $responseFactura["total"]),'',0,'C');


	$pdf->Ln(12);

	$pdf->SetFont('Arial','',9);

	$pdf->SetTextColor(39,39,51);
	$pdf->MultiCell(0,9,iconv("UTF-8", "ISO-8859-1","*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar esta factura ***"),0,'C',false);

	$pdf->Ln(9);

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_Nro_1.pdf",true);