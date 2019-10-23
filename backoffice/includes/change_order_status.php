<?php
    require("init.php");
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    $orderId=$urlaray['orderId'];
    $status=$urlaray['status'];
    

    $sql="UPDATE `orders` SET `status`='".$status."' WHERE `order_id`=".$orderId."";
    $result=$database->query($sql);
   
    $post_data = array('code'=>1);
	
    $info = json_encode($post_data);
    echo $info;

     ?>