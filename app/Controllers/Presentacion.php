<?php
namespace App\Controllers;

use App\Models\PresentacionModel;
use CodeIgniter\Config\BaseConfig;


class presentacion extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();

    }
    public function index()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $PresentacionModel = new PresentacionModel();
        $data['title'] = 'Lista de presentacion';
        $data['data'] = $PresentacionModel->seleccionar();
        return $this->load_view('board/presentacion', $data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form');
        $PresentacionModel = new PresentacionModel();
        $data['unidad'] = $PresentacionModel->unidad();
        $data['title'] = 'Crear Nueva Presentacion';
        if (
            !$this->validate([
                'presentacion' => 'required|min_length[3]|max_length[255]|is_unique[presentacion.name]',
                'fk_unidad' => 'required',
            ])
        ) {
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/presentacion', $data);
        }
        $datos = [
            'presentacion' => $_POST["presentacion"],
            'fk_unidad' => $_POST["fk_unidad"],
        ];
        $PresentacionModel->insertar($datos);
        return redirect()->route('presentacion');
    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form');
        $PresentacionModel = new PresentacionModel();
        if (!isset ($_GET["id"]) and empty ($_GET['id'])) {
            $id = '0';
        } else {
            $id = $_GET["id"];
        }
        $data['datos'] = $PresentacionModel->encontrar($id);
        $data['unidad'] = $PresentacionModel->unidad();
        $data['title'] = 'Actualizar Presentacion';
        if (
            !$this->validate([
                'presentacion' => 'required|min_length[3]|is_unique[presentacion.name,idpresentacion,{id}]',
                'fk_unidad' => 'required',
            ])
        ) {
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/presentacion', $data);
        }
        $datos = [
            'presentacion' => $_POST["presentacion"],
            'fk_unidad' => $_POST["fk_unidad"],
        ];
        $PresentacionModel->actualizar($id, $datos);
        return redirect()->route('presentacion');
    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $PresentacionModel = new PresentacionModel();
        if (!isset ($_GET["id"]) and empty ($_GET['id'])) {
            return false;
        } else {
            $id = $_GET["id"];
        }
        return $PresentacionModel->delete($id);

    }
    public function recovery()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $PresentacionModel = new PresentacionModel();
        $data['title'] = 'Recuperar Presentacion';
        $data['data'] = $PresentacionModel->view_delete();
        return $this->load_view('recovery/presentacion', $data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $PresentacionModel = new PresentacionModel();
        if (!isset ($_GET["id"]) and empty ($_GET['id'])) {
            return false;
        } else {
            $id = $_GET["id"];
        }
        return $PresentacionModel->recovery_data($id);
    }
    public function view_ajax()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $PresentacionModel = new PresentacionModel();
        $json = json_encode($PresentacionModel->seleccionar());
        return $json;
    }
    public function insert_ajax()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $PresentacionModel = new PresentacionModel();
        if (!isset ($_GET["data"]) and empty ($_GET['data'])) {
            return 'false';
        } else {
            $datos = [
                'unidad' => $_GET["data"],
            ];
        }
        $datos = [
            'presentacion' => $_GET["data"],
            'fk_unidad' => $_GET["data"],
        ];
        return $PresentacionModel->insertar($datos);
    }
    protected function load_view($view = null, $data = null)
    {
        $data['home'] = 'Presentacion';
        $data['principal'] = $_SESSION['usuario'];
            return view('head', $data).
             view('header').
             view('sidebar').
             view($view, $data).
             view('footer');
        
    }
    protected function validar()
    {
        if (isset ($_SESSION["fkroles"])) {
            $PresentacionModel = new PresentacionModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 8;
            $valiadar = $PresentacionModel->valiadar($var);
            return $valiadar;
        }
    }
}