<?php

namespace App\Models;
use CodeIgniter\Model;

class VentaModel extends Model {
	

	public function validar_caja($data = null){
        $db = \Config\Database::connect();
		$sql = "SELECT 
			`idarqueo_caja`, 
			caja.name as caja, 
			usuario.usuario as usuario, 
			`fk_usuario`,
			`monto_inicial`, 
			`monto_final`, 
			`total_ventas`, 
			`horario_inicio`, 
			`horario_final`
		 	FROM `arqueo_caja` 
		 	INNER JOIN caja on arqueo_caja.fkcaja = caja.idcaja
			INNER JOIN usuario ON arqueo_caja.fk_usuario =usuario.idusuario
			WHERE `fk_usuario` =? AND `horario_final` <=>NULL;";
		$query = $db->query($sql,[$data['user']]);
        $arqueo = $query->getRowArray();
		if (!empty($arqueo)) {
			$sql = "SELECT * FROM `venta` WHERE `created_at` <=> null AND `deleted_at` <=> NULL AND `fk_arqueo` = ?;";
			$query = $db->query($sql,[$arqueo['idarqueo_caja']]);
			$row = $query->getRowArray();
			if (empty($row)) {
				$sql = "INSERT INTO `venta`( `fk_arqueo`, `fk_persona`) VALUES (?,'2');";
				$db->query($sql,[$arqueo['idarqueo_caja']]);
				return $arqueo;
			}
			return $arqueo;
        } 
		return false;
    }

	function seleccionar($data = null) {
		$db = \Config\Database::connect();
        $sql = "SELECT `idventas`, `fk_arqueo`, persona.nombre AS `fk_persona`, venta.`created_at`, `total`, venta.`updated_at`, venta.`deleted_at` FROM `venta`  
		INNER JOIN persona ON persona.idpersona = venta.fk_persona 
		WHERE `fk_arqueo` = ?;";
        $query = $db->query($sql,[$data]);
        $row = $query->getResultArray();
        return $row;
	}

	function view_venta($data = null) {	
        $db = \Config\Database::connect();
		$sql = "SELECT * FROM `venta` WHERE `created_at` <=> null AND `deleted_at` <=> NULL AND `fk_arqueo` = ?;";
		$query = $db->query($sql,[$data]);
        $row = $query->getRowArray();
        return $row;
	}

	function cargar_producto($data = null)  {
		$db = \Config\Database::connect();
		$code = $data["code"] ;
		$venta =$data["venta"];
		// verificar si hay stock de producto
		$sql = "SELECT `idproducto`, `name`, `codigo`, `stocks`, `minimo`,  `precio_venta` ,`precio_compra`
		FROM `producto` WHERE `codigo` = ? AND `stocks` >= 1 AND `deleted_at`<=> NULL ;";
        $query = $db->query($sql,[$code]);
        $producto = $query->getRowArray();
		if (!isset($producto)) {
			return false;
		}
		// verificar detalle de venta 
		$sql = "SELECT `fk_producto`, `fk_venta`, `cantidad`, `total` 
		FROM `detalle_venta` WHERE `fk_producto` = ? AND `fk_venta` = ?;";
        $query = $db->query($sql,[$producto['idproducto'],$venta]);
		$verificar = $query->getRowArray();
		if (!isset($verificar)) {
			// agregar nueva detalle de venta
			$sql = "INSERT INTO `detalle_venta` (`fk_producto`, `fk_venta`, `cantidad`,`subtotal`, `total` ,`ganancia`) 
			VALUES (?,?,'1',?,?,?);";
			$ganancia = ($producto['precio_venta'] - $producto['precio_compra']);
			$db->query($sql,[$producto['idproducto'],$venta,$producto['precio_venta'],$producto['precio_venta'],$ganancia]);
			$sql = "UPDATE `producto` SET `stocks`= `stocks` - 1 WHERE `idproducto` = ?;";
			$db->query($sql,[$producto['idproducto']]);
			return true;
		}
		// agregar aumentar detalle de venta
		$sql = "UPDATE `detalle_venta` SET 
			`cantidad`= `cantidad` + 1,
			`total`= `total` + ?,
			`ganancia` = `ganancia` + ?
		WHERE `fk_producto` = ? AND `fk_venta` = ?;";
		$ganancia = ($producto['precio_venta'] - $producto['precio_compra']);
		$db->query($sql,[$producto['precio_venta'],$ganancia,$producto['idproducto'],$venta]);

		$sql = "UPDATE `producto` SET `stocks`= `stocks` - 1 WHERE `idproducto` = ?;";
		$db->query($sql,[$producto['idproducto']]);
		return true;
	}

