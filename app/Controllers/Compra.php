<?php 
namespace App\Controllers;
use App\Models\CompraModel;
use CodeIgniter\Config\BaseConfig;


class Compra extends BaseController
{
    public function __construct(){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();	
        $this->helper = helper(array('form', 'url'));

	}
	public function index(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $CompraModel = new CompraModel();
        $data['title'] = 'Lista de Compra';
        $data['home'] = 'compra';
        $data['principal']= $_SESSION['usuario'];;
        if (!$this->validate([
            'date_final'    => 'required',  
            'date_inicio'    => 'required',      
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('board/compra',$data);
        }
        $datos = [
            'date_inicio'    => $_POST["date_inicio"],
            'date_final'     => $_POST["date_final"],
            
        ];
        $data['data'] =$CompraModel->seleccionar($datos);
        return $this->load_view('board/compra',$data);
    }

    protected function load_view( $view = null, $data = null){
        echo view('head',$data);
        echo view('header');
        echo view('sidebar');
        echo view($view,$data);
        echo view('footer');
    }
    protected function validar() {
        if (isset($_SESSION["fkroles"])) {
            $CompraModel = new CompraModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 15 ;
            $valiadar = $CompraModel->valiadar($var);
            return $valiadar;
        }
    }
}