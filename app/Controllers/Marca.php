<?php 
namespace App\Controllers;
use App\Models\MarcaModel;
use CodeIgniter\Config\BaseConfig;


class marca extends BaseController
{
    public function __construct(){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();	

	}
	public function index()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $MarcaModel = new MarcaModel();
        $data['title'] = 'Lista de Marca';
        $data['data'] =$MarcaModel->seleccionar();
        return $this->load_view('board/marca',$data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        helper('form');
        $MarcaModel = new MarcaModel();
        $data['title'] = 'Crear nueva Marca';
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

    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        helper('form');
        $MarcaModel = new MarcaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        $data['datos'] = $MarcaModel->encontrar($id);
        $data['title'] = 'Actualizar Marca';
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

    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $MarcaModel = new MarcaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}   
        $MarcaModel->delete($id);
        header("Location: ".base_url()."marca/");
    }
    public function recovery(){
        if ($this->validar() == NULL) {
            return false;
    
        }
        $MarcaModel = new MarcaModel();
        $data['title'] = 'Recuperar Marca';
        $data['data'] =$MarcaModel->view_delete();
        return $this->load_view('recovery/marca',$data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return false;
    
        }
        $MarcaModel = new MarcaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        
            $MarcaModel->recovery_data($id);
        
        return redirect()->route('marca');

    }
    protected function load_view( $view = null, $data = null)
    {
        
        $data['home'] = 'Marca';
        $data['principal']= $_SESSION['usuario'];
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