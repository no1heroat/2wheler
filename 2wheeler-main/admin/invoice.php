<?php 
   require "../connection/connection.php";

if(isset($_GET['error'])){
    if($_GET['error'] == 1){
        echo "<script>alert('Not Saved');</script>";
    }
    else{
        echo "<script>alert('Invoice Bill Saves');</script>";
    }
}

   ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php
      require "link.php";
      ?>
      <link rel="stylesheet" type="text/css" href="../admin/admin.css">
      <title>Invoice</title>
      <style>
         @media print{
            body * {
               visibility: hidden;

            }
            .print-container, .print-container *{
               visibility: visible;
            }
         }
        .result{
         color:red;
        }
        td
        {
          text-align:center;
        }
      </style>
   </head>

   <body>
   <header class="header">
        <a href="../admin/admindashboard.php"> Admin Dashboard </a>
        <div class="logout">
            <a href="../admin/adminlogin.php" onclick = 'return Logout()'>Logout</a>
        </div>
    </header>
      <section class="mt-3">
         <div class="container-fluid">
         <h4 class="text-center" style="color:green">Billing Section</h4>
         <!-- <h6 class="text-center"> All Parts are Available here</h6> -->
         <div class="row">
            <div class="col-md-5  mt-4 ">
               <table class="table" style="background-color:#f5f5f5;">
               
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Parts Name</th>
                        <th style="width: 31%">Qty</th>
                        <th>Price</th>
                     </tr>
                  </thead>
                  
                  <tbody>
                     <tr>
                        <td scope="row">1</td>
                        <td style="width:60%">
                           
                           <select name="parts" id="parts" class="form-control">
                              <?php 
                                 $query = "SELECT * FROM product";
                                 $result = mysqli_query($con,$query);
                                 while($row = mysqli_fetch_assoc($result)){
                                 ?>

                              <option id="<?php echo $row['id']; ?>" value="<?php echo $row['p_name']; ?>" class="parts custom-select">
                                 <?php echo $row['p_name']; ?>
                              </option>
                              <?php  }?>   
                           </select>
                        </td>
                        
                        <td style="width:1%">
                          <input type="number" name="quantity" id="qty" min="0" value="0" class="form-control">
                        </td>
                        <td>
                           <p name="price" id="price"></p>
                        </td>
                        <td><button id="add" name="Add" class="btn btn-primary">Add</button></td>
                     </tr>
                  </tbody>
               </table>
               <div role="alert" id="errorMsg" class="mt-5" >
                 <!-- Error msg  -->
              </div>
            </div>
      
            <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
            <div class="text-right">
            <button onclick="window.print()" class="save" name="save" id="save">Print</button>  
                     </div>
                     <!-- <div class="btn">
      <button type="submit" value="Save" name="save" id="save">Save</button>
    </div> -->
               <div class="p-4 print-container">
                  <div class="text-center">
                     <h4>Two Wheeler Billing System (TWBS)</h4>
                  </div>
                  <span class="mt-4"> Time : </span><span  class="mt-4" id="time"></span>
                  <div class="row">
                     <div class="col-xs-6 col-sm-6 col-md-6 ">
                        <span id="day"></span> : <span id="year"></span>
                     </div>
                     <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p></p>
                     </div>
                  </div>
                  <form>
                     <input type="text" placeholder="Enter Customer Name">
                     <input type="text" placeholder="Enter Customer Phone No">
                                 </form>
                  <div class="row">
                     </span>
                     <table id="receipt_bill" class="table">
                        <thead>
                           <tr>
                              <th> No.</th>
                              <th name="parts_name" id="parts_name">Parts Name</th>
                              <th name="qty" id="qty">Quantity</th>
                              <th name="price" id="price">Price</th>
                              <th name="total" id="total">Total</th>
                           </tr>
                        </thead>
                        <tbody id="new" >
                          
                        </tbody>
                        <tr>
                           <td> </td>
                           <td> </td>
                           <td> </td>
                           <td class="text-right text-dark" >
                                <h5><strong>Sub Total:  Rs. </strong></h5>
                                <p><strong>Tax (5%) : Rs. </strong></p>
                           </td>
                           <td class="text-center text-dark" >
                              <h5> <strong><span id="subTotal"></strong></h5>
                              <h5> <strong><span id="taxAmount"></strong></h5>
                           </td>
                        </tr>
                        <tr>
                           <td> </td>
                           <td> </td>
                           <td> </td>
                           <td class="text-right text-dark">
                              <h5><strong>Grand Total: Rs. </strong></h5>
                           </td>
                           <td class="text-center text-danger">
                              <h5 name="total" id="totalAmount"><strong> </strong></h5>
                              
                           </td>
                        </tr>
                     </table>
                                 
                  </div>
               </div>
            </div>
         </div>
      </section>
                                 
   </body>
