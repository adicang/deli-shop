<?php
    require("init.php");
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    $productName=$urlaray['productName'];
   
    $sql="SELECT  `unitOfMeasure`, `unitsInStock` FROM `products` WHERE name='".$productName."';";
    $result=$database->query($sql);
    $row = $result->fetch_assoc();
    $amountToReturn=$row['unitsInStock'];
if($row['unitOfMeasure']=="gram"){
    $unitToReturn="גרם";
}
if($row['unitOfMeasure']=="unit"){
    $unitToReturn="יחידות";
}
if($row['unitOfMeasure']=="maaraz"){
    $unitToReturn="מארזים";
}
    $totalRes=$amountToReturn. " ".$unitToReturn; 
    $post_data = array('code'=>$totalRes);
	
    $info = json_encode($post_data);
    echo $info;

     ?>