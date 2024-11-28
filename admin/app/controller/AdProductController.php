<?php

require_once('../app/model/Sanphamodel.php');

class AdProductController {
    public function viewUsers() {
        $userModel = new UserModel();
        $data['user'] = $userModel->getAllUsers();
        require_once('./app/view/userView.php');
    }
}

?>
