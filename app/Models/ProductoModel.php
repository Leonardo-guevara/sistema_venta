<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'idproducto';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'codigo',
        'foto',
        'stocks',
        'minimo',
        'precio_compra',
        'precio_venta',
        'fk_unidad',
        'fk_categoria',
        'fk_marca',
        'fk_presentacion'
    ];

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
        $sql = "SELECT 
            producto.idproducto AS idproducto,
            producto.codigo AS codigo, 
            producto.name AS name, 
            producto.precio_venta AS precio_venta, 
            producto.stocks AS stocks, 
            unidad.name AS unidad 
            FROM producto 
            INNER JOIN unidad ON producto.fk_unidad = unidad.idunidad 
            WHERE producto.deleted_at <=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
        // $sql = 'SELECT * FROM producto WHERE id IN ? AND status = ? AND author = ?';
        // $db->query($sql, [[3, 6], 'live', 'Rick']);
    }
    public function unidad()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `unidad` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function marca()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `marca` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    public function presentacion()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `presentacion` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $row = $query->getResultArray();
        return $row;
    }
    function selec_presentacion($data) {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `presentacion` WHERE  `fk_unidad` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$data]);
        $row = $query->getResultArray();
        return $row;
	}
	
    public function categoria(Type $var = null)
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
        $sql = "INSERT INTO `producto`
            ( `name`, `codigo`, `foto`, `description`, `stocks`, 
            `minimo`, `precio_compra`, `precio_venta`, `fk_unidad`,
            `fk_categoria`, `fk_marca`, `fk_presentacion`, `created_at`) 
            VALUES (
                    ?,?,?,?,
                    ?,?,?,?,
                    ?,?,?,?,
                    NOW()
                );";
        $db->query($sql,[
            $datos['name'], $datos['codigo'],
            $datos['foto'], $datos['description'],
            $datos['stocks'],
            $datos['minimo'],$datos['precio_compra'],
            $datos['precio_venta'],$datos['fk_unidad'],
            $datos['fk_categoria'],$datos['fk_marca'],
            $datos['fk_presentacion']
        ]);
        $sql = "INSERT INTO `movimiento_inventario`( 
            `name`, `fecha`, `fk_usuario`, `producto`,
            `cantidad`) VALUES ( ?, NOW(),?,?,?)";
        $query = $db->query($sql,[
            'nuevo',$datos['user'],
            $datos['codigo'],$datos['stocks'] 
        ]);
        $sql = "INSERT INTO `compra`
        ( `producto`,`name`,
        `cantidad`, `precio_compra`,
        `precio_venta`, `usuario`)
         VALUES ( ?,?,?,?,?,?)";
        $query = $db->query($sql,[
            $datos['codigo'], 'nuevo',
            $datos['stocks'],$datos['precio_compra'],
            $datos['precio_venta'],$datos['user'] 
        ]);


    }
    public function encontrar($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM `producto` WHERE `idproducto` = ? AND `deleted_at`<=> NULL;";
        $query = $db->query($sql,[$id]);
        $row = $query->getRowArray();
        return $row;
    }
    public function actualizar($id = null ,$datos = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT `stocks` FROM `producto` WHERE `idproducto` = ?;";
        $query = $db->query($sql,[$id]);
        $stocks  = $query->getRowArray();

        $sql = "UPDATE `producto` SET 
            `name` = ?, `codigo` = ?, 
            `foto` = ?, `description` = ?,
            `stocks` = ?, `minimo` = ?, 
            `precio_compra` = ?, `precio_venta` = ?, 
            `fk_unidad` = ?, `fk_categoria` = ?, 
            `fk_marca` = ?, `fk_presentacion` = ?,
            `updated_at` = NOW() 
          WHERE `idproducto` = ?;";

        $db->query($sql,[
            $datos['name'],$datos['codigo'],
            $datos['foto'],$datos['description'],
            $datos['stocks'],$datos['minimo'],
            $datos['precio_compra'],$datos['precio_venta'],
            $datos['fk_unidad'],$datos['fk_categoria'],
            $datos['fk_marca'],$datos['fk_presentacion'],
            $id
        ]);

 
        $agregar = $datos['stocks'] - $stocks['stocks']    ; 
        
        $sql = "INSERT INTO `movimiento_inventario`( 
            `name`, `fecha`, `fk_usuario`, `producto`,
            `cantidad`) VALUES ( ?, NOW(),?,?,?)";
        $query = $db->query($sql,[
            'update',$datos['user'],
            $datos['codigo'], $agregar  
        ]);
        $sql = "INSERT INTO `compra`
        ( `producto`,`name`,
        `cantidad`, `precio_compra`,
        `precio_venta`, `usuario`)
         VALUES ( ?,?,?,?,?,?)";
        $query = $db->query($sql,[
            $datos['codigo'], 'actualizo',
            $agregar,$datos['precio_compra'],
            $datos['precio_venta'],$datos['user'] 
        ]);
    }
    public function recovery_data( $id )
    {        
        $db = \Config\Database::connect();
        $sql = "UPDATE `producto` SET `deleted_at` = NULL  WHERE `producto`.`idproducto` IN (?);";
        $db->query($sql,[$id]);
    }

    public function view_delete()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT 
            producto.idproducto AS idproducto,
            producto.codigo AS codigo, 
            producto.name AS name, 
            producto.precio_venta AS precio_venta, 
            producto.stocks AS stocks, 
            unidad.name AS unidad 
            FROM producto 
            INNER JOIN unidad ON producto.fk_unidad = unidad.idunidad  
            WHERE  producto.deleted_at  IS NOT NULL;";
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