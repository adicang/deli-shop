<?php

//fetch_data.php

$connect = new PDO("mysql:host=localhost;dbname=talisrae_dudi_backoffice", "talisraelba", "97QOTa=aYo");
$connect->exec("set names utf8");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $data  = array(
        ':name' => "%" . $_GET['name'] . "%",
        ':phone' => "%" . $_GET['phone'] . "%",
        ':email' => "%" . $_GET['email'] . "%",
        ':type' => "%" . $_GET['type'] . "%",
        ':address' => "%" . $_GET['address'] . "%",
        ':id' => "%" . $_GET['id'] . "%",
        ':email' => "%" . $_GET['email'] . "%"
    );
    $query = "SELECT * FROM suppliers WHERE name LIKE :name AND phone LIKE :phone AND email LIKE :email AND type LIKE :type AND address LIKE :address AND id LIKE :id  ORDER BY id";
    
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'address' => $row['address'],
            'type' => $row['type']
            
        );
    }
    header("Content-Type: application/json");
    echo json_encode($output);
}

if ($method == "POST") {
    $data      = array(
        ':name' => $_POST['name'],
        ':phone' => $_POST["phone"],
        ':type' => $_POST["type"],
        ':address' => $_POST["address"],
        ':email' => $_POST["email"]
    );
    $query     = "SELECT id FROM suppliers";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->fetchAll();
    $flag   = FALSE;
    
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $flag = TRUE;
    }
    
    if ($flag) {
        echo 0;
    } else {
        
        $query     = "INSERT INTO suppliers (name, phone, type, address, email) VALUES (:name, :phone, :type, :address, :email)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        echo 1;
    }
}

if ($method == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $data      = array(
        ':id' => $_PUT['id'],
        ':name' => $_PUT['name'],
        ':phone' => $_PUT['phone'],
        ':type' => $_PUT['type'],
        ':address' => $_PUT['address'],
        ':email' => $_PUT['email']
    );
    $query     = "SELECT id FROM suppliers";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->fetchAll();
    $flag   = FALSE;
    
    $query     = "UPDATE suppliers SET name = :name, phone = :phone, email = :email, type = :type, address = :address WHERE id = :id";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    echo 1;
    
}
if ($method == "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $query     = "DELETE FROM suppliers WHERE id = '" . $_DELETE["id"] . "'";
    $statement = $connect->prepare($query);
    $statement->execute();
}
?>