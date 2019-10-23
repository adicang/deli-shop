<?php
    require_once('init.php');
    global $session;

    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

	

    if (!$urlaray['userName']){
        $post_data = array('code'=>0,'loginError'=>'*אנא הזן שם משתמש');
    }
    else if(!$urlaray['password']) {
        $post_data = array('code'=>0,'loginError'=>'*אנא הזן סיסמה');
	}
    else{
            $user=$urlaray['userName'];
            $password=md5($urlaray['password']);
			$currUser=new User();
            $error=$currUser->find_user($user,$password);
            if (!$error){
					$currUser=$currUser->find_user_by_id($user);
                    $session->login($currUser);
                    $sql="SELECT * FROM customers where username='".$user."' and isApproved=1";
                    $result=$database->query($sql);
                    if ($result->num_rows > 0) {
                    $post_data = array('code'=>1,'loginError'=>'');
                    }
                    else{
                        $post_data = array('code'=>0,'loginError'=>'*המשתמש לא סיים את תהליך ההרשמה');
                    }
            }
            else{
                $post_data=array('code'=>0,'loginError'=>'*אחד או יותר מהערכים שהוזנו לא נכונים');
            }
    }
	
	if ($urlaray['rememberMe']){
		setcookie ("userName",$urlaray['userName'],time() + (86400 * 30), "/");
		setcookie ("password",$urlaray['password'],time() + (86400 * 30), "/");
	}
	
		
    $info = json_encode($post_data);
    echo $info;
  

   
  ?>
