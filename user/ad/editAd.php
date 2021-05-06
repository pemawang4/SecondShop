
<?php include '../../includes/header.php'; 
      include 'ad.php';
    $cat = new Category;
    $ad = new Ad;
    if(isset($_GET['adId'])){
        $adId = $_GET['adId'];
        $ad = $ad->getAdById($adId);

        $mainCatId = $ad['mainCatId'];
        $mainCat = $cat->mainCatById($mainCatId);

        // echo '<pre>';
        // print_r($mainCat);
        // exit;
    }

    //Updating post
    if(isset($_POST['updateAd'])){
        // echo "<pre>";
        // print_r($_POST);
        // exit;

        $fileName = $_FILES['productPic']['name'];
        $fileSize = $_FILES['productPic']['size'];
        $fileTmp = $_FILES['productPic']['tmp_name'];
        $fileType = $_FILES['productPic']['type'];
        
        $mainCat['catName'] = "";
        $_POST['userId'] = Session::get('userId');
        $insertAd = $ad->updatePost($_POST, $fileName, $fileSize, $fileTmp, $fileType);
    }
?>
<div class="nav" style="margin-bottom:5px;">
    <div class="col-md-6 col-sm-6">
        <ul>
            <li><a href=""><i class="fas fa-home"></i> Home</a></li>
            <?php if(isset($_SESSION['authCheck'])){ ?>
            <li><a href=""><i class="fas fa-user-cog"></i> My Account</a></li>
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

<div class="container">
    <div class="userAccount">
        <div class="row no-gutters">
            <div class="col-md-3 col-sm-3">
                <div class="accountMenuHeader">
                    <i class="fas fa-user-cog"></i>
                    My Account
                </div>
                <div class="accountMenu">
                    <ul>
                        <li><a href="" id="newAd">Post New Ad</a></li>
                        <li><a href="" id="myAds">My Ads</a></li>
                        <li><a href="">Messages</a></li>
                        <li><a href="">My Profile</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9 col-sm-9" style="border-left: 1px solid black">
                <div class="row no-gutters">
                    <div class="col-md-12 col-sm-12">
                        <div class="adv-header">
                            <h2>Ad Details</h2>
                        </div>
                    </div>
                </div>
                <form action="<?php echo htmlSpecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row no-gutters single-ad-edit-body">
                        <div class="col-md-6 col-sm-6">
                                <h3><?php echo $ad['adTitle']; ?></h3>
                                <div class="single-ad-header">
                                    Product Specification
                                </div>
                                <table class="table">
                                    <tr>
                                        <td width="43%">Ad Description</td>
                                        <td width="57%"><input type="text" value="<?php echo $ad['adDesc']; ?>" name="adDesc"></td>
                                    </tr>
                                    <tr>
                                        <td>Ad Duration</td>
                                        <td><input type="text" name="adDuration" value="<?php echo $ad['adDuration']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><input type="text" name="price" value="<?php echo $ad['price']; ?>" id=""></td>
                                    </tr>
                                    <?php if(isset($mainCat['catName']) != 'Events &amp; Programs' || isset($mainCat['catName']) != 'Services' || isset($mainCat['catName']) == 'Business &amp; Industrial' || isset($mainCat['catName']) != 'Travel, Tour &amp; Packages'){ ?>
                                    <tr>
                                        <td>Negotiable</td>
                                        <td><input type="text" name="priceNeg" value="<?php echo $ad['priceNeg']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Product Condition</td>
                                        <td><input type="text" name="productCondition" value="<?php echo $ad['productCondition']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Used Period</td>
                                        <td><input type="text" name="productUsed" value="<?php echo $ad['productUsed']; ?>" id=""></td>
                                    </tr>
                                    <?php if($mainCat['catName'] === 'Mobile'){ ?>
                                    <tr>
                                        <td>Owner Document</td>
                                        <td><input type="text" name="ownershipDocument" value="<?php echo $ad['ownershipDocument']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Sim Slot</td>
                                        <td><input type="text" name="slimSlot" value="<?php echo $ad['slimSlot']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Screen Size</td>
                                        <td><input type="text" name="screenSize" value="<?php echo $ad['screenSize']; ?>" id=""></td>
                                    </tr>

                                    <tr>
                                        <td>Mobile OS</td>
                                        <td><input type="text" name="phoneOs" value="<?php echo $ad['phoneOs']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Back Camera</td>
                                        <td><input type="text" name="backCamera" value="<?php echo $ad['backCamera']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Front Camera</td>
                                        <td><input type="text" name="frontCamera" value="<?php echo $ad['frontCamera']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>CUP</td>
                                        <td><input type="text" name="CPUCore" value="<?php echo $ad['CPUCore']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>RAM</td>
                                        <td><?php echo $ad['ram']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Internal Storage</td>
                                        <td><input type="text" name="internalStorage" value="<?php echo $ad['internalStorage']; ?>" id=""></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($mainCat['catName'] == 'Cars' || $mainCat['catName'] == 'Motorcycle'){ ?>
                                    <tr>
                                        <td>Type</td>
                                        <td><input type="text" name="type" value="<?php echo $ad['type']; ?>" id=""></td>
                                    </tr>
                                    <?php } if($mainCat['catName']=='Motorcycle'){ ?>
                                    <tr>
                                        <td>Anchal</td>
                                        <td><input type="text" name="anchal" value="<?php echo $ad['anchal']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Lot No</td>
                                        <td><input type="text" name="lotNo" value="<?php echo $ad['lotNo']; ?>" id=""></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($mainCat['catName'] == 'Motorcycle'){ ?>
                                    <tr>
                                        <td>Milage Given</td>
                                        <td><input type="text" name="milage" value="<?php echo $ad['milage']; ?>" id=""></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($mainCat['catName'] == 'Cars' || $mainCat['catName'] == 'Motorcycle'){ ?>
                                    <tr>
                                        <td>Make Year</td>
                                        <td><input type="text" name="makeYear" value="<?php echo $ad['makeYear']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Km Ran</td>
                                        <td><input type="text" name="kmRun" value="<?php echo $ad['kmRun']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Engine(CC)</td>
                                        <td><input type="text" name="engineCC" value="<?php echo $ad['engineCC']; ?>" id=""></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($mainCat['catName'] == 'Cars'){ ?>
                                    <tr>
                                        <td>Color</td>
                                        <td><input type="text" name="color" value="<?php echo $ad['color']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Fule Type</td>
                                        <td><input type="text" name="fule" value="<?php echo $ad['fule']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Transmission</td>
                                        <td><input type="text" name="transmission" value="<?php echo $ad['transmission']; ?>" id=""></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($mainCat['catName'] == 'Cars' || $mainCat['catName'] == 'Motorcycle' || $mainCat['catName'] == 'Mobile'){ ?>
                                    <tr>
                                        <td>Features</td>
                                        <td><input type="text" name="features" value="<?php echo $ad['features']; ?>" id=""></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($mainCat['catName'] == 'Real Estate'){ ?>
                                    <tr>
                                        <td>Location</td>
                                        <td><input type="text" name="location" value="<?php echo $ad['location']; ?>" id=""></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($mainCat['catName'] == 'Business &amp; Industrial'){ ?>
                                    <tr>
                                        <td>Included In Price</td>
                                        <td><input type="text" name="includedInPrice" value="<?php echo $ad['includedInPrice']; ?>" id=""></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($mainCat['catName'] != 'Events &amp; Programs' || $mainCat['catName'] != 'Real Estate' || $mainCat['catName'] != 'Services' || $mainCat['catName'] != 'Travel, Tour &amp; Packages' || $mainCat['catName'] != 'Business &amp; Industrial'){ 
                                        
                                    ?>
                                    <tr>
                                        <td>Home Delivery</td>
                                        <td><input type="text" name="homeDelivery" value="<?php echo $ad['homeDelivery']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Delivery Area</td>
                                        <td><input type="text" name="deliveryArea" value="<?php echo $ad['deliveryArea']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Delivery Charge</td>
                                        <td><input type="text" name="deliveryCharge" value="<?php echo $ad['deliveryCharge']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Warranty Type</td>
                                        <td><input type="text" name="warrantyType" value="<?php echo $ad['warrantyType']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Warranty Period</td>
                                        <td><input type="text" name="warrantyPeriod" value="<?php echo $ad['warrantyPeriod']; ?>" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>Warranty Includes</td>
                                        <td>
                                            <input type="text" name="warrantyIncludes" value="<?php echo $ad['warrantyIncludes']; ?>" id="">
                                            <input type="file" name="productPic" value="<?php echo $ad['productPic']; ?>">
                                            <input type="hidden" name="mainCatId" value="<?php echo $ad['subCatId']; ?>">
                                            <input type="hidden" name="subCatId" value="<?php echo $ad['mainCatId']; ?>">
                                            <input type="hidden" name="adId" id="adId" value="<?php echo $ad['adId']; ?>">
                                            <input type="hidden" name="adTitle" value="<?php echo $ad['adTitle']; ?>">
                                        </td>
                                    </tr>
                                    
                                    <?php } }?>
                                </table>
                                <div class="updateAd">                        
                                    <button name="updateAd" class="btn btn-sm btn-success">Update Ad</button>
                                </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="single-ad-image">
                                <img src="../../images/<?php echo $ad['productPic']; ?>" alt="">
                            </div> 
                        </div>
                    </div>
                </form>
                
                <!-- <div class="row no-gutters">
                    <div class="col-md-12 col-sm-12">
                        <div class="adv-body">
                            <?php //if(isset($_GET['adSaved']) && isset($_GET['adSaved']) == "success"){ ?>
                                    <div class="alert-success">
                                        New ad has been saved successfully.
                                    </div>
                            <?php //} ?>
                            <div class="all-ad-body">
                                <div class="col-md-3 col-sm-3">
                                    <img src="../../images/1.jpeg" alt="ad-img" width="100" height="90">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="ad-details">
                                            asdfasd
                                        </div>
                                    </div>
                            </div>                 
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
$(document).ready(function(){
    $('#newAd').click(function(event){
        //$('.accountMenuBody').show();
        event.preventDefault();
        $('.mainCat').show();
    });

    $(".mainCatId").click(function(){
        //event.preventDevault();
        var mainCatId = $(this).val();
        

        $('.subCat').fadeIn(500);
        $.post("../../classes/category.php", {'mainCatId': mainCatId}, function(data){ 
         }).done(function(data){
            $('.subCat').html(data);
         });

         
    });

    $(document).on('click', '.subCatId', function(){
        $('.next').show();
    });

    $(document).on('click', '#next', function(){
        //$('.next').show();
        var subCatId = $('.subCatId').val();
        $(location).attr('href', 'newAd.php?subCatId=' + subCatId);
    });

    $('#myAds').click(function(event){
        event.preventDefault();
        $('.accountMenuBody').hide();
        $('.accountMenuBody1').show();
    });

    $("#submit1").click(function(){
        //event.preventDevault();
        //alert();
        
    });
});
</script>
<?php include '../../includes/footer.php'; ?>