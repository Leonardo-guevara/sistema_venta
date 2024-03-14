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
        $this->helper = helper(array('form', 'url'));

    }
    public function index()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $UnidadModel = new UnidadModel();
        $data['title'] = 'Lista de Unidad';
        $data['home'] = 'Unidad';
        $data['principal'] = $this->session->get('usuario');
        $data['data'] = $UnidadModel->seleccionar();
        return $this->load_view('board/unidad', $data);
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form', 'url');
        $UnidadModel = new UnidadModel();
        $data['title'] = 'Crear Nuevo Unidad';
        $data['home'] = 'Unidad';
        $data['principal'] = $this->session->get('usuario');
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
    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form', 'url');
        $UnidadModel = new UnidadModel();
        if (!isset($_GET["id"]) and empty($_GET['id'])) {
            $id = '0';
        } else {
            $id = $_GET["id"];
        }
        $data['datos'] = $UnidadModel->encontrar($id);
        $data['title'] = 'Actualizar Unidad';
        $data['home'] = 'Unidad';
        $data['principal'] = $this->session->get('usuario');
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
        if (!isset($_GET["id"]) and empty($_GET['id'])) {
            $id = '0';
        } else {
            $id = $_GET["id"];
        }
        $UnidadModel->delete($id);
        header("Location: " . base_url() . "unidad/");

    }
    public function recovery()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $UnidadModel = new UnidadModel();
        $data['title'] = 'Recuperar Unidad';
        $data['home'] = 'Unidad';
        $data['principal'] = $this->session->get('usuario');
        $data['data'] = $UnidadModel->view_delete();
        return $this->load_view('recovery/unidad', $data);
    }
    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $UnidadModel = new UnidadModel();
        if (!isset($_GET["id"]) and empty($_GET['id'])) {
            $id = '0';
        } else {
            $id = $_GET["id"];
        }
        $UnidadModel->recovery_data($id);
        return redirect()->route('unidad');
    }
    protected function load_view($view = null, $data = null)
    {
        echo view('head', $data);
        echo view('header');
        echo view('sidebar');
        echo view($view, $data);
        echo view('footer');
    }

    protected function validar()
    {
        if (isset($_SESSION["fkroles"])) {
            $UnidadModel = new UnidadModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 1;
            $valiadar = $UnidadModel->valiadar($var);
            return $valiadar;
        }
    }
}