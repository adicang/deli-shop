function addUserToDatabase() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var myObj = JSON.parse(this.responseText);
            if (myObj.code == 1){
                var str="reg2.php?userId=";
                userId=myObj.regError;
                var url= str.concat(userId);
                window.location.href=url;
            }
            else
                document.getElementById("RegError").innerHTML = myObj.regError;
        }
    }
    
    request.open("POST", '../includes/include/regis.php', true);
    request.setRequestHeader('Content-type', 'application/json');
    var user_data = {
        
        "fullname": document.getElementById("fullname").value,
        "username": document.getElementById("username").value,
        "email": document.getElementById("email").value,
        "phoneNum": document.getElementById("phoneNum").value,
        "password": document.getElementById("password").value,
        "male": document.getElementById("male").checked,
        "female": document.getElementById("female").checked,
        "address": document.getElementById("autocomplete").value,
        "yearOfBirth": document.getElementById("yearOfBirth").value,
    }

    var data = JSON.stringify(user_data);
    request.send(data);
}


function editUserOnDatabase() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var myObj = JSON.parse(this.responseText);
            if (myObj.code == 1){
                window.location.href="editComplete.php";
            }
            else
                document.getElementById("RegError").innerHTML = myObj.regError;
        }
    }
    
    request.open("POST", '../includes/include/regisUpdate.php', true);
    request.setRequestHeader('Content-type', 'application/json');
    var user_data = {
        
        "fullname": document.getElementById("fullname").value,
        "username": document.getElementById("username").value,
        "email": document.getElementById("email").value,
        "phoneNum": document.getElementById("phoneNum").value,
        "password": document.getElementById("password").value,
        "male": document.getElementById("male").checked,
        "female": document.getElementById("female").checked,
        "address": document.getElementById("autocomplete").value,
        "yearOfBirth": document.getElementById("yearOfBirth").value,
    }

    var data = JSON.stringify(user_data);
    request.send(data);
}



function confirmUser(){
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var myObj = JSON.parse(this.responseText);
            if (myObj.code == 1){
                window.location.href="signIn.php"
            }
            else
                document.getElementById("RegError").innerHTML = myObj.regError;
        }
    }
    
    var url_string = window.location.href;
    var url = new URL(url_string);
    var userId = url.searchParams.get("userId");
    

    request.open("POST", '../includes/include/regisConfirm.php', true);
    request.setRequestHeader('Content-type', 'application/json');
    var user_data = {
        "confirmationCode": document.getElementById("confirmationCode").value,
        "userId": userId
    }

    var data = JSON.stringify(user_data);
    request.send(data);
}