</html>
<script>
   $(document).ready(function(){
     $('#parts').change(function() {
      var id = $(this).find(':selected')[0].id;
       $.ajax({
          method:'POST',
          url:'fetch_product.php',
          data:{id:id},
          dataType:'json',
          success:function(data)
            {
               $('#price').text(data.product_price);

 
               //$('#qty').text(data.product_qty);
            }
       });
     });
    
     //add to cart 
     var count = 1;
     $('#add').on('click',function(){
    
        var name = $('#parts').val();
        var qty = $('#qty').val();
        var price = $('#price').text();
 
        if(qty == 0)
        {
           var erroMsg =  '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
           $('#errorMsg').html(erroMsg).fadeOut(9000);
        }
        else
        {
           billFunction(); // Below Function passing here 
        }
         
        function billFunction()
          {
          var total = 0;
       
          $("#receipt_bill").each(function () {
          var total =  price*qty;
          var subTotal = 0;
          subTotal += parseInt(total);
          
          var table =   '<tr><td>'+ count +'</td><td>'+ name + '</td><td>' + qty + '</td><td>' + price + '</td><td><strong><input type="hidden" id="total" value="'+total+'">' +total+ '</strong></td></tr>';
          $('#new').append(table)
 
           // Code for Sub Total of Vegitables 
            var total = 0;
            $('tbody tr td:last-child').each(function() {
                var value = parseInt($('#total', this).val());
                if (!isNaN(value)) {
                    total += value;
                }
            });
             $('#subTotal').text(total);
               
            // Code for calculate tax of Subtoal 5% Tax Applied
              var Tax = (total * 5) / 100;
              $('#taxAmount').text(Tax.toFixed(2));
 
             // Code for Total Payment Amount
 
             var Subtotal = $('#subTotal').text();
             var taxAmount = $('#taxAmount').text();
 
             var totalAmounr = parseFloat(Subtotal) + parseFloat(taxAmount);
             $('#totalAmount').text(total.toFixed(2)); // Showing using ID 
        
         });
         count++;
        } 
       });
           // Code for year 
             
           var currentdate = new Date(); 
             var datetime = currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear();
                $('#year').text(datetime);
 
           // Code for extract Weekday     
                function myFunction()
                 {
                    var d = new Date();
                    var weekday = new Array(7);
                    weekday[0] = "Sunday";
                    weekday[1] = "Monday";
                    weekday[2] = "Tuesday";
                    weekday[3] = "Wednesday";
                    weekday[4] = "Thursday";
                    weekday[5] = "Friday";
                    weekday[6] = "Saturday";
 
                    var day = weekday[d.getDay()];
                    return day;
                    }
                var day = myFunction();
                $('#day').text(day);
     });
</script>
 
<!-- // Code for TIME -->
<script>
    window.onload = displayClock();
 
     function displayClock(){
       var time = new Date().toLocaleTimeString();
       document.getElementById("time").innerHTML = time;
        setTimeout(displayClock, 1000); 
     }
</script>

<?php
        require "../connection/connection.php";
        if(isset($_POST['Add'])){
         $pid = $_POST['id'];
         $pname = $_POST['p_name'];
         $qty = $_POST['qty'];
         $price = $_POST['product_price'];
         $qqty = $_POST['quantity'];
     
         $query = "UPDATE product SET qty='$qty'- quantity='$qqty' WHERE id='$pid'";
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
        //$date=date("Y-m-d");
      //   $query="SELECT * FROM report";
      //   $result=mysqli_query($con,$query);
      //   while($row=mysqli_fetch_assoc($result)){
      //   echo "<tr>";
      //   echo "<td>".$row['id']."</td>";
      //   echo "<td>".$row['parts_name']."</td>";
      //   echo "<td>".$row['qty']."</td>";
      //   echo "<td>".$row['price']."</td>";
      //   echo "<td>".$row['total']."</td>";
      //   echo "<td><a href='../auth/deletecategory.php?id=".$row['id']."'><input type='submit' value='Delete' class='delete'></a></td>";
      //   echo "<td><a href='../auth/updatecategory.php?id=".$row['id']."'><input type='submit' value='Update' class='update'></a></td>";
      //   echo "</tr>";
         // }
        ?>

<script>
//  function confirmDelete() {
//   return confirm("Are you sure want to delete this data?");
// }
function Logout() {
  return confirm("Are you sure want to Log Out?");
}
</script>
