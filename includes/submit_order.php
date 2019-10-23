<?php
	
  require_once('include/init.php');
  ?>
<!DOCTYPE html>
<html lang="he">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>אצל דודי</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
        id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">


</head>

<body>
    <div class="wrapper recepies">
            <header>
                    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
        
        
                        <div class="social-wrapper">
                            <a href="tel:09-9554290" class="phone social">
                                <i class="fas fa-phone-volume"></i>
                            </a>
                            <a href="https://www.facebook.com/Dudisplace/" class="facebook social">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
        
                        <a class="navbar-brand d-block mx-auto d-lg-none" href="../index.php">
                            <img class="img-fluid" src="../assets/img/logo.jpg" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        
                        <div class="collapse navbar-collapse " id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="../index.php">דף הבית</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="recipes.php">מתכונים</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="products.php">מוצרים</a>
                                </li>
                                <a class="navbar-brand d-none d-lg-block" href="../index.php">
                                    <img class="img-fluid" src="../assets/img/logo.jpg" alt="">
                                </a>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.php">אודות</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php">השארת משוב</a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="../index.php#contactUs">יצירת קשר</a>
                                  </li>
                            </ul>
                            <div class="">
                                <ul class="navbar-nav mx-auto">
       
                                <?php

                                    if($session->get_signed_in()){
                                        echo '<li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        שלום '.$session->get_user_name(). '  </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="my_orders.php">ההזמנות שלי</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="my_account.php">החשבון שלי</a>
                                        <a class="dropdown-item" href="include/logout.php">התנתק</a>
                                        </div>
                                        </li>';
                                        
                                        
                                        $sql1="SELECT count(productId) FROM `product_in_cart` WHERE username='".$session->get_user_name()."' GROUP BY username";
                                        $result1=$database->query($sql1);
                                        if($result1->num_rows > 0){
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $productCount=(string)$row1['count(productId)'];
                                            
                                        }
                                        else{
                                            $productCount="0";
                                        }
                                      
                                        
                                        echo '<li class="nav-item">
                                                <a href="my_shopping_cart.php" class="nav-link">
                                                    <i class="material-icons large"> shopping_cart</i>
                                                    <span class="num-of-items" id="numOfItems">'.$productCount.'</span>
                                                </a>
                                            </li>';
                                    }
                                        
                                        
                                    else{
                                      echo '<li class="nav-item">
                                      <a class="nav-link" href="signIn.php">
                                        כניסת משתמשים</a>
                                    </li>';
                                     
                                    }
                            ?>
                    </ul>
                            </div>
                        </div>
                    </nav>
        
                </header>
            
 <section>
     <div class="row text-center mt-5 mb-5" dir="rtl">
         <div class="col">
             <h3> </h3>
             
         </div>
     </div>
 </section>
        
        
        <section>
            <div class="container">
                <div class="row">
                <div class="col-md-4">  
                    <div class="check-data-box">
                        <div class="table-item-box">
                            <div class="data-tit-box">
                                <h4 class="data-tit">1. פרטי ההזמנה</h4>
                            </div>
                            <div class="data-cont-box">
                                <table class="table table-hover font-size-13">
                <thead>
                    <tr>
                        <th>שם המוצר</th>
                        <th>מחיר</th>
                        <th>כמות</th>
                        <th>סך הכל לתשלום</th>
                        <th> </th>
                      </tr>
                    </thead>
                <tbody>
            <?php
                $sql="SELECT * FROM `product_in_cart` INNER JOIN `products` ON products.id=product_in_cart.productId WHERE username='".$session->get_user_name()."'";
                 $result=$database->query($sql);
                    if ($result->num_rows > 0){
                        $totalOrder=0;
                 while($row = mysqli_fetch_assoc($result)) { ?>
            
   
    
                      <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?> ש"ח ל-<?php if($row['unitOfMeasure']=="gram"){echo "100 גרם";} if($row['unitOfMeasure']=="maaraz"){echo "מארז";}if($row['unitOfMeasure']=="unit"){echo "יחידה";} ?></td>
                        <td><input id="<?php echo $row['id_productInCart']; ?>" onchange="changeAmountOnOrder(this.id)" type="tel" class="input-shopping-cart" value="<?php echo $row['amount']; ?>"><?php if($row['unitOfMeasure']=="gram"){echo " גרם";} if($row['unitOfMeasure']=="maaraz"){echo "מארזים";}if($row['unitOfMeasure']=="unit"){echo "יחידות";} ?> </td>
                        <td>&#8362;<span id="totalToPay"><?php echo $row['totalToPay']?></span></td>
                          <?php $totalOrder+=$row['totalToPay']; ?>
                          <td><button class="btn" onclick="removeFromOrderCart(<?php echo $row['productId']; ?>,'<?php echo $row['username']; ?>')"><i class="material-icons remove-from-cart">close</i></button></td>
                      </tr>
      
   
                <?php } }
                    
                    
                    else{
                        echo "<tr><td colspan='5' class='text-center'>לא נמצאו מוצרים בעגלת הקניות שלך</td></tr>";
                    } ?>
                     </tbody>
  </table>
                            </div>
                           </div>
                    </div>
                    
           
        
        </div>
            
             <div class="col-md-4">
                 <div class="check-data-box">
                        <div class="table-item-box">
                            <div class="data-tit-box">
                                <h4 class="data-tit">2. פרטי המשלוח</h4>
                            </div>
                            <div class="data-cont-box">
                                <p><input class="form-group" type="radio" name="delivery_type" onclick="selectedTypeDeliverySection()" value="self" id="self_type">  איסוף עצמי </p>
                                <p><input class="form-group" type="radio" name="delivery_type" onclick="selectedTypeDeliverySection()" value="delivery" id="delivery_type"> משלוח </p>
                            
                            <?php
                                
                                $sql="select * from customers where username='".$session->get_user_name()."'";
                                $result=$database->query($sql);
                                $row = $result->fetch_assoc();
                                
                                ?>
                                
                                
                                <div id="delivery">
                                    <label class="label-form" for="fullName"> שם מלא </label>
                                        <p> <input class="form-group font-size-18" type="text" id="fullNameDelivery" value="<?php echo $row['fullName']; ?>"></p>
                                    <label class="label-form" for="phoneDelivery"> מספר טלפון </label>
                                        <p> <input class="form-group font-size-18" type="text" id="phoneDelivery" value="<?php echo $row['user_phone']; ?>"></p>
                                    <label class="label-form" for="addressDelivery"> כתובת למשלוח </label>
                                        <p> <input class="form-group font-size-18" type="text" id="addressDelivery" value="<?php echo $row['address']; ?>"></p>
                                    <label class="label-form" for="notesDelivery"> הערות </label>
                                        <p> <textarea class="form-group font-size-18"  id="notesDelivery"></textarea></p>
                                        
                                <div style='padding: 15px;border-radius: 3px;background: rgb(254, 240, 240);'>
                                    עד 3 ימי עסקים מיום לאחר ביצוע ההזמנה
                                </div>
                                
                                </div>
                                
                                <div id="self">
                                        <label class="label-form" for="fullName"> שם מלא </label>
                                        <p> <input class="form-group font-size-18" type="text" id="fullNameSelf" value="<?php echo $row['fullName']; ?>"></p>
                                    <label class="label-form" for="phoneDelivery"> מספר טלפון </label>
                                        <p> <input class="form-group font-size-18" type="text" id="phoneSelf" value="<?php echo $row['user_phone']; ?>"></p>
                                    <label class="label-form" for="notesDelivery"> הערות </label>
                                        <p> <textarea class="form-group font-size-18"  id="notesSelf"></textarea></p>
                                        
                                    <div style='padding: 15px;border-radius: 3px;background: rgb(254, 240, 240);'>ההזמנה תחכה לך בחנות תוך יום עסקים אחד מרגע השלמת ההזמנה בכתובת משכית 32 הרצליה 
                                        <div>בין הימים: א-ה 7:30-19:00</div>
                                    </div>
                                </div>
                        </div>
                        </div>
                    </div>
            </div>
                    

        
                    
           
            
             <div class="col-md-4">
               
                 <div class="check-data-box">
                        <div class="table-item-box">
                            <div class="data-tit-box">
                                <h4 class="data-tit">3. פרטי התשלום</h4>
                            </div>
                             <div class="data-cont-box">
                            
                            <p><input class="form-group" type="radio" name="payment_type" id="creditCard" value="creditCard">  כרטיס אשראי </p>
                            <p><input class="form-group" type="radio" name="payment_type" id="payPal" value="payPal">   <img src="../assets/img/paypal_small_logo.webp" width="40%"> </p>
                            
                          
                            
                            </div>
                           </div>
                    </div>
                 <div class="bag_box">
                    <table class="items-list">
                        <tr>
                            <td><p class="s-tit margin-b10">סה”כ בסל הקניות</p></td>
                            <td class="t-left"><p class="s-tit margin-b10"><?php echo $totalOrder; ?> ₪</p></td>
                        </tr>
                        <tr id="checkout_shipping" style="display: table-row;">
                            <td><p class="s-tit margin-b10">משלוח</p></td>
                            <td class="t-left"><p class="s-tit margin-b10"><span id="delivery_amount" data-amount="0">0</span> ₪</p></td>
                        </tr>
                        <tr>
                            <td><p class="form-tit">סה&#34;כ לתשלום</p></td>
                            <td class="t-left"><p class="form-tit"><span id="total_price_after_changes"><?php echo $totalOrder; ?></span> ₪</p></td>
                        </tr>
                    </table>
                     
                    <div class="row">
                        <div class="col-12">
                            <button onclick="payForOrder(<?php echo $totalOrder; ?>)" class="form-btn full-width-btn c-form-btn" id="checkout_form2">המשך לתשלום</button>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <span id="order_error_message" class="error-message"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- not in stock Modal -->
        <div id="not-in-stock-modal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">המוצר חסר במלאי</h4>
              </div>
              <div class="modal-body">
                <p>לא ניתן לשנות את כמות היחידות מכיוון שאין כמות כזו במלאי</p></p>
              </div>
              <div class="modal-footer no-border">
                <button type="button" class="btn approve-btn"  onclick="location.reload();" data-dismiss="modal">אישור</button>
              </div>
            </div>

          </div>
        </div>

        <footer>
            <div class="container">
                <div class="row footer">
                    <div class="col-md-4 col-12">
                            <ul class="list-unstyled">
                                    <li class="headIt text-white font-weight-bold">תפריט</li>
                                    <li><a href="../index.php" class="text-white">דף הבית</a></li>
                                    <li><a href="recipes.php" class="text-white">מתכונים</a></li>
                                    <li><a  href="about.php" class=" text-white">אודות</a></li>
                                   <li><a  href="products.php" class=" text-white">מוצרים</a></li>
                                    <li><a  href="signIn.php" class=" text-white">כניסת משתמשים</a></li>
                                    <li><a  href="contact.php" class=" text-white">השארת משוב</a></li>
                                </ul>
                    </div>
                    <div class="col-md-4 col-12">
                        <ul class="list-unstyled">
                            <li class="headIt text-white font-weight-bold">מתכונים</li>
                            <li><a  href="recipe1.php" class=" text-white">אוסובוקו טלה</a></li>
                            <li><a  href="recipe2.php" class=" text-white">צלעות טלה מתובל</a></li>
                            <li><a  href="recipe3.php" class=" text-white">סלט קינואה</a></li>
                            <li><a  href="recipe4.php" class=" text-white">סלט שווארמה</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-12">
                            <ul class="list-unstyled">
                                    <li class="headIt text-white font-weight-bold">   שעות פעילות</li>
                                    <li><a class="text-white">ימים א-ה 8:00-18:00</a></li>
                                    <li><a class="text-white">ימי שישי וערבי חג 8:00-14:00</a></li>
                                </ul>

                                <ul class="list-unstyled">
                                        <li><a href="tel:09-9554290" class="text-white">ליצירת קשר – 09-9554290.</a></li>
                                        <li><a class="text-white">כתובת – משכית 32 הרצליה פיתוח. </a></li>
                                    </ul>
                         




                       
                    </div>
                </div>
            </div>

            <div class="row allrights text-center black text-white">
                <div class="col">
                    <p>כל הזכויות שמורות ל״אצל דודי - מעדני בשר״</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>