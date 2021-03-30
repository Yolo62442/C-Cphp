<?php
 session_start();
 if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    return;
}
header('Content-Type: application/json');
 require_once "link.php";
    $stmt = $link->prepare("INSERT INTO recipe(title, step1, step2, step3, type, user_id)
    VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $_POST['title'], $_POST['step1'], $_POST['step2'], $_POST['step3'], $_POST['type'], $_SESSION['user']['id']);
    $stmt->execute();
    $result = $stmt->execute();
    $stmt = $link->prepare("SELECT id FROM recipe ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $arr = [
         1 =>['name' => $_POST['in1Name'], 'q' => $_POST['in1quant']],
         2 =>['name' => $_POST['in2Name'], 'q' => $_POST['in2quant']],
         3 =>['name' => $_POST['in3Name'], 'q' => $_POST['in3quant']],
         4 =>['name' => $_POST['in4Name'], 'q' => $_POST['in4quant']],
         5 =>['name' => $_POST['in5Name'], 'q' => $_POST['in5quant']],
        ];
        for($i = 1; $i < 6; $i++){
            $stmt = $link->prepare("INSERT INTO ingridients(ingrid_name, quantity, recipe_id)
            VALUES (?,?,?)");
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
    
    
