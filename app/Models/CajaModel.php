<?php

namespace App\Models;

use CodeIgniter\Model;

class cajaModel extends Model
{
    protected $table      = 'caja';
    protected $primaryKey = 'idcaja';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
    'name','detalle'
    ];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];


    public function seleccionar()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `caja` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
        // $sql = 'SELECT * FROM unidad WHERE id IN ? AND status = ? AND author = ?';
        // $db->query($sql, [[3, 6], 'live', 'Rick']);
    }

   
    public function insertar($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `caja` (`name`, `detalle`, `created_at`) 
        VALUES ( ?,?, NOW());";
        $datos['caja'] = strtoupper($datos['caja']);
        $db->query($sql,[$datos['caja'],$datos['detalle']]);
    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `caja` WHERE `idcaja` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function actualizar($id = null ,$datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `caja` SET `name` = ?, `detalle` = ?, `updated_at` = NOW() WHERE `caja`.`idcaja` IN (?);";
        $datos['caja'] = strtoupper($datos['caja']);
        $db->query($sql,[$datos['caja'],$datos['detalle'],$id]);
    }
    public function delete_caja($id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `caja` SET `deleted_at` = NOW() WHERE `caja`.`idcaja` IN (?);";
        $db->query($sql,[$id]);
        # code...
    }
    public function usuario( $id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `idusuario`, `usuario`, `deleted_at` FROM `usuario` WHERE`deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function cajas_abiertas()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT`fkcaja` , `horario_inicio`,`horario_final` FROM `arqueo_caja` WHERE `horario_final` <=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function historial( $id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `arqueo_caja`.`idarqueo_caja`,
         caja.name AS fkcaja, usuario.usuario AS fk_usuario, 
         arqueo_caja.`monto_inicial`, arqueo_caja.`monto_final`, 
         arqueo_caja.`total_ventas`, arqueo_caja.`horario_inicio`, 
         arqueo_caja.`horario_final` 
         FROM `arqueo_caja` INNER JOIN caja on fkcaja = caja.idcaja 
         INNER JOIN usuario on fk_usuario = usuario.idusuario 
         WHERE  fkcaja = ? AND`horario_final` IS NOT NULL;";

        $query = $db->query($sql,[$id]);
        $row = $query->getResultArray();
        return $row;
    }
    public function recovery_data( $id )
    {        
        $db = \Config\Database::connect();
        $sql = "UPDATE `caja` SET `deleted_at` = NULL  WHERE `caja`.`idcaja` IN (?);";
        $db->query($sql,[$id]);
    }

    public function view_delete()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `caja` WHERE `deleted_at` IS NOT NULL;";
        $query = $db->query($sql);
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