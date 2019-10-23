<?php
session_start();
require_once 'init.php';
$uid       = $_SESSION['uid'];
$statusMsg = '';
$method    = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $name        = $_POST['name'];
    $price               = $_POST['price'];
    $unitOfMeasure       = $_POST['unitOfMeasure'];
    $validityInDays       = $_POST['validityInDays'];
    $unitsInStock         =$_POST['unitsInStock'];
    $department       = $_POST['department'];
    $description = $_POST['description'];
    $gid         = $_POST['gid'];
    if (!empty($_FILES["image"]["name"])) {
        $targetDir      = "../products/img/";
        $fileName       = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType       = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes     = array(
            'jpg',
            'png',
            'jpeg',
            'gif'
        );
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
            }
        }
        if (isset($_POST['gid'])) {
            
            $sql = "UPDATE products SET name = '$name', description = '$description', price = '$price', image = '$fileName', unitOfMeasure = '$unitOfMeasure', department = '$department', validityInDays = '$validityInDays', unitsInStock = '$unitsInStock' WHERE id = '$gid'";
        } else {
            $sql = "INSERT INTO products (name, description, price, image,unitOfMeasure,department,validityInDays,unitsInStock) VALUES ('" . $name . "', '" . $description . "', '" . $price . "', '" . $fileName . "','" . $unitOfMeasure . "','" . $department . "','" . $validityInDays . "', '" . $unitsInStock . "')";
        }
    } else {
        $sql = "UPDATE products SET name = '$name', description = '$description', price = '$price',unitOfMeasure = '$unitOfMeasure', department = '$department', validityInDays = '$validityInDays' , unitsInStock = '$unitsInStock'  WHERE id = '$gid'";
    }
    $result = $database->query($sql);
    echo $_POST['gid'];
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if ($method == 'GET') {
    $gid    = $_GET['gid'];
    $delete = $_GET['delete'];
    if (isset($delete)) {
        $sql    = "DELETE FROM products WHERE id=$gid";
        $result = $database->query($sql);
    } 
     
 else {
        $sql    = "SELECT * FROM products where id=$gid";
        $result = $database->query($sql);
        $rows   = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        echo json_encode($rows, JSON_UNESCAPED_UNICODE);
    }
}
?>