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

    $msg = "";
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
                            <h2>My Ads</h2>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-12 col-sm-12">
                        <div class="adv-body">
                        </div>
                    </div>
                </div>
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