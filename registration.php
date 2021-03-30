<?php
header('Content-Type: application/json');

if(!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $FName = $_POST["FName"];
    $SName = $_POST["SName"];
    $avatar = $_POST["avatar"];
    $date = $_POST["birthdate"];
    if (!preg_match("/^[a-zA-Z ]*$/",$FName)) {
        $return = array(
            'message' => "name"
         );        
    }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $return = array(
            'message' => "email"
         );   
    }else{
        require_once "link.php";
        $stmt = $link->prepare("INSERT INTO users(email, password, name, surname, url, birthday)
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $email, $pass, $FName, $SName, $avatar, $date);
        /* execute query */
        $stmt->execute();

        /* Get the result */
        $result = $stmt->execute();
            $stmt = $link->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            /* execute query */
            $stmt->execute();

            /* Get the result */
            $result = $stmt->get_result();

            $row = $result->fetch_assoc();

            session_start();
            $_SESSION['user'] = array(
                'id' => $row['id'],
                'name' => $FName,
                'surname' => $SName,
                'img' => $avatar,
                'email' => $email,
                'date' => $date
            );
            $return = array(
            'message' => "success"
            );   
        $stmt->close();
    }
}
else{
    $return = array(
        'errorMessage' => "Registration attempt denied."
    );
    http_response_code(403);
}
echo (json_encode($return));
?>