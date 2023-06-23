<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Home extends BaseController
{
    public function __construct(Type $var = null) {
		$this->session = \Config\Services::session();	

    }
    protected $helpers = ['form'];

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

        return redirect()->route('inventario');  
        die();
    }
   
    public function barcode()
    {
        
        $data['title'] = 'Crear codigo de barra';
        $data['home'] = 'barcode';
        $data['principal']= $this->session->get('usuario');
        return $this->load_view('extra/barcode',$data);
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
        $texto = '<h2 class="">CAMBIO DE CONTRASEÑA&nbsp;</h2><p><b><u>SU NUEVA CONTRASEÑA&nbsp; SERA:</u></b></p>';
        $mensaje = $texto. $UsuarioModel->contrasenha('8');
        // echo '<pre>';
        // var_dump($mensaje);
        // echo '<br>';
        // var_dump($_POST["email"]);

        $correo =$_POST["email"] ;

        $asunto = 'Cambio de Contrasenha' ;
        $email = \Config\Services::email();
        $email->setFrom('leonardo.guevara@posgrado.helpfibo.com', 'Contrasenha');
        $email->setTo($correo);
        $email->setSubject( $asunto);
        $email->setMessage($mensaje);
        if (!$email->send()) {
            echo 'algo fallo <br>';
            echo $correo;
        }else{
            echo 'ya se envio';
        }
        die();

    }
    public function correo_email($correo = null )
    {       
        $email = \Config\Services::email();
        $email->setFrom('leo.com',"titulo");
        $email->setTo('lguevara240.@gmail.com');
        $email->setSubject('prueva');
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
