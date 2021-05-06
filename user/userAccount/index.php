<?php include '../../includes/header.php'; 
    include_once '../userAuth.php';
    $userAuth = new UserAuth;
    $cat = new Category;
    include '../ad/ad.php';
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

    if(isset($_POST['userId']) && !empty($_POST['userId'])){
        $userId = $_POST['userId']; 
        $userDetails = $userAuth->getUserProfile($userId);

        // echo $userDetails['fullName'];
        // exit;
    }
    
    if(isset($_POST['profileUserId']) && !empty($_POST['profileUserId'])){
        $userId = $_POST['profileUserId']; 
        $userDetails = $userAuth->updateUserProfile($_POST);
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
            <li><a href="../logout.php">Log Out </a></li>
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
                        <li> <a href="" id="home">Home</a> </li>
                        <li><a href="?newAd=newAd" id="newAd">Post New Ad</a></li>
                        <li><a href="" id="myAds">My Ads</a></li>
                        <li><a href="" id="msg">Messages</a></li>
                        <li><a href="" id="user">My Profile</a></li>
                        <li><a href="" id="change-password">Change Password</a></li>
                    </ul>
                </div>
            </div>

            <!-- Home div  -->
            <div class="col-md-9 col-sm-9" id="home-div">
                <div class="my-account-home">
                    <h3>Welcome <u><?php echo Session::get('name');?></u></h3><p></p>
                    <p>This is the home page. From here you can take control of your ads.</p>
                    <p>Please navigate through the menu list present at left side.</p>
                </div>
            </div>

            <!-- My ads div  -->
            <div class="col-md-9 col-sm-9" id="myAds-div" style="border-left: 1px solid black; display: none;">
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
                            <a href="../ad/adView.php?adId=<?php echo $ad['adId']; ?>">View Ad</a> | &nbsp;
                            <a href="../ad/editAd.php?adId=<?php echo $ad['adId']; ?>">Edit</a> | &nbsp;
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

            <!-- Messages div -->
            <div class="col-md-9 col-sm-9 msg" id="msg-div" style="display: none;">
                <div class="msg-header">Messages</div>
                <div class="row no-gutters msg-title">
                    <div class="col-md-3">
                        Ad Title
                    </div>
                    <div class="col-md-4">Qustion</div>
                     <div class="col-md-5">
                         <div class="row no-gutters">
                         <div class="col-md-4">Asked On</div>
                         <div class="col-md-4">Asked By</div>
                         <div class="col-md-4">Action</div>
                         </div>
                     </div>           
                </div> 
                <div class="row no-gutters msg-body">
                <div class="col-md-3">
                        Ad Title
                    </div>
                    <div class="col-md-4">Qustion</div>
                     <div class="col-md-5">
                         <div class="row no-gutters">
                         <div class="col-md-4">Asked On</div>
                         <div class="col-md-4">Asked By</div>
                         <div class="col-md-4">Action</div>
                         </div>
                     </div>   
                </div>                            
            </div>

            <!-- User profile div  -->
            <div class="col-md-9 col-sm-9 user-profile" id="user-div">
            <div class="msg-header">User Details</div>
                <table class="table table-bordered">
                    <tbody>
                        <?php
                                $userId = Session::get('userId'); 
                                $user = $userAuth->getUser($userId);
                            
                        ?>
                        <tr>
                            <th scope="row">Full Name: </th>
                            <td> <?php echo $user['fullName']; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Email: </th>
                            <td> <?php echo $user['email']; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Contact: </th>
                            <td> <?php echo $user['contact']; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Address: </th>
                            <td> <?php echo $user['address']; ?></td>
                            <td></td>
                            <input type="hidden" id="userId" value="<?php echo $user['userId']; ?>">
                        </tr>
                        <tr>
                            <th><button class="btn btn-primary btn-sm" id="edit">Edit Profile</button></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class='col-md-9 col-sm-9' id='profile-edit-div'>
            </div>

            <div class="col-md-9 col-sm-9" id="change-password-div">
            
            </div>
            <!-- newAd div -->
            <div class="col-md-3 col-sm-3 newAd" id="newAd-div">
                <div class="mainCat">
                    <ul>
                        <?php  
                            $mainCats = $cat->getCategories();
                            foreach($mainCats as $mainCat){
                        ?>
                            <li class="mainCatId" value="<?php echo $mainCat['catId']; ?>"><?php echo $mainCat['catName']; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="subCat">
                    <ul>
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="next justify-content-center">
                    <!-- <a href=""> -->
                        <button id="next" class="btn btn-primary btn-block"> Next </button>
                    <!-- </a> -->
                </div>
            </div>
            
        </div>
    </div>
</div>




<script type="text/javascript">
$(document).ready(function(){
    $('#home').click(function(){
        $('#home-div').show();
        $('#newAd-div').hide();
        $('#newAd-div').hide();
        $('#msg-div').hide();
        $('#profile-edit-div').hide();
        $('#user-div').hide();


    });

    $('#myAds').click(function(){
        $('#myAds-div').show();
        $('#home-div').hide();
        $('#newAd-div').hide();
        $('#msg-div').hide();
        $('#user-div').hide();

    });

    $('#newAd').click(function(event){
            event.preventDefault();
            $('#newAd-div').show();
            $('.mainCat').fadeIn(500);
            $('#home-div').hide();
            $('#myAds-div').hide();
            $('#user-div').hide();
    });

    $('#msg').click(function(event){        
        event.preventDefault();
        $('#msg-div').show();
        $('#newAd-div').hide();
        $('#myAds-div').hide();
        $('#home-div').hide();
        $('#user-div').hide();

        
    });

    $('#user').click(function(event){        
        event.preventDefault();
        $('#user-div').show();
        $('#msg-div').hide();
        $('#newAd-div').hide();
        $('#myAds-div').hide();
        $('#home-div').hide();        
        $('#profile-edit-div').hide();

    });

    $('#edit').click(function(event){        
        event.preventDefault();
        $('#profile-edit-div').show();
        $('#user-div').hide();
        $('#msg-div').hide();
        $('#newAd-div').hide();
        $('#myAds-div').hide();
        $('#home-div').hide();

        var userId = $('#userId').val();
        $.post('index.php', {'userId':userId}, function(){}).done(function(data){
            $('#profile-edit-div').html(data);
        });
    });

    $(document).on('click', '#update-profile', function(event){
        event.preventDefault();
        var profileUserId = $('#profile-userId').val();
        var fullName = $('#fullName').val();
        var email = $('#email').val();
        var contact = $('#contact').val();
        var address = $('#address').val();
        //alert(address);
        //alert(profileUserId + fullName + email + contact + address);
        $.post('index.php', {profileUserId:profileUserId, fullName:fullName, email:email, contact:contact, address:address}, function(){}).done(function(data){
            alert("Profile details updated successfully.");
            //reloading whole page
            location.reload();
            
        });
    });

    $(document).on('click', '#update-cancle', function(event){
        event.preventDefault();
        $('#user-div').show();        
        $('#profile-edit-div').hide();
        $('#msg-div').hide();
        $('#newAd-div').hide();
        $('#myAds-div').hide();
        $('#home-div').hide();
    });

    $(document).on('click', 'change-password', function(event){
        alert();
        event.preventDefault();        
        $('#change-password-div').show();
        $('#profile-edit-div').hide();
        $('#user-div').hide();
        $('#msg-div').hide();
        $('#newAd-div').hide();
        $('#myAds-div').hide();
        $('#home-div').hide();

        var userId = $('#userId').val();
        $.post('index.php', {'passwordId':userId}, function(){}).done(function(data){
            //$('#profile-edit-div').html(data);
        });
    });

    $(".mainCatId").click(function(){
        var mainCatIdLi = $(this).val();
        $('#home-div').hide();
        $('.subCat').fadeIn(500);
        $.post("../../classes/category.php", {'mainCatIdLi': mainCatIdLi}, function(data){ 
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
        $(location).attr('href', '../ad/newAd.php?subCatId=' + subCatId);
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

//{profileUserId:profileUserId, fullName:fullName, email:email, contact:contact, address:address}
</script>
<?php include '../../includes/footer.php'; ?>