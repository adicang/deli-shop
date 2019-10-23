<?php
    require("init.php");
    
    
    
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    

    $productId=$urlaray['productId'];
    $username=$urlaray['userName'];
   
        
        //check if product exists
        $sql="SELECT * FROM `product_in_cart` where productId=".$productId." and username='".$username."'";
        $result=$database->query($sql);
        if ($result->num_rows > 0){
             $sql = "DELETE FROM `product_in_cart` where productId=".$productId." and username='".$username."'";
             $result=$database->query($sql);
        }  
        
    
    
    
   
	
    $info = json_encode($post_data);
    echo $info;


     ?>