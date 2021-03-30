<?php
session_start();
header('Content-Type: application/json');
    $email = $_POST["email"];
    $content = $_POST["content"];
   
        require_once "link.php";
        $stmt = $link->prepare("INSERT INTO feedback(email, content)
                                VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $content);
        /* execute query */
        $stmt->execute();

        /* Get the result */
        $result = $stmt->execute();
            
            $return = array(
            'message' => "success"
            );   
        $stmt->close();

echo (json_encode($return));
?>