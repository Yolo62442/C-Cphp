<?php 
    header('Content-Type: application/json');
    require 'link.php';
    
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        $stmt = $link->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        if ($row != null && $row['email'] != null) {
            $res = array("message" => "false");
        } else {
            $res = array("message" => "true");
        }
    } else {
        $res = array("message" => "none");
    }
    echo json_encode($res);
?>
