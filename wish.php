<?php
session_start();
require_once "link.php";
$stmt = $link->prepare("INSERT INTO wish(recipe_id, user_id) 
                        VALUES(?, ?)");
$stmt->bind_param("ii", $_POST['id'], $_SESSION['user']['id']);
/* execute query */
$stmt->execute();

/* Get the result */
$result = $stmt->get_result();
$return = array(
    'message' => "success"
    );   
$stmt->close();
echo (json_encode($return));
?>