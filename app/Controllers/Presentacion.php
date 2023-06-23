<?php 
namespace App\Controllers;
use App\Models\PresentacionModel;
use CodeIgniter\Config\BaseConfig;


class presentacion extends BaseController
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
        $PresentacionModel = new PresentacionModel();
        $data['title'] = 'Lista de presentacion';
        $data['home'] = 'Presentacion';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$PresentacionModel->seleccionar();
        return $this->load_view('board/presentacion',$data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $PresentacionModel = new PresentacionModel();
        $data['unidad']=$PresentacionModel->unidad();
        $data['title'] = 'Crear Nueva Presentacion';
        $data['home'] = 'Presentacion';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'presentacion'    => 'required|min_length[3]|max_length[255]|is_unique[presentacion.name]',  
            'fk_unidad'    => 'required',  
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/presentacion',$data);
        }
        $datos = [
            'presentacion'        => $_POST["presentacion"],
            'fk_unidad'            => $_POST["fk_unidad"],
        ];
        $PresentacionModel->insertar($datos);
        return redirect()->route('presentacion');
        die();
    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $PresentacionModel = new PresentacionModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        $data['datos'] = $PresentacionModel->encontrar($id);
        $data['unidad']=$PresentacionModel->unidad();
        $data['title'] = 'Actualizar Presentacion';
        $data['home'] = 'Presentacion';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'presentacion'    => 'required|min_length[3]|is_unique[presentacion.name,idpresentacion,{id}]',  
            'fk_unidad'    => 'required',      
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/presentacion',$data);
        }
        $datos = [
            'presentacion'        => $_POST["presentacion"],
            'fk_unidad'            => $_POST["fk_unidad"],
        ];
        $PresentacionModel->actualizar($id,$datos);
        return redirect()->route('presentacion');
        die();
    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $PresentacionModel = new PresentacionModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}   
        $PresentacionModel->delete($id);
        header("Location: ".base_url()."presentacion/");
        die();

    }
    public function recovery(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $PresentacionModel = new PresentacionModel();
        $data['title'] = 'Recuperar Presentacion';
        $data['home'] = 'Presentacion';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$PresentacionModel->view_delete();
        return $this->load_view('recovery/presentacion',$data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $PresentacionModel = new PresentacionModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        
            $PresentacionModel->recovery_data($id);
        return redirect()->route('presentacion');
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
            $PresentacionModel = new PresentacionModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 8 ;
            $valiadar = $PresentacionModel->valiadar($var);
            return $valiadar;
        }
    }
}