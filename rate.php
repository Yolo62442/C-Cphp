<?php
header('Content-Type: application/json');

require_once "link.php";
$stmt = $link->prepare("SELECT * FROM recipe WHERE id = ? ");
$stmt->bind_param("i",$_POST['id'] );
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $row['count'] + 1;
$rating = ($row['rating'] * $row['count'] + $_POST['rate'] )/($count);
$stmt = $link->prepare("UPDATE recipe SET rating = ?, count = ? WHERE id =?");
$stmt->bind_param('dii',$rating, $count, $_POST['id'] );
$result = $stmt->execute();
    $return = array(
    'message' => "success"
    );   
$stmt->close();

echo (json_encode($return));






?>
