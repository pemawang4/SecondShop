<?php include '../includes/header.php'; ?>
<?php 
    $validate = new Validate;
    $db = new Database;
    $userAuth = new UserAuth;       
    $fullName = $email = $contact = $address = $gender = "";
    if(isset($_POST['register'])){
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        
        $register = $userAuth->register($_POST);  
    }
?>

<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-md-6 col-sm-6 offset-md-3">
            <div class="card">
                <div class="card-header"><h3>Register</h3></div>
                <div class="card-body">
                <span style="color:#eb0b0b; margin: 10px 0 10px 0;"><?php echo $userAuth->error; ?></span>
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="fullName">Full Name <span class="red">*</span></label>
                                    <input type="text" name="fullName" placeholder="Enter your full name" class="form-control" value="<?php echo $fullName; ?>">
                                    <span style="color:#eb0b0b; margin: 10px 0 10px 0;"><?php echo $userAuth->nameErr; ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="red">*</span></label>
                                    <input type="text" name="email" placeholder="Enter email" class="form-control" value="<?php echo $email; ?>">
                                    <span style="color:#eb0b0b; margin: 10px 0 10px 0;"><?php echo $userAuth->emailErr; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="password"> Password <span class="red">*</span></label>
                                    <input type="password" name="password" placeholder="Enter password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password"> Confirm Password <span class="red">*</span></label>
                                    <input type="password" name="confirmPassword" placeholder="Enter password" class="form-control">
                                    <span style="color:#eb0b0b;"><?php echo $userAuth->passwordErr; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact Number <span class="red">*</span></label>
                                    <input type="number" name="contact" placeholder="Enter contact number" class="form-control" value="<?php echo $contact; ?>">
                                </div>    
                                <div class="form-group">
                                    <label for="email">Address <span class="red">*</span></label>
                                    <input type="text" name="address" placeholder="Enter address" class="form-control" value="<?php echo $address ?>">
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 margin">
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