	function delete_barcode($data = null) {
		$db = \Config\Database::connect();
		$code = $data["code"] ;
		$venta =$data["venta"];
		// verificar si existe de producto
		$sql = "SELECT `idproducto`, `name`, `codigo`, `stocks`, `minimo`,  `precio_venta` ,`precio_compra`
		FROM `producto` WHERE `codigo` = ?  AND `deleted_at`<=> NULL ;";
		$query = $db->query($sql,[$code]);
		$producto = $query->getRowArray();
		if (!isset($producto)) {
			return false;
		} 
		$sql = "SELECT `fk_producto`, `fk_venta`, `cantidad`, `total` 
		FROM `detalle_venta` WHERE  `cantidad` > 0 AND `fk_producto` = ? AND `fk_venta` = ?;";
        $query = $db->query($sql,[$producto['idproducto'],$venta]);
		$verificar = $query->getRowArray();
		if (!isset($verificar)) {
			return false;
		}
		if ($verificar['cantidad'] <= 1 ) {
			# code...
			$sql = "DELETE FROM `detalle_venta` WHERE `fk_producto` = ? AND `fk_venta` = ?;";
			$db->query($sql,[$producto['idproducto'],$venta]);
			return true;
		}
		$sql = "UPDATE `detalle_venta` SET 
		`cantidad`= `cantidad` - 1,
		`total`= `total` - ?,
		`ganancia` = `ganancia` - ?
		WHERE `fk_producto` = ? AND `fk_venta` = ?;";
		
		$ganancia = ($producto['precio_venta'] - $producto['precio_compra']);
		$db->query($sql,[$producto['precio_venta'],$ganancia ,$producto['idproducto'],$venta]);
		$sql = "UPDATE `producto` SET `stocks`= `stocks` + 1 WHERE `idproducto` = ?;";
		$db->query($sql,[$producto['idproducto']]);

		return true;
	}

	function detalle_venta($data = null)  {
		$db = \Config\Database::connect();	
		$sql = "SELECT producto.name as `fk_producto`, `fk_venta`, `cantidad`, `subtotal`, `total` \n"
    		. "FROM `detalle_venta` \n"
    		. "INNER JOIN producto on detalle_venta.fk_producto = producto.idproducto\n"
    		. "WHERE  `fk_venta` = ?;";
        $query = $db->query($sql,[$data]);
        $row = $query->getResultArray();
        return $row;
	}

