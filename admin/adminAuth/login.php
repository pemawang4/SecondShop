<?php include '../includes/header.php' ?>
<?php if(isset($_GET['message'])){ ?>
    <div class="alert alert-success">
        <?php echo $_GET['message']. ' Please login to continue.'; $_GET['message'] = "";?>
    </div>
<?php } ?>
<?php 
    $username = "";
    $adminAuth = new AdminAuth;
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $login = $adminAuth->login($_POST['username'], $_POST['password']);
    }
?>
<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-md-6 col-sm-6 offset-md-3">
            <div class="card">
                <div class="card-header text-center"><h3>Login</h3></div>
                <div class="card-body">
                <?php if(isset($adminAuth->noUserPass)){ ?><div class="alert alert-danger"><?php echo $adminAuth->noUserPass; ?></div><?php } ?>
                <?php if(isset($adminAuth->badUserPass)){ ?><div class="alert alert-danger"><?php echo $adminAuth->badUserPass; ?></div><?php } ?>
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <label for="username">Username or Email</label>
                            <input type="text" name="username" placeholder="Enter username or email" class="form-control" value="<?php echo $username; ?>">
                        
                        </div>

                        <div class="form-group margin">
                            <label for="password">Password </label>
                            <input type="password" name="password" placeholder="Enter password" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success registerBtn" name="login">Login</button>
                        </div>
                        </form>
                        <p class="text-center">Or <a href="register.php">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php' ?>