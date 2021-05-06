<?php include 'includes/header.php'; 

    $cat = new Category; 
    if(isset($_POST['addSubCat'])){
        if($_POST['catName'] == ""){
            echo "<div class='alert alert-danger text-center'> Please provide category name properly. </div>";
        }else{
            $addSubCat = $cat->addSubCategory($_POST);
            if($addSubCat){
                echo "<div class='alert alert-success text-center'> Category added successfully. </div>";
            }
        }
    }

    if(isset($_GET['delId'])){
        $id = $_GET["delId"];
        $delCat = $cat->delSubCat($id);
        
        if($delCat = true){
            echo "<div class='alert alert-success text-center'> Sub category deleted successfully. </div>";
        }else{
            echo "<div class='alert alert-danger text-center'> Could not delete sub category. Please try again.</div>";
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
                                    <li> <a href="category.php">Main Category</a> </li>
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
                    <h4>Category</h4>
                </div>  
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="subCatSelect">
                            <div class="form-group">
                                <label for="sel1">Select Main Category First</label>
                                <select class="form-control" name="mainCatId" id="mainCatId">
                                    <option>Main Category</option>
                                <?php 
                                    $categories = $cat->getCategories();
                                    foreach($categories as $category){
                                ?>
                                    <option value="<?php echo $category['catId']; ?>"><?php echo $category['catName']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="getSubCats"> <i class="fas fa-search"></i> Search </button>
                    </form>
                    <?php 
                        if(isset($_POST['getSubCats'])){
                            $cat = new Category;
                            $subCats = $cat->getSubCats($_POST);
                            if($subCats){
                        }
                    ?>
                        <button class="btn btn-success float-right margin" data-toggle="modal" data-target="#addSubCat<?php echo $_POST['mainCatId'];?>">Add Category</button>                                    

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="15%">No</th>
                                    <th width="45%"> Sub Categories </th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($subCats as $subCat){ ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $subCat['catName']; ?></td>
                                    <td>
                                        <a href="subCatEdit.php?catId=<?php echo $subCat['subCatId'];?>">
                                            <button class="btn btn-primary btn-sm" name="edit">Edit</button>
                                        </a>
                                        <a href="?delId=<?php echo $subCat['subCatId'];?>">
                                            <button class="btn btn-danger btn-sm" name="delete" onclick="if (confirm('Are you want to delete?')) commentDelete(1); return false">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Create Category Modal -->
<div class="modal fade" id="addSubCat<?php echo $_POST['mainCatId'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" name="mainCatId" value="<?php echo $_POST['mainCatId'] ?>">
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
            <button type="submit" class="btn btn-primary" name="addSubCat">Add Category</button>
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

            // $('#mainCatId').change(function(){
                
            //     var mainCatId = $(this).val();
            //     //alert(mainCatId);
            //     $.ajax({
            //         type: 'post',
            //         //dataType: 'json',
            //         url: '../classes/category.php',
            //         data: {'mainCatId': mainCatId},
            //         //cache: false,
            //         success: function(response){
            //             //alert(response);
            //             //response.find(element).remove();
            //             var cats JSON.parse(JSON.stringify(response))
            //             //var cat = JSON.parse(cats);
            //             //alert(cats.catName);
            //              console.log(cats);
            //             // var st = '';
            //             // $.each(cats, function(index){
            //             //     st += "<tr><td>" + cats[index].subCatId + "</td>";
            //             //     st += "<td>" + cats[index].catName + "</td>";
            //             //     st += "<td>" + cats[index].catDesc + "</td></tr>";
            //             // });
            //             // $('#subCatsTable').html(st);                        
            //         },
            //         error: function(){
            //             alert("Unable to get sub categories.");
            //         }
            //     });
            // });
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