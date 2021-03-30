<?php
header('Content-Type: application/json');

        require_once "link.php";
        $stmt = $link->prepare("UPDATE recipe SET show_id = 2 WHERE id =?");
        $stmt->bind_param("s",$_POST['id'] );
        /* execute query */
        $result = $stmt->execute();
            $return = array(
            'message' => "success"
            );   
        $stmt->close();
        
echo (json_encode($return));


 ?>