<?php

namespace App\Models;

use CodeIgniter\Model;

class UnidadModel extends Model
{
    protected $table      = 'unidad ';
    protected $primaryKey = 'idunidad ';

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
        $sql = "SELECT * FROM `unidad` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function insertar($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `unidad` (`name`, `created_at`) VALUES ( ?, NOW());";
        $datos['unidad'] = strtoupper($datos['unidad']);
        $db->query($sql,[$datos['unidad']]);
    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `unidad` WHERE `idunidad` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function actualizar($id = null ,$datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `unidad` SET `name` = ?,  `updated_at` = NOW() WHERE `unidad`.`idunidad` IN (?);";
        $datos['unidad'] = strtoupper($datos['unidad']);
        $db->query($sql,[$datos['unidad'],$id]);
    }
    public function recovery_data( $id )
    {        
        $db = \Config\Database::connect();
        $sql = "UPDATE `unidad` SET `deleted_at` = NULL  WHERE `unidad`.`idunidad` IN (?);";
        $db->query($sql,[$id]);
    }

    public function view_delete()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `unidad` WHERE `deleted_at` IS NOT NULL;";
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