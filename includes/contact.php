<?php


	
require_once('include/init.php');


if (isset($_POST["submit"])) {

    $servername = "localhost";
    $username = "talisraelba";
    $password = "97QOTa=aYo";
    $dbname = "talisrae_dudi_backoffice";
    
   

    $name = $_POST['name'];
    $family = $_POST['family'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $person = $_POST['person'];
    $date = $_POST['date'];
    $text = $_POST['text'];
    


 
    if( $name == '' ){
        $errorname = 'הכניסו שם מלא';
    }

    if( $family == '' ){
        $errorfamily = 'הכניסו שם תקין';
    }
    if( $phone == '' ){
        $errorphone = 'הכניסו מספר תקין';
    }
    if( $email == '' ){
        $erroremail = 'הכניסו אימייל תקני';
    }
    if( $person == '' ){
        $errorperson = 'הכניסו איש שירות';
    }
  
    if( $date == '' ){
        $errordate = 'הכניסו תאריך';
    }
    if( $text == '' ){
        $errortext = 'הכניסו משוב';
    }


    if($name !== '' && $family !== '' && $phone !== '' && $email !== '' && $person !== '' && $date !== '' && $text !== ''){
                    // Create connection
                
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    mysqli_set_charset($conn,"utf8");
                      
                    
                    // Check connection
                    
                    if (mysqli_connect_errno()) {
                        
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        die();
               
                      }
                     mysqli_set_charset($conn,"utf8");
                      
                
                    $sql = "INSERT INTO mashuv(`name`, `family`, `phone`, `email`, `person`, `date`, `text`) VALUES ('$name', '$family', '$phone' ,'$email','$person', '$date', '$text')";
                     
                    if ($conn->query($sql) === TRUE) {
                        header('Location: thankyou.php');
                    } else {
                        echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
                    }
    }



}

?>

<!DOCTYPE html>
<html lang="he">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>אצל דודי</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="../css/style.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>

<body>
    <div class="wrapper contact">
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <div class="row aboutHead text-center" dir="rtl">
                <div class="col">
                    <h3>השארת משוב</h3>
                    <p>אנחנו תמיד שמחים לשמוע ממכם</p>
                </div>
            </div>
        </section>

        <section>

            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <img class="img-fluid" src="../assets/img/shuarma.png" alt="">
                    </div>
                    <div class="col-md-6 col-12">
                        <form method="post" class="text-right" action="#">
                            <div class="form-group">
                                <label for="name">שם פרטי</label>
                                <input id="name" class="form-control text-right" type="text" name="name" value="<?php if(isset($_POST['name']) ) echo $_POST['name']; ?>">
                                <span class="text-danger mt-3"><?php echo $errorname; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="family">שם משפחה</label>
                                <input id="family" class="form-control text-right" type="text" name="family" value="<?php if(isset($_POST['family']) ) echo $_POST['family']; ?>">
                                <span class="text-danger mt-3"><?php echo $errorfamily; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">טלפון</label>
                                <input id="phone" class="form-control text-right" type="phone" name="phone" value="<?php if(isset($_POST['phone']) ) echo $_POST['phone']; ?>">
                                <span class="text-danger mt-3"><?php echo $errorphone; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="email">אימייל</label>
                                <input id="email" class="form-control text-right" type="email" name="email" value="<?php if(isset($_POST['email']) ) echo $_POST['email']; ?>">
                                <span class="text-danger mt-3"><?php echo $erroremail; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="natzig">שם הנציג</label>
                                <select id="natzig" class="form-control text-right" name="person">
                                    <option>אייל</option>
                                    <option>טל</option>
                                    <option>דודי</option>
                                </select>
                                <span class="text-danger mt-3"><?php echo $errorperson; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="date">תאריך</label>
                                <input id="date" class="form-control text-right" type="date" name="date" value="<?php if(isset($_POST['date']) ) echo $_POST['date']; ?>">
                                <span class="text-danger mt-3"><?php echo $errordate; ?></span>
                            </div>
                            <div class="form-group" dir="rtl">
                                <label for="mashuv">משוב</label>
                                <textarea id="text" class="form-control" rows="3" name="text" value="<?php if(isset($_POST['text']) ) echo $_POST['text']; ?>"></textarea>
                                <span class="text-danger mt-3"><?php echo $errortext; ?></span>
                            </div>

                            <div class="form-group" dir="rtl">
                                <input id="thebutton" class="form-control btn btn-danger" type="submit" name="submit" value="שלחו משוב">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

        </section>


        <section>
            <div class="row fifth">
                <div class="col">
                    <h3>צרו איתנו קשר</h3>
                </div>
            </div>
            <div class="container">
                <div class="row sixth">
                    <div class="col-md-6 col-12">
                        <h3> שעות פעילות </h3>
                        <p>

                            <span>ימים א-ה 8:00-18:00</span>
                            <span> ימי שישי וערבי חג 8:00-14:00</span>
                        </p>
                        <p>
                            <a href="tel:09-9554290">ליצירת קשר – 09-9554290 <i class="fas fa-phone-volume"></i> </a>
                            <span> כתובת – משכית 32 הרצליה פיתוח. </span></p>

                        <p>
                            <a href="https://www.facebook.com/Dudisplace/"> חפשו אותנו בפייסבוק <i class="fab fa-facebook-f"></i></a>
                        </p>
                    </div>
                    <div class="col-md-6 col-12">
                        <img class="img-fluid" src="../assets/img/dudi.jpg" alt="">
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
                            <li><a  href="contact.php" class=" text-white">השארת משוב</a></li>>
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
                            <li class="headIt text-white font-weight-bold"> שעות פעילות</li>
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

