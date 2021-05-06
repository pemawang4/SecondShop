<?php include 'includes/header.php'; ?>
<nav>
    <div class="adminNav margin">
    <h3>Second Shop Admin Site</h3></div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3>Menu</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group adminMenu">
                        <li class="list-group-item list-group-item-action"><a href="home.php"><i class="fas fa-tachometer-alt"></i>  Dashboard</a></li>
                        <li class="list-group-item list-group-item-action"><a href="category.php"><i class="fas fa-bars"> </i>  Category</a></li>
                        <li class="list-group-item list-group-item-action"><a href=""><i class="fas fa-tags"></i>  Brand</a></li>
                        <li class="list-group-item list-group-item-action"><a href=""><i class="fas fa-shopping-cart"></i>  Products</a></li>
                        <li class="list-group-item list-group-item-action"><a href=""><i class="far fa-address-card"></i>  Users</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="dashPanel text-center">
                        <a href="home.php"><i class="fas fa-tachometer-alt"></i>  <br> Dashboard <br>
                            <small>Go to Dashboard</small>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="dashPanel text-center">
                        <a href="category.php"><i class="fas fa-tachometer-alt"></i>  <br> Category <br>
                            <small>Manage Category</small>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="dashPanel text-center">
                        <a href="home.php"><i class="fas fa-tags"></i>  <br> Brand <br>
                            <small>Manage Brand</small>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="dashPanel text-center">
                        <a href="home.php"><i class="fas fa-shopping-cart"></i>  <br> Products <br>
                            <small>Manage Products</small>
                        </a>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>