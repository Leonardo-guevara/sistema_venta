<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Config\BaseConfig;


class Producto extends BaseController
{
    public function __construct()
    {
        // $this->session = \Config\Services::session();
        \Config\Services::session();
    }

    public function index()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $ProductoModel = new ProductoModel();
        $data['title'] = 'Lista de Producto';
        if (!empty($_POST)) {
            if (!$this->validate([
                'producto' => 'required',
            ])) {
                $data['errors'] = $this->validator->getErrors();
                return $this->load_view('board/producto', $data);
            }
            $datos = [
                'producto' => $_POST["producto"],
            ];
            $data['data'] = $ProductoModel->seleccionar($datos);
            return $this->load_view('board/producto', $data);
        }
        $datos = [
            'producto' => "0",
        ];
        $data['data'] = $ProductoModel->seleccionar($datos);
        return $this->load_view('board/producto', $data);
    }

    public function json()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $ProductoModel = new ProductoModel();
        if (!isset($_GET["code"]) and empty($_GET['code'])) {
            $code = '0';
        } else {
            $code = $_GET["code"];
        }
        $json = json_encode($ProductoModel->selec_presentacion($code));
        return $json;
    }
    public function insertunidad()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $ProductoModel = new ProductoModel();

        if (!$this->validate([
            'unidad' => 'required|min_length[3]|max_length[255]|is_unique[unidad.name]',
        ])) {
            $data['errors'] = $this->validator->getErrors();
            return $this->insert();
        }
        $data = [
            'data' => $_GET["unidad"],
        ];
        $ProductoModel->insertunidad($data);
        return $this->insert();
    }
    public function insertmarca()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $ProductoModel = new ProductoModel();
        if (!$this->validate([
            'marca' => 'required|min_length[3]|max_length[255]|is_unique[marca.name]',
        ])) {
            $data['errors'] = $this->validator->getErrors();
            return $this->insert();
        }
        $data = [
            'data' => $_GET["marca"],
        ];
        $ProductoModel->insertmarca($data);
        return $this->insert();
    }
    public function insertpresentacion()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $ProductoModel = new ProductoModel();
        if (!$this->validate([
            'unidad' => 'required',
            'presentacion' => 'required|min_length[3]|max_length[255]',
        ])) {
            $data['errors'] = $this->validator->getErrors();
            return $this->insert();
        }
        $data = [
            'fk_unidad' =>$_GET["unidad"],
            'presentacion' => $_GET["presentacion"],
        ];
        $ProductoModel->insertpresentacion($data);
        return $this->insert();
    }
    public function insertcategoria()
    {
        if ($this->validar() == NULL) {
            return false;
        }
        $ProductoModel = new ProductoModel();
        if (!$this->validate([
            'categoria' => 'required|min_length[3]|max_length[255]|is_unique[categoria.name]',
        ])) {
            $data['errors'] = $this->validator->getErrors();
            return $this->insert();
        }
        $data = [
            'data' => $_GET["categoria"],
        ];
        $ProductoModel->insertcategoria($data);
        return $this->insert();
    }
    public function insert()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form');
        $ProductoModel = new ProductoModel();
        $data['title'] = 'Crear Nuevo Producto';
        $data['home'] = 'Producto';
        $data['unidad'] = $ProductoModel->unidad();
        $data['categoria'] = $ProductoModel->categoria();
        $data['marca'] = $ProductoModel->marca();
        $data['presentacion'] = $ProductoModel->presentacion();
        if (!empty($_FILES["file"]["name"]) and isset($_FILES["file"]["name"])) {
            $foto = $this->upload_img($_FILES);
        }
        if (
            !$this->validate([
                'codigo' => 'required|min_length[3]|max_length[255]|is_unique[producto.codigo]',
                'name' => 'required|min_length[3]|max_length[255]|is_unique[producto.name]',
                'description' => 'required',
                'fk_unidad' => 'required',
                'fk_categoria' => 'required',
                'stocks' => 'required',
                'minimo' => 'required',
                'precio_compra' => 'required|decimal',
                'precio_venta' => 'required|decimal',
                'fk_presentacion' => 'required',

            ])
        ) {
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/producto', $data);
        }
        if (isset($_POST['fk_presentacion']) and !empty($_POST['fk_presentacion'])) {
            $fk_presentacion = $_POST['fk_presentacion'];
        } else {
            $fk_presentacion = '1';
        }

        // validar imagen
        if (isset($foto) and !empty($foto)) {
            $foto = "public/dist/img/vacio.png";
        }
        $datos = [
            'codigo' => $_POST["codigo"],
            'name' => $_POST["name"],
            'fk_presentacion' => $fk_presentacion,
            'description' => $_POST["description"],
            'fk_unidad' => $_POST["fk_unidad"],
            'fk_categoria' => $_POST["fk_categoria"],
            'stocks' => $_POST["stocks"],
            'minimo' => $_POST["minimo"],
            'precio_compra' => $_POST["precio_compra"],
            'precio_venta' => $_POST["precio_venta"],
            'fk_marca' => $_POST["fk_marca"],
            'foto' => $foto,
        ];
        $datos['user'] = $_SESSION['idusuario'];
        $ProductoModel->insertar($datos);
        return redirect()->route('producto');
    }

    public function update()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        helper('form');
        $ProductoModel = new ProductoModel();
        if (!isset($_GET["id"]) and empty($_GET['id'])) {
            $id = '';
        } else {
            $id = $_GET["id"];
        }
        $data['datos'] = $ProductoModel->encontrar($id);
        $data['title'] = 'Actualizar Producto';
        $data['home'] = 'Producto';
        $data['unidad'] = $ProductoModel->unidad();
        $data['marca'] = $ProductoModel->marca();
        $data['categoria'] = $ProductoModel->categoria();
        $data['presentacion'] = $ProductoModel->presentacion();

        if (!empty($_FILES["file"]["name"]) and isset($_FILES["file"]["name"])) {
            $foto = $this->upload_img($_FILES);
        }
        if (
            !$this->validate([
                'codigo' => 'required|min_length[3]|max_length[255]|is_unique[producto.codigo,idproducto,{id}]',
                'name' => 'required|min_length[3]|max_length[255]|is_unique[producto.name,idproducto,{id}]',
                'description' => 'required',
                'fk_unidad' => 'required',
                'fk_presentacion' => 'required',
                'fk_categoria' => 'required',
                'stocks' => 'required',
                'minimo' => 'required',
                'precio_compra' => 'decimal',
                'precio_venta' => 'decimal',

            ])
        ) {
            $data['errors'] = $this->validator->getErrors();
            return $this->load_view('form/producto', $data);
        }
        if (isset($_POST['fk_presentacion']) and !empty($_POST['fk_presentacion'])) {
            $fk_presentacion = $_POST['fk_presentacion'];
        } else {
            $fk_presentacion = '1';
        }
        // validar imagen
        if (isset($foto) and !empty($foto)) {
            $foto;
        } elseif ($data['datos']["foto"] == '') {
            $foto = "public/dist/img/vacio.png";
        } else {
            $foto = $data['datos']["foto"];
        }

        $datos = [
            'name' => $_POST["name"],
            'codigo' => $_POST["codigo"],
            'foto' => $foto,
            'description' => $_POST["description"],
            'stocks' => $_POST["stocks"],
            'minimo' => $_POST["minimo"],
            'precio_compra' => $_POST["precio_compra"],
            'precio_venta' => $_POST["precio_venta"],
            'fk_unidad' => $_POST["fk_unidad"],
            'fk_categoria' => $_POST["fk_categoria"],
            'fk_marca' => $_POST["fk_marca"],
            'fk_presentacion' => $fk_presentacion,
        ];
        $datos['user'] = $_SESSION['idusuario'];
        $ProductoModel->actualizar($id, $datos);
        return redirect()->route('producto');
    }

    public function delete()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $ProductoModel = new ProductoModel();
        if (!isset($_GET["id"]) and empty($_GET['id'])) {
            $id = '0';
        } else {
            $id = $_GET["id"];
        }
        $ProductoModel->delete($id);
        header("Location: " . base_url() . "Producto/");
    }

    public function recovery()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $ProductoModel = new ProductoModel();
        $data['title'] = 'Recuperar Producto';
        $data['data'] = $ProductoModel->view_delete();
        return $this->load_view('recovery/producto', $data);
    }

    public function recovery_mode()
    {
        if ($this->validar() == NULL) {
            return redirect()->route('login');
        }
        $ProductoModel = new ProductoModel();
        if (!isset($_GET["id"]) and empty($_GET['id'])) {
            $id = '0';
        } else {
            $id = $_GET["id"];
        }

        $ProductoModel->recovery_data($id);
        return redirect()->route('producto');
    }

    function upload_img($data)
    {

        $validationRule = [
            'file' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[file]',
                    'is_image[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[file,500]'
                ],
            ],
        ];
        if (!$this->validate($validationRule)) {
            $validar = ['errors' => $this->validator->getErrors()];

            return $validar;
        }
        $file = $this->request->getFile('file');

        if (!$file->hasMoved()) {
            $ext = $file->guessExtension();
            $name = 'user' . date('Y_m_d_H_i_s') . '.' . $ext;
            $ruta = './public/file/producto/';

            $file->move($ruta, $name);
            $data = 'public/file/producto/' . $name;

            return $data;
        } else {
            $data = ['errors' => 'El archivo ya se ha movido.'];
            return $data;
        }
    }

    protected function load_view($view = null, $data = null)
    {

        $data['home'] = 'Producto';
        $data['principal'] = $_SESSION['usuario'];
        echo view('head', $data);
        echo view('header');
        echo view('sidebar');
        echo view($view, $data);
        echo view('footer');
    }

    protected function validar()
    {
        if (isset($_SESSION["fkroles"])) {
            $ProductoModel = new ProductoModel();
            $var['roles'] = intval($_SESSION["fkroles"]);
            $var['permiso'] = 6;
            $valiadar = $ProductoModel->valiadar($var);
            return $valiadar;
        }
    }
}
