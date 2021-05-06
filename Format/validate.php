<?php 
//$filepath = realpath(dirname(__FILE__));
include_once $_SERVER['DOCUMENT_ROOT'].'/secondShop/admin/includes/header.php'; 

class Validate{
    public function sanitize($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validateName($name){
        if(!preg_match("/^[a-zA-Z ]*$/", $name)){
            return false;
        }else{
            return true;
        }
    }

    public function validateEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }else{
            return true;
        }
    }
}

$validate = new Validate;
?>