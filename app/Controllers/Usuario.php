<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use CodeIgniter\Config\BaseConfig;


class Usuario extends BaseController
{
    public function __construct(){
        
        $this->session = \Config\Services::session();	
        $this->helper = helper(array('form', 'url'));

	}

    public function index()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $UsuarioModel = new UsuarioModel();
        $data['title'] = 'Lista de Usuario';
        $data['home'] = 'Usuario';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$UsuarioModel->seleccionar();
        return $this->load_view('board/usuario',$data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $UsuarioModel = new UsuarioModel();
        $data['title'] = 'Crear nuevo Usuario';
        $data['home'] = 'Usuario';
        $data['roles'] =$UsuarioModel->roles();
        $data['principal']= $this->session->get('usuario');
        if(!empty($_FILES["file"]["name"]) and isset($_FILES["file"]["name"])){
            $foto = $this->upload_img($_FILES);    
        }
        if (!$this->validate([
            'usuario'    => 'required|min_length[3]|max_length[255]|is_unique[usuario.usuario]',
            'detalle'    => 'required|min_length[3]',
            'email'     => 'required|valid_email|is_unique[usuario.email]', 
            'fkroles'    => 'required',
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/usuario',$data);
        }
       
        // validar imagen
        if(isset($foto) and !empty($foto)){
            $foto = $foto;
       }else {
           $foto = "public/dist/img/vacio.png";
       } 
        $password = $UsuarioModel->contrasenha('8');
        $datos = [
            'password'    => $password,
            'usuario'     => $_POST["usuario"],
            'detalle'     => $_POST["detalle"],
            'foto'        => $foto,
            'email'       => $_POST["email"],
            'fkroles'     => $_POST["fkroles"],
        ];
        $correo["email"] = $datos["email"] ;
        $texto = '<h2 style="color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif;">Nueva Contraseña&nbsp;</h2><p style="color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small;">recuerda que puede cambiar la contraseña desde la aplicación&nbsp;<a href="https://udabol.helpfibo.com/" target="_blank">https://posgrado.helpfibo.com/</a></p><p style="color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small;"><b><u>Tu contraseña es:</u></b></p>';
        $correo['mensaje'] = $texto.$password ;
        $correo['asunto'] = 'Crear  Contrasenha' ;
        $correo['titulo'] = ' Se creo una Contrasenha' ;

        $email = \Config\Services::email();
        $email->setFrom('leonardo@udabol.helpfibo.com',$correo["titulo"]);
        $email->setTo($datos["email"]);
        $email->setSubject( $correo["asunto"]);
        $email->setMessage($correo["mensaje"]);
        
        if (!$email->send()) {
            return redirect()->route('usuario'); 
         }else  {
            $UsuarioModel->insertar($datos);
            return redirect()->route('usuario');  
         }
        die();

    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        helper('form', 'url');
        $UsuarioModel = new UsuarioModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];} 
        // if ($id != 1) {
        $data['datos'] = $UsuarioModel->encontrar($id);
        $data['title'] = 'Actualizar Usuario';
        $data['home'] = 'Usuario';
        $data['roles'] =$UsuarioModel->roles();
        if(!empty($_FILES["file"]["name"]) and isset($_FILES["file"]["name"])){
            $foto = $this->upload_img($_FILES);    
        }
        $data['principal']= $this->session->get('usuario');
        if (!$this->validate([
            'usuario'    => 'required|min_length[3]|max_length[255]|is_unique[usuario.usuario,idusuario,{id}]',
            'detalle'    => 'required|min_length[3]',
            'email'     => 'required|valid_email|is_unique[usuario.email,idusuario,{id}]',  
            'fkroles'    => 'required',
        ])){
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/usuario',$data);
        }
         // validar imagen
         if(isset($foto) and !empty($foto)){
             $foto = $foto;
        }elseif ($data['datos']["foto"] == '') {
            $foto = "public/dist/img/vacio.png";
        } else {
            $foto = $data['datos']["foto"];
        }
        $datos = [
            'usuario'     => $_POST["usuario"],
            'detalle'     => $_POST["detalle"],
            'foto'        => $foto,
            'email'       => $_POST["email"],
            'fkroles'     => $_POST["fkroles"],
        ];
        $UsuarioModel->actualizar($id,$datos);
        // }
        return redirect()->route('usuario');
        die();
    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $UsuarioModel = new UsuarioModel();
        if(!isset($_GET["id"]) and empty($_GET['id'])) { $id = '0';} else {$id = $_GET["id"];}  
        if ($id != 1) {
            $UsuarioModel->delete_user($id);
        }
        return redirect()->route('usuario');
        die();

    }
    public function recovery(){
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
        $UsuarioModel = new UsuarioModel();
        $data['title'] = 'Recuperar Usuario';
        $data['home'] = 'Usuario';
        $data['principal']= $this->session->get('usuario');
        $data['data'] =$UsuarioModel->view_delete();
        return $this->load_view('recovery/usuario',$data);
    }
    function change_password() {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
            die();
        }
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

    public function correo_email($correo = null )
    {       
        $email = \Config\Services::email();
        $email->setFrom('leonardo.guevara@posgrado.helpfibo.com',$correo["titulo"]);
        $email->setTo($correo["email"]);
        $email->setSubject( $correo["asunto"]);
        $email->setMessage($correo["mensaje"]);
        $email->send();

    }
    protected function upload_img($data) {
        $validationRule = [
            'file' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[file]',
                    'is_image[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[file,1000]',
                    'max_dims[file,1024,1024]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $validar = ['errors' => $this->validator->getErrors()];
            return  $validar;
        }
        $file = $this->request->getFile('file');
        if (! $file->hasMoved()) {
            $ext = $file->guessExtension();
            $name = 'user'.date('Y_m_d_H_i_s').'.'.$ext;
            $ruta = './public/file/usuario/';
            $file->move($ruta,$name);
            $data = 'public/file/usuario/'.$name ;
            return  $data   ;
        } else {
            $data = ['errors' => 'El archivo ya se ha movido.'];
            return  $data;
        }
    }
    protected function validar() {
        if (isset($_SESSION["fkroles"])) {
            $UsuarioModel = new UsuarioModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 11 ;
            $valiadar = $UsuarioModel->valiadar($var);
            return $valiadar;
        }
    }
}
