 <?php

require_once('../app/model/ProductModel.php');
require_once('../app/model/CategoryModel.php');

class AdProductController {
    private $product;
    private $category;
    private $data;

    public function __construct() {
        $this->product = new ProductModel();
        $this->category = new CategoryModel();
    }

    function renderView($view, $data = null) {
        $view = './app/view/' . $view . '.php';
        require_once $view;

    }

    function viewPro() {
        $this->data['product'] = $this->product->getProducts(0);
        $this->renderView('product', $this->data);
    }

    function viewAdd() {
        $this->data['listcate'] = $this->category->getCate();
        $this->renderView('addpro', $this->data);
    }

    function addPro() {
        if (isset($_POST['sub'])) {
            $data = [];
            $data['title'] = $_POST['title'];
            $data['price'] = $_POST['price'];
            $data['description'] = $_POST['description'];
            $data['category_id'] = $_POST['category_id'];
            $data['image'] = $_FILES['image']['name'];
            $file = '../public/upload/img/' . $data['image'];
            move_uploaded_file($_FILES['image']['tmp_name'], $file);
            $this->product->insertPro($data);
            echo '<script>location.href="index.php?page=product";</script>';
        }
    }

    function updatePro() {
        if (isset($_POST['update'])) {
            $data = [];
            $data['id'] = $_POST['id'];  
            $data['title'] = $_POST['title'];
            $data['price'] = $_POST['price'];
            $data['description'] = $_POST['description'];
            $data['category_id'] = $_POST['category_id'];
    
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = $_FILES['image']['name'];
                $file = '../public/upload/img/' . $data['image'];
                move_uploaded_file($_FILES['image']['tmp_name'], $file);
            } else {
                $data['image'] = isset($_POST['existing_image']) ? $_POST['existing_image'] : null;
            }
    
            $this->product->updatePro($data);
            echo '<script>location.href="index.php?page=product";</script>';
        }
    }
    

    function delPro() {
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $id = $_GET['id'];
            $this->product->deletePro($id);
            echo '<script>location.href="index.php?page=product";</script>';
        }
    }

    function viewEdit($id = null) {
        if ($id) {
            $this->data['pro_detail'] = $this->product->getIdPro($id);
        } else {
            $this->data['pro_detail'] = [];
        }
        $this->data['listcate'] = $this->category->getCate();
        $this->renderView('editpro', $this->data);
    }
}
?> 
