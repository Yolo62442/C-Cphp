<?php
 header('Content-Type: application/json');
     require_once "link.php";
    $stmt = $link->prepare("SELECT * FROM recipe WHERE title LIKE'%".$_POST["search"]."%'");
   
    $stmt->execute();

    /* Get the result */
    $result = $stmt->get_result();

    $row = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

echo (json_encode($row));
 
?>