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
            <div class="row space-row">
                <div class="categories-container">
                   <a href="product_Page.php?department=meat" class="catogory-option  <?php if($_GET['department']=="meat"){ echo "color-black";} ?>" >בשרים ועופות</a>
                    <a href="product_Page.php?department=fish" class="catogory-option  <?php if($_GET['department']=="fish"){ echo "color-black";} ?>">דגים</a>
                     <a href="product_Page.php?department=naknikim" class="catogory-option  <?php if($_GET['department']=="naknikim"){ echo "color-black";} ?>" >נקניקים</a>
                    <a href="product_Page.php?department=cheese" class="catogory-option  <?php if($_GET['department']=="cheese"){ echo "color-black";} ?>">גבינות</a>
                   <a href="product_Page.php?department=shimurim" class="catogory-option  <?php if($_GET['department']=="shimurim"){ echo "color-black";} ?>">חומרי גלם לבישול</a>
                     <a href="product_Page.php?department=wine" class="catogory-option  <?php if($_GET['department']=="wine"){ echo "color-black";} ?>">אלכוהול</a>
                </div>
            </div>
        </section>
        
 <section>
        <div class="row">
         <?php
            $department=$_GET['department'];
            $sql = 'SELECT * FROM `products` WHERE `department` = "'.$department.'"';
            $result = $database->query($sql);
            $count=0;
            while($row = mysqli_fetch_assoc($result)) {?>
         <div class="col-lg-3 col-md-5 my-3">
            <!-- Card -->
            <div class="card shadow">
               <!-- Card image -->
               <div class="view overlay">
                  <img class="card-img-top" src="../backoffice/products/img/<?php echo $row['image'];?>">
                  <a href="#!">
                     <div class="mask rgba-white-slight"></div>
                  </a>
               </div>
               <!-- Card content -->
               <div class="card-body">
                  <!-- Title -->
                  <h4 class="card-title"><?php echo $row['name']; ?></h4>
                   <div class="card-description">
                  <!-- Text -->
                  <p class="card-text"><?php echo $row['description']; ?></p>
                  
                 
                  
                  <p><b> תוקף: </b><?php echo $row['validityInDays']; ?> ימים</p>
                   </div>
                   <div class="space-between"></div>
                    <div class="row ">
                    <p>
                        <b> מחיר:</b> <?php echo $row['price']; ?> ש"ח   / <?php if($row['unitOfMeasure']=="gram"){echo "100 גרם ";} if($row['unitOfMeasure']=="maaraz"){echo " מארז";}if($row['unitOfMeasure']=="unit"){echo " יחידה";} ?>
                    </p>
                    <div class="row add_to_cart_row">
                        <form class="addToCartForm add_to_cart_wrapper" >
                            <div class="add_to_cart_count">
                                <a class="minus" data-quantity="minus" data-field="quantity<?php echo $row['id']; ?>"></a>
                                <input type="text" id="quantity<?php echo $row['id']; ?>" name="quantity<?php echo $row['id']; ?>" value="1" class="qty" rel="9362" readonly />
                                <a class="plus" data-quantity="plus" data-field="quantity<?php echo $row['id']; ?>"></a>
                            </div>
                            <button type="button" class="add_to_cart_category btn-cart" rel="9362" title="הוסף" class="button btn-cart" source="category_page" onclick="<?php if ($session->get_signed_in()){ echo "addProductToCart(".$row['id'].",'".$session->get_user_name()."')"; } else{ echo "pleaseLogInShowModal()"; } ?>"><span><span>הוסף</span></span></button>
                        </form>
                    </div>
                    
                    

                
                     
                  </div>
               </div>
            </div>
            <!-- Card -->
         </div>
         <?php
            }
            $count++; 
            ?>
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
                <p>לא ניתן להוסיף את המוצר לעגלת הקניות מכיוון שכרגע הוא חסר במלאי</p>
              </div>
              <div class="modal-footer no-border">
                <button type="button" class="btn approve-btn"  data-dismiss="modal">המשך בחיפוש מוצרים אחרים</button>
              </div>
            </div>

          </div>
        </div>
        
        
        <!-- already in cart Modal -->
        <div id="on-cart-modal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">מוצר זה נמצא בעגלת הקניות שלך</h4>
              </div>
              <div class="modal-body">
                <p>מוצר זה כבר נמצא בעגלת הקניות שלך, אנא בחר מוצרים נוספים</p>
              </div>
              <div class="modal-footer no-border">
            <button type="button" class="btn approve-btn" onclick="location.href='my_shopping_cart.php'" data-dismiss="modal">מעבר לעגלת הקניות</button>
              </div>
            </div>

          </div>
        </div>
        

        <!-- not login Modal -->
        <div id="not-login-modal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">לא ניתן להוסיף לעגלת הקניות</h4>
              </div>
              <div class="modal-body">
                <p>כדי להוסיף מוצר זה לעגלת הקניות יש להתחבר לחשבון המשתמש שלך</p>
              </div>
              <div class="modal-footer no-border">
                <button type="button" class="btn approve-btn" onclick="location.href='signIn.php'" data-dismiss="modal">התחבר לחשבון שלך</button>
              </div>
            </div>

          </div>
        </div>
        
        <!-- login Modal -->
        <div id="add-to-cart-modal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" onclick="location.reload();">&times;</button>
                <h4 class="modal-title">מוצר נוסף בהצלחה!</h4>
              </div>
              <div class="modal-body">
                <p>המוצר נוסף בהצלחה לעגלת הקניות!</p>
              </div>
              <div class="modal-footer no-border">
                <button type="button" class="btn approve-btn" onclick="location.href='my_shopping_cart.php'" data-dismiss="modal">מעבר לעגלת הקניות</button>
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