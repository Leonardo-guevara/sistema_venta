<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table      = 'persona';
    protected $primaryKey = 'idpersona';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name','email','telefono','cedula'];

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
        $sql = "SELECT * FROM `persona` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
        // $sql = 'SELECT * FROM persona WHERE id IN ? AND status = ? AND author = ?';
        // $db->query($sql, [[3, 6], 'live', 'Rick']);
    }
    public function insertar($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `persona` (`name`, `created_at`) VALUES ( ?, NOW());";
        $sql = "INSERT INTO persona (nombre, apellidos, edad) VALUES ('Nombre', 'Apellidos', 25) 
        WHERE NOT EXISTS (SELECT nombre FROM persona WHERE nombre = 'Daniel')";
        $query = $db->query($sql,[$datos['persona']]);
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
        // $sql = "INSERT INTO `un idad` (`name`, `created_at`, ) VALUES ( ?, NOW());";
        $sql = "UPDATE `persona` SET `name` = ?,  `updated_at` = NOW() WHERE `persona`.`idpersona` IN (?);";
        $query = $db->query($sql,[$datos['persona'],$id]);

        # code...
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