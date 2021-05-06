<?php 
require_once '../../Database/database.php';
require_once '../../Format/validate.php';

class Ad{
    public $db;
    public $validate;
    public function __construct(){
        $this->db = new Database();
        $this->validate = new Validate();
    }

    public function adPost($post, $fileName, $fileSize, $fileTmp, $fileType){
        $userId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['userId']));
        $mainCatId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mainCatId']));
        $subCatId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['subCatId']));
        $adTitle = empty($post['adTitle']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['adTitle']));
        $adDesc = empty($post['adDesc']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['adDesc']));
        $adDuration = empty($post['adPeriod']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['adPeriod']));
        $price = empty($post['price']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['price']));
        $priceNegotiable = empty($post['priceNegotiable']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['priceNegotiable']));
        $condition = empty($post['condition']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['condition']));
        $productUsed = empty($post['productUsed']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['productUsed']));
        $ownershipDoc = empty($post['ownershipDoc']) ? '' : implode(', ', $post['ownershipDoc']);
        $simSlot = empty($post['simSlot']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['simSlot']));
        $screenSize = empty($post['screenSize']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['screenSize']));
        $mobileOs = empty($post['mobileOs']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mobileOs']));
        $backCam = empty($post['backCam']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['backCam']));
        $frontCam = empty($post['frontCam']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['frontCam']));
        $mobileCpu = empty($post['mobileCpu']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mobileCpu']));
        $mobileRam = empty($post['mobileRam']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mobileRam']));
        $mobileStorage = empty($post['mobileStorage']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mobileStorage']));
        $type = empty($post['type']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['type']));
        $anchal = empty($post['anchal']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['anchal']));
        $lotNo = empty($post['lotNo']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['lotNo']));
        $makeYear = empty($post['makeYear']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['makeYear']));
        $milage = empty($post['milage']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['milage']));
        $km = empty($post['km']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['km']));
        $color = empty($post['color']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['color']));
        $engineCC = empty($post['engineCC']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['engineCC']));
        $fuleType = empty($post['fuleType']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['fuleType']));
        $carTransmission = empty($post['carTransmission']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['carTransmission']));
        $features = empty($post['features']) ? '' : implode(", ", $post['features']);
        $includedInPrice = empty($post['includedInPrice']) ? '' : implode(", ", $post['includedInPrice']);
        $location = empty($post['location']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['location']));
        $homeDelivery = empty($post['homeDelivery']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['homeDelivery']));
        $deliveryArea = empty($post['deliveryArea']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['deliveryArea']));
        $deliveryCharge = empty($post['deliveryCharge']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['deliveryCharge']));
        $warrantyType = empty($post['warrantyType']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['warrantyType']));
        $warrantyPeriod = empty($post['warrantyPeriod']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['warrantyPeriod']));
        $warrantyIncludes = empty($post['warrantyIncludes']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['warrantyIncludes']));
        
        $errors= array();
        $text = explode('.', $fileName);
        $tmp = end($text);
        $fileExt = strtolower($tmp);
        
        $extensions = array("jpeg", "jpg", "png");
        
        if(in_array($fileExt, $extensions) === false){
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($fileSize > 2097152){
            $errors[] = 'File size must be excately 2 MB';
        }
        
        if(empty($errors) == true){
            $fileName = time().$fileName;
            move_uploaded_file($fileTmp, "../../images/".$fileName);
            //echo "Success";
        }else{
            print_r($errors);
        }

        $query = "INSERT INTO 
        ad (userId, mainCatId, subCatId, adTitle, adDesc, adDuration, price, priceNeg, productCondition, productUsed, ownershipDocument, slimSlot, screenSize, phoneOs, backCamera, frontCamera, CPUCore, ram, internalStorage, type, anchal, lotNo, makeYear, milage, kmRun, color, engineCC, fule, transmission, features, location, includedInPrice, homeDelivery, deliveryArea, deliveryCharge, warrantyType, warrantyPeriod, warrantyIncludes, productPic) 
        VALUES('$userId', '$mainCatId', '$subCatId', '$adTitle', '$adDesc', '$adDuration', '$price', '$priceNegotiable', '$condition', '$productUsed', '$ownershipDoc', '$simSlot', '$screenSize', '$mobileOs', '$backCam', '$frontCam', '$mobileCpu', '$mobileRam', '$mobileStorage', '$type', '$anchal', '$lotNo', '$makeYear', '$milage', '$km', '$color', '$engineCC', '$fuleType', '$carTransmission', '$features', '$location', '$includedInPrice', '$homeDelivery', '$deliveryArea', '$deliveryCharge', '$warrantyType', '$warrantyPeriod', '$warrantyIncludes', '$fileName')";
        //echo $userId;
        //exit; //;
        $insert = $this->db->insert($query);

        if($insert){
            $query = "SELECT * FROM ad ORDER BY adId DESC LIMIT 1";
            $row = $this->db->select($query);
            $ad = $row->fetch_assoc();
            $id = $ad['adId'];

            header("Location:allAd.php?adSaved=success&adId=".$id);
        }else{
            return false;
        }

    }

    public function updatePost($post, $fileName, $fileSize, $fileTmp, $fileType){
        $userId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['userId']));
        $adId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['adId']));
        $mainCatId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mainCatId']));
        $subCatId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['subCatId']));
        $adTitle = empty($post['adTitle']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['adTitle']));
        $adDesc = empty($post['adDesc']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['adDesc']));
        $adDuration = empty($post['adPeriod']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['adPeriod']));
        $price = empty($post['price']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['price']));
        $priceNegotiable = empty($post['priceNegotiable']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['priceNegotiable']));
        $condition = empty($post['condition']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['condition']));
        $productUsed = empty($post['productUsed']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['productUsed']));
        $ownershipDoc = empty($post['ownershipDoc']) ? '' : implode(', ', $post['ownershipDoc']);
        $simSlot = empty($post['simSlot']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['simSlot']));
        $screenSize = empty($post['screenSize']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['screenSize']));
        $mobileOs = empty($post['mobileOs']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mobileOs']));
        $backCam = empty($post['backCam']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['backCam']));
        $frontCam = empty($post['frontCam']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['frontCam']));
        $mobileCpu = empty($post['mobileCpu']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mobileCpu']));
        $mobileRam = empty($post['mobileRam']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mobileRam']));
        $mobileStorage = empty($post['mobileStorage']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mobileStorage']));
        $type = empty($post['type']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['type']));
        $anchal = empty($post['anchal']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['anchal']));
        $lotNo = empty($post['lotNo']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['lotNo']));
        $makeYear = empty($post['makeYear']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['makeYear']));
        $milage = empty($post['milage']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['milage']));
        $km = empty($post['km']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['km']));
        $color = empty($post['color']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['color']));
        $engineCC = empty($post['engineCC']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['engineCC']));
        $fuleType = empty($post['fuleType']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['fuleType']));
        $carTransmission = empty($post['carTransmission']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['carTransmission']));
        $features = empty($post['features']) ? '' : implode(", ", $post['features']);
        $includedInPrice = '';
        //$includedInPrice = empty($post['includedInPrice']) ? '' : implode(", ", $post['includedInPrice']);
        $location = empty($post['location']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['location']));
        $homeDelivery = empty($post['homeDelivery']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['homeDelivery']));
        $deliveryArea = empty($post['deliveryArea']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['deliveryArea']));
        $deliveryCharge = empty($post['deliveryCharge']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['deliveryCharge']));
        $warrantyType = empty($post['warrantyType']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['warrantyType']));
        $warrantyPeriod = empty($post['warrantyPeriod']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['warrantyPeriod']));
        $warrantyIncludes = empty($post['warrantyIncludes']) ? '' : mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['warrantyIncludes']));
        
        $errors= array();
        $text = explode('.', $fileName);
        $tmp = end($text);
        $fileExt = strtolower($tmp);
        
        $extensions = array("jpeg", "jpg", "png");
        
        if(in_array($fileExt, $extensions) === false){
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($fileSize > 2097152){
            $errors[] = 'File size must be excately 2 MB';
        }
        
        if(empty($errors) == true){
            $fileName = time().$fileName;
            move_uploaded_file($fileTmp, "../../images/".$fileName);
            //echo "Success";
        }else{
            print_r($errors);
        }

        $query = "UPDATE 
        ad SET userId = '$userId', mainCatId = '$mainCatId', subCatId = '$subCatId', adTitle = '$adTitle', adDesc = '$adDesc', adDuration = '$adDuration', price = '$price', priceNeg = '$priceNegotiable', productCondition = '$condition', productUsed = '$productUsed', ownershipDocument = '$ownershipDoc', slimSlot = '$simSlot', screenSize = '$screenSize', phoneOs = '$mobileOs', backCamera = '$backCam', frontCamera = '$frontCam', CPUCore = '$mobileCpu', ram = '$mobileRam', internalStorage = '$mobileStorage', type = '$type', anchal = '$anchal', lotNo = '$lotNo', makeYear = '$makeYear', milage = '$milage', kmRun = '$km', color = '$color',  engineCC = '$engineCC', fule = '$fuleType', transmission = '$carTransmission', features = '$features', location = '$location', includedInPrice = '$includedInPrice', homeDelivery = '$homeDelivery', deliveryArea = '$deliveryArea', deliveryCharge = '$deliveryCharge', warrantyType = '$warrantyType', warrantyPeriod = '$warrantyPeriod', warrantyIncludes = '$warrantyIncludes', productPic = '$fileName' WHERE adId = '$adId'";
        //echo $userId;
        //exit; //;
        $insert = $this->db->update($query);

        if($insert){
            $query = "SELECT * FROM ad ORDER BY adId DESC LIMIT 1";
            $row = $this->db->select($query);
            $ad = $row->fetch_assoc();
            $id = $ad['adId'];

            header("Location:allAd.php?adSaved=success&adId=".$id);
        }else{
            return false;
        }

    }

    public function getAdByUser($userId){
        $query = "SELECT * FROM ad WHERE userId = '$userId ORDER BY adId DESC'";
        $ads = $this->db->select($query);
        return $ads;
    }

    public function getAdById($id){
        $sql = "SELECT * FROM ad WHERE adId = '$id'";
        $result = $this->db->select($sql);
        $ad = $result->fetch_assoc();
        return $ad;
    }
    // public function getCatById($id){
    //     $query = "SELECT * FROM categories WHERE catId = '$id'";
    //     $result = $this->db->select($sucCatQuery);
    //     $subCat = $result->fetch_assoc();
    //     return $subCat;
    // }

    // public function getSubCatById($id){
    //     $query = "SELECT * FROM subCategories WHERE subCatId = '$id'";
    //     $result = $this->db->select($sucCatQuery);
    //     $mainCat = $result->fetch_assoc();
    //     return $mainCat;
    // }

    public function deleteAd($id, $delId, $table){
        $delAd = $this->db->delete($id, $delId, $table);

        header("Location:allAd.php?delete=deleted");

    }

    public function markAsSold($adId){
        $query = "UPDATE ad SET soldMark = 1 WHERE adId = $adId";

        $result = $this->db->con->query($query);

        if($result){
            header('Location: allAd.php');
        }else{
            echo "Error";
        }
    }

    public function markAsUnsold($adId){
        $query = "UPDATE ad SET soldMark = 0 WHERE adId = $adId";

        $result = $this->db->con->query($query);

        if($result){
            header('Location: allAd.php');
        }else{
            echo "Error";
        }
    }

}

// if(isset($_POST['delId'])){
//     $ad = new Ad;
//     $delId = $_POST;
//     $delAd = $ad->deleteAd($delId);

//     if($delAd){
//         echo "Deleted";
//     }else{
//         echo "Delete Failed";
//     }
// }
?>