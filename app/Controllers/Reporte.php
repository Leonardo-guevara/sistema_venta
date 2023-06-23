<?php
namespace App\Controllers;
use App\Models\VentaModel;
use CodeIgniter\Config\BaseConfig;

class Reporte extends BaseController
{
    public function __construct(Type $var = null) {
		$this->session = \Config\Services::session();	

    }
    protected $helpers = ['form'];
    public function index()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $VentaModel = new VentaModel();
        $data['user']  = $this->session->get('idusuario');
        // $data['data']  = $VentaModel->validar_caja($data);
        // if (!empty($data['data'])) {
            $data['title'] = 'Lista de ventas';
            $data['home'] = 'Venta';
            $data['principal']= $this->session->get('usuario');
            $data['listausuario']  = $VentaModel->usuario();
            // $data['data'] =$VentaModel->seleccionar($data["data"]["idarqueo_caja"]);
            return $this->load_view('reporte/reporte',$data);
        // // } 
        // echo 'hola';

    }
    function ajax_reporte() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }

        if(!isset($_GET["usuario"]) and empty($_GET['usuario'])) { $usuario = '0';} else {$usuario = $_GET["usuario"];} 
        if(!isset($_GET["date_final"]) and empty($_GET['date_final'])) { $date_final = '0';} else {$date_final = $_GET["date_final"];} 
        if(!isset($_GET["date_inicio"]) and empty($_GET['date_inicio'])) { $date_inicio = '0';} else {$date_inicio = $_GET["date_inicio"];} 
   
        $data['usuario'] = $usuario;
        $data['inicio'] = $date_inicio;
        $data['final'] = $date_final;
        $VentaModel = new VentaModel();
        $json = json_encode($VentaModel->ajax_reporte($data));
        return $json;
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
            $VentaModel = new VentaModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 3 ;
            $valiadar = $VentaModel->valiadar($var);
            return $valiadar;
        }
    }

}