	function finalizar_venta($data = null,$user = null) {
		$db = \Config\Database::connect();
		
		// buscar el ineventario
		$sql = "SELECT producto.codigo AS `fk_producto`, `fk_venta`, `cantidad`, `subtotal`, `total` ,`detalle_venta`.`ganancia`
		FROM `detalle_venta` 
		INNER JOIN producto ON producto.idproducto = detalle_venta.fk_producto
		WHERE `fk_venta` = ?;";
		$query = $db->query($sql,[$data]);
		$row = $query->getResultArray();
		$total_ganado = 0;
		if (isset($row) ){
		// 	// agregar a inventario
			foreach ($row as $value) {
				$sql = "INSERT INTO `movimiento_inventario`( 
					`name`, `fecha`, `fk_usuario`, `producto`,
					`cantidad`) VALUES ( ?, NOW(),?,?,?)";
				$query = $db->query($sql,[
					'venta',$user,
					$value['fk_producto'],-$value['cantidad'] 
				]);
				$total_ganado = $total_ganado + $value['ganancia'] ;
			}
		}
		// update venta
		$sql = "UPDATE `venta` SET `ganancia`= ?, `created_at` = NOW() WHERE `idventas` = ?;";
		$db->query($sql,[$total_ganado ,$data]);
		// update arqueo
		$sql = "SELECT arqueo_caja.idarqueo_caja, venta.total FROM `arqueo_caja` INNER JOIN venta ON venta.fk_arqueo = arqueo_caja.idarqueo_caja WHERE  venta.idventas = ?;";
		$query = $db->query($sql,[$data]);
		$arqueo = $query->getRowArray();
		if (isset($arqueo)) {
			$sql = "UPDATE `arqueo_caja` SET `total_ventas`= `total_ventas` + ?  , `monto_final` = `monto_final` + ? WHERE  `idarqueo_caja` = ?;";
			$db->query($sql,[$arqueo['total'] ,$total_ganado ,$arqueo['idarqueo_caja']]);
			return true;
		} 
		return false;
	}

	function chage_user($data = null) {
		$db = \Config\Database::connect();
		$sql = "UPDATE `venta` SET  `fk_persona` = ? WHERE `idventas` = ?;";
		$db->query($sql,[$data['fk_persona'],$data['idventas']]);
        return true;
	}

	function suma_precio($data = null) {
		
		$db = \Config\Database::connect();
		// resultado de la suma
		$sql = "SELECT SUM( DISTINCT `total`) AS resultado FROM `detalle_venta` WHERE `fk_venta` = ?;";
		$query = $db->query($sql,[$data]);
		$row = $query->getRowArray();
		$sql = "UPDATE `venta` SET `total`= ? WHERE `idventas` = ?;";
		$db->query($sql,[$row['resultado'],$data]);

        return $row;
	}
	function persona() {
		$db = \Config\Database::connect();
        $sql = "SELECT * FROM `persona` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
	}
	function view_producto() {
		$db = \Config\Database::connect();
        $sql = "SELECT `name`, `codigo`, `foto`, `stocks` FROM `producto` WHERE `deleted_at` is null;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
	}
	function usuario() {
		$db = \Config\Database::connect();
        $sql = "SELECT * FROM `usuario` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
	}
	function ajax_reporte($data = null) {
		$db = \Config\Database::connect();
		$sql = "SELECT `idventas`,arqueo_caja.idarqueo_caja, usuario.usuario AS vendedor, arqueo_caja.fk_usuario AS usuario, persona.nombre, venta.`created_at`, `total` FROM `venta` INNER JOIN arqueo_caja ON venta.fk_arqueo = arqueo_caja.idarqueo_caja INNER JOIN persona ON persona.idpersona = venta.fk_persona INNER JOIN usuario ON usuario.idusuario = arqueo_caja.fk_usuario \n"
		. "WHERE arqueo_caja.fk_usuario = ? AND venta.created_at BETWEEN ? AND ?;";
		if ($data['usuario'] == 'true') {
			$data['usuario'] = true;
		}
		// $fecha = "2018-03-29 15:20:40";

		$query = $db->query($sql,[$data['usuario'],$data['date_inicio'],$data['date_final']]);
		$row = $query->getResultArray();
		return $row;
	}

	public function valiadar($var = null){
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `permsio_roles` WHERE `fk_roles` = ? AND `fk_permiso` = ?;";
        $query = $db->query($sql,[$var['roles'],$var['permiso']]);
        $row = $query->getRowArray();
        return $row;
    } 
	function view_recibo($data = null) {
		
    $db = \Config\Database::connect();
		$sql = "SELECT `idventas`, usuario.usuario, persona.nombre , persona.cedula ,venta.`created_at`, `total`\n"
    . "FROM `venta` \n"
    . "INNER JOIN persona ON   venta.fk_persona = persona.idpersona\n"
    . "INNER JOIN arqueo_caja on venta.fk_arqueo = arqueo_caja.idarqueo_caja\n"
    . "INNER JOIN usuario ON arqueo_caja.fk_usuario = usuario.idusuario\n"
    . "WHERE `idventas` = ?;";
	$query = $db->query($sql,[$data]);
	$venta = $query->getRowArray();
	$sql = "SELECT `cantidad`, producto.name as producto, `subtotal`, `total` 
	FROM `detalle_venta` 
	INNER JOIN producto ON producto.idproducto = detalle_venta.fk_producto 
	WHERE `fk_venta` = ?;";
	$query = $db->query($sql,[$data]);
	$detalle = $query->getResultArray();
	$retornar = $venta;
	$retornar['detalle'] = $detalle;
		return $retornar;
	}

}