<?php

require_once('../app/model/UserModel.php');

class AdUserController {
    public function viewUsers() {
        $userModel = new UserModel();
        $data['users'] = $userModel->getAllUsers();
        require_once('./app/view/userView.php');
    }
}

?>
