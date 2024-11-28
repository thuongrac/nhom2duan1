<?php
    class AdCategoryController{
        private $db;
         function __construct(){
            $this->db = new Database();
        }
        function getCate(){
            $sql = "SELECT * FROM categories";
            return $this->db->getAll($sql);
        }
    }
?>