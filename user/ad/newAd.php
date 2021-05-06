<?php include '../../includes/header.php'; 
      include 'ad.php';
    $cat = new Category;
    $ad = new Ad;
    if(isset($_GET['subCatId'])){
        $subCatId = $_GET['subCatId'];
        $subCat = $cat->subCatById($subCatId);

        // echo "<pre>";
        // print_r($subCat);
        // exit;

        $mainCatId = $subCat['mainCatId'];
        $mainCat = $cat->mainCatById($mainCatId);
    }

    if(isset($_POST['postAd'])){
        // echo "<pre>";
        // print_r($_POST);
        // exit;

        $fileName = $_FILES['productPic']['name'];
        $fileSize = $_FILES['productPic']['size'];
        $fileTmp = $_FILES['productPic']['tmp_name'];
        $fileType = $_FILES['productPic']['type'];
        
        $mainCat['catName'] = "";
        $_POST['userId'] = Session::get('userId');
        $insertAd = $ad->adPost($_POST, $fileName, $fileSize, $fileTmp, $fileType);
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
                            <h2>Fill Ad Details</h2>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-12 col-sm-12">
                        <div class="adv-body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                <table>
                                    <tbody>
                                    <input type="hidden" name="subCatId" value="<?php echo $subCatId; ?>">
                                    <input type="hidden" name="mainCatId" value="<?php echo $mainCatId; ?>">
                                    <?php if($mainCat['catName'] == 'Events &amp; Programs' || $mainCat['catName'] == 'Services' || $mainCat['catName'] == 'Travel, Tour &amp; Packages' || $mainCat['catName'] == 'Want To Buy(Buyer List)'){ ?>
                                        <tr>
                                                <td>Ad Title</td>
                                                <td><input type="text" name="adTitle" placeholder="Insert ad title here" name="adTitle"></td>
                                            </tr>
                                            <tr>
                                                <td>Ad Description</td>
                                                <td><textarea placeholder="Ad description" id="" name="adDesc"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>Run Ads For</td>
                                                <td><select name="adPeriod" id=""> 
                                                    <option value="">Select Time </option>
                                                    <option value="1 Week">1 Week</option>
                                                    <option value="1 Month">1 Month</option>
                                                    <option value="2 Month">2 Month</option>
                                                    <option value="3 Month">3 Month</option>
                                                </select></td>
                                            </tr>
                                            <?php if($mainCat['catName'] != 'Want To Buy(Buyer List)'){ ?>
                                            <tr>
                                                <td>Price</td>
                                                <td><input type="text" placeholder="Insert price" name="price"></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td>Upload Pic</td>
                                                <td><input type="file" name="productPic"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><button class="adPost" type="submit" name="postAd">Post Ad</button></td>
                                            </tr>
                                    <?php }else{ ?>
                                            <tr>
                                                <td>Ad Title</td>
                                                <td><input type="text" placeholder="Insert ad title here" name="adTitle"></td>
                                            </tr>
                                            <tr>
                                                <td>Ad Description</td>
                                                <td><textarea placeholder="Ad description" id="" name="adDesc"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>Run Ads For</td>
                                                <td><select name="adPeriod" id=""> 
                                                    <option value="">Select Time </option>
                                                    <option value="1week">1 Week</option>
                                                    <option value="1month">1 Month</option>
                                                    <option value="2month">2 Month</option>
                                                    <option value="3month">3 Month</option>
                                                    <option value="4month">3 Month</option>
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td><input type="text" placeholder="Insert price" name="price"></td>
                                            </tr>
                                            <tr>
                                                <td>Price Negotiable</td>
                                                <td><input type="radio" name="priceNegotiable" value="yes"> Yes
                                                <input type="radio" name="priceNegotiable" value="fixed"> Fixed Price</td>
                                            </tr>
                                            <tr>
                                                <td>Product Condition</td>
                                                <td>
                                                    <input type="radio" name="condition" value="Brand New"> Brand New
                                                    <input type="radio" name="condition" value="Excellent"> Excellent
                                                    <input type="radio" name="condition" value="Good/Fair"> Good/Fair   
                                                    <input type="radio" name="condition" value="Bad/Not Working"> Bad/Not Working
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Product Used</td>
                                                <td><input type="text" name="productUsed" placeholder="Days/Months/Years"></td>
                                            </tr>
                                            <?php if($mainCat['catName'] == 'Cars'){ ?>
                                                <tr>
                                                <td>Type</td>
                                                <td>
                                                    <select name="type" id="">
                                                        <option value="">Select Type</option>
                                                        <option value="Small Hatchback">Small Hatchback</option>
                                                        <option value="Mid Size Hatchback">Mid Size Hatchback</option>
                                                        <option value="Sedan">Sedan</option>
                                                        <option value="CUV / Compact SUV">CUV / Compact SUV</option>
                                                        <option value="Jeep / SUV">Jeep / SUV</option>
                                                        <option value="Van">Van</option>
                                                        <option value="Bus">Bus</option>
                                                        <option value="Truck">Truck</option>
                                                        <option value="Pickup">Pickup</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Make Year</td>
                                                <td>
                                                    <select name="makeYear" id="">
                                                        <option value="">Select Year</option>
                                                        <?php 
                                                            $year = 1900;
                                                            $pYear = date("Y");
                                                            for($i = $year; $i <= $pYear; $i++){
                                                                echo "<option value='". $i ."'>". $i ."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kilometers </td>
                                                <td>
                                                    <input type="text" name="km">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Color </td>
                                                <td>
                                                    <input type="text" name="color">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Engine (CC) </td>
                                                <td>
                                                    <input type="text" name="engineCC">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fule</td>
                                                <td>
                                                    <select name="fuleType" id="">
                                                        <option value="">Select Fule Type</option>
                                                        <option value="Petrol">Petrol</option>
                                                        <option value="Diesel">Diesel</option>
                                                        <option value="Electric">Electric</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Transmission </td>
                                                <td>
                                                    <select name="carTransmission" id="">
                                                        <option value="">Select Transmission Type</option>
                                                        <option value="Manual Gear - 2 WD">Manual Gear - 2 WD</option>
                                                        <option value="Manual Gear - 4 WD">Manual Gear - 4 WD</option>
                                                        <option value="Automatic Gear - 2 WD">Automatic Gear - 2 WD</option>
                                                        <option value="Automatic Gear - 4 WD">Automatic Gear - 4 WD</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Features
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="features[]" value="Power Window"> Power Window <br>
                                                    <input type="checkbox" name="features[]" value="Power Steering"> Power Steering <br> 
                                                    <input type="checkbox" name="features[]" value="Leather Seat"> Leather Seat  <br>
                                                    <input type="checkbox" name="features[]" value="Sunroof"> Sunroof  <br>
                                                    <input type="checkbox" name="features[]" value="Central Lock"> Central Lock  <br>
                                                    <input type="checkbox" name="features[]" value="Alloy Wheels"> Alloy Wheels  <br>
                                                    <input type="checkbox" name="features[]" value="Anti-theft Alarm"> Anti-theft Alarm  <br>
                                                    <input type="checkbox" name="features[]" value="Keyless Remote Entry"> Keyless Remote Entry <br>
                                                    <input type="checkbox" name="features[]" value="Tubeless Tyres"> Tubeless Tyres  <br>
                                                    <input type="checkbox" name="features[]" value="Air Bags"> Air Bags  <br>
                                                    <input type="checkbox" name="features[]" value="Anti-lock Braking (ABS)"> Anti-lock Braking (ABS) <br> 
                                                    <input type="checkbox" name="features[]" value="Air Conditioning"> Air Conditioning <br>
                                                    <input type="checkbox" name="features[]" value="Climate Control"> Climate Control  <br>
                                                    <input type="checkbox" name="features[]" value="Steering Mounted Controls"> Steering Mounted Controls  <br>
                                                    <input type="checkbox" name="features[]" value="Projected Headlight"> Projected Headlight  <br>
                                                    <input type="checkbox" name="features[]" value="Fog Lights"> Fog Lights  <br>
                                                    <input type="checkbox" name="features[]" value="Electric ORVM"> Electric ORVM  <br>
                                                    <input type="checkbox" name="features[]" value="Audio System"> Audio System  <br>
                                                    <input type="checkbox" name="features[]" value="LCD Touchscreen"> LCD Touchscreen  <br>
                                                    <input type="checkbox" name="features[]" value="Bluetooth Connectivity"> Bluetooth Connectivity  <br>

                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php if($mainCat['catName'] == 'Motorcycle'){ ?>
                                                <tr>
                                                    <td>Type </td>
                                                    <td>
                                                        <select name="type" id="motorcycleType">
                                                            <option value="Standard">Standard</option>
                                                            <option value="Cruiser">Cruiser</option>
                                                            <option value="Sports">Sports</option>
                                                            <option value="Dirt">Dirt</option>
                                                            <option value="Scooty">Scooty</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Anchal</td>
                                                    <td>
                                                        <select name="anchal" id="">
                                                            <option value="">Select Anchal</option>
                                                            <option value="Pradesh 3">Pradesh 3</option>
                                                            <option value="Bagmati">Bagmati</option>
                                                            <option value="Bheri">Bheri</option>
                                                            <option value="Dhawalagiri">Dhawalagiri</option>
                                                            <option value="Gandaki">Gandaki</option>
                                                            <option value="Janakpur">Janakpur</option>
                                                            <option value="Karnali">Karnali</option>
                                                            <option value="Koshi">Koshi</option>
                                                            <option value="Lumbini">Lumbini</option>
                                                            <option value="Mahakali">Mahakali</option>
                                                            <option value="Mechi">Mechi</option>
                                                            <option value="Narayani">Narayani</option>
                                                            <option value="Rapti">Rapti</option>
                                                            <option value="Sagarmatha">Sagarmatha</option>
                                                            <option value="Seti">Seti</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Lot </td>
                                                    <td>
                                                        <input type="text" name="lotNo" placeholder="Insert lot number">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Engine (CC)</td>
                                                    <td>
                                                        <input type="text" name="engineCC" placeholder="Insert engine (CC)">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Make Year</td>
                                                    <td>
                                                        <input type="text" name="makeYear" placeholder="Insert make year">
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td>Milage (km / l)</td>
                                                    <td>
                                                        <input type="text" name="milage" placeholder="Insert milage">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kilometers Run</td>
                                                    <td>
                                                        <input type="text" name="km" placeholder="Insert distance ran">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Features </td>
                                                    <td>
                                                        <input type="checkbox" name="features[]" value="Electric Start"> Electric Start <br>
                                                        <input type="checkbox" name="features[]" value="Alloy Wheels"> Alloy Wheels <br>
                                                        <input type="checkbox" name="features[]" value="Tubeless Tyres"> Tubeless Tyres  <br>
                                                        <input type="checkbox" name="features[]" value="Digital Display Panel"> Digital Display Panel <br>
                                                        <input type="checkbox" name="features[]" value="Projected Headlight"> Projected Headlight <br>
                                                        <input type="checkbox" name="features[]" value="LED Tail Light"> LED Tail Light <br>
                                                        <input type="checkbox" name="features[]" value="Front Disc Brake"> Front Disc Brake <br>
                                                        <input type="checkbox" name="features[]" value="Rear Disc Brake"> Rear Disc Brake <br>
                                                        <input type="checkbox" name="features[]" value="Anti-lock Braking (ABS)"> Anti-lock Braking (ABS) <br>
                                                        <input type="checkbox" name="features[]" value="Mono Suspension"> Mono Suspension <br>
                                                        <input type="checkbox" name="features[]" value="Split Seat"> Split Seat <br>
                                                        <input type="checkbox" name="features[]" value="Low Fuel Indicator"> Low Fuel Indicator <br>
                                                        <input type="checkbox" name="features[]" value="Tripmeter"> Tripmeter  <br>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if($mainCat['catName'] == 'Business &amp; Industrial'){ ?>
                                                <tr>
                                                    <td>Type</td>
                                                    <td>
                                                        <select name="type" id="">
                                                            <option value="Shop - Mobile">Shop - Mobile</option>
                                                            <option value="Shop - Electronics">Shop - Electronics</option>
                                                            <option value="Shop - Food">Shop - Food</option>
                                                            <option value="Shop - Stationery / Gift">Shop - Stationery / Gift</option>
                                                            <option value="Shop - Clothing / Shoes">Shop - Clothing / Shoes</option>
                                                            <option value="Shop - Others">Shop - Others</option>
                                                            <option value="Shop - Only decorated">Shop - Only decorated</option>
                                                            <option value="Shop - Cyber / Gaming">Shop - Cyber / Gaming</option>
                                                            <option value="Shop - Parlour / Cosmetic">Shop - Parlour / Cosmetic</option>
                                                            <option value="Farm-Poultry">Farm-Poultry</option>
                                                            <option value="Health-Medical">Health-Medical</option>
                                                            <option value="Restaurant-Hotel">Restaurant-Hotel</option>
                                                            <option value="Travel-Trek">Travel-Trek</option>
                                                            <option value="Hostel">Hostel</option>
                                                            <option value="Educational Inst.">Educational Inst.</option>
                                                            <option value="Office">Office</option>
                                                            <option value="Factory">Factory</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Included In Price</td>
                                                    <td>
                                                        <input type="checkbox" name="includedInPrice[]" value="Stock / Product"> Stock / Product <br>
                                                        <input type="checkbox" name="includedInPrice[]" value="Furniture, Fixture & Decoration"> Furniture, Fixture & Decoration <br>
                                                        <input type="checkbox" name="includedInPrice[]" value="Equipments used in Business"> Equipments used in Business <br>
                                                        <input type="checkbox" name="includedInPrice[]" value="Name/Brand of Business"> Name/Brand of Business <br>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if($mainCat['catName'] == 'Mobile'){ ?>
                                                <tr>
                                                    <td>Ownership Document Provided</td>
                                                    <td>
                                                        <input type="checkbox" name="ownershipDoc[]" value="Sales bill of my shop"> Sales bill of my shop <br>
                                                        <input type="checkbox" name="ownershipDoc[]" value="Stamped warranty card"> Stamped warranty card <br>
                                                        <input type="checkbox" name="ownershipDoc[]" value="IMEI matching box"> IMEI matching box <br>
                                                        <input type="checkbox" name="ownershipDoc[]" value="Original purchase bill (for used phone)"> Original purchase bill (for used phone) <br>
                                                        <input type="checkbox" name="ownershipDoc[]" value="I do not have any document"> I do not have any document <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sim Slot</td>
                                                    <td>
                                                        <select name="simSlot" id="">
                                                            <option value="Select Sim Slot">Select Sim Slot</option>
                                                            <option value="Single Sim - 2G">Single Sim - 2G</option>
                                                            <option value="Single Sim - 3G">Single Sim - 3G</option>
                                                            <option value="Single Sim - 4G (LTE)">Single Sim - 4G (LTE)</option>
                                                            <option value="Single Sim - CDMA">Single Sim - CDMA</option>
                                                            <option value="Dual Sim - 2G + 2G">Dual Sim - 2G + 2G</option>
                                                            <option value="Dual Sim - 3G + 2G">Dual Sim - 3G + 2G</option>
                                                            <option value="Dual Sim - 4G + 3G">Dual Sim - 4G + 3G</option>
                                                            <option value="Dual Sim - 4G + 4G">Dual Sim - 4G + 4G</option>
                                                            <option value="Dual Sim - GSM + CDMA">Dual Sim - GSM + CDMA</option>
                                                            <option value="Triple Sim">Triple Sim</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Screen Size</td>
                                                    <td>
                                                        <select name="screenSize" id="">
                                                            <option value="">Select Screen Size</option>
                                                            <option value="Less than 3.5 inch">Less than 3.5 inch</option>
                                                            <option value="3.5 to 3.9 inch">3.5 to 3.9 inch</option>
                                                            <option value="4.0 to 4.4 inch">4.0 to 4.4 inch</option>
                                                            <option value="4.5 to 4.9 inch">4.5 to 4.9 inch</option>
                                                            <option value="5.0 to 5.4 inch">5.0 to 5.4 inch</option>
                                                            <option value="5.5 to 5.9 inch">5.5 to 5.9 inch</option>
                                                            <option value="6.0 inch or more">6.0 inch or more</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Smartphone OS</td>
                                                    <td>
                                                        <select name="mobileOs" id="">
                                                            <option value="">Select Smartphone OS</option>
                                                            <option value="Not a Smartphone">Not a Smartphone</option>
                                                            <option value="Android 4.4 (KitKat) or below">Android 4.4 (KitKat) or below</option>
                                                            <option value="Android 5.0 (Lollipop)">Android 5.0 (Lollipop)</option>
                                                            <option value="Android 6.0 (Marshmallow)">Android 6.0 (Marshmallow)</option>
                                                            <option value="Android 7.0 (Nougat)">Android 7.0 (Nougat)</option>
                                                            <option value="Android 8.0 (Oreo)">Android 8.0 (Oreo)</option>
                                                            <option value="Android 9.0 (Pie)">Android 9.0 (Pie)</option>
                                                            <option value="Apple iOS 9 or below">Apple iOS 9 or below</option>
                                                            <option value="Apple iOS 10">Apple iOS 10</option>
                                                            <option value="Apple iOS 11">Apple iOS 11</option>
                                                            <option value="Apple iOS 12">Apple iOS 12</option>
                                                            <option value="Windows 8.x or below">Windows 8.x or below</option>
                                                            <option value="Windows 10">Windows 10</option>
                                                            <option value="Symbian">Symbian</option>
                                                            <option value="RIM Blackberry">RIM Blackberry</option>
                                                            <option value="Firefox OS">Firefox OS</option>
                                                            <option value="Tizen">Tizen</option>
                                                            <option value="Other OS">Other OS</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Back Camera</td>
                                                    <td>
                                                        <select name="backCam" id="">
                                                            <option value="">Select Back Camera</option>
                                                            <option value="No">No</option>
                                                            <option value="1 MP or less">1 MP or less</option>
                                                            <option value="2 MP - 2.9 MP">2 MP - 2.9 MP</option>
                                                            <option value="3 MP - 4.9 MP">3 MP - 4.9 MP</option>
                                                            <option value="5 MP - 7.9 MP">5 MP - 7.9 MP</option>
                                                            <option value="8 MP - 12.9 MP">8 MP - 12.9 MP</option>
                                                            <option value="13 MP - 19.9 MP">13 MP - 19.9 MP</option>
                                                            <option value="20 MP or more">20 MP or more</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Front Camera</td>
                                                    <td>
                                                        <select name="frontCam" id="">
                                                            <option value="">Select Front Camera</option>
                                                            <option value="No">No</option>
                                                            <option value="VGA">VGA</option>
                                                            <option value="1 MP">1 MP</option>
                                                            <option value="2 MP">2 MP</option>
                                                            <option value="3 MP">3 MP</option>
                                                            <option value="5 MP">5 MP</option>
                                                            <option value="8 MP">8 MP</option>
                                                            <option value="13 MP or more">13 MP or more</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>CPU Core</td>
                                                    <td>
                                                        <select name="mobileCpu" id="">
                                                            <option value="">Select CPU Type</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Dual - 2">Dual - 2</option>
                                                            <option value="Quad - 4">Quad - 4</option>
                                                            <option value="Hexa - 6">Hexa - 6</option>
                                                            <option value="Octa - 8">Octa - 8</option>
                                                            <option value="Deca - 10">Deca - 10</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>RAM</td>
                                                    <td>
                                                        <select name="mobileRam" id="">
                                                            <option value="">Select RAM</option>
                                                            <option value="512 MB or less">512 MB or less</option>
                                                            <option value="1 GB">1 GB</option>
                                                            <option value="1.5 GB">1.5 GB</option>
                                                            <option value="2 GB">2 GB</option>
                                                            <option value="3 GB">3 GB</option>
                                                            <option value="4 GB">4 GB</option>
                                                            <option value="6 GB">6 GB</option>
                                                            <option value="8 GB or more">8 GB or more</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Internal Storage</td>
                                                    <td>
                                                        <select name="mobileStorage" id="">
                                                            <option value="">Select Internal Storage</option>
                                                            <option value="Less than 512 MB">Less than 512 MB</option>
                                                            <option value="512 MB">512 MB</option>
                                                            <option value="1 GB">1 GB</option>
                                                            <option value="4 GB">4 GB</option>
                                                            <option value="8 GB">8 GB</option>
                                                            <option value="16 GB">16 GB</option>
                                                            <option value="32 GB">32 GB</option>
                                                            <option value="64 GB">64 GB</option>
                                                            <option value="128 GB">128 GB</option>
                                                            <option value="256 GB or more">256 GB or more</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Features </td>
                                                    <td>
                                                        <input type="checkbox" name="features[]" value="Memory Card Slot"> Memory Card Slot <br>
                                                        <input type="checkbox" name="features[]" value="Water & Dust Proof (IP)"> Water & Dust Proof (IP) <br>
                                                        <input type="checkbox" name="features[]" value="Gorilla Glass Screen"> Gorilla Glass Screen <br>
                                                        <input type="checkbox" name="features[]" value="WiFi"> WiFi <br>
                                                        <input type="checkbox" name="features[]" value="NFC"> NFC <br>
                                                        <input type="checkbox" name="features[]" value="Front LED Flash"> Front LED Flash <br>
                                                        <input type="checkbox" name="features[]" value="GPS"> GPS <br>
                                                        <input type="checkbox" name="features[]" value="Dual Camera - Back"> Dual Camera - Back <br>
                                                        <input type="checkbox" name="features[]" value="Dual Camera - Front"> Dual Camera - Front <br>
                                                        <input type="checkbox" name="features[]" value="Fingerprint Sensor"> Fingerprint Sensor <br>
                                                        <input type="checkbox" name="features[]" value="Heart Rate Sensor"> Heart Rate Sensor <br>
                                                        <input type="checkbox" name="features[]" value="Proximity Sensor"> Proximity Sensor <br>
                                                        <input type="checkbox" name="features[]" value="Compass Sensor"> Compass Sensor <br>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if($mainCat['catName'] != 'Real Estate'){ ?>
                                            <tr>
                                                <td>Home Delivery</td>
                                                <td>
                                                    <input type="radio" name="homeDelivery" value="Yes"> Yes
                                                    <input type="radio" name="homeDelivery" value="No"> No
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Delivery Area</td>
                                                <td>
                                                    <input type="radio" name="deliveryArea" value="Within My Area"> Within My Area
                                                    <input type="radio" name="deliveryArea" value="Within My City"> Within My City
                                                    <input type="radio" name="deliveryArea" value="Anywhere in Nepal"> Anywhere in Nepal
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Delevery Charge</td>
                                                <td><input type="text" name="deliveryCharge" placeholder="Insert delever charge"></td>
                                            </tr>
                                            <tr>
                                                <td>Product Warranty</td>
                                                <td>
                                                    <input type="radio" name="warrantyType" value="Dealer/Shop"> Dealer/Shop
                                                    <input type="radio" name="warrantyType" value="Manufacturer/Importer"> Manufacturer/Importer
                                                    <input type="radio" name="warrantyType" value="No Warranty"> No Warranty
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Waranty Lasts For</td>
                                                <td><input type="text" name="warrantyPeriod" placeholder="Insert warranty period"></td>
                                            </tr>
                                            <tr>
                                                <td>Waranty Includes</td>
                                                <td><input type="text" name="warrantyIncludes" placeholder="Warranty includes"></td>
                                            </tr>
                                            <tr>
                                                <td>Upload Pic</td>
                                                <td><input type="file" name="productPic"></td>
                                            </tr>
                                    <?php }else{ ?>
                                            <tr>
                                                <td>Location </td>
                                                <td>
                                                    <input type="text" name="location" placeholder="Enter property location">
                                                </td>
                                            </tr>
                                            <?php if($subCat['catName'] != 'Flatmates &amp; Paying Guests'){ ?>
                                                <tr>
                                                    <td>Property Address</td>
                                                    <td><textarea name="propertyAdd"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td>Property Type</td>
                                                    <td>
                                                        <select name="propertyType" id="">
                                                            <option value="">House - Individual</option>
                                                            <option value="House - In a Colony">House - In a Colony</option>
                                                            <option value="House - Semi-commercial">House - Semi-commercial</option>
                                                            <option value="Bungalow">Bungalow</option>
                                                            <option value="Apartment Building">Apartment Building</option>
                                                            <option value="Commercial Building">Commercial Building</option>
                                                            <option value="Land - Individual">Land - Individual</option>
                                                            <option value="Land - Plotted">Land - Plotted</option>
                                                            <option value="Land - Commercial Use">Land - Commercial Use</option>
                                                            <option value="Land - Agriculture">Land - Agriculture</option>
                                                            <option value="Godown/Tahara">Godown/Tahara</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Road Size</td>
                                                    <td>
                                                        <select name="roadSize" id="">
                                                            <option value="Less than 5 feet">Less than 5 feet</option>
                                                            <option value="5 to 8 feet">5 to 8 feet</option>
                                                            <option value="9 to 12 feet">9 to 12 feet</option>
                                                            <option value="13 to 20 feet">13 to 20 feet</option>
                                                            <option value="Above 20 feet">Above 20 feet</option>
                                                            <option value="Goreto Bato">Goreto Bato</option>
                                                            <option value="No Road Access">No Road Access</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Land Size</td>
                                                    <td><input type="text" name="landSize" placeholder="Anna/Dhur"></td>
                                                </tr>

                                                <tr>
                                                    <td>Floors</td>
                                                    <td><input type="text" name="floors"></td>
                                                </tr>

                                                <tr>
                                                    <td>Built up (Sq. Ft)</td>
                                                    <td><input type="text" name="builtUp"></td>
                                                </tr>

                                                <tr>
                                                    <td>Bedrooms</td>
                                                    <td><input type="text" name="bedRooms"></td>
                                                </tr>

                                                <tr>
                                                    <td>Bathrooms</td>
                                                    <td><input type="text" name="bathrooms"></td>
                                                </tr>

                                                <tr>
                                                    <td>Living Rooms</td>
                                                    <td><input type="text" name="livingRooms"></td>
                                                </tr>

                                                <tr>
                                                    <td>Furnishing</td>
                                                    <td>
                                                        <select name="furnishing" id="">
                                                            <option value="none">None</option>
                                                            <option value="semi">Semi</option>
                                                            <option value="full">Full</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Features</td>
                                                    <td>
                                                        <input type="checkbox" name="features[]" value="">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Features</td>
                                                    <td>
                                                        <input type="checkbox" name="features[]" value="Garden"> Garden <br>
                                                        <input type="checkbox" name="features[]" value="Parking Space"> Parking Space  <br>
                                                        <input type="checkbox" name="features[]" value="Garage"> Garage <br>
                                                        <input type="checkbox" name="features[]" value="Servant Quarter"> Servant Quarter<br>
                                                        <input type="checkbox" name="features[]" value="Security Guards"> Security Guards <br>
                                                        <input type="checkbox" name="features[]" value="Backup Generator "> Backup Generator <br>
                                                        <input type="checkbox" name="features[]" value="Elevator"> Elevator <br>
                                                        <input type="checkbox" name="features[]" value="Swimming Pool "> Swimming Pool  <br>
                                                        <input type="checkbox" name="features[]" value="Gymnasium"> Gymnasium <br>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td>Upload Pic</td>
                                                <td><input type="file" name="productPic"></td>
                                            </tr>
                                    <?php } ?>
                                        <tr>
                                            <td></td>
                                            <td><button class="adPost" type="submit" name="postAd">Post Ad</button></td>
                                        </tr>
                                    <?php }  ?>
                                    </tbody>
                                </table>
                            </form>
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