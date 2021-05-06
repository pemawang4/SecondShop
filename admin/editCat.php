<?php include 'includes/header.php'; 
$cat = new Category; 
$db = new Database; 
if(isset($_POST['updateCat'])){
    $updateCat = $cat->updateCat($_POST);
    if($updateCat = true){
        echo "<div class='alert alert-success text-center'>Category updated successfully.</div>";
    }else{
        echo "<div class='alert alert-danger'>Category couldnot be updated. Please try again.</div>";
    }
}

if(isset($_GET['catId']) && isset($_GET['catId']) != ''){
    $catId = $_GET['catId'];
    $query = "SELECT * FROM categories WHERE catId = $catId";
    $row = $db->select($query);
    $cat = $row->fetch_assoc();
}
?>

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
                        <li class="list-group-item list-group-item-action"><a href="home.php">Dashboard</a></li>
                        <li class="list-group-item list-group-item-action catSlide">Category
                                <ul class="catMenu">
                                    <li> <a href="">Main Category</a> </li>
                                    <li><a href="subCat.php">Sub Category</a></li>
                                </ul>
                        </li>
                        <li class="list-group-item list-group-item-action"><a href="">Brand</a></li>
                        <li class="list-group-item list-group-item-action"><a href="">Users</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
        <a href="category.php" class="btn btn-secondary margin">Go Back</a>
            <div class="card">
                <div class="card-header">
                    <h4>Category</h4>
                </div>  
                <div class="card-body">
                    <form action="" method="post">
                    <div class="form-group">
                            <input type="hidden" name="catId" value="<?= $cat['catId']; ?>">
                            <label for="catName">Category</label>
                            <input type="text" name="catName" class="form-control" value="<?= $cat['catName']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="catDesc">Category Description </label>
                            <textarea name="catDesc" class="form-control" id="" cols="30" rows="10"><?= $cat['catDesc']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="updateCat">Update</button>
                            <a href="category.php">
                                <button class="btn btn-danger" type="button">Cancel</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        $('.catSlide').click(function(event){
            event.stopPropagation();    
            $('.catMenu').slideToggle();

        });
    });
</script>
<?php include 'includes/footer.php'; ?>