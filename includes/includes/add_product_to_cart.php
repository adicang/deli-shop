<?php
    require("init.php");
    
    
    
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    

    $productId=$urlaray['productId'];
    $username=$urlaray['userName'];
    $amount=$urlaray['amount'];
        
        //check if product exists on the user cart
        $sql="SELECT * FROM `product_in_cart` where username='".$username."' and productId=".$productId."";
        $result=$database->query($sql);
        
        //check if product in stock
        $sql1="SELECT unitsInStock FROM `products` where id=".$productId."";
        $result1=$database->query($sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $inStock=$row1['unitsInStock'];



        if ($result->num_rows > 0){
            $post_data=array('code'=>1);
        }  
        else if($inStock-$amount<=0){
            $post_data=array('code'=>2);
        }
        else{
                $sql = "SELECT `unitOfMeasure`,`price` FROM `products` WHERE `id`=".$productId."";
                $result=$database->query($sql);
                $row = mysqli_fetch_assoc($result);
                if($row['unitOfMeasure']=="gram"){
                    $amount*=100;
                    $totalToPay=($amount*$row['price'])/100;
                }
                else{
                    $amount*=1;
                    $totalToPay=($amount*$row['price']);
                }
               
                $sql = "INSERT INTO `product_in_cart`(`productId`, `username`,`amount`, `totalToPay`) VALUES (".$productId.",'".$username."',".$amount.",".$totalToPay.")";
                $result=$database->query($sql);
                $post_data=array('code'=>3);
                
           


            }
        
    
    
    
   
	
    $info = json_encode($post_data);
    echo $info;


     ?>