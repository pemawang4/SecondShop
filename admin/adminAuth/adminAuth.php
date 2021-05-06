<?php 
    $path = $_SERVER['DOCUMENT_ROOT'] . '/secondShop/';
    include_once $path.'classes/session.php';
    include_once $path.'Database/database.php';
    include_once $path.'Format/validate.php';

    class AdminAuth{
        public $db;
        public $validate;
        public $error, $nameErr, $userNameErr, $emailErr, $passwordErr;
        public $noUserPass, $badUserPass;
        public function __construct(){
            $this->db = new Database();
            $this->validate = new Validate();
            Session::start();
        }

        public function register($post){
            $firstName = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['firstName']));
            $lastName = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['lastName']));
            $userName = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['userName']));
            $email = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['email']));
            $password = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['password']));
            $confirmPassword = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['confirmPassword']));
            $contact = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['contact']));
            $address = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['address']));
            if(isset($post['gender'])){
                $gender = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['gender']));
            }else{
                $gender = "";
            }
            if(empty($firstName) || empty($lastName) || empty($userName) || empty($email) || empty($password) || empty($confirmPassword) || empty($contact) || empty($address) || empty($gender)){
                return $this->error = "Please fill all the fileds properly.";
            }else{
                $name = $firstName . $lastName;
                if($this->validate->validateName($name) == false){
                    return $this->nameErr = "Please enter only letters in the name field.";
                }else{
                    $userNameLenght = strlen($userName);
                    if($userNameLenght < 6){
                        return $this->userNameErr = "Username should at least contain 6 charecters.";
                    }else{
                        $query = "SELECT * FROM admin WHERE username = '$userName'";
                        $result = $this->db->select($query);
                        $row = $result->fetch_assoc();
                        if($row['username'] == $userName){
                            return $this->userNameErr = "The username already existed. Please select a different username.";
                        }else{
                            if($this->validate->validateEmail($email) == false){
                                return $this->emailErr = "Please fill the email properly.";
                            }else{
                                $query = "SELECT * FROM admin WHERE email = '$email'";
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
                                            $passwordErr = "The given passwords do not match. Please enter the same password.";
                                        }else{
                                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                                            $query = "INSERT INTO admin(firstName, lastName, username, password, email, contact, admin, gender, address) values ('$firstName', '$lastName', '$userName', '$hashedPassword', '$email', '$contact', 0, '$gender', '$address')";
                                            $insert = $this->db->insert($query);
                                            $message = "User created successfully.";
                                            if($insert == true){
                                                header("Location: login.php?message=".urlencode($message));
                                            }
                                        }
                                    }
                                }   
                            }
                        }  
                    }  
                }
            }
        }
        
        //User logging in
        public function login($username, $password){
            $username = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($username));
            $password = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($password));
            
            if(empty($username) || empty($password)){
                return $this->noUserPass = "Please enter username and password correctly.";
            }else{
                //$hashed = password_hash($password, PASSWORD_DEFAULT);
                $query = "SELECT * FROM admin WHERE username = '$username' OR email = '$username'";
                $result = $this->db->select($query);
                $row = $result->fetch_assoc();

                if(!password_verify($password, $row['password'])){
                    return $this->badUserPass = "Please enter the correct username and password.";
                }else{
                    Session::start();
                    Session::set('email', $row['email']); 
                    Session::set('name', $row['firstName'].' '.$row['lastName']);
                    Session::set('userId', $row['id']);
                    Session::set('authCheck', true);
                    header("Location: ../home.php");
                }
            }
        }
    }
?>