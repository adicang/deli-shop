<?php  
   session_start();
   require_once ('../includes/init.php');
   $user = new User();
   $uid = $_SESSION['uid'];
   if (!$user->get_session()){
   header("location:login.php");
   exit();
   }
   if (isset($_GET['q'])){
   $user->user_logout();
   header("location:login.php");
   exit();
   }
   ?>
<!doctype html>
<html>
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Custom Bootstrap CSS -->
      <link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <link rel="stylesheet" href="../sidebar/sidebar.css" />
      <link rel="stylesheet" href="index.css">
   </head>
   <title>אצל דודי - הזמנות</title>
   <body>
      <?php include "../sidebar/sidebarH.php"; ?>
      <div class="text-center">
         <h1>הזמנות</h1>
      </div>
      <div class="container-fluid">
         <table id="orders" class="table shadow" dir="rtl">
             
                <thead>
                    <tr>
                        <th>מזהה הזמנה</th>
                        <th>תאריך ההזמנה</th>
                        <th>שם משתמש</th>
                        <th>סוג משלוח</th>
                        <th>תשלום</th>
                        <th>הערות</th>
                        <th>  </th>
                        <th>סטטוס</th>
                      </tr>
                    </thead>
                <tbody>
            <?php
                $sql="SELECT * FROM `orders` ORDER BY create_date DESC;";
                 $result=$database->query($sql);
                    if ($result->num_rows > 0){
                        
                        while($row = mysqli_fetch_assoc($result)) { ?>
            
   
    
                        <tr  class="parent <?php if($row['status']=="בוטלה") echo "canceled-order"; ?>">
                          <td><?php echo $row['order_id']; ?></td>
                          <td><?php $dt = new DateTime($row['create_date']);
                               echo $dt->format('d-m-Y');  ?></td>
                          <td><?php echo $row['username']; ?></td>
                          <td><?php echo $row['delivery_type']; ?></td>
                          <td><?php echo $row['total_payment']; ?>  &#8362;</td>
                        <td><?php echo $row['notes']; ?></td>
                       <td><a href="#" class="link-open-rows">צפייה במוצרי ההזמנה</a></td>
                        <td>
                            <button class="btn btn-status <?php if($row['status']=="התקבלה"){echo "current-status";} ?>" <?php if($row['status']=="התקבלה"||$row['status']=="בוטלה"){echo "disabled";} ?> onclick="changeOrderStatus(<?php echo $row['order_id'] ?>,'accepted')">התקבלה</button>
                            <button class="btn btn-status <?php if($row['status']=="בהכנה"){echo "current-status";} ?>" <?php if($row['status']=="בהכנה"||$row['status']=="בוטלה"){echo "disabled";} ?> onclick="changeOrderStatus(<?php echo $row['order_id'] ?>,'preparation')">בהכנה</button>
                            <button class="btn btn-status <?php if($row['status']=="הסתיימה"){echo "current-status";} ?>" <?php if($row['status']=="הסתיימה"||$row['status']=="בוטלה"){echo "disabled";} ?> onclick="changeOrderStatus(<?php echo $row['order_id'] ?>,'completed')">הסתיימה</button></td>
                          </tr>
                    
              

                    
                        
                                <?php
                                    $sql1="SELECT * FROM `product_in_order` INNER JOIN products ON product_in_order.productId=products.id WHERE orderId=".$row['order_id']."";
                                    $result1=$database->query($sql1);
                                    if ($result1->num_rows > 0){ ?>
                                        <tr class="hide">
                                            <td class="no-border-top top-product-row"> </td>
                                            <td class="no-border-top top-product-row" >שם המוצר</td>
                                            <td class="no-border-top top-product-row"> </td>
                                            <td class="no-border-top top-product-row">כמות</td>
                                            <td class="no-border-top top-product-row">מחיר</td>
                                            <td class="no-border-top top-product-row"> </td>
                                            <td class="no-border-top top-product-row"> </td>
                                            <td class="no-border-top top-product-row"> </td>
                                            
                                        </tr>
                                            <?php
                                        while($row1 = mysqli_fetch_assoc($result1)) { ?>
                                          <tr class="hide">
                                              <td class="no-border-top"> </td>
                                              <td class="no-border-top"><?php echo $row1['name']; ?></td>
                                              <td class="no-border-top"><img class="img-shopping-cart" width="150px" height="100px" src="../products/img/<?php echo $row1['image'];?>"></td>
                                              <td class="no-border-top"><?php echo $row1['amount']; ?><?php if($row1['unitOfMeasure']=="gram"){echo " גרם";} if($row1['unitOfMeasure']=="maaraz"){echo " מארז";}if($row1['unitOfMeasure']=="unit"){echo " יחידות";} ?></td>
                                              <td class="no-border-top"><?php echo $row1['totalToPay']?> &#8362;</td>
                                               <td class="no-border-top"> </td>
                                              <td class="no-border-top"> </td>
                                          </tr>
                                <?php } } ?>
                    
                                
                            
                    
      
   
                <?php } }
                    
                    
                    else{
                        echo "<tr><td colspan='5' class='text-center'>לא נמצאו הזמנות עבור החשבון שלך</td></tr>";
                    } ?>
                     </tbody>
             
         </table>
      </div>
      <?php include "../sidebar/sidebarF.php"; ?>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="script.js"></script>
       

   </body>