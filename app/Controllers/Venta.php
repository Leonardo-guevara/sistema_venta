<?php 
namespace App\Controllers;
use App\Models\VentaModel;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Email\Email;


class Venta extends BaseController
{
    public function __construct(){
		$session = \Config\Services::session();	

	}
	public function index($data = null){
        if ($this->validar() == NULL) {
             return redirect()->route('login');
        }
        $VentaModel = new VentaModel();
        $data['user']  = $_SESSION['idusuario'];
        $data['data']  = $VentaModel->validar_caja($data);
        if (!empty($data['data']   )) {
            return $this->venta($data);
        } 
        return $this->vacia($data);
    }
    public function venta($data = null)  {
        if ($this->validar() == NULL) {
             return redirect()->route('login');
        }
        helper('form');

        if (isset($data['data'])) {
            $VentaModel = new VentaModel();
            $data['user']  = $_SESSION['idusuario'];
            $data['title'] = 'RECIBO DE VENTA';
            $data['home']  = 'Venta';
            $data['datos'] = $VentaModel->view_venta($data['data']['idarqueo_caja']);
            $data['persona']  = $VentaModel->cliente();

            return $this->load_view('form/ventanilla',$data);
           
        }else{
            // return $this->vacia($data);
            return view('errors/html/error_404.php'); 
        }
    }
    function cliente() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form');
        $VentaModel = new VentaModel();

        if (!$this->validate([
            'persona'   => 'required|min_length[3]|max_length[255]',
            'cedula'    => 'required|min_length[3]|max_length[255]|is_unique[persona.cedula]',
            'email'     => 'is_unique[persona.email]',
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->index($data);
        }
        $datos = [
            'persona'      => $_GET["persona"],
            'email'        => $_GET["email"],
            'telefono'     => $_GET["telefono"],
            'cedula'       => $_GET["cedula"],
        ];
        //  $VentaModel->newclienete($datos);
        $data['fk_persona'] = $VentaModel->newclienete($datos);
        return $this->index($data);
        // return $data;
        
    }
    public function recibo() {
        if ($this->validar() == NULL) {
             return redirect()->route('login');
        }
        $VentaModel = new VentaModel();
        $data['user']  = $_SESSION['idusuario'];
        $data['data']  = $VentaModel->validar_caja($data);
        if (!empty($data['data'])) {
            $data['title'] = 'Lista de ventas';
            $data['home'] = 'Venta';
            $data['data'] =$VentaModel->seleccionar($data["data"]["idarqueo_caja"]);
            return $this->load_view('board/recibo',$data);
        } 
        return $this->vacia($data);
       
    }
    public function view_producto() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
       }
       $VentaModel = new VentaModel(); 
       $data['data'] = $VentaModel->view_producto();
       $json = json_encode($data);
       return $json;
        
    }
    public function view_recibo() {
        if ($this->validar() == NULL) {
             return redirect()->route('login');
        }
        $VentaModel = new VentaModel();
        $data['title'] = 'Comprobante Recibo ';
        $data['home'] = 'Venta';
        if(!isset($_GET["view"]) and empty($_GET['view'])) { $view = '0';} else {$view = $_GET["view"];} 
        $data['data'] =$VentaModel->view_recibo($view);
        return $this->load_view('reporte/view_recibo',$data);
    }
    function chage_user() {
        if ($this->validar() == NULL) {
             return redirect()->route('login');
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
        if(!isset($_GET["cliente"]) and empty($_GET['cliente'])) { $user = '0';} else {$user = $_GET["cliente"];} 
        $data['idventas']= $venta;
        $data['fk_persona']= $user;
        $json = json_encode($VentaModel->chage_user($data));
       
        return $json;
    }
    public function finalizar_venta() {
        if ($this->validar() == NULL) {
            return false;
        }
        $VentaModel = new VentaModel();
        if(!isset($_POST["idventas"]) and empty($_POST['idventas'])) { $venta = '0';} else {$venta = $_POST["idventas"];} 
        $user  = $_SESSION['idusuario'];
        $VentaModel->finalizar_venta($venta,$user);
        return $this->index();
    }
    public function vacia($data = null)  {
        if ($this->validar() == NULL) {
            return false;
        }
        if (isset($data)) {
            $data['title'] = 'Arqueo sin asignar';
            $data['home'] = 'Ventamilla';
            return $this->load_view('board/vacio',$data);
        }else{
            return view('errors/html/error_404.php'); 
        }

    }
    public function ajax() {
        if ($this->validar() == NULL) {
            return false;
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
        if(!isset($_GET["code"]) and empty($_GET['code'])) { $code = '0';} else {$code = $_GET["code"];} 
        if(!isset($_GET["cantidad"]) and empty($_GET['cantidad'])) { $cantidad = '0';} else {$cantidad = $_GET["cantidad"];} 
        $data["code"]= $code;
        $data["venta"]=$venta;
        $data["cantidad"]=$cantidad;
        $json = json_encode($VentaModel->cargar_producto($data));
        return $json;
    }

    function delete_barcode()  {
        if ($this->validar() == NULL) {
            return false;
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
        if(!isset($_GET["code"]) and empty($_GET['code'])) { $code = '0';} else {$code = $_GET["code"];} 
        if(!isset($_GET["cantidad"]) and empty($_GET['cantidad'])) { $cantidad = '0';} else {$cantidad = $_GET["cantidad"];} 
        $data["code"]= $code;
        $data["venta"]=$venta;
        $data["cantidad"]=$cantidad;
        $json = json_encode($VentaModel->delete_barcode($data));
        return $json;
    }
    function json( $venta = null) {
        if ($this->validar() == NULL) {
            return false;
        }
        $VentaModel = new VentaModel();
        if(!isset($_GET["venta"]) and empty($_GET['venta'])) { $venta = '0';} else {$venta = $_GET["venta"];} 
        $data['detalle_venta'] = $VentaModel->detalle_venta($venta);
        $data['suma_precio'] = $VentaModel->suma_precio($venta);
        $json = json_encode($data);
        return $json;
    }
    protected function load_view( $view = null, $data = null){
        $data['user']  = $_SESSION['idusuario'];
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