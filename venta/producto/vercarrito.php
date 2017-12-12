<?php
    include('../deposito.class.php');
    if (isset($_GET['id_carrito'])) {
        $param['id_carrito']=$_GET['id_carrito'];
        $datos=$deposito->consultar("select ca.id_carrito as Orden, concat(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) as nombCliente, concat(em.nombre,' ',em.a_paterno,' ',em.a_materno) as nombEmpleado,su.sucursal as sucursal,ca.fecha,p.producto,pr.sku,pr.presentacion,cd.cantidad,cd.precio_unitario,cd.descuento_aplicado,cd.precio_unitario*cd.cantidad as subtotal
        from carrito ca join cliente cl on ca.id_cliente=cl.id_cliente 
                    join empleado em on ca.id_empleado=em.id_empleado
                    join sucursal su on ca.id_sucursal=su.id_sucursal
                    join carrito_detalle cd on ca.id_carrito=cd.id_carrito
                    join presentacion pr on cd.sku=pr.sku
                    join producto p on pr.id_producto=p.id_producto
                    where cd.id_carrito=:id_carrito;",$param);
        require_once($_SERVER['DOCUMENT_ROOT'].'/deposito/vendor/autoload.php');
        $content='<page>';
        $content.='<h1>deposito Galaxia</h1>';
        $content.='<h3>'.$datos[0]['sucursal'].'</h3>';
        $content.='<p>Empleado: '.$datos[0]['nombEmpleado'].'</p>';
        $content.='<p>Cliente: '.$datos[0]['nombCliente'].'</p>';
        $content.='<p>Fecha: '.$datos[0]['fecha'].' </p>';
        $content.= '<table class="table">';
        $content.= '<tr>';
        $content.= '<th>Sku</th>';
        $content.= '<th>Cantidad</th>';
        $content.= '<th>Precio Unitario</th>';
        $content.= '<th>Descuento Aplicado</th>';
        $content.= '<th>Subtotal</th>';
        $content.= '<th></th>';
        $content.= '</tr>';
        $grantotal=0;
        foreach ($datos as $key => $value) {
            $content.= '<tr>';
                $content.= '<th>'.$value['sku'].'</th>';
                $content.= '<th>'.$value['cantidad'].'</th>';
                $content.= '<td>'.round($value['precio_unitario'],2).'</td>';
                $content.= '<td>'.$value['descuento_aplicado'].'%</td>';
                $content.= '<th>$'.round($value['subtotal'],2).'</th>';
            $content.= '</tr>';
            $grantotal+=round($value['subtotal'],2);
        }
        $content.= '<tr><td></td><td></td><td><h3>Gran Total:</h3></td><td><h3>$'.$grantotal.'</h3></td></tr>';
        $content.= '</table>';
        $content.='</page>';
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    //      $html2pdf->setModeDebug();
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $html2pdf->Output('exemple00.pdf');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        } 
    }
?>