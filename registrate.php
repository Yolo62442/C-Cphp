<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    return;
}  
?>
<!Doctype html>
<html>
<head>
<title> Registration </title>
<link rel="stylesheet" href="Login.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#exampleInputEmail2").keyup(function(){
                event.preventDefault();
                $.ajax('check.php', {
                    type: 'POST',  // http method
                    data: { email: $( "#exampleInputEmail2" ).val()},
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        if (data.message == 'true') {
                            $("#check").text("Account is not reserved");
                            $("#check").css({"color": "green"});
                        }else if (data.message == 'false') {
                            $("#check").text("Account is reserved");
                            $("#check").css({"color": "red"});
                        }else if(data.message == 'none'){
                            $("#check").text("Loading");
                            $("#check").css({"color": "grey"});
                        }
                    },
                    error: function (errorData, textStatus, errorMessage) {
                        var msg = (errorData.responseJSON != null) ? errorData.responseJSON.errorMessage : '';
                        $("#errormsg1").text('Error: ' + msg + ', ' + errorData.status);

                        $("#errormsg1").show();
                    }
                  
                });
            });
            $("#registrate").click(function(){
                event.preventDefault();
                $.ajax('registration.php', {
                    type: 'POST',  // http method
                    data: { email: $( "#exampleInputEmail2" ).val(),
                        password:  $( "#exampleInputPassword2" ).val(),
                        FName: $( "#exampleInputFName1" ).val(),
                        SName: $( "#exampleInputSName1" ).val(),
                        avatar: $( "#exampleInputAvatar" ).val(),
                        birthdate: $( "#exampleInputBirthdate" ).val()},  // data to submit
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        if (data.message == 'success') {
                            alert("Registration is successful");
                            window.location.href = "index.php";
                        }else if (data.message == 'name'){
                            $("#check1").text("Only Letters are available");
                            $("#check1").css({"color": "red"});
                        }else if (data.message == 'email'){
                            $("#check").text("Invalid email format");
                            $("#check").css({"color": "red"});
                        }else{
                            $("#errormsg1").text('Error: ' + data.message);
                        }
                    },
                    error: function (errorData, textStatus, errorMessage) {
                        var msg = (errorData.responseJSON != null) ? errorData.responseJSON.errorMessage : '';
                        $("#errormsg1").text('Error: ' + msg + ', ' + errorData.status);

                        $("#errormsg1").show();
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
            <p class="p">
                Here you can find recipes for every situation and also share your own 
            </p>
        </div>
        <div class="cl4">
            <div class="col-md-8">
                <form>
                    <span class="error text-danger" id="errormsg1" style="display: none"></span>
                    <h1>Registration</h1>
                    <div class="form-group">
                    <div  id="check" ></div>
                        <span id="check"></span>
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                    <span id="check1"></span>
                        <label for="exampleInputFName1">First Name</label>
                        <input type="text" class="form-control" id="exampleInputFName1" placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputSName1">Second Name</label>
                        <input type="text" class="form-control" id="exampleInputSName1" placeholder="Enter Second Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword2">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAvatar">URL Avatar</label>
                        <input type="url" class="form-control" id="exampleInputAvatar"  placeholder="avatar">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputBirthdate">Birthdate</label>
                        <input type="date" class="form-control" id="exampleInputBirthdate">
                    </div>
                    <button type="submit" class="btn btn-primary1" style="background-color:green; border-color:green; color:white;" id="registrate">Registrate</button>
                    <a href="login.php">Sign in</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>