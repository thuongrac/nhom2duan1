<?php

require_once('../app/core/Database.php');

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addUser($name, $email, $phone, $role) {
        $query = "INSERT INTO users (name, email, phone, role) VALUES (:name, :email, :phone, :role)";
        $this->db->query($query);
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':role', $role);
        return $this->db->execute();
    }

    public function updateUser($id, $name, $email, $phone, $role) {
        $query = "UPDATE users SET name = :name, email = :email, phone = :phone, role = :role WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':role', $role);
        return $this->db->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

?>
