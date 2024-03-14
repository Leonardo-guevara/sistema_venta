<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $table = 'roles ';
    protected $primaryKey = 'idroles ';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'detalle'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]'
    ];
    protected $validationMessages = [
        'name' => 'se requiere un nombre'
    ];
    protected $skipValidation = false;
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
        $sql = "SELECT * FROM `roles` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
        // $sql = 'SELECT * FROM Roles WHERE id IN ? AND status = ? AND author = ?';
        // $db->query($sql, [[3, 6], 'live', 'Rick']);
    }
    public function insertar($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `roles` (`name`, `detalle`, `created_at`) VALUES ( ?,?, NOW());";
        $datos['roles'] = strtoupper($datos['roles']);
        $query = $db->query($sql, [$datos['roles'], $datos['detalle']]);
    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `roles` WHERE `idroles` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql, [$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function actualizar($id = null, $datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `roles` SET `name` = ?, `detalle`= ? , `updated_at` = NOW() WHERE `Roles`.`idRoles` = ?;";
        $datos['roles'] = strtoupper($datos['roles']);
        $query = $db->query($sql, [$datos['roles'], $datos['detalle'], $id]);
    }
    public function encontrar_permiso($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `fk_permiso` FROM `permsio_roles` WHERE `fk_roles` = ?;";
        $query = $db->query($sql, [$id]);
        $row = $query->getResultArray();
        return $row;
    }
    public function permiso($id = null, $datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "DELETE FROM `permsio_roles` WHERE `fk_roles` = ?;";
        $db->query($sql, [$id]);
        if (!isset($datos['value'])) {
            return false;
        }
        $permiso = '';
        foreach ($datos['value'] as $key => $value) {
            $permiso = $permiso . '(' . $id . ',' . $value . ')' . ',';
        }
        $permiso = substr($permiso, 0, -1);

        $sql = "INSERT INTO `permsio_roles`(`fk_roles`, `fk_permiso`) VALUES $permiso ;";
        $db->query($sql);

    }
    public function recovery_data($id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `roles` SET `deleted_at` = NULL  WHERE `roles`.`idroles` IN (?);";
        $db->query($sql, [$id]);
    }

    public function view_delete()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `roles` WHERE `deleted_at` IS NOT NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function valiadar($var = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `permsio_roles` WHERE `fk_roles` = ? AND `fk_permiso` = ?;";
        $query = $db->query($sql, [$var['roles'], $var['permiso']]);
        $row = $query->getRowArray();
        return $row;
    }

}