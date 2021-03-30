<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        return;
    }
      
   ?>
   <!Doctype html>

<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title> Welcome </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="addrecipes.css" >
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#add").click(function(){
                event.preventDefault();
                $.ajax('add.php', {
                    type: 'POST',  // http method
                    data: { title: $( "#title" ).val(),
                        step1:  $( "#step1" ).val(),
                        step2: $( "#step2" ).val(),
                        step3: $( "#step3" ).val(),
                        type: $( "#type" ).val(),
                        in1Name: $( "#in1Name" ).val(),
                        in2Name: $( "#in2Name" ).val(),
                        in3Name: $( "#in3Name" ).val(),
                        in4Name: $( "#in4Name" ).val(),
                        in5Name: $( "#in5Name" ).val(),
                        in1quant: $( "#in1quant" ).val(),
                        in2quant: $( "#in2quant" ).val(),
                        in3quant: $( "#in3quant" ).val(),
                        in4quant: $( "#in4quant" ).val(),
                        in5quant: $( "#in5quant" ).val(),},  // data to submit
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        if (data.message == 'success') {
                            window.location.href = "Mypage.php";
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
<?php require "header.php"?>
    <h1 class="f1">Add recipe</h1>
    <form action="" method="post">
        <?php
         require 'form.php'?>
        <div class="col-md-2"></div>
        </form>
<?php
require 'footer.php';
?>
     