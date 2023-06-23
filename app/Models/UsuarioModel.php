<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
    'fk_persona',
    'password',
    'foto',
    'user',
    'detalle',
    'roles'
    ];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [
        'contrasenha' => [
            'required' => 'SALIO MAL',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;



    public function seleccionar()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `usuario` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }

    public function persona()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `persona` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function roles()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `roles` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function insertar($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO `usuario` (`fk_persona`, `password`, `foto`, `usuario`, `detalle`, `fkroles`, `created_at`) 
        VALUES ( ?,?,?,?,?,?, NOW());";
        $sha512_password = hash('sha512',$datos['password']);
        $db->query($sql,[$datos['fk_persona'],$sha512_password,$datos['foto'],$datos['usuario'],$datos['detalle'],$datos['fkroles']]);
        //correo
        $sql = "SELECT `email` FROM `persona` WHERE `idpersona` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$datos['fk_persona']]);
        $row = $query->getRowArray();
        return $row;
    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `usuario` WHERE `idusuario` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function actualizar($id = null ,$datos = null)
    {
        $db = \Config\Database::connect();
        // $sql = "INSERT INTO `un idad` (`name`, `created_at`, ) VALUES ( ?, NOW());";
        $sql = "UPDATE `usuario` SET `fk_persona` = ?, `foto` = ?, `usuario` = ?, `detalle` = ?, `fkroles` = ?,  `updated_at` = NOW() WHERE `usuario`.`idusuario` IN (?);";
        $query = $db->query($sql,[$datos['fk_persona'],$datos['foto'],$datos['usuario'],$datos['detalle'],$datos['fkroles'],$id]);
    }

    public function login($data = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `idusuario`, `usuario`, `fk_persona`, `foto`, `detalle`, `fkroles` FROM `usuario` WHERE `usuario` = ? and `password` = ? and `deleted_at` <=> NULL;";
        $sha512_password = hash('sha512', $data['password']);
        $query = $db->query($sql,[$data['user'],$sha512_password]);
        $user = $query->getRowArray();
        if (empty($user)) {
            $error = 'ALgo salio mal intente de nuevo';
            return $error ;
        }
        $sql = "SELECT fk_permiso FROM `permsio_roles` WHERE `fk_roles` = ?;";
        $query = $db->query($sql,[$user['fkroles']]);
        $permiso = $query->getResultArray();
        $user['permiso'] =  $permiso;
        return $user;
    }
    public function contrasenha( $length = null)
    {
        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
        $max = strlen($pattern)-1;
        for($i = 0; $i < $length; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        return $key;
    }
    public function change_password( $data = null)
    {
        $contrasenha = $data['contrasenha'];
        $usuario = $data['usuario'];
        $contrasenha = hash('sha512', $contrasenha);
        $db = \Config\Database::connect();
        $sql = "SELECT `idusuario` FROM `usuario` WHERE  `usuario`.`usuario`  = ? and  `usuario`.`password` = ?;";
        $query = $db->query($sql,[$usuario,$contrasenha]);
        $buscar = $query->getRowArray();
        if (empty($buscar)) {
        
            $error = '<ul><li> Ecribe bien la contrasenha anteriol </li></ul>'  ;
            return $error ;
        }
        $new_password = $data['password'];
        $new_password = hash('sha512', $new_password);
        $sql = "UPDATE `usuario` SET `password`= ? WHERE `idusuario` = ?;";
        $db->query($sql,[$new_password,$buscar['idusuario']]);
        // return true;
    }
    public function update_password($id = null ,$datos = null)
    {
        $db = \Config\Database::connect();
        $sha512_password = hash('sha512', $datos);
        $sql = "UPDATE `usuario` SET `password`= ? WHERE `idusuario` = ?;";
        $query = $db->query($sql,[$sha512_password,$id]);
    }
    public function delete_user($id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `usuario` SET `deleted_at` = NOW() WHERE `usuario`.`idusuario` IN (?);";
        $db->query($sql,[$id]);
        # code...
    }

    public function recovery_user( $id )
    {        
        $db = \Config\Database::connect();
        $sql = "UPDATE `usuario` SET `deleted_at` = NULL  WHERE `usuario`.`idusuario` IN (?);";
        $db->query($sql,[$id]);
    }

    public function view_delete()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `usuario` WHERE `deleted_at` IS NOT NULL;";
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