<?php include 'includes/header.php'; 

    $cat = new Category; 
    if(isset($_POST['addCat'])){

        if($_POST['catName'] == ""){
            echo "<script> toastr.error('Please provide category name properly. Category could not be added.'); </script>";
        }else{
            $addCat = $cat->addCategory($_POST);
            if($addCat){
                echo "<script> toastr.success('Category added successfully.'); </script>";
            }
        }
    }

    if(isset($_GET['delId'])){
        $id = $_GET["delId"];
        $delCat = $cat->delCat($id);
        
        if($delCat = true){
            echo "<script>toastr.success('Category deleted successfully.')</script>";
        }else{
            echo "<script>toastr.error('Category could not be deleted. Please try again.')</script>";
        }
    }

    if(isset($_POST['editCat'])){
        $updateCat = $cat->updateCat($_POST);
        if($update = true){
            echo "<script>toastr.success('Category updated successfully.');</script>";
        }else{
            echo "<script>toastr.success('Category couldnot be updated. Please try again.');</script>";
        }
    }
?>

<nav>
    <div class="adminNav margin">
    <h3> <i class="fas fa-user-shield"></i> Second Shop Admin Site</h3></div>
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
            <div class="card">
                <div class="card-header">
                    <h4>Category <button class="btn btn-success float-right" data-toggle="modal" data-target="#addCat">Add Category</button></h4>
                </div>  
                <div class="card-body">
                    <div class="divCat">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="20%">No</th>
                                <th width="50%">Categories</th>
                                <th width="30%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $categories = $cat->getCategories();
                                $i = 1;
                                foreach($categories as $category){
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $category['catName']; ?></td>
                                <input type="hidden" name="catId" value="<?php echo $category['catId'] ?>">
                                <td>
                                    <a href="editCat.php?catId=<?php echo $category['catId'];?>">
                                        <button name="catId" id="catId" class="btn btn-primary btn-sm">Edit </button>
                                    </a>
                                    
                                    <a href="?delId=<?php echo $category['catId']; ?>"> 
                                        <button name="delCat" class="btn btn-danger btn-sm" onclick="if (confirm('Are you want to delete?')) commentDelete(1); return false">Delete </button>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Create Category Modal -->
<div class="modal fade" id="addCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" class="form-control" name="catName" placeholder="Enter category">
            </div>

            <div class="form-group">
                <label for="categoryName">Category Description</label>
                <textarea type="text" cols="30" rows="6" class="form-control" name="catDesc" placeholder="Enter category"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="addCat">Add Category</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Category Update Modal -->
<div class="modal fade" id="editCat<?php echo $category['catId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="modal-body">
            <?php  
                if(isset($category['catId']) && isset($category['catId']) == !empty($category['catId'])){
                    $catId = $category['catId'];
                    $catRow = $cat->editCat($catId);   
            ?>
            <div class="form-group">
                <label for="catName">Category</label>
                <input type="text" name="catName" class="form-control" value="<?php echo $catRow['catName']; ?>">
                <input type="hidden" name="catUpdateId" value="<?php echo $catRow['catId']; ?>">
            </div>
            <div class="form-group">
                <label for="catDesc">Category Description</label>
                <textarea name="catDesc" cols="30" rows="6" class="form-control"><?php echo $catRow['catDesc']; ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="editCat" class="btn btn-primary">Edit Category</button>
        </div>
      </form>
        <?php } ?>
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
        // $('#addCat').click(function(){
        //     var catName = $("input[name='catName']").val();
        //     var catDesc = $("textarea[name='catDesc']").val();
            
        //     var url = '../classes/category.php?addCat';
        //     var data = {
        //             'catName' : catName,
        //             'catDesc' : catDesc
        //         } 
        //     $.post(url, data).done(function(data) {
        //         toastr.info('Are you the 6 fingered man?');
        //         $('.categoryModal').hide();
        //         window.location.reload(true);
        //     });
    //});

        // $("#editCat").click(function(){
        //     toastr.info('Are you the 6 fingered man?');
        // });

        // $('#delCat').click(function(){
        //     Swal.fire({
        //         title: 'Are you sure want to delete?',
        //         // text: "You won't be able to revert this!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Delete'
        //         }).then((result) => {
        //         if (result.value) {
        //             var catId = $("input[name='catId']").val();
        //             var url = "../classes/category.php?delCat";
        //             var data = {'catId':catId}
        //             $.post(url, data).done(function(data){
        //                 //var info = JSON.parse(data);
        //                 //alert(data.type);
        //                 console.log(data.type);
        //                 // if(data.type == success){
        //                 //     toastr.success(data.message);   
        //                 // }
                        
        //                 // if(data.type == error){
        //                 //     toastr.success(data.message); 
        //                 // }
        //             });  
        //         }
        //     })
        // });
    //});
</script>
<?php include 'includes/footer.php'; ?>