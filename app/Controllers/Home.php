<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Home extends BaseController
{
    public function __construct(Type $var = null) {
		$this->session = \Config\Services::session();	

    }
    protected $helpers = ['form'];
    public function index() {
        if (empty($this->session->get('usuario'))) {
            return redirect()->route('login');
            die();
        }
        $db      = \Config\Database::connect();
        $data['title'] = 'Presentacion';
        $data['principal']= $this->session->get('usuario');
        // selecionar usuario
        $sql = "SELECT * FROM `usuario` WHERE `deleted_at`<=> NULL;";
        $query = $db->query($sql);
        $data["usuario"] = $row = $query->getResultArray();
        // selecionar movimiento
        $sql = "SELECT movimiento_inventario.`name`, `fecha`, producto.name AS `producto`, `cantidad` FROM `movimiento_inventario` 
        INNER JOIN producto ON producto.codigo = movimiento_inventario.producto 
        ORDER BY `fecha` DESC LIMIT 25;";
        $query = $db->query($sql);
        $data["movimiento"] = $row = $query->getResultArray();
        // 

        return $this->load_view('board/home',$data);
    }
    public function view(){
        return view('demo/demo');
    }
    public function login()
    {
        helper('form', 'url');
        $UsuarioModel = new UsuarioModel();
        if (!$this->validate([
            'user'    => 'required',
            'password'    => 'required',   
        ])){
            $data['errors'] = $this->validator->getErrors();
            return view("login/login",$data); 
        }
        $datos = [
            'user'        => $_POST["user"],
            'password'    => $_POST["password"],
        ];
        $data = $UsuarioModel->login($datos);
        if ($data == 'ALgo salio mal intente de nuevo') {
            $datos['error'] = $data ;
            return view('login/login',$datos);
        }
       $_SESSION = $data;

        return redirect()->route('');  
        die();
    }
   
    public function barcode()
    {
        
        $data['title'] = 'Crear codigo de barra';
        $data['home'] = 'barcode';
        $data['principal']= $this->session->get('usuario');
        return $this->load_view('extra/barcode',$data);
    }
    function change_password() {
        // if ($this->validar() == NULL) {
        //     return redirect()->route('login');
        //     die();
        // }
        $UsuarioModel = new UsuarioModel();
        $data['title'] = 'Cambiara Contraseña';
        $data['home'] = 'Usuario';
        $data['principal']= $this->session->get('usuario');
        $data['data'] = $UsuarioModel->view_delete();

        if (!$this->validate([
            'contrasenha'   => 'required',
            'password'      => 'required|min_length[5]',
            'passconf'      => 'required|matches[password]'  
            
        ])){

            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('login/change_password',$data);
        }
        if(isset($_POST["contrasenha"]) and !empty($_POST['contrasenha'])){
            $dat['usuario'] = $_SESSION["usuario"];
            $dat['contrasenha'] = $_POST["contrasenha"];
            $dat['password'] = $_POST["password"];
            $data['error'] = $UsuarioModel->change_password($dat);
            if (isset($data['error'])) {
                return $this->load_view('login/change_password',$data);
            }
        }
        return redirect()->route('login');
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
    public function recovery_mode()
    {

        $UsuarioModel = new UsuarioModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        $UsuarioModel->recovery_user($id);
        return redirect()->route('usuario');
        die();
    }
    public function recover_password()
    {

        $UsuarioModel = new UsuarioModel();
        
        if (!$this->validate([
            'email'    => 'required|min_length[3]|max_length[255]',
            ])){
                $data['errors'] = $this->validator->getErrors();
                return view("login/recover_password",$data);
            }
        $correo =$_POST["email"] ;
        $texto = '<h2 class="">CAMBIO DE CONTRASEÑA&nbsp;0
        </h2><p><b><u>SU NUEVA CONTRASEÑA&nbsp; SERA:</u></b></p>';
        $mensaje = $texto. $UsuarioModel->buscar_contrasenha($correo);
        $asunto = 'Cambio de Contrasenha' ;
   
        $email = \Config\Services::email();
        $email->setFrom('leonardo@udabol.helpfibo.com', 'Recuperar Contrasenha');
        $email->setTo($correo);
        $email->setSubject( $asunto);
        $email->setMessage($mensaje);
        $email->send();

        return redirect()->route('login');
        die();
    

    }
    public function correo_email($correo = null )
    {       
        $email = \Config\Services::email();
        $email->setFrom('leonardo@udabol.helpfibo.com',"titulo");
        $email->setTo('lguevara240.@gmail.com');
        $email->setSubject('prueba');
        $email->setMessage('hola');
        // $email->send();
        if (!$email->send()) {
            // $email->UndoEveryChanges();
            // throw new \Exception("Email sending failed");
            echo  'salio mal';
         }else  {
            echo  'salio bien';
         }
    }
    public function close_sesion()
    {
        session_destroy();
        return view("login/login");
        die();
    }

}
