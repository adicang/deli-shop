<?php
    require("init.php");
    
      
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    if (!$urlaray['confirmationCode']){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן קוד אימות ');
    }
    else{
        $userId=$urlaray['userId'];
        $confirmationCode=$urlaray['confirmationCode'];
        $sql="SELECT * FROM customers where id=".$userId." and confirmationCode='".md5($confirmationCode)."'";
        $result=$database->query($sql);
        if ($result->num_rows > 0) {
            $sql="UPDATE `customers` SET `isApproved`=1 WHERE id=".$userId."";
            $result=$database->query($sql);
            $post_data = array('code'=>1,'regError'=>'');
        }
        else{
            $post_data = array('code'=>0,'regError'=>'הקוד שגוי, אנא נסו שנית');
        }
    }
        
       
        
   
	
    $info = json_encode($post_data);
    echo $info;




    

    
?>