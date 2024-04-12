<?php
namespace App\Controllers;

use App\Models\UnidadModel;
use CodeIgniter\Config\BaseConfig;


class Unidad extends BaseController
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
        $UnidadModel = new UnidadModel();
        $data['title'] = 'Lista de Unidad';
        $data['data'] = $UnidadModel->seleccionar();
        return $this->load_view('board/unidad', $data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form');
        $UnidadModel = new UnidadModel();
        $data['title'] = 'Crear Nuevo Unidad';
        if (
            !$this->validate([
                'unidad' => 'required|min_length[3]|max_length[255]|is_unique[unidad.name]',
            ])
        ) {
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/unidad', $data);
        }
        $datos = [
            'unidad' => $_POST["unidad"],
        ];
        $UnidadModel->insertar($datos);
        return redirect()->route('unidad');
    }
    public function view_ajax()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $UnidadModel = new UnidadModel();
        $json = json_encode($UnidadModel->seleccionar());
        return $json;
    }
    public function insert_ajax()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $UnidadModel = new UnidadModel();
        if (!isset ($_GET["data"]) and empty ($_GET['data'])) {
            return 'false';
        } else {
            $datos = [
                'unidad' => $_GET["data"],
            ];
        }
        return $UnidadModel->insertar($datos);
    }
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form');
        $UnidadModel = new UnidadModel();
        if (!isset ($_GET["id"]) and empty ($_GET['id'])) {
            $id = '0';
        } else {
            $id = $_GET["id"];
        }
        $data['datos'] = $UnidadModel->encontrar($id);
        $data['title'] = 'Actualizar Unidad';
        if (
            !$this->validate([
                'unidad' => 'required|min_length[3]|max_length[255]|is_unique[unidad.name,idunidad,{id}]',
            ])
        ) {
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/unidad', $data);
        }
        $datos = [
            'unidad' => $_POST["unidad"],
        ];
        $UnidadModel->actualizar($id, $datos);
        return redirect()->route('unidad');
    }
    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $UnidadModel = new UnidadModel();
        if (!isset ($_GET["id"]) and empty ($_GET['id'])) {
            $id = '0';
        } else {
            $id = $_GET["id"];
        }
        return $UnidadModel->delete($id);

    }
    public function recovery()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $UnidadModel = new UnidadModel();
        $data['title'] = 'Recuperar Unidad';
        $data['data'] = $UnidadModel->view_delete();
        return $this->load_view('recovery/unidad', $data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $UnidadModel = new UnidadModel();
        if (!isset ($_GET["id"]) and empty ($_GET['id'])) {
            return false;
        } else {
            $id = $_GET["id"];
        }
        return $UnidadModel->recovery_data($id);
    }
    protected function load_view($view = null, $data = null)
    {
        
        $data['home'] = 'Unidad';
        $data['principal'] = $_SESSION['usuario'];
        echo view('head', $data);
        echo view('header');
        echo view('sidebar');
        echo view($view, $data);
        echo view('footer');
    }

    protected function validar()
    {
        if (isset ($_SESSION["fkroles"])) {
            $UnidadModel = new UnidadModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 1;
            $valiadar = $UnidadModel->valiadar($var);
            return $valiadar;
        }
    }
}