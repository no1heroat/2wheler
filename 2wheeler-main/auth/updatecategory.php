<?php
require "../connection/connection.php";
$id = $_GET['id'];
$query = "SELECT * FROM category WHERE id = '$id'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../admin/admin.css">

</head>
<body>
    <header class="header">
        <a href="../admin/admindashboard.php"> Admin Dashboard </a>
        <div class="logout">
            <a href="../admin/adminlogin.php" onclick = 'return Logout()'>Logout</a>
        </div>
    </header>
    <aside>
        <ul>
            <li>
                <a href="../admin/admindashboard.php">Dashboard</a>
            </li>
            <!-- <li>
                <a href="../admin/admincategory.php">Category</a>
            </li> -->
            <li>
                <a href="../admin/adminproduct.php">Product</a>
            </li>
            <li>
                <a href="../admin/adminenquiry.php">Enquiry</a>
            </li>
            <li>
                <a href="../admin/invoice.php">Invoice</a>
            </li>
            <li>
                <a href="../admin/adminreport.php">Sell Report</a>
            </li>
        </ul>
    </aside>
    <div class="content1">
    <h1> Update Category </h1>
    </div>
    <div class="container">
  <form action="../auth/updatecategory.php" method="POST">
    <div class="row">
      <div class="col-25">
        <label for="id">ID</label>
      </div>
      <div class="col-75">
        <input type="text" id="id" value="<?php echo $row['id'];?>" name="id" placeholder="Enter ID">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="cname">Category Name</label>
      </div>
      <div class="col-75">
        <select name="cname">
          <option value="interior">Interior Parts</option>
          <option value="exterior">Exterior Parts</option>
          
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="description">Description</label>
      </div>
      <div class="col-75">
        <input type="text" id="description" value="<?php echo $row['description'];?>" name="description" placeholder="Enter description">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="type">Type</label>
      </div>
      <div class="col-75">
        <select id="type" name="type">
          <option value="product">Product</option>
        </select>
      </div>
    </div>
    
    <div class="row">
      <button type="submit" value="Update" name="update" id="update">Update</button>
    </div>
  </form>
</div>

</body>
</html>

<?php
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['cname'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    $query = "UPDATE category SET cname='$name', description='$description', type='$type' WHERE id='$id'";
    $result=mysqli_query($con,$query);
    if ($result){
        header("location:../admin/admincategory.php?error=2");
    }
    else{
        header("location:../admin/admincategory.php?error=1");
    }
}
else
{
    die ('error');
}

?>
<script>
//  function confirmDelete() {
//   return confirm("Are you sure want to delete this data?");
// }
function Logout() {
  return confirm("Are you sure want to Log Out?");
}
</script>