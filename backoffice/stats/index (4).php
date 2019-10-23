<?php  
   session_start();
   require_once ('../includes/init.php');
   $user = new User();
   $role = $_SESSION['role'];
   if (!$user->get_session()) {
    header("location:../login.php");
    exit();
    }
    if($role != 'מנהל'){
        header("location: ../index.php");
        exit();
    }
    if (isset($_GET['q'])) {
        $user->user_logout();
        header("location:../login.php");
        exit();
    }
   $uid = $_SESSION['uid'];

   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-9NlqO4dP5KfioUGS568UFwM3lbWf3Uj3Qb7FBHuIuhLoDp3ZgAqPE1/MYLEBPZYM" crossorigin="anonymous">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <link rel="stylesheet" href="../sidebar/sidebar.css" />
      <title>אצל דודי - דוחות</title>
   </head>
   <style>
      .custom-select {
      width: 30%;
      }
      canvas {
      max-width: 100%;
      height:80%;
      margin:auto;
      }
      .img-best-seller{
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,0.125);
            border-radius: 0.4rem;
            margin-top: 15px;
      }
   </style>
   <body>
      <?php include "../sidebar/sidebarH.php"; ?>
      <!-- Page Wrapper -->
      <div id="wrapper" class="toggled">
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
               <!-- Begin Page Content -->
               <div class="container text-center">
                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800">אצל דודי - דוחות</h1>
                  <br>
                  <!-- Content Row -->
                  <div class="justify-content-center">
                     <!-- Earnings (Weekly) Card Example -->
                     <div class="row mb-4 justify-content-center text-center">
                        <div class="col-sm-5 h-100 m-1 card shadow py-2">
                           <div class="card-body">
                              <div class="no-gutters align-items-center">
                                 <div class="col">
                                    <div class="h5 font-weight-bold  mb-2">הכנסות מהזמנות לחודש זה</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800"> <span id="monthlyIncome">
                                        
                                        </span> &#8362;
                                        </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-5 h-100 m-1 card shadow py-2">
                           <div class="card-body">
                              <div class="no-gutters align-items-center">
                                 <div class="col">
                                    <div class="h5 font-weight-bold  mb-2">כמות הזמנות לחודש זה</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800"><span id="monthlyCst">
                                    </span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="row mb-4 justify-content-center text-center">
                        <div class="col-sm-5 h-100 m-1 card shadow py-2">
                           <div class="card-body">
                              <div class="no-gutters align-items-center">
                                 <div class="col">
                                    <div class="h5 font-weight-bold  mb-2">המוצר הנמכר ביותר</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800"> 
                                        <span id="monthlyIncome">
                                        <?php
                                            $sql="SELECT productId, count(*) AS ct FROM product_in_order a GROUP BY productId ORDER BY ct DESC LIMIT 1";
                                            $result=$database->query($sql);
                                            $row = mysqli_fetch_assoc($result);
                                            $productId=$row['productId'];
                                            $sql1="SELECT * FROM products where id=".$productId."";
                                            $result1=$database->query($sql1);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            echo $row1['name'];
                                            echo "<br>";
                                            echo "<img class='img-best-seller' width='300px' height='200px' src='../products/img/".$row1['image']."'>";
                                            
                                        
                                        ?>
                                        </span> 
                                        </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     
                     <div class="container card text-center shadow mb-4 p-0 m-0">
                        <div class="card-header text-center">
                           <h5 class="m-1 font-weight-bold ">
                              הכנסות לשנת 2019  
                           </h5>
                           
                           
                        </div>
                        <div class="card-body p-0">
                           <div class="chart-area">
                              <canvas id="myAreaChart"></canvas>
                           </div>
                           <hr>
                           <div class="h6 text-xs font-weight-bold  mb-1">  סך הכנסות שנתיות:  
                              <span id="yearlyIncome" class="h6 mb-0 font-weight-bold text-gray-800"></span>
                           </div>
                        </div>
                     </div>
                     
                     
                     <!-- Donut Chart -->
                     <div class="container text-center card shadow mb-4 p-0 text-right">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3">
                           <h5 class="m-1 font-weight-bold ">
                           כמות הזמנות לשנת 2019  
                           </h5>
                           
                          
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                           <div class="chart-pie pt-4">
                              <canvas id="pieChart"></canvas>
                           </div>
                           <hr>
                        </div>
                     </div>
                     
                     
                     <!-- units in stock for each product -->
                        <div class="row mb-6 justify-content-center text-center">
                        <div class="col-sm-6 h-100 m-1 card shadow py-2">
                           <div class="card-body">
                              <div class="no-gutters align-items-center">
                                 <div class="col">
                                    <div class="h5 font-weight-bold  mb-2">כמות במלאי של מוצרי המעדניה</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <select style="width: 100%;" class="custom-select text-last-center" name="getInStock" id="getInStock" onchange="getInStock()">
                                                    <option value="">בחר מוצר</option>
                                                    <?php 
                                                        $sql="SELECT  `name` from products ORDER BY name ";
                                                        $result = $database->query($sql);
                                                         while($row = mysqli_fetch_assoc($result)){
                                                             echo "<option value='".$row['name']."'>".$row['name']."</option>";
                                                         }
                                                    ?>
                          
                                            </select>
                                          </div>
                                            <div class="form-group col-6">
                                                <input style="width: 100%; border: 1px solid #ced4da; border-radius: 0.4rem; font-size: 18px; padding: 7px;" id="amount_to_fill" type="text" disabled>
                                                </div>
                                        </div> 
                                        
                                        </span> 
                                        </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <?php include "../sidebar/sidebarF.php"; ?>
      <!-- JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <!-- Page level custom scripts -->
      <script src="script.js"></script>
   </body>
</html>