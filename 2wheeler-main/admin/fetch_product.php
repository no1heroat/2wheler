<?php 
   require "../connection/connection.php";
 
   $query = "SELECT * FROM product WHERE id='".$_POST['id']."'";
   $result = mysqli_query($con,$query);
   while($row = mysqli_fetch_assoc($result))
   {
         $data = $row;
   }
    echo json_encode($data);
 ?>