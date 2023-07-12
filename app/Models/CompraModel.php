<?php

namespace App\Models;

use CodeIgniter\Model;

class CompraModel extends Model
{
    protected $table      = 'marca';
    protected $primaryKey = 'idmarca';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    public function seleccionar($data = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `idcompra`,compra.`producto` as codigo,
         producto.name AS producto, compra.`name`,
         `cantidad`, compra.`precio_compra`,
         compra.`precio_venta`, usuario.usuario, compra.`created_at` 
         FROM `compra` 
         INNER JOIN usuario on usuario.idusuario = compra.usuario 
         INNER JOIN producto on producto.codigo = compra.producto
         WHERE  compra.`created_at` BETWEEN ? AND ?;";
        $query = $db->query($sql,[$data['date_inicio'],$data['date_final']]);
        $row = $query->getResultArray();
        return $row;
    }
    public function valiadar($var = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `permsio_roles` WHERE `fk_roles` = ? AND `fk_permiso` = ?;";
        $query = $db->query($sql,[$var['roles'],$var['permiso']]);
        $row = $query->getRowArray();
        return $row;
    }
   
}