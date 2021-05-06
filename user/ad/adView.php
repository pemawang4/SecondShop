
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

    // if(isset($_GET['adId'])){
    //     echo $_GET['adId'];
    // }
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
                <div class="row no-gutters single-ad-body">
                   <div class="col-md-6 col-sm-6">
                        <h3><?php echo $ad['adTitle']; ?></h3>
                        <div class="single-ad-header">
                            Product Specification
                        </div>
                        <table class="table">
                            <tr>
                                <td width="43%">Ad Description</td>
                                <td width="57%"><?php echo $ad['adDesc']; ?></td>
                            </tr>
                            <tr>
                                <td>Ad Duration</td>
                                <td><?php echo $ad['adDuration']; ?></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><?php echo $ad['price']; ?></td>
                            </tr>
                            <?php if(isset($mainCat['catName']) != 'Events &amp; Programs' || isset($mainCat['catName']) != 'Services' || isset($mainCat['catName']) == 'Business &amp; Industrial' || isset($mainCat['catName']) != 'Travel, Tour &amp; Packages'){ ?>
                            <tr>
                                <td>Negotiable</td>
                                <td><?php echo $ad['priceNeg']; ?></td>
                            </tr>
                            <tr>
                                <td>Product Condition</td>
                                <td><?php echo $ad['productCondition']; ?></td>
                            </tr>
                            <tr>
                                <td>Used Period</td>
                                <td><?php echo $ad['productUsed']; ?></td>
                            </tr>
                            <?php if($mainCat['catName'] === 'Mobile'){ ?>
                            <tr>
                                <td>Owner Document</td>
                                <td><?php echo $ad['ownershipDocument']; ?></td>
                            </tr>
                            <tr>
                                <td>Sim Slot</td>
                                <td><?php echo $ad['slimSlot']; ?></td>
                            </tr>
                            <tr>
                                <td>Screen Size</td>
                                <td><?php echo $ad['screenSize']; ?></td>
                            </tr>

                            <tr>
                                <td>Mobile OS</td>
                                <td><?php echo $ad['phoneOs']; ?></td>
                            </tr>
                            <tr>
                                <td>Back Camera</td>
                                <td><?php echo $ad['backCamera']; ?></td>
                            </tr>
                            <tr>
                                <td>Front Camera</td>
                                <td><?php echo $ad['frontCamera']; ?></td>
                            </tr>
                            <tr>
                                <td>CUP</td>
                                <td><?php echo $ad['CPUCore']; ?></td>
                            </tr>
                            <tr>
                                <td>RAM</td>
                                <td><?php echo $ad['ram']; ?></td>
                            </tr>
                            <tr>
                                <td>Internal Storage</td>
                                <td><?php echo $ad['internalStorage']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mainCat['catName'] == 'Cars' || $mainCat['catName'] == 'Motorcycle'){ ?>
                            <tr>
                                <td>Type</td>
                                <td><?php echo $ad['type']; ?></td>
                            </tr>
                            <?php } if($mainCat['catName']=='Motorcycle'){ ?>
                            <tr>
                                <td>Anchal</td>
                                <td><?php echo $ad['anchal']; ?></td>
                            </tr>
                            <tr>
                                <td>Lot No</td>
                                <td><?php echo $ad['lotNo']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mainCat['catName'] == 'Motorcycle'){ ?>
                            <tr>
                                <td>Milage Given</td>
                                <td><?php echo $ad['milage']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mainCat['catName'] == 'Cars' || $mainCat['catName'] == 'Motorcycle'){ ?>
                            <tr>
                                <td>Make Year</td>
                                <td><?php echo $ad['makeYear']; ?></td>
                            </tr>
                            <tr>
                                <td>Km Ran</td>
                                <td><?php echo $ad['kmRun']; ?></td>
                            </tr>
                            <tr>
                                <td>Engine(CC)</td>
                                <td><?php echo $ad['engineCC']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mainCat['catName'] == 'Cars'){ ?>
                            <tr>
                                <td>Color</td>
                                <td><?php echo $ad['color']; ?></td>
                            </tr>
                            <tr>
                                <td>Fule Type</td>
                                <td><?php echo $ad['fule']; ?></td>
                            </tr>
                            <tr>
                                <td>Transmission</td>
                                <td><?php echo $ad['transmission']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mainCat['catName'] == 'Cars' || $mainCat['catName'] == 'Motorcycle' || $mainCat['catName'] == 'Mobile'){ ?>
                            <tr>
                                <td>Features</td>
                                <td><?php echo $ad['features']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mainCat['catName'] == 'Real Estate'){ ?>
                            <tr>
                                <td>Location</td>
                                <td><?php echo $ad['location']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mainCat['catName'] == 'Business &amp; Industrial'){ ?>
                            <tr>
                                <td>Included In Price</td>
                                <td><?php echo $ad['includedInPrice']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mainCat['catName'] != 'Events &amp; Programs' || $mainCat['catName'] != 'Real Estate' || $mainCat['catName'] != 'Services' || $mainCat['catName'] != 'Travel, Tour &amp; Packages' || $mainCat['catName'] != 'Business &amp; Industrial'){ 
                                
                            ?>
                            <tr>
                                <td>Home Delivery</td>
                                <td><?php echo $ad['homeDelivery']; ?></td>
                            </tr>
                            <tr>
                                <td>Delivery Area</td>
                                <td><?php echo $ad['deliveryArea']; ?></td>
                            </tr>
                            <tr>
                                <td>Delivery Charge</td>
                                <td><?php echo $ad['deliveryCharge']; ?></td>
                            </tr>
                            <tr>
                                <td>Warranty Type</td>
                                <td><?php echo $ad['warrantyType']; ?></td>
                            </tr>
                            <tr>
                                <td>Warranty Period</td>
                                <td><?php echo $ad['warrantyPeriod']; ?></td>
                            </tr>
                            <tr>
                                <td>Warranty Includes</td>
                                <td><?php echo $ad['warrantyIncludes']; ?></td>
                            </tr>
                            <?php } }?>
                        </table>
                       
                   </div>

                   <div class="col-md-6 col-sm-6">
                       <div class="single-ad-image">
                           <img src="../../images/<?php echo $ad['productPic']; ?>" alt="">
                       </div> 
                   </div>
                </div>
                
                
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