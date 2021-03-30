<?php

header('Content-Type: application/json');

if(!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    require_once "link.php";

    $stmt = $link->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $pass);
    /* execute query */
    $stmt->execute();

    /* Get the result */
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    if ($row != null && $row['email'] != null) {
        session_start();
        $_SESSION['user'] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'surname' => $row['surname'],
            'email' => $row['email'],
            'avatar' => $row['url'],
            'date' => $row['birthday']
        );

        $return = array(
            'message' => "success"
        );
    } else {
        $return = array(
            'errorMessage' => "Incorrect login or/and password!"
        );
        http_response_code(401);
    }

    $stmt->close();
}
else{
    $return = array(
        'errorMessage' => "Login attempt denied."
    );
    http_response_code(403);
}
echo (json_encode($return));