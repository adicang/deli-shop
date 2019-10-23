<?php
    require("init.php");
    
    
    
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    

    $productInCartId=$urlaray['productInCartId'];
    $amount=$urlaray['amount'];
   
        
        //check if product exists
        $sql="SELECT productId FROM `product_in_cart` where id_productInCart=".$productInCartId."";
        $result=$database->query($sql);
        $row = mysqli_fetch_assoc($result);
        $productId=$row['productId'];
         $sql = "SELECT `unitOfMeasure`,`price` FROM `products` WHERE `id`=".$productId."";
        $result=$database->query($sql);
        $row = mysqli_fetch_assoc($result);
        if($row['unitOfMeasure']=="gram"){
            $totalToPay=($amount*$row['price'])/100;
        }
        else{
            $totalToPay=($amount*$row['price']);
        }
        
        //check if product in stock
        $sql1="SELECT unitsInStock FROM `products` where id=".$productId."";
        $result1=$database->query($sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $inStock=$row1['unitsInStock'];
        
        if($inStock-$amount<=0){
            $post_data=array('code'=>1);
        }
        else{
             $sql="UPDATE `product_in_cart` SET `amount`=".$amount.",`totalToPay`=".$totalToPay." WHERE `id_productInCart`=".$productInCartId."";
             $result=$database->query($sql);
             $post_data=array('code'=>2);
        }
        
      
    
    
    
   
	
    $info = json_encode($post_data);
    echo $info;


     ?>