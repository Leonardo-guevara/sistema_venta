<?php 
namespace App\Controllers;
use App\Models\VentaModel;
use CodeIgniter\Config\BaseConfig;


class Venta extends BaseController
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
        $VentaModel = new VentaModel();
        $data['user']  = $this->session->get('idusuario');
        $data['data']  = $VentaModel->validar_caja($data);
        if (!empty($data['data'])) {
            return $this->venta($data);
            die();
        } 
        return $this->vacia($data);
        die();
    }
    public function venta($data = null)  {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        if (isset($data)) {
            $VentaModel = new VentaModel();
            $data['title'] = 'RECIBO DE VENTA';
            $data['home']  = 'Venta';
            $data['datos'] = $VentaModel->view_venta($data['data']['idarqueo_caja']);
            $data['principal']= $this->session->get('usuario');
            $data['persona']  = $VentaModel->persona($data);
            return $this->load_view('form/ventanilla',$data);
            die();
        }else{
            return view('errors/html/error_404.php'); 
        }
    }
    public function recibo() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $VentaModel = new VentaModel();
        $data['user']  = $this->session->get('idusuario');
        $data['data']  = $VentaModel->validar_caja($data);
        if (!empty($data['data'])) {
            $data['title'] = 'Lista de ventas';
            $data['home'] = 'Venta';
            $data['principal']= $this->session->get('usuario');
            $data['data'] =$VentaModel->seleccionar($data["data"]["idarqueo_caja"]);
            return $this->load_view('board/recibo',$data);
        } 
        return $this->vacia($data);
        die();
    }
    public function view_recibo() {
        
        $VentaModel = new VentaModel();
        $data['title'] = 'Comprobante Recibo ';
        $data['home'] = 'Venta';
        $data['principal']= $this->session->get('usuario');
        if(!isset($_GET["view"]) and empty($_GET['view'])) { $view = '0';} else {$view = $_GET["view"];} 
        $data['data'] =$VentaModel->view_recibo($view);
        return $this->load_view('reporte/view_recibo',$data);
    }
    function chage_user() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
        if(!isset($_GET["user"]) and empty($_GET['user'])) { $user = '0';} else {$user = $_GET["user"];} 
        $data['idventas']= $venta;
        $data['fk_persona']= $user;
        $json = json_encode($VentaModel->chage_user($data));
        return $json;
    }
    public function finalizar_venta() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
        $user  = $this->session->get('idusuario');

        $json = json_encode($VentaModel->finalizar_venta($venta,$user));
        
        return $json;
    }
    public function vacia($data = null)  {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        if (isset($data)) {
            $data['title'] = 'Arqueo sin asignar';
            $data['home'] = 'Venta';
            $data['principal']= $this->session->get('usuario');
            return $this->load_view('board/vacio',$data);
        }else{
            return view('errors/html/error_404.php'); 
        }

    }
    public function ajax() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
        if(!isset($_GET["code"]) and empty($_GET['code'])) { $code = '0';} else {$code = $_GET["code"];} 
        $data["code"]= $code;
        $data["venta"]=$venta;
        $json = json_encode($VentaModel->cargar_producto($data));
        return $json;
    }
    function suma_precio() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
   
        $json = json_encode($VentaModel->suma_precio($venta));
        return $json;
    }
    function delete_barcode()  {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
        if(!isset($_GET["code"]) and empty($_GET['code'])) { $code = '0';} else {$code = $_GET["code"];} 
        $data["code"]= $code;
        $data["venta"]=$venta;
        $json = json_encode($VentaModel->delete_barcode($data));

        return $json;
    }
    function json() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
   
        $json = json_encode($VentaModel->detalle_venta($venta));
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
            $var['permiso'] = 1 ;
            $valiadar = $VentaModel->valiadar($var);
            return $valiadar;
        }
    }
}