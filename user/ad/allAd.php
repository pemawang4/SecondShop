<?php include '../../includes/header.php'; 
      include 'ad.php';
    $cat = new Category;
    $ad = new Ad;
    if(isset($_GET['subCatId'])){
        $subCatId = $_GET['subCatId'];
        $subCat = $cat->subCatById($subCatId);

        $mainCatId = $subCat['mainCatId'];
        $mainCat = $cat->mainCatById($mainCatId);
    }

    if(isset($_GET['delId'])){
        $delId = $_GET['delId'];
        $table = 'ad';
        $id = 'adId';
        $delAd = $ad->deleteAd($id, $delId, $table);
    }

    if(isset($_GET['delete']) == 'deleted'){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Ad deleted successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }

    if(isset($_GET['sold'])){
        //echo "here";
        //exit;
        $adId = $_GET['sold'];

        $markAsSold = $ad->markAsSold($adId);
    }

    if(isset($_GET['unsold'])){
        $adId = $_GET['unsold'];

        $markAsUnsold = $ad->markAsUnsold($adId);
    }
?>
<div class="nav" style="margin-bottom:5px;">
    <div class="col-md-6 col-sm-6">
        <ul>
            <li><a href="../userAccount/"><i class="fas fa-home"></i> Home</a></li>
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
                            <h2>My Ads</h2>
                        </div>
                    </div>
                </div>
                <?php 
                    $userId = Session::get('userId');
                    $ads = $ad->getAdByUser($userId);
                    
                    foreach($ads as $ad){
                ?>
                <div class="row no-gutters all-ad-body">
                    <div class="col-md-3 col-sm-3">
                        <img src="../../images/<?php echo $ad['productPic']; ?>" alt="ad-img" width="130" height="115">
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <h2><?php echo $ad['adTitle']; ?></h2>
                        <?php if($ad['soldMark'] == 1){ echo "<h3 style='color:red;'>Item Sold</h3>"; } ?>
                        <p>Price:<b> &#8377 <?php echo empty($ad['price'])? 0 : $ad['price']; ?></b></p>
                        <p>Cagetory: Main Category > SubCategory</p>
                        <div class="ad-btns">
                            <a href="adView.php?adId=<?php echo $ad['adId']; ?>">View Ad</a> | &nbsp;
                            <a href="editAd.php?adId=<?php echo $ad['adId']; ?>">Edit</a> | &nbsp;
                            <a href="?delId=<?php echo $ad['adId'];?>" onclick="return confirm('Are you sure want to delete this ad?')" class="delete" id="">Delete</a> | &nbsp;
                            <?php 
                                if($ad['soldMark'] == 0){
                            ?>
                                    <a href='?sold=<?php echo $ad['adId'];?>' onclick="return confirm('Are you sure want to mark it as sold?')">Mark As Sold</a> | &nbsp;
                            <?php 
                                }else{
                            ?>
                                    <a href='?unsold=<?php echo $ad['adId'];?>' onclick="return confirm('Are you sure want to mark it as unsold?')">Mark As Unsold</a> | &nbsp;
                            <?php 
                                }
                            ?>
                            <input type="hidden" name="adId" class="adId" value="<?php echo $ad['adId']; ?>">
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- <div class="row no-gutters">
                    <div class="col-md-12 col-sm-12">
                        <div class="adv-body">
                            <?php if(isset($_GET['adSaved']) && isset($_GET['adSaved']) == "success"){ ?>
                                    <div class="alert-success">
                                        New ad has been saved successfully.
                                    </div>
                            <?php } ?>
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
        //alert();Hello I am Pema Wangchu sherpa and the real name this is notfare 
        
    });

    $(document).on('click', '#soldMark', function(){
        var id = $('.adId').val();
        alert(id);
    });
});
</script>
<?php include '../../includes/footer.php'; ?>