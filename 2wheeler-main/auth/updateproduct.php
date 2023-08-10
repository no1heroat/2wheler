<?php
require "../connection/connection.php";

$pid = $_GET['id'];
$query = "SELECT * FROM product WHERE id = '$pid'";
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
    <h1> Update Parts </h1>
    </div>
    <div class="container">
  <form action="../auth/updateproduct1.php" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-25">
        <label for="id">ID</label> 
      </div>
      <div class="col-75">
        <input type="text" value="<?php echo $row['id']?>" name="id" placeholder="Enter ID">
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-25"> -->
        <!-- <label for="p_type">Product Type</label> -->
      <!-- </div>
      <div class="col-75">
        <select name="p_type">
          <option value="interior">Interior Parts</option>
          <option value="exterior">Exterior Parts</option>
        </select>
      </div>
    </div> -->
    <div class="row">
      <div class="col-25">
        <!-- <label for="p_name">Product Name</label>  -->
      </div>
      <div class="col-75">
        <input type="text" value="<?php echo $row['p_name']?>" name="p_name" placeholder="Enter Parts Name">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
         <!-- <label for="qty">Product Quantity</label>  -->
      </div>
      <div class="col-75">
        <input type="text" value="<?php echo $row['qty']?>" name="qty" placeholder="Enter Parts Quantity">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <!-- <label for="product_price">Price</label> -->
      </div>
      <div class="col-75">
        <input type="text" value="<?php echo $row['product_price']?>" name="product_price" placeholder="Enter Price">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <!-- <label for="Pimage">Choose Image</label> -->
      </div>
      <div class="col-75">
        <input type="file" name="Pimage" class="form-control"><br>
        <img src="<?php echo $row['Pimage']?>" alt="" style="height: 50px;">
      </div>
    </div>
    
    
    <div class="row">
      <input type="hidden" name="id" value="<?php echo $row['id']?>">
      <button type="submit" value="Update" name="update">Update</button>
    </div>
  </form>
</div>

</body>
</html>

<!-- <?php
// if(isset($_POST['update'])){
//     $pid = $_POST['id'];
//     $ptype = $_POST['p_type'];
//     $pname = $_POST['p_name'];
//     $qty = $_POST['qty'];
//     $price = $_POST['product_price'];
//     $Pimage = $_FILES['Pimage'];
//     $image_loc = $_FILES['Pimage']['tmp_name'];
//     $image_name = $_FILES['Pimage']['name'];
//     $img_des = 'Uploadimage/' . $image_name;
//     move_uploaded_file($image_loc, 'Uploadimage/' . $image_name);
    
//     $query = "UPDATE product SET p_type = '$ptype', p_name = '$pname', qty = '$qty', product_price = '$price', Pimage = '$img_des' WHERE id = '$pid'";
//     $result=mysqli_query($con,$query);
//     if ($result){
//         header("location:../admin/adminproduct.php?error=2");
//     }
//     else{
//         header("location:../admin/adminproduct.php?error=1");
//     }
// }
// else
// {
//     die ('error');
// }

?> -->
<script>
//  function confirmDelete() {
//   return confirm("Are you sure want to delete this data?");
// }
function Logout() {
  return confirm("Are you sure want to Log Out?");
}
</script>
