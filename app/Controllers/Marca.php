<?php 
namespace App\Controllers;
use App\Models\MarcaModel;
use CodeIgniter\Config\BaseConfig;


class marca extends BaseController
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
        $MarcaModel = new MarcaModel();
        $data['title'] = 'Lista de Marca';
        $data['home'] = 'Marca';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$MarcaModel->seleccionar();
        return $this->load_view('board/marca',$data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $MarcaModel = new MarcaModel();
        $data['title'] = 'Crear nueva Marca';
        $data['home'] = 'Marca';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'marca'    => 'required|min_length[3]|max_length[255]|is_unique[marca.name]',    
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/marca',$data);
        }
        $datos = [
            'marca'        => $_POST["marca"],
        ];
        $MarcaModel->insertar($datos);
        return redirect()->route('marca');
        die();
    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $MarcaModel = new MarcaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        $data['datos'] = $MarcaModel->encontrar($id);
        $data['title'] = 'Actualizar Marca';
        $data['home'] = 'Marca';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'marca'    => 'required|min_length[3]|max_length[255]|is_unique[marca.name,idmarca,{id}]',    
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/marca',$data);
        }
        $datos = [
            'marca'        => $_POST["marca"],
        ];
        $MarcaModel->actualizar($id,$datos);
        return redirect()->route('marca');
        die();
    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $MarcaModel = new MarcaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}   
        $MarcaModel->delete($id);
        header("Location: ".base_url()."marca/");
        die();

    }
    public function recovery(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $MarcaModel = new MarcaModel();
        $data['title'] = 'Recuperar Marca';
        $data['home'] = 'Marca';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$MarcaModel->view_delete();
        return $this->load_view('recovery/marca',$data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $MarcaModel = new MarcaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        
            $MarcaModel->recovery_data($id);
        
        return redirect()->route('marca');
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
            $MarcaModel = new MarcaModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 9 ;
            $valiadar = $MarcaModel->valiadar($var);
            return $valiadar;
        }
    }
}