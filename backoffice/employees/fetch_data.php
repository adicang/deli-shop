<?php

//fetch_data.php

$connect = new PDO("mysql:host=localhost;dbname=talisrae_dudi_backoffice", "talisraelba", "97QOTa=aYo");
$connect->exec("set names utf8");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $data  = array(
        ':fname' => "%" . $_GET['fname'] . "%",
        ':lname' => "%" . $_GET['lname'] . "%",
        ':email' => "%" . $_GET['email'] . "%",
        ':birth' => "%" . $_GET['birth'] . "%",
        ':role' => "%" . $_GET['role'] . "%",
        ':uid' => "%" . $_GET['uid'] . "%",
        ':phone' => "%" . $_GET['phone'] . "%"
    );
    $query = "SELECT * FROM users WHERE fname LIKE :fname AND lname LIKE :lname AND email LIKE :email AND birth LIKE :birth AND role LIKE :role AND uid LIKE :uid AND phone LIKE :phone";
    
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output[] = array(
            'id' => $row['id'],
            'fname' => $row['fname'],
            'lname' => $row['lname'],
            'email' => $row['email'],
            'birth' => date("d.m.Y", strtotime($row['birth'])),
            'role' => $row['role'],
            'uid' => $row['uid'],
            'phone' => $row['phone']
        );
    }
    header("Content-Type: application/json");
    echo json_encode($output);
}

if ($method == "POST") {
    $data      = array(
        ':fname' => $_POST['fname'],
        ':lname' => $_POST["lname"],
        ':email' => $_POST["email"],
        ':birth' => date("Y-m-d", strtotime($_POST["birth"])),
        ':role' => $_POST["role"],
        ':uid' => $_POST["uid"],
        ':password' => md5($_POST["uid"]),
        ':phone' => $_POST["phone"]
    );
    $query     = "SELECT uid FROM users";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->fetchAll();
    $flag   = FALSE;
    
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $flag = TRUE;
    }
    foreach ($result as $row) {
        if ($row['uid'] == $_POST["uid"]) {
            $flag = TRUE;
        }
    }
    if ($flag) {
        echo 0;
    } else {
        $query     = "INSERT INTO users (fname, lname, email, birth, role, uid, password, phone) VALUES (:fname, :lname, :email, :birth, :role, :uid, :password, :phone)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        echo 1;
    }
}

if ($method == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $data      = array(
        ':id' => $_PUT['id'],
        ':fname' => $_PUT['fname'],
        ':lname' => $_PUT['lname'],
        ':email' => $_PUT['email'],
        ':birth' => date("Y-m-d", strtotime($_PUT['birth'])),
        ':role' => $_PUT['role'],
        ':uid' => $_PUT['uid'],
        ':password' => md5($_PUT['uid']),
        ':phone' => $_PUT['phone']
    );
    $query     = "SELECT uid FROM users";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->fetchAll();
    $flag   = FALSE;
    $query     = "UPDATE users SET fname = :fname, lname = :lname, email = :email, birth = :birth, role = :role, uid = :uid, password = :password, phone = :phone WHERE id = :id";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    echo 1;
    
}
if ($method == "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $query     = "DELETE FROM users WHERE id = '" . $_DELETE["id"] . "'";
    $statement = $connect->prepare($query);
    $statement->execute();
}
?>