<?php 
namespace App\Controllers;
use App\Models\RolesModel;
use CodeIgniter\Config\BaseConfig;


class Roles extends BaseController
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
        $RolesModel = new RolesModel();
        $data['title'] = 'Lista de Roles';
        $data['home'] = 'Roles';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$RolesModel->seleccionar();
        return $this->load_view('board/Roles',$data);
    }
    public function insert(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $RolesModel = new RolesModel();
        $data['title'] = 'Crear Nuevo Roles';
        $data['home'] = 'Roles';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'roles'    => 'required|min_length[3]|max_length[255]|is_unique[roles.name]',
            'detalle'  => 'required',
    
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/roles',$data);
        }
        $datos = [
            'roles'        => $_POST["roles"],
            'detalle'      =>$_POST["detalle"],
        ];
        $RolesModel->insertar($datos);
        return redirect()->route('roles');
        die();
    }
    public function update(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $RolesModel = new RolesModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        if ($id != 1) {
        $data['datos'] = $RolesModel->encontrar($id);
        $data['title'] = 'Crear Nuevo Roles';
        $data['home'] = 'Roles';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'roles'    => 'required|min_length[3]|max_length[255]|is_unique[roles.name,idroles,{id}]',   
            'detalle'  => 'required',
 
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/roles',$data);
        }
        $datos = [
            'roles'        => $_POST["roles"],
            'detalle'      =>$_POST["detalle"],
        ];
        $RolesModel->actualizar($id,$datos);
        } 
        return redirect()->route('roles');
        die();
    }
    public function delete(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $RolesModel = new RolesModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}   
        if ($id != 1) {
        $RolesModel->delete($id);
        }
        header("Location: ".base_url()."Roles/");
        die();

    }
    public function permiso(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $RolesModel = new RolesModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        if ($id != 1) {
        $data['datos'] = $RolesModel->encontrar_permiso($id);
        $data['title'] = 'Asignar Permiso';
        $data['home'] = 'Roles';
        $data['principal']= $this->session->get('usuario');
        if (isset($_POST) and empty($_POST)){
            return $this->load_view('form/permiso',$data);
        }
        $RolesModel->permiso($id, $_POST);
        } 
        return redirect()->route('roles');
        die();
    }
    public function recovery(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $RolesModel = new RolesModel();
        $data['title'] = 'Recuperar Roles';
        $data['home'] = 'Roles';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$RolesModel->view_delete();
        return $this->load_view('recovery/roles',$data);
    }
    public function recovery_mode(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $RolesModel = new RolesModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        $RolesModel->recovery_data($id);
        return redirect()->route('roles');
        die();
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
            $RolesModel = new RolesModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 12 ;
            $valiadar = $RolesModel->valiadar($var);
            return $valiadar;
        }
    }
}