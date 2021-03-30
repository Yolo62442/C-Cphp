<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        return;
    }
    require_once "link.php";
    require "recipeClass.php";
    $stmt = $link->prepare("SELECT * FROM recipe WHERE id = ? ");
    $stmt->bind_param("i", $_GET['id']);
    /* execute query */
    $stmt->execute();

    /* Get the result */
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $recipe = new Recipe($row['id'],$row['title'],$row['step1'],$row['step2'],$row['step3'],$row['type'],$row['user_id'], $row['rating']);
    $stmt = $link->prepare("SELECT * FROM ingridients WHERE recipe_id = ? ");
    $id =$recipe->getId();
    $stmt->bind_param("i", $id);
    /* execute query */
    $stmt->execute();

    /* Get the result */
    $result = $stmt->get_result();
    $ingrids = $result->fetch_all();
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
            $( "#title" ).val('<?php echo $recipe->getTitle();?>');
            $( "#step1" ).val('<?php echo $recipe->getStep1();?>');
            $( "#step2" ).val('<?php echo $recipe->getStep2();?>');
            $( "#step3" ).val('<?php echo $recipe->getStep3();?>');
            $( "#in1Name" ).val('<?php echo $ingrids[0][1];?>');
            $( "#in2Name" ).val('<?php echo $ingrids[1][1];?>');
            $( "#in3Name" ).val('<?php echo $ingrids[2][1];?>');
            $( "#in4Name" ).val('<?php echo $ingrids[3][1];?>');
            $( "#in5Name" ).val('<?php echo $ingrids[4][1];?>');
            $( "#in1quant" ).val('<?php echo $ingrids[0][2];?>');
            $( "#in2quant" ).val('<?php echo $ingrids[0][2];?>');
            $( "#in3quant" ).val('<?php echo $ingrids[0][2];?>');
            $( "#in4quant" ).val('<?php echo $ingrids[0][2];?>');
            $( "#in5quant" ).val('<?php echo $ingrids[0][2];?>');
            $("#add").click(function(){
                event.preventDefault();
                $.ajax('edit.php', {
                    type: 'POST',  // http method
                    data: { id: <?php echo $recipe->getId();?>,
                        title: $( "#title" ).val(),
                        step1:  $( "#step1" ).val(),
                        step2: $( "#step2" ).val(),
                        step3: $( "#step3" ).val(),
                        in1Name: $( "#in1Name" ).val(),
                        in2Name: $( "#in2Name" ).val(),
                        in3Name: $( "#in3Name" ).val(),
                        in4Name: $( "#in4Name" ).val(),
                        in5Name: $( "#in5Name" ).val(),
                        in1quant: $( "#in1quant" ).val(),
                        in2quant: $( "#in2quant" ).val(),
                        in3quant: $( "#in3quant" ).val(),
                        in4quant: $( "#in4quant" ).val(),
                        in5quant: $( "#in5quant" ).val(),
                        id1: <?php echo $ingrids[0][0]?>,
                        id2: <?php echo $ingrids[1][0]?>,
                        id3: <?php echo $ingrids[2][0]?>,
                        id4: <?php echo $ingrids[3][0]?>,
                        id5: <?php echo $ingrids[4][0]?>,
                        },  // data to submit
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
    <h1 class="f1">Edit recipe</h1>
    <form action="" method="post">
        <?php
         require 'form.php'?>
        <div class="col-md-2"></div>
        </form>
<?php
require 'footer.php';
?>
     