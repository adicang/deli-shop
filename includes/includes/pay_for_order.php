<?php
    require("init.php");
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    $fullName=$urlaray['fullName'];
    $phone=$urlaray['phone'];
    $notes=$urlaray['notes'];
    $totalPayment=$urlaray['totalPayment'];
    $deliveryType=$urlaray['deliveryType'];
    $address=$urlaray['address'];
    $username=$session->get_user_name();

    $sql="INSERT INTO `orders`(`username`, `phone`, `address`, `delivery_type`, `notes`, `fullname`,`total_payment`) VALUES ('".$username."','".$phone."','".$address."','".$deliveryType."','".$notes."','".$fullName."',".$totalPayment.");";
    $result=$database->query($sql);
    $sql="SELECT max(order_id) FROM orders";
    $result=$database->query($sql);
    $row = $result->fetch_assoc();
    $post_data = array('code'=>1,'orderId'=> $row['max(order_id)']);
	
    $info = json_encode($post_data);
    echo $info;

     ?>