<?php

namespace App\Models;

use CodeIgniter\Model;

class ArqueoModel  extends Model
{
    protected $table      = 'arqueo_caja';
    protected $primaryKey = 'idarqueo_caja ';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
    'fkcaja','fk_usuario',
    'monto_inicial','monto_final',
    'total_ventas','horario_inicio',
    'horario_final'
    ];



    public function seleccionar()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `arqueo_caja`.`idarqueo_caja`, caja.name AS fkcaja, usuario.usuario AS fk_usuario,
    arqueo_caja.`monto_inicial`, arqueo_caja.`monto_final`,arqueo_caja.`total_ventas`,
    arqueo_caja.`horario_inicio`,arqueo_caja.`horario_final` FROM `arqueo_caja` 
    INNER JOIN caja on fkcaja = caja.idcaja
    INNER JOIN usuario on fk_usuario = usuario.idusuario
    WHERE `horario_final` <=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function historial(Type $var = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `arqueo_caja`.`idarqueo_caja`,\n"
    . "	caja.name AS fkcaja,\n"
    . "	usuario.usuario AS fk_usuario,\n"
    . " arqueo_caja.`monto_inicial`, arqueo_caja.`monto_final`,\n"
    . " arqueo_caja.`total_ventas`, arqueo_caja.`horario_inicio`,\n"
    . " arqueo_caja.`horario_final` \n"
    . " FROM `arqueo_caja` \n"
    . " INNER JOIN caja on fkcaja = caja.idcaja\n"
    . " INNER JOIN usuario on fk_usuario = usuario.idusuario\n"
    . " WHERE `horario_final` IS NOT NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }

    public function usuario()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `usuario` WHERE`deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function caja()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `caja` WHERE`deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }

    public function arqueo_inicio($datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `arqueo_caja` WHERE `fkcaja` = ? AND `horario_final` IS  NULL;";
        $query = $db->query($sql,[$datos['fkcaja']]);
        $caja = $query->getRowArray();
        if (!empty($caja)) {
            $error = 'La caja ya esta ocupada';
            return $error ;
        } 
        $sql = "SELECT * FROM `arqueo_caja` WHERE `fk_usuario` = ? AND `horario_final` IS  NULL;";
        $query = $db->query($sql,[$datos['fk_usuario']]);
        $usuario = $query->getRowArray();
        if (!empty($usuario)) {
            $error = 'El usuario esta ocupado';
            return $error ;
        } 
        $sql = "INSERT INTO `arqueo_caja` (`fkcaja`, `fk_usuario`, `monto_inicial`,`horario_inicio`) 
        VALUES (?,?,?,NOW());";
        $db->query($sql,[$datos['fkcaja'],$datos['fk_usuario'],$datos['monto_inicial']]);
        // $db->query($sql);
        // $row = $query->getRowArray();
        // return $row;
    }
    public function encontrar_arqueo($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `arqueo_caja` WHERE `fkcaja` = ? AND `horario_final`<=> NULL;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function arqueo_final($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE `arqueo_caja` SET `horario_final` = NOW() WHERE `arqueo_caja`.`idarqueo_caja` = ?;";
        $db->query($sql,[$id]);
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