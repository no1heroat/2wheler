<?php
require "../connection/connection.php";
session_start();
if(!isset($_SESSION['adminloginid']))
{
    header("location:../admin/adminlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../admin/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        section{
           width: 100%;
           height: 100%;
           display: flex;
           /* align-items: center; */
           /* justify-content: center; */
        }
        ul#menu{
           list-style: none;
           width: 250px;
   
        }
        ul#menu li{
           margin: 8px 0;
           position: relative;
           background-color: #2b2b2b;
           border-radius: 2px;
           overflow: hidden;
    
        }
        ul#menu li:hover::before{
           border-radius: 0 50px 50px 0;
           width: 110%;
        }
        ul#menu li:nth-child(1):before{
            background-color: #4185f3;

        }
        ul#menu li:nth-child(2):before{
            background-color: #4df341;

        }
        ul#menu li:nth-child(3):before{
            background-color: #f34141;

        }
        ul#menu li:nth-child(4):before{
            background-color: #41f3f3;

        }
        ul#menu li:nth-child(5):before{
            background-color:blue;

        }
        ul#menu li:nth-child(6):before{
            background-color: yellow;

        }
        ul#menu li::before{
           content: ' ';
           position:absolute;
           left: 0;
           top: 0;
           bottom: 0;
           width: 5px;
           background-color: #f0f;
           transition: 0.3s all ease-in-out;
        }
        ul#menu li a{
           display: block;
           padding: 10px 20px;
           color:white;
           text-decoration: none;
           font-size: 18px;
           font-weight: 500;
           position: relative;
           z-index: 1;
        }
   </style>
</head>
<body>
    <header class="header">
        <a href=""> Admin Dashboard </a>
        <div class="logout">
            <a href="../admin/adminlogin.php" class="btn btn-primary" onclick = 'return Logout()' ><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
        </div>
    </header>
    <section>
        <ul id="menu">
            <li><a href="../admin/admindashboard.php">Dashboard</a></li>
            <li><a href="../admin/adminproduct.php">Product</a></li>
            <li><a href="../admin/adminenquiry.php">Enquiry</a></li>
            <li><a href="../admin/invoice.php">Invoice</a></li>
            <li><a href="../admin/adminreport.php">Sell Report</a></li>
            <li><a href="../admin/inventory.php">Check Inventory</a></li>
        </ul>
    </section>
    <div class="content1">
    <h1> Welcome to Two Wheeler Billing System Admin </h1>
    </div>
    <!-- <?php
    // require "../connection/connection.php";
    ?>
    <div class = "content">
        <div class = "card bg-primary text-white mb-4">
        <div class="card-body">
                    Category
                    <?php
                //     $query = "SELECT * from category";
                //    $result = mysqli_query($con,$query);
                //     if($total = mysqli_num_rows($result))
                //    {
                //        echo '<h4 class="mb-0"> '.$total.' </h4>';
                //    }
                //    else{
                //        echo '<h4 class="mb-0"> No data </h4>'; 
                //    }
                   ?>  
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="../admin/admincategory.php">View Details</a>
        </div>
        </div>
    </div> -->

    <div class = "content">
        <div class = "card bg-primary text-white mb-4">
        <div class="card-body">
                    Product
                    <?php
                    $query = "SELECT * from product";
                   $result = mysqli_query($con,$query);
                    if($total = mysqli_num_rows($result))
                   {
                       echo '<h4 class="mb-0"> '.$total.' </h4>';
                   }
                   else{
                       echo '<h4 class="mb-0"> No data </h4>'; 
                   }
                   ?>  
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="../admin/adminproduct.php">View Details</a>
        </div>
        </div>
    </div>

    <div class = "content">
    <div class="col-xl-3 col-md-6">
        <div class = "card bg-primary text-white mb-4">
        <div class="card-body">
                    Enquiry
                    <?php
                    $query = "SELECT * from enquiry";
                   $result = mysqli_query($con,$query);
                    if($total = mysqli_num_rows($result))
                   {
                       echo '<h4 class="mb-0"> '.$total.' </h4>';
                   }
                   else{
                       echo '<h4 class="mb-0"> No data </h4>'; 
                   }
                   ?>  
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="../admin/adminenquiry.php">View Details</a>
        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
        </div>
    </div>

</body>
</html>

<script>
function Logout() {
  return confirm("Are you sure want to Log Out?");
}
</script>