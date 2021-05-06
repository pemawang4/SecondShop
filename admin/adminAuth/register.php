<?php 
include '../includes/header.php'; 
    $validate = new Validate;
    $db = new Database;
    $adminAuth = new AdminAuth;       
    $firstName = $lastName = $userName = $email = $contact = $address = $gender = "";
    if(isset($_POST['register'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        if(isset($_POST['gender'])){
            $gender = $_POST['gender'];
        }else{
            $gender = "";
        }
        $register = $adminAuth->register($_POST);  
    }
?>

<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-md-10 col-sm-10 offset-md-1">
            <div class="card">
                <div class="card-header text-center"><h3>Register</h3></div>
                <div class="card-body">
                <span style="color:#eb0b0b; margin: 10px 0 10px 0;"><?php echo $adminAuth->error; ?></span>
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 offset-md-1">
                                <label for="firstName">First Name </label>
                                <input type="text" name="firstName" placeholder="Enter first name" class="form-control" value="<?php echo $firstName; ?>">
                            </div>

                            <div class="col-md-5 col-sm-5">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="lastName" placeholder="Enter last name" class="form-control" value="<?php echo $lastName; ?>">
                            </div>
                            
                            <div class="col-md-10 offset-md-1 margin">
                                <span style="color:#eb0b0b; margin: 10px 0 10px 0;"><?php echo $adminAuth->nameErr; ?></span> 
                            </div>
                            <div class="col-md-5 col-sm-5 offset-md-1 margin">
                                <label for="username">User Name</label>
                                <input type="text" name="userName" placeholder="Enter a new username" class="form-control" value="<?php echo $userName; ?>">
                                <span style="color:#eb0b0b; margin: 10px 0 10px 0;"><?php echo $adminAuth->userNameErr; ?></span>
                            </div>

                            <div class="col-md-5 col-sm-5">
                                <label for="email">Email </label>
                                <input type="text" name="email" placeholder="Enter email" class="form-control" value="<?php echo $email; ?>">
                                <span style="color:#eb0b0b; margin: 10px 0 10px 0;"><?php echo $adminAuth->emailErr; ?></span>
                            </div>
                            
                            <div class="col-md-5 col-sm-5 offset-md-1">
                                <label for="password"> Password </label>
                                <input type="password" name="password" placeholder="Enter password" class="form-control">
                            </div>

                            <div class="col-md-5 col-sm-5">
                                <label for="password"> Confirm Password </label>
                                <input type="password" name="confirmPassword" placeholder="Enter password" class="form-control">
                            </div>

                            <div class="col-md-10 offset-md-1 margin">
                                <span style="color:#eb0b0b;"><?php echo $adminAuth->passwordErr; ?></span>
                            </div>

                            <div class="col-md-5 col-sm-5 offset-md-1 margin">
                                <label for="contact">Contact Number</label>
                                <input type="number" name="contact" placeholder="Enter contact number" class="form-control" value="<?php echo $contact; ?>">
                            </div>

                            <div class="col-md-5 col-sm-5">
                                <label for="email">Address </label>
                                <input type="text" name="address" placeholder="Enter address" class="form-control" value="<?php echo $address ?>">
                            </div>

                            <div class="col-md-5 col-sm-5 offset-md-1 margin">
                                <label for="gender">Gender </label><br>
                                <label for="male" class="radio-inline"> <input type="radio" value="male" name="gender" <?php if(isset($gender) && $gender == 'male'){ echo 'checked'; } ?> > Male </label> &nbsp;
                                <label for="female" class="radio-inline"> <input type="radio" value="female" name="gender" <?php if(isset($gender) && $gender == 'female'){ echo 'checked'; } ?> > Female </label>
                            </div>

                            <!-- <div class="col-md-5 col-sm-5" style="margin-bottom: 40px;">
                                <label for="impage">Image </label>
                                <input type="file" name="image" class="">
                            </div> -->

                            <div class="col-md-10 col-sm-10 offset-md-1">
                                <div class="form-group">
                                    <button class="btn btn-success registerBtn" name="register" type="submit">Sign Up</button>
                                    <p class="text-center">Or <a href="login.php">Login</a> </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>