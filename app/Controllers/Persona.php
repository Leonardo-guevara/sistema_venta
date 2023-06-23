<?php 
namespace App\Controllers;
use App\Models\PersonaModel;
use CodeIgniter\Config\BaseConfig;


class Persona extends BaseController
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
        $PersonaModel = new PersonaModel();
        $data['title'] = 'Lista de persona';
        $data['home'] = 'persona';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$PersonaModel->seleccionar();
        return $this->load_view('board/persona',$data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $PersonaModel = new PersonaModel();
        $data['title'] = 'Crear Nuevo Persona';
        $data['home'] = 'Persona';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'persona'   => 'required|min_length[3]|max_length[255]',
            'email'     => 'required|valid_email|is_unique[persona.email]',
            'telefono'  => 'required|min_length[3]|max_length[255]',
            'cedula'    => 'required|min_length[3]|max_length[255]|is_unique[persona.cedula]',
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/persona',$data);
        }
        $datos = [
            'persona'      => $_POST["persona"],
            'email'        => $_POST["email"],
            'telefono'     => $_POST["telefono"],
            'cedula'       => $_POST["cedula"],
        ];
        $PersonaModel->insertar($datos);
        return redirect()->route('persona');
        die();
    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $PersonaModel = new PersonaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        $data['datos'] = $PersonaModel->encontrar($id);
        $data['title'] = 'Crear Nuevo Persona';
        $data['home'] = 'Persona';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'persona'   => 'required|min_length[3]|max_length[255]',
            'email'     => 'required|valid_email|is_unique[persona.email,idpersona,{id}]',
            'telefono'  => 'required|min_length[3]|max_length[255]',
            'cedula'    => 'required|min_length[3]|max_length[255]|is_unique[persona.cedula,idpersona,{id}]',
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/persona',$data);
        }
        $datos = [
            'persona'      => $_POST["persona"],
            'email'        => $_POST["email"],
            'telefono'     => $_POST["telefono"],
            'cedula'       => $_POST["cedula"],
        ];
        $PersonaModel->actualizar($id,$datos);
        return redirect()->route('persona');
        die();
    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $PersonaModel = new PersonaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}   
        if ($id != 1) {
            $PersonaModel->delete($id);
        }
        return redirect()->route('persona');
        die();

    }
    public function recovery(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $PersonaModel = new PersonaModel();
        $data['title'] = 'Recuperar Cliente';
        $data['home'] = 'Persona';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$PersonaModel->view_delete();
        return $this->load_view('recovery/persona',$data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $PersonaModel = new PersonaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        
            $PersonaModel->recovery_user($id);
        return redirect()->route('persona');
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
            $PersonaModel = new PersonaModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 5 ;
            $valiadar = $PersonaModel->valiadar($var);
            return $valiadar;
        }
    }
}