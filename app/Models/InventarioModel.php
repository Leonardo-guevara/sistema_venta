<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarioModel extends Model
{
    protected $table      = 'movimiento_inventario';
    protected $primaryKey = 'iddetalle_movimiento';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'fecha',
        'fk_usuario',
        'fk_producto',
        'cantidad'
    ];
    public function seleccionar($data = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT movimiento_inventario.`iddetalle_movimiento` AS id, 
        movimiento_inventario.`name` as movimiento, 
        movimiento_inventario.`fecha` AS fecha , 
        usuario.usuario  as usuario ,
        producto.name AS producto, 
        producto.codigo AS codigo ,
        producto.stocks AS stocks ,
        movimiento_inventario.cantidad AS cantidad 
        FROM `movimiento_inventario` 
        INNER JOIN usuario ON movimiento_inventario.fk_usuario = usuario.idusuario 
        INNER JOIN producto ON movimiento_inventario.producto = producto.codigo 
        WHERE  fecha BETWEEN ? AND ?
         ;";
        $query = $db->query($sql,[$data['date_inicio'],$data['date_final']]);
        $row = $query->getResultArray();
        return $row;

    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `idproducto`,`name`,`codigo`,`stocks`,`precio_compra`, `precio_venta`  
        FROM `producto` WHERE `codigo` = ? AND `deleted_at`<=> NULL ;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        // $row = $query->getResultArray();
        return $row;
    }
    public function agregar($data = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `movimiento_inventario`(`name`,`fecha`,`fk_usuario`,`producto`, `cantidad`) 
        VALUES ( ?, current_timestamp(),?,?,?);";
        $db->query($sql,[
            $data['name'],
            $data['fk_usuario'],
            $data['fk_producto'],
            $data['cantidad']
        ]);
        $sql = "UPDATE producto SET stocks = stocks + ? WHERE `codigo` = ?;";
        $db->query($sql,[$data['cantidad'],$data['fk_producto'] ]);

        $sql = "INSERT INTO `compra`
        ( `producto`,`name`,
        `cantidad`, `precio_compra`,
        `precio_venta`, `usuario`)
         VALUES ( ?,?,?,?,?,?)";
        $query = $db->query($sql,[
            $data['fk_producto'], $data['name'],
            $data['cantidad'],$data['precio_compra'],
            $data['precio_venta'],$data['fk_usuario'] 
        ]);

    }
    // public function create_name(Type $var = null)
    // {
    //     # code...
    //     if ($stocks['stocks'] > $datos['stocks']) {
    //         $cantidad = ($datos['stocks'] - $stocks['stocks']);
    //         $movimiento = 'Se ha quitado Producto';
    //         // echo $movimiento . $cantidad;
    //     }elseif ($datos['stocks'] < $stocks['stocks']) {
    //         $cantidad = ($datos['stocks'] - $stocks['stocks']);
    //         $movimiento = 'Se ha aumentado Producto';
    //         // echo $movimiento . $cantidad;
    //     }else {
    //         $cantidad = 0;
    //         $movimiento = 'No se movido Producto';
    //         // echo $movimiento . $cantidad;
    //     }

    //     $sql_movi = "INSERT INTO `movimiento_inventario`( 
    //         `name`, `fecha`, `fk_usuario`, `fk_producto`,
    //         `cantidad` VALUES (?, NOW() ,?,?,?);";
    //     $db->query($sql_movi,[
    //         $movimiento, 1, $datos['codigo'], intval($cantidad) 
    //     ]);

    //     $sql = "INSERT INTO `movimiento_inventario`( 
    //         `name`, `fecha`, `fk_usuario`, `fk_producto`,
    //         `cantidad`) VALUES ( ?, NOW(),?,?,?)";
    //     $query = $db->query($sql,[
    //         'Entrada Inventario',1,
    //         $datos['codigo'],$datos['stocks'] 
    //     ]);
    // }

    public function valiadar($var = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `permsio_roles` WHERE `fk_roles` = ? AND `fk_permiso` = ?;";
        $query = $db->query($sql,[$var['roles'],$var['permiso']]);
        $row = $query->getRowArray();
        return $row;
    }

}