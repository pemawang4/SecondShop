<?php 
    $path = $_SERVER['DOCUMENT_ROOT'] . '/secondShop/';
    include_once $path.'classes/session.php';
    include_once $path.'Database/database.php';
    include_once $path.'Format/validate.php';

    class UserAuth{
        public $db;
        public $validate;
        public $error, $nameErr, $emailErr, $passwordErr;
        public $noUserPass, $badUserPass;
        public function __construct(){
            $this->db = new Database();
            $this->validate = new Validate();
            Session::start();
        }

        public function register($post){
            $fullName = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['fullName']));
            $email = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['email']));
            $password = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['password']));
            $confirmPassword = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['confirmPassword']));
            $contact = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['contact']));
            $address = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['address']));
            
            if(empty($fullName) || empty($email) || empty($password) || empty($confirmPassword) || empty($contact) || empty($address)){
                return $this->error = "Please fill all the fileds properly.";
            }else{
                if($this->validate->validateName($fullName) == false){
                    return $this->nameErr = "Please enter only letters in the name field.";
                }else{
                    if($this->validate->validateEmail($email) == false){
                        return $this->emailErr = "Please fill the email properly.";
                    }else{
                        $query = "SELECT * FROM users WHERE email = '$email'";
                        $result = $this->db->select($query);
                        $row = $result->fetch_assoc();
                        if($row['email'] == $email){
                            return $this->emailErr = "The email entered already exists. Please enter different email.";
                        }else{
                            $passwordLenght = strlen($password);
                            if($passwordLenght < 8){
                                return $this->passwordErr = "Password should at least contain 8 charecters.";
                            }else{
                                if($password !== $confirmPassword){
                                    return $this->passwordErr = "The given passwords do not match. Please enter the same password.";
                                }else{
                                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                                    $query = "INSERT INTO users(fullName, email, password, contact, address) values ('$fullName', '$email', '$hashedPassword', '$contact', '$address')";
                                    $insert = $this->db->insert($query);
                                    $message = "User created successfully.";
                                    if($insert){
                                        header("Location: login.php?message=".urlencode($message));
                                    }
                                }
                            }
                        }   
                    } 
                }
            }
        }
        
        //User logging in
        public function login($post){
            $email = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['email']));
            $password = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['password']));
            
            if(empty($email) || empty($password)){
                return $this->noUserPass = "Please enter username and password correctly.";
            }else{
                $query = "SELECT * FROM users WHERE email = '$email'";
                $result = $this->db->select($query);
                $row = $result->fetch_assoc();

                if(!password_verify($password, $row['password'])){
                    return $this->badUserPass = "Please enter the correct username and password.";
                }else{
                    Session::start();
                    Session::set('email', $row['email']); 
                    Session::set('name', $row['fullName']);
                    Session::set('userId', $row['userId']);
                    Session::set('authCheck', true);
                    header("Location: ../index.php");
                }
            }
        }

        public function getUser($userId){
            $query = "SELECT * FROM users WHERE userId = $userId";
            $result = $this->db->select($query);
            $user = $result->fetch_assoc();
            return $user;
        }

        public function getUserProfile($userId){
            $query = "SELECT * FROM users WHERE userId = $userId";
            $result = $this->db->select($query);
            $user = $result->fetch_assoc();
            echo "
            
            <table class='table'>
                    <tbody>
                            <tr>
                                <th scope='row'>Full Name: </th>
                                <td><input type='text' name='fullName' id='fullName' value='".$user['fullName']."'></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope='row'>Email: </th>
                                <td> <input type='text' name='email' id='email' value='".$user['email']."'></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope='row'>Contact: </th>
                                <td> <input type='text' name='contact' id='contact' value='".$user['contact']."'></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope='row'>Address: </th>
                                <td> <input type='text' name='address' id='address' value='".$user['address']."'></td>
                                <td></td>
                                <input type='hidden' name='profile-userId' id='profile-userId' value='".$user['userId']."'>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <button class='btn btn-primary btn-sm' id='update-profile'>Update Profile</button>
                                    <button class='btn btn-danger btn-sm' id='update-cancle'>Cancle</button>

                                </td>
                            </tr>
                        </tbody>
            </table>
            ";
            die();
        }

        public function updateUserProfile($post){
            $userId = $post['profileUserId'];
            $fullName = $post['fullName'];
            $email = $post['email'];
            $contact = $post['contact'];
            $address = $post['address'];

            $query = "UPDATE users SET fullName = '$fullName', email = '$email', contact = '$contact', address = '$address'";
            $result = $this->db->update($query);

        }
    }

    