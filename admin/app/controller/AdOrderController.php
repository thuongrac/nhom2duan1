<?php
require_once '../app/model/OrderModel.php';

class AdOrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    

    public function viewOrders() {
        $orderModel = new OrderModel();
        $orders = $orderModel->getAllOrders(); 
        require_once './app/view/orderView.php'; 
    }
}
?>
