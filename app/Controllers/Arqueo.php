<?php

namespace App\Controllers;
use App\Models\ArqueoModel;
use CodeIgniter\Config\BaseConfig;


class Arqueo extends BaseController
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
        $ArqueoModel = new ArqueoModel();
        $data['title'] = 'Lista de Arqueo';
        $data['home'] = 'Arqueo';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$ArqueoModel->seleccionar();
        // $data['arqueos'] =$ArqueoModel->arqueos_abiertas();
        return $this->load_view('board/arqueo',$data);
    }
    public function historial()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $ArqueoModel = new ArqueoModel();
        $data['title'] = 'Historial de Arqueo';
        $data['home'] = 'Arqueo';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$ArqueoModel->historial();
        // $data['arqueos'] =$ArqueoModel->arqueos_abiertas();
        return $this->load_view('board/arqueo_historial',$data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $ArqueoModel = new ArqueoModel();
        $data['caja'] = $ArqueoModel->caja();
        $data['usuario'] = $ArqueoModel->usuario();
        $data['title'] = 'Crear Nuevo Arqueo';
        $data['home'] = 'Arqueo';
        $data['error'] = '';
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'fk_usuario'    => 'required',
            'fkcaja'    => 'required',
            'monto_inicial'    => 'required|integer'
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/arqueo',$data);
        }
        $datos = [
            'fk_usuario'     => $_POST["fk_usuario"],
            'fkcaja'         => $_POST["fkcaja"],
            'monto_inicial'  => $_POST["monto_inicial"]
        ];
        $data['error']  = $ArqueoModel->arqueo_inicio($datos);
        if (!empty($data['error'])) {
            return $this->load_view('form/arqueo',$data);
        }
        return redirect()->route('arqueo');  
        die();
    }


    public function close()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $ArqueoModel = new ArqueoModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        $ArqueoModel->arqueo_final($id);
        return redirect()->route('arqueo');
        die();
    }

    protected function load_view( $view = null, $data = null)
    {
        echo view('head',$data);
        echo view('header');
        echo view('sidebar',$data);
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
    protected function validar() {
        if (isset($_SESSION["fkroles"])) {
            $ArqueoModel = new ArqueoModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 14 ;
            $valiadar = $ArqueoModel->valiadar($var);
            return $valiadar;
        }
    }
}
