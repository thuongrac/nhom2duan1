<?php
require_once('../app/model/database.php');

require_once ('../app/model/ProductModel.php');
require_once ('./app/controller/AdProductController.php');
require_once ('./app/controller/AdCategoryController.php');
require_once ('./app/controller/AdUserController.php');
require_once ('./app/controller/AdOrderController.php');

require_once ('./app/view/header.php');

if (isset($_GET['page'])){
    $page = $_GET['page'];
    switch ($page) {
        case 'addpro':
            $add = new AdProductController();
            $add->viewAdd();
            break;
        case 'add':
            $product = new AdProductController();
            $product->addPro(); 
            break;
        case 'editpro':
            $edit = new AdProductController();
            $edit->viewEdit($_GET['id']);
            break;
        case 'updatepro':
            $update = new AdProductController();
            $update->updatePro();
            break;
        case 'delpro':
            $del = new AdProductController();
            $del->delPro();
            break;
        case 'cate':
            $cate = new AdCategoryController();
            $cate->getCategory();
            break;
        case 'product':
            $pro = new AdProductController();
            $pro->viewPro();
            break;

            case 'user':
                $userController = new AdUserController();
                $userController->viewUsers();
                break;

            case 'order':
                $order = new AdOrderController();
                $order->viewOrders();
                break;
        default:
            $product = new AdProductController();
            $product->viewPro();
            break;
    }
} else {
    $product = new AdProductController();
    $product->viewPro();
}

require_once('app/view/footer.php');
?>
