<?php

namespace App\Models;

use CodeIgniter\Email\Email;
use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table      = 'persona';
    protected $primaryKey = 'idpersona';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre','email','telefono','cedula'];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [ 
        'nombre'     => 'required|min_length[3]'
    ];
    protected $validationMessages   = [
        'nombre'     => 'se requiere un nombre'
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
        $sql = "SELECT * FROM `persona` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function insertar($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `persona` (`nombre`, `email`, `telefono`, `cedula`, `created_at`) VALUES ( ?,?,?,?, NOW());";
        $datos['persona'] = strtoupper($datos['persona']);
        $datos['telefono'] = strtoupper($datos['telefono']);
        $datos['cedula'] = strtoupper($datos['cedula']);
        if (isset($datos['email'])) {
            return  $db->query($sql,[$datos['persona'],null,$datos['telefono'],$datos['cedula']]);
        }
        $datos['email'] = strtoupper($datos['email']);
        return $db->query($sql,[$datos['persona'],$datos['email'],$datos['telefono'],$datos['cedula']]);
       
    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `persona` WHERE `idpersona` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function actualizar($id = null ,$datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `persona` SET `nombre` = ?,  `updated_at` = NOW() WHERE `persona`.`idpersona` IN (?);";
        $datos['persona'] = strtoupper($datos['persona']);
        $db->query($sql,[$datos['persona'],$id]);
    }
    // public function delete($id)
    // {
    //     $db = \Config\Database::connect();
    //     $sql = "UPDATE `persona` SET `deleted_at` = NOW() WHERE `persona`.`idpersonao` IN (?);";
    //     $db->query($sql,[$id]);
    //     # code...
    // }
    public function recovery_user( $id )
    {        
        $db = \Config\Database::connect();
        $sql = "UPDATE `persona` SET `deleted_at` = NULL  WHERE `persona`.`idpersona` IN (?);";
        $db->query($sql,[$id]);
    }

    public function view_delete()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `persona` WHERE `deleted_at` IS NOT NULL;";
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