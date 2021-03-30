<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    return;
}  
?>
<!Doctype html>
<html lang="en">
<head>
<title> Login </title>
<link rel="stylesheet" href="Login.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".button1").click(function(){
                event.preventDefault();
                $.ajax('authorization.php', {
                    type: 'POST',  // http method
                    data: { email: $( "#exampleInputEmail1" ).val(),
                        password:  $( "#exampleInputPassword1" ).val()},  // data to submit
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        if (data.message == 'success') {
                            window.location.href = "index.php";
                        }
                    },
                    error: function (errorData, textStatus, errorMessage) {
                        var msg = (errorData.responseJSON != null) ? errorData.responseJSON.errorMessage : '';
                        $("#errormsg").text('Error: ' + msg + ', ' + errorData.status);

                        $("#errormsg").show();
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div style="width: 100%;">
        <div class="cl1">
            <header>
                <h1 style="color: white;"> C&C</h1>
            </header>
            <p class ="p">
                Here you can find recipes for every situation and also share your own 
            </p>
        </div>
            <div class="class4">
                <header>
                    <a href="registrate.php" >Sign up</a>
                </header>
                <span class="error text-danger" id="errormsg" style="display: none"></span>
                <form action="" method="POST">
                    <div class = "grid">
                        <div class = "class1">Login here</div>
                        <div class = "class2">Username</div>
                        <div class = "class3"><input class="input1" type="text" name="username" id="exampleInputEmail1"  ></div>
                        <div class = "class2">Password</div>
                        <div class = "class3"><input class="input1" type="password" name="password" id="exampleInputPassword1" /></div>
                        <div class = "class2"></div>
                        <div class = "class3">
                            <button class="button1">Login</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>