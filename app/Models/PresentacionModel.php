<?php

namespace App\Models;

use CodeIgniter\Model;

class PresentacionModel extends Model
{
    protected $table      = 'presentacion ';
    protected $primaryKey = 'idpresentacion ';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name'];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [ 
        'name'     => 'required|min_length[3]'
    ];
    protected $validationMessages   = [
        'name'     => 'se requiere un nombre'
    ];
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
        $sql = "SELECT 
        `presentacion`.idpresentacion,
        `presentacion`.name,
        `unidad`.name as unidad 
        FROM presentacion INNER JOIN unidad  
        ON `presentacion`.fk_unidad = `unidad`.idunidad 
        WHERE `presentacion`.`deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function unidad()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `unidad` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function insertar($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `presentacion` (`name`,`fk_unidad`,`created_at`) VALUES ( ?,?, NOW());";
        $datos['presentacion'] = strtoupper($datos['presentacion']);
        $query = $db->query($sql,[$datos['presentacion'],$datos['fk_unidad']]);
    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `presentacion` WHERE `idpresentacion` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function actualizar($id = null ,$datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `presentacion` SET `name` = ?, `fk_unidad` = ?,  `updated_at` = NOW() WHERE `presentacion`.`idpresentacion` IN (?);";
        $datos['presentacion'] = strtoupper($datos['presentacion']);
        $query = $db->query($sql,[$datos['presentacion'],$datos['fk_unidad'],$id]);
    }
    public function recovery_data($id )
    {        
        $db = \Config\Database::connect();
        $sql = "UPDATE `presentacion` SET `deleted_at` = NULL  WHERE `presentacion`.`idpresentacion` IN (?);";
        $db->query($sql,[$id]);
    }

    public function view_delete()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT
        `presentacion`.idpresentacion,
        `presentacion`.name,
        `unidad`.name as unidad , 
        `presentacion`.created_at, 
        `presentacion`.deleted_at 
        FROM presentacion INNER JOIN unidad  
        ON `presentacion`.fk_unidad = `unidad`.idunidad 
        WHERE `presentacion`.`deleted_at` IS NOT NULL;";
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