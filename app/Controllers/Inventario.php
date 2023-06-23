<?php 
namespace App\Controllers;
use App\Models\InventarioModel;
use CodeIgniter\Config\BaseConfig;


class Inventario extends BaseController
{
    public function __construct(){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();	
        $this->helper = helper(array('form', 'url'));
        
	}
	public function index()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $InventarioModel = new InventarioModel();
        $data['title'] = 'Lista de Inventario';
        $data['home'] = 'Inventario';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$InventarioModel->seleccionar();
        return $this->load_view('board/inventario',$data);

    }
    public function json()
    {
        $InventarioModel = new InventarioModel();
        if(!isset($_GET["code"]) and empty($_GET['code'])) { $code = '0';} else {$code = $_GET["code"];} 
        $json = json_encode($InventarioModel->encontrar($code));
        return $json;
    }
    public function agregar()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $InventarioModel = new InventarioModel();
        $data['title'] = 'Agregar Producto';
        $data['home'] = 'Inventario';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'code'    => 'required', 
            'stockt'    => 'required|is_natural_no_zero',    
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/agregar',$data);
        }
        $datos = [
            'name'          => 'agregar',
            'fk_usuario'    => $this->session->get('idusuario'),
            'fk_producto'   => $_POST["code"],
            'cantidad'      => $_POST["stockt"],

        ];
        $InventarioModel->agregar($datos);
        return redirect()->route('agregar');
        die();
    }
    public function Ajuste(Type $var = null)
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $InventarioModel = new InventarioModel();
        $data['title'] = 'Ajuste de Producto';
        $data['home'] = 'Inventario';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'code'    => 'required', 
            'stockt'    => 'required|numeric',    
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/agregar',$data);
        }
        $datos = [
            'name'          => 'ajuste',
            'fk_usuario'    => $this->session->get('idusuario'),
            'fk_producto'   => $_POST["code"],
            'cantidad'      => $_POST["stockt"],

        ];
        $InventarioModel->agregar($datos);
        return redirect()->route('Inventario');
        die();
    }
    protected function load_view( $view = null, $data = null)
    {
        echo view('head',$data);
        echo view('header');
        echo view('sidebar');
        echo view($view,$data);
        echo view('footer');
    }
    protected function validar() {
        if (isset($_SESSION["fkroles"])) {
            $InventarioModel = new InventarioModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 4 ;
            $valiadar = $InventarioModel->valiadar($var);
            return $valiadar;
        }
    }
}