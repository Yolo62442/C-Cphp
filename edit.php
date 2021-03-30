<?php
 session_start();
 if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    return;
}
header('Content-Type: application/json');
 require_once "link.php";
    $stmt = $link->prepare(" UPDATE recipe SET title = ?, step1 =?, step2 =?, step3=? WHERE id = ?");
    $stmt->bind_param("ssssi", $_POST['title'], $_POST['step1'], $_POST['step2'], $_POST['step3'], $_POST['id']);
    $stmt->execute();
    $result = $stmt->execute();
        $arr = [
         1 =>['name' => $_POST['in1Name'], 'q' => $_POST['in1quant'], 'id' => $_POST['id1']],
         2 =>['name' => $_POST['in2Name'], 'q' => $_POST['in2quant'], 'id' => $_POST['id2']],
         3 =>['name' => $_POST['in3Name'], 'q' => $_POST['in3quant'], 'id' => $_POST['id3']],
         4 =>['name' => $_POST['in4Name'], 'q' => $_POST['in4quant'], 'id' => $_POST['id4']],
         5 =>['name' => $_POST['in5Name'], 'q' => $_POST['in5quant'], 'id' => $_POST['id5']],
        ];
        for($i = 1; $i < 6; $i++){
            $stmt = $link->prepare("UPDATE ingridients SET ingrid_name = ?, quantity = ? WHERE id = ?");
            $id = $arr[$i]['id'];
            $name =$arr[$i]['name'];
            $q = $arr[$i]['q'];
            $stmt->bind_param("ssi",$name, $q, $id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
    $return = array(
        'message' => "success"
        );   
    $stmt->close();
    
echo (json_encode($return));
    