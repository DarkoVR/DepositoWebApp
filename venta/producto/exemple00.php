<?php
    include('../deposito.class.php');
    if (isset($_GET['id_venta'])) {
        $param['id_venta']=$_GET['id_venta'];
        $datos=$deposito->consultar("SELECT ca.id_venta as Orden, concat(cl.nombre,' ',cl.apaterno,' ',cl.amaterno) as nombCliente, concat(em.nombre,' ',em.apaterno,' ',em.amaterno) as nombEmpleado,ca.fecha,p.producto,pr.sku,pr.presentacion,cd.cantidad,cd.precio_unitario,cd.descuento_aplicado,cd.precio_unitario*cd.cantidad as subtotal
        from venta ca join cliente cl on ca.id_cliente=cl.id_cliente 
                    join empleado em on ca.id_empleado=em.id_empleado
                    join detalle_venta cd on ca.id_venta=cd.id_venta
                    join presentacion pr on cd.sku=pr.sku
                    join producto p on pr.id_producto=p.id_producto
                    where cd.id_venta=:id_venta",$param);
        require_once($_SERVER['DOCUMENT_ROOT'].'/Deposito/vendor/autoload.php');
        $content='<page>';
        $content.='<h1>Deposito Vazquez</h1>';
        $content.='<p>Empleado: '.$datos[0]['nombEmpleado'].'</p>';
        $content.='<p>Cliente: '.$datos[0]['nombCliente'].'</p>';
        $content.='<p>Fecha: '.$datos[0]['fecha'].' </p>';
        $content.= '<table class="table" style="text-align: center;">';
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
                $content.= '<td>'.$value['cantidad'].'</td>';
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