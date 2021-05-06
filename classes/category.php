<?php 
    $path = $_SERVER['DOCUMENT_ROOT'] . '/secondShop/';
    include_once $path.'Database/database.php';
    include_once $path.'Format/validate.php';

    
    class Category{
        public $db;
        public $validate;
        public function __construct(){
            $this->db = new Database();
            $this->validate = new Validate();
        }

        public function addCategory($post){
            $categoryName = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catName']));
            $categoryDesc = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catDesc']));
            $query = "INSERT INTO categories(catName, catDesc) values('$categoryName', '$categoryDesc')";
            $addCat = $this->db->insert($query);
            
            if($addCat){
                return true;
            }else{
                return false;
            }
        }

        public function getCategories(){
            $query = "SELECT * from categories ORDER BY catId DESC";

            $result = $this->db->select($query);
            return $result;
        }

        public function delCat($id){
            $table = "categories";
            $rowId = 'catId';
            $delCat = $this->db->delete($id, $rowId, $table);

            if($delCat = true){
                return true;
            }else{
                return false;
            }
        }

        public function editCat($catId){
            $query = "SELECT * FROM categories WHERE catId = $catId";
            $result = $this->db->select($query);
            $catRow = $result->fetch_assoc();
            return $catRow;
        }

        public function updateCat($post){
            $catName = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catName']));
            $catDesc = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catDesc']));
            $catId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catId']));
            $query = "UPDATE categories SET catName = '$catName', catDesc = '$catDesc' WHERE catId = $catId";
           
            $catUpdate = $this->db->update($query);
            return $catUpdate;
        }
        
        // Sub category secion
        public function getSubCats($post){
            $mainCatId = $post['mainCatIdLi'];
            $query = "SELECT * FROM subCategories WHERE mainCatId = $mainCatId";
            $result = $this->db->select($query);
            return $result;
        }

        //adding new sub categories
        public function addSubCategory($post){
            $mainCatId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['mainCatId']));
            $categoryName = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catName']));
            $categoryDesc = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catDesc']));
            $query = "INSERT INTO subCategories(mainCatId, catName, catDesc) values('$mainCatId', '$categoryName', '$categoryDesc')";
            $addSubCat = $this->db->insert($query);
            
            if($addSubCat){
                return true;
            }else{
                return false;
            }
        }

        public function updateSubCat($post){
            $catName = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catName']));
            $catDesc = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catDesc']));
            $catId = mysqli_real_escape_string($this->db->con, $this->validate->sanitize($post['catId']));
            $query = "UPDATE subCategories SET catName = '$catName', catDesc = '$catDesc' WHERE subCatId = $catId";
            $catUpdate = $this->db->update($query);
            return $catUpdate;
        }

        //Deleting sub category
        public function delSubCat($id){
            $table = "subCategories";
            $rowId = 'subCatId';
            $delCat = $this->db->delete($id, $rowId, $table);

            if($delCat = true){
                return true;
            }else{
                return false;
            }
        }

        public function subCatById($subCatId){
            $query = "SELECT * FROM subCategories WHERE subCatId = $subCatId";
            $result = $this->db->select($query);
            $subCat = $result->fetch_assoc();
            return $subCat;
        }

        public function mainCatById($mainCatId){
            $query = "SELECT * FROM categories WHERE catId = $mainCatId";
            $result = $this->db->select($query);
            $mainCat = $result->fetch_assoc();
            return $mainCat;
        }
    }

    if(isset($_POST['mainCatIdLi'])){
        $cat = new Category;
        $subCats = $cat->getSubCats($_POST);
        $result = $subCats->fetch_assoc();
        foreach($subCats as $subCat){
            echo "<li style='padding: 7px; list-style:none; cursor: pointer;' class='subCatId' value=".$subCat['subCatId'].">" .$subCat['catName']. "</li>";
        }
    }
?>