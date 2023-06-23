<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table      = 'categoria';
    protected $primaryKey = 'idcategoria';

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

    public function seleccionar()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `categoria` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function insertar($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `categoria` (`name`, `created_at`) VALUES ( ?, NOW()) ;";
        $datos['categoria'] = strtoupper($datos['categoria']);
        $query = $db->query($sql,[$datos['categoria']]);
    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `categoria` WHERE `idcategoria` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function actualizar($id = null ,$datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `categoria` SET `name` = ?,  `updated_at` = NOW() WHERE `categoria`.`idcategoria` IN (?);";
        $datos['categoria'] = strtoupper($datos['categoria']);
        $db->query($sql,[$datos['categoria'],$id]);
    }
    public function recovery_data( $id )
    {        
        $db = \Config\Database::connect();
        $sql = "UPDATE `categoria` SET `deleted_at` = NULL  WHERE `categoria`.`idcategoria` IN (?);";
        $db->query($sql,[$id]);
    }

    public function view_delete()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `categoria` WHERE `deleted_at` IS NOT NULL;";
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