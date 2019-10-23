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
        $randomCode=createRandomConfirmationCode();
        //check if username exists
        $sql="SELECT * FROM `customers` where username='".$username."'";
        $result=$database->query($sql);
        if ($result->num_rows > 0){
            $post_data = array('code'=>0,'regError'=>'שם משתמש לא פנוי');
        }
        //check if password storng
        else if (strlen($pwd) < 8) {
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
            $error=user::add_user($fullName,$username,$email,$phoneNum,$password,$gender,$address,$yearOfBirth,md5($randomCode));
            if ($error){
                $error='Can not add user.  Error is:'.$database->get_connection()->error;
                $post_data = array('code'=>0,'regError'=>$error);
            }
            else{
                $sql = "SELECT * FROM customers where username='".$username."'";
                $result=$database->query($sql);
                $row = $result->fetch_assoc();
                $userId=$row["id"];
                ini_set( 'display_errors', 1 );
                error_reporting( E_ALL );
                $from = "bookinGym@gmail.com";
                $to = $email;
                $subject = "אישור הרשמה אצל דודי";
                $message = '<html lang="HE">
                            <head>
                            </head>
                            <body style="text-align:right; direction:rtl;">
                                <table>
                                    <tr>
                                        <td><h3>תודה על הצטרפותך למאגר הלקוחות של אצל דודי!</h3></td>
                                    </tr>
                                    <tr>
                                        <td>על מנת להצטרף סופית לאתר עליך להזין את הקוד הבא בקישור המצורף:</td>
                                    </tr>
                                    <tr>
                                        <td>
                                    <b> קוד אישור:  </b>  '.$randomCode.'  </td>
                                    </tr>
                                    <tr>
                                    <td><b> קישור להזנת הקוד: </b> 
                                    <a href="http://talisraelba.mtacloud.co.il/includes/reg2.php?userId='.$userId.'"> לחץ כאן על מנת להזין את קוד האישור </a></td>
                                    </tr>
                                    <tr>
                                    <tr></tr>
                                    <tr></tr>
                                        <td>בברכה, </td>
                                    </tr>
                                    <tr>
                                        <td>אצל דודי</td>
                                    </tr
                                </table>
                            </body>
                        </html>';
                
                $headers = "From:" . $from;
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                mail($to,$subject,$message, $headers);
                $post_data = array('code'=>1,'regError'=>$userId);


            }
        }
    }
    
    function createRandomConfirmationCode() { 

        $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $pass = '' ; 
    
        while ($i <= 7) { 
            $num = rand() % 33; 
            $tmp = substr($chars, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
        } 
    
        return $pass; 
    
    }
   
	
    $info = json_encode($post_data);
    echo $info;


     ?>
