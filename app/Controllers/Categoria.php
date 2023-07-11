<?php 
namespace App\Controllers;
use App\Models\CategoriaModel;
use CodeIgniter\Config\BaseConfig;


class Categoria extends BaseController
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
        $CategoriaModel = new CategoriaModel();
        $data['title'] = 'Lista de Categoria';
        $data['home'] = 'Categoria';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$CategoriaModel->seleccionar();
        return $this->load_view('board/Categoria',$data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $CategoriaModel = new CategoriaModel();
        $data['title'] = 'Crear Nuevo Categoria';
        $data['home'] = 'Categoria';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'categoria'    => 'required|min_length[3]|max_length[255]|is_unique[categoria.name,idcategoria,{id}]',    
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/Categoria',$data);
        }
        $datos = [
            'categoria'        => $_POST["categoria"],
        ];
        // return $this->load_view('form/Categoria',$data);
        $CategoriaModel->insertar($datos);
        return redirect()->route('categoria');
        die();
    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $CategoriaModel = new CategoriaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        $data['datos'] = $CategoriaModel->encontrar($id);
        $data['title'] = 'Actualizar Nuevo Categoria';
        $data['home'] = 'Categoria';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'categoria'    => 'required|min_length[3]|max_length[255]',    
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/categoria',$data);
        }
        $datos = [
            'categoria'        => $_POST["categoria"],
        ];
        $CategoriaModel->actualizar($id,$datos);
        return redirect()->route('categoria');
        die();
    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $CategoriaModel = new CategoriaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}   
        $CategoriaModel->delete($id);
        header("Location: ".base_url()."categoria");
        die();

    }
    public function recovery(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $CategoriaModel = new CategoriaModel();
        $data['title'] = 'Recuperar Categoria';
        $data['home'] = 'Categoria';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$CategoriaModel->view_delete();
        return $this->load_view('recovery/categoria',$data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $CategoriaModel = new CategoriaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        $CategoriaModel->recovery_data($id);
        return redirect()->route('categoria');
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
            $CategoriaModel = new CategoriaModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 10 ;
            $valiadar = $CategoriaModel->valiadar($var);
            return $valiadar;
        }
    }
}