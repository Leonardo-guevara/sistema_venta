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
    'email',
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
        $sql = "INSERT INTO `usuario` (`email`, `password`, `foto`, `usuario`, `detalle`, `fkroles`, `created_at`) 
        VALUES ( ?,?,?,?,?,?, NOW());";
        $sha512_password = hash('sha512',$datos['password']);
        $db->query($sql,[$datos['email'],$sha512_password,$datos['foto'],$datos['usuario'],$datos['detalle'],$datos['fkroles']]);
        //correo
        $sql = "SELECT `email` FROM `persona` WHERE `idpersona` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$datos['email']]);
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
        $sql = "UPDATE `usuario` SET `email` = ?, `foto` = ?, `usuario` = ?, `detalle` = ?, `fkroles` = ?,  `updated_at` = NOW() WHERE `usuario`.`idusuario` IN (?);";
        $query = $db->query($sql,[$datos['email'],$datos['foto'],$datos['usuario'],$datos['detalle'],$datos['fkroles'],$id]);
    }

    public function login($data = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `idusuario`, `usuario`, `email`, `foto`, `detalle`, `fkroles` FROM `usuario` WHERE `usuario` = ? and `password` = ? and `deleted_at` <=> NULL;";
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
   
    public function buscar_contrasenha( $var = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT usuario.idusuario,`password` FROM `usuario` 
        WHERE  email = ?;";
         $query = $db->query($sql,[$var]);
         $user = $query->getRowArray();
         if (!empty($user)) {
            $length = 8;
            $key = "";
            $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
            $max = strlen($pattern)-1;
            for($i = 0; $i < $length; $i++){
                $key .= substr($pattern, mt_rand(0,$max), 1);
            }
            
        $contrasenha = hash('sha512', $key);
            $sql = 'UPDATE `usuario` SET `password`= ? WHERE `idusuario` = ?;';
            $db->query($sql,[$contrasenha,$user['idusuario']]);
            return $key;
        }
         return 'Este correo no existe';

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
        
        $usuario = $data['usuario'];
        $sha512_password = hash('sha512', $data['contrasenha']);
        $db = \Config\Database::connect();
        $sql = "SELECT `idusuario` FROM `usuario` WHERE  `usuario`  = ? and  `password` = ?;";
        $query = $db->query($sql,[$usuario,$sha512_password]);
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