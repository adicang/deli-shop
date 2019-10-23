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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">


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
            
 <section class="container-fluid padding" id="regForm">
    <div class="container" dir="rtl">
        <div class="row" style="margin-top: 4%;">
        <div class="col-md-4"></div>
        <div class="col-md-4 well text-center regForm">
          <h3>ערכו את פרטי החשבון שלכם</h3>
          
            <?php
                 $result=$database->query("select * from customers where username='".$session->get_user_name()."'");
                 $row = $result->fetch_assoc();
               
            ?>
            
                <div class="form-group">
                    <input class="form-control" type="text" name="fullname" id="fullname" value="<?php echo $row['fullName']; ?>" required="" placeholder="שם מלא" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" minlength="3" maxlength="15" name="uname"  autocomplete="off" id="username" disabled value="<?php echo $row['username']; ?>"/> <span id="user-result"></span> 
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="uemail" required="" value="<?php echo $row['email']; ?>" id="email" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="number" name="phoneNum" required="" value="<?php echo $row['user_phone']; ?>" id="phoneNum" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="upass" required="" placeholder="הקלד סיסמה חדשה" id="password"/>
                </div>
                <div class="form-group">
                    <label><input type="radio" name="ugender" value="male" required id="male" <?php if($row['gender']==male){echo checked;} ?> > זכר</label>
                    <label><input type="radio" name="ugender" value="female" id="female" <?php if($row['gender']==female){echo checked;} ?>> נקבה</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="address" required="" value="<?php echo $row['address']; ?>" id="autocomplete"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="number" min="1919" name="uyear" id="yearOfBirth" required="" value="<?php echo $row['yearOfBirth']; ?>"/>
                </div>
                <div class="form-group">
                    <p id="RegError" class="error-message"></p>
                </div>
                
                <button class="btn btn-danger to-center btn-edit-account" value="ביטול" onclick="goBack()">ביטול</button>
                <button class="btn btn-success to-center btn-edit-account" value="שמירת פרטים" onclick="editUserOnDatabase()">שמירת פרטים</button>
                
           
            <br>
            </div>
        </div>
    </div>
  </section>

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
    <script src="../js/regis.js"></script>
     <script src='../js/autoComplete.js'></script>
     <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB82EdqJSv80J9--zaL2APp17ybPYlJGc4&libraries=places,geometry&callback=initAutocomplete&language=iw&region=IL"
    async defer></script>
</body>

</html>