<?php 
    include 'includes/header.php'; 
    Session::start();
    
?>
<div class="nav" style="margin-bottom:10px;">
    <div class="col-md-6 col-sm-6">
        <ul>
            <li><a href=""><i class="fas fa-home"></i> Home</a></li>
            <?php if(isset($_SESSION['authCheck'])){ ?>
            <li><a href="user/userAccount/index.php"><i class="fas fa-user-cog"></i> My Account</a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="col-md-6 col-sm-6">
        <ul class="float-right">
            <?php if(!isset($_SESSION['authCheck'])){ ?>
            <li><a href="">Sign Up | </a></li>
            <li><a href="user/login.php">Login</a></li>
            <?php }else{ ?>
            <li><a href="user/logout.php">Log Out </a></li>
            <?php } ?>
        </ul>
    </div>
</div>
    
    <!-- Ad Search Bar -->
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2">
                <img src="images/logo.png" alt="logo" height="40" width="170">
            </div>

            <div class="col-md-10 col-sm-10">
                <form class="form-inline">
                    <select name="" id="" class="search">
                        <option value="" class="text-center"> All <i class="fas fa-chevron-circle-down"></i></option>
                        <?php 
                            $cat = new Category;
                            $cats = $cat->getCategories();
                            foreach($cats as $cat){
                        ?>
                        <option value="<?php $cat['catId'] ?>"><?php echo $cat['catName']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" class="searchBar" placeholder="Search here">
                    <a href="#">
                        <i class="fas fa-search searchIcon"></i>
                    </a>
                </form>
            <div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <!-- Featured Ad -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="ad-header">
                            Featured Ads
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
                
                <!-- Popular Ads -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="ad-header">
                            Popular Ads
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>

                <!-- Recent Ads -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="ad-header">
                            New Ads
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="ad-body">
                            <div class="ad">
                                <img src="images/1.jpeg" alt="">
                                <div class="ad-title">
                                    Best T-Shirt
                                </div>
                                <div class="ad-price">
                                    &#8377 1000
                                </div>
                                <div class="ad-address">
                                    Chabahil, Kathmandu
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="other-ads">
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>