<?php

namespace App\Controllers;
use App\Models\CajaModel;
use CodeIgniter\Config\BaseConfig;


class Caja extends BaseController
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
        $CajaModel = new CajaModel();
        $data['title'] = 'Lista de Caja';
        $data['home'] = 'Caja';
        $data['principal']= $_SESSION['usuario'];;
        $data['data'] =$CajaModel->seleccionar();
        $data['cajas'] =$CajaModel->cajas_abiertas();
        return $this->load_view('board/caja',$data);

    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $CajaModel = new CajaModel();
        $data['title'] = 'Crear Nuevo caja';
        $data['home'] = 'caja';
        $data['principal']= $_SESSION['usuario'];;
        if (!$this->validate([
            'caja'    => 'required|min_length[3]|max_length[255]|is_unique[caja.name]',
            'detalle'    => 'required|min_length[3]',
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/caja',$data);
        }
        $datos = [
            'caja'     => $_POST["caja"],
            'detalle'     => $_POST["detalle"],
        ];
        $CajaModel->insertar($datos);
        return redirect()->route('caja');  
        die();
    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $CajaModel = new CajaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        $data['datos'] = $CajaModel->encontrar($id);
        $data['title'] = 'Crear Nuevo caja';
        $data['home'] = 'Caja';
        $data['principal']= $_SESSION['usuario'];;
        if (!$this->validate([
            'caja'    => 'required|min_length[3]|max_length[255]|is_unique[caja.name,idcaja,{id}]',
            'detalle'    => 'required|min_length[3]',
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/caja',$data);
        }
        $datos = [
            'caja'     => $_POST["caja"],
            'detalle'     => $_POST["detalle"],
        ];
        $CajaModel->actualizar($id,$datos);
        return redirect()->route('caja');
        die();
    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $CajaModel = new CajaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        $CajaModel->delete($id);
        return redirect()->route('caja');
        die();
    }
    public function arqueo()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $CajaModel = new CajaModel();
        $data['title'] = 'Historial de Caja Arqueo';
        $data['home'] = 'Caja';
        $data['principal']= $_SESSION['usuario'];;
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        $data['data'] =$CajaModel->historial($id);
        return $this->load_view('board/arqueo_historial',$data);
    }
    public function recovery()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $CajaModel = new CajaModel();
        $data['title'] = 'Recuperar Caja';
        $data['home'] = 'Caja';
        $data['principal']= $_SESSION['usuario'];;
        $data['data'] =$CajaModel->view_delete();
        return $this->load_view('recovery/caja',$data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $CajaModel = new CajaModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        $CajaModel->recovery_data($id);
        return redirect()->route('caja');
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
    public function correo_email($correo = null )
    {       
        $email = \Config\Services::email();
        $email->setFrom('leonardo.guevara@posgrado.helpfibo.com',$correo["titulo"]);
        $email->setTo($correo["email"]);
        $email->setSubject( $correo["asunto"]);
        $email->setMessage($correo["mensaje"]);
        $email->send();
    }
    protected function validar() 
    {
        if (isset($_SESSION["fkroles"])) {
            $CajaModel = new CajaModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 13;
            $valiadar = $CajaModel->valiadar($var);
            return $valiadar;
        }
    }
}
