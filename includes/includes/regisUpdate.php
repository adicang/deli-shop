<?php
    require("init.php");
    
    
    
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    
    if(!$urlaray['username']){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן שם משתמש ');
    }
    else if(!$urlaray['fullname']){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן שם מלא ');
    }
    else if(!$urlaray['email']){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן כתובת אימייל ');
    }
    else if($urlaray['email'] && !filter_var($urlaray['email'], FILTER_VALIDATE_EMAIL)){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן כתובת אימייל תקינה');
    }
    else if(!$urlaray['phoneNum']){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן מספר טלפון ');
    }
    else if(!$urlaray['password']){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן סיסמה ');
    }
    else if(!$urlaray['female'] && !$urlaray['male'] ){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן מין ');
    }
    else if(!$urlaray['address']){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן כתובת מגורים ');
    }
    else if(!$urlaray['yearOfBirth']){
        $post_data = array('code'=>0,'regError'=>'*אנא הזן שנת לידה  ');
    }
    else{
        $fullName=$urlaray['fullname'];
        $username=$urlaray['username'];
        $email=$urlaray['email'];
        $pwd=$urlaray['password'];
        if($urlaray['male']==1){
            $gender='male';
        }
        else if($urlaray['female']==1){
            $gender='female';
        }
        $address=$urlaray['address'];
        $yearOfBirth=$urlaray['yearOfBirth'];
        $phoneNum=$urlaray['phoneNum'];
       
        
        //check if password storng
        if (strlen($pwd) < 8) {
            $post_data = array('code'=>0,'regError'=>'על הסיסמה להיות לפחות 8 תווים');
        }
        else if (!preg_match("#[0-9]+#", $pwd)) {
            $post_data = array('code'=>0,'regError'=>'על הסיסמה להיות לכלול לפחות ספרה אחת ');
        }
        else if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $post_data = array('code'=>0,'regError'=>'  על הסיסמה להיות לכלול לפחות אות אחת באנגלית');
        }     
        else{
            $password=md5($urlaray['password']);
            $error=user::edit_user($fullName,$username,$email,$phoneNum,$password,$gender,$address,$yearOfBirth,md5($randomCode));
            if ($error){
                $error='Can not edit user.  Error is:'.$database->get_connection()->error;
                $post_data = array('code'=>0,'regError'=>$error);
            }
            else{
                $post_data = array('code'=>1,'regError'=>$userId);
            }
        }
    }
    
    
	
    $info = json_encode($post_data);
    echo $info;


     ?>
