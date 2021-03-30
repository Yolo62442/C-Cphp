<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    return;
}
require_once "link.php";
$stmt = $link->prepare("SELECT * FROM recipe where show_id = 1 ");
/* execute query */
$stmt->execute();

/* Get the result */
$result = $stmt->get_result();
$recipes = $result->fetch_all(MYSQLI_ASSOC);
?>
<!Doctype html>

<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title> Welcome </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Allrecipes.css" >
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#feed").click(function(){
                event.preventDefault();
                $.ajax('send.php', {
                    type: 'POST',  // http method
                    data: { email: $( "#email" ).val(),
                        content:  $( "#content" ).val() },  // data to submit
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        if (data.message == 'success') {
                           alert("Thank you for feedback");
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
        $(document).ready(function() {
             $('#search').change(function(){
                 var txt = $(this).val();
                 if(txt != ''){
                    $.ajax('search.php', {
                    type: 'POST',  // http method
                    data: { search: txt},  // data to submit
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        $('#result').empty;
                        var res = data;
                        for(let i = 0; i < res.length; i++){
                            $('#result').append( 
                                '<div class="grid">\n' + 
                                '<div>\n' +
                                    '<img src="welcome.jpg" alt="Welcome" width="100px" height="100px">\n' +
                                '</div>\n' +
                                '<div>\n' +
                                    '<a href="recipe.php?id=' + res[i].id + '" style="text-decoration:none;">' + res[i].title +  '</a>\n' +
                                    '<p>' + res[i].type + '</p>\n' + 
                                '</div>/n' + 
                            '</div>'     
                            );
                        }
                    }
                
                 });
                }else{
                     $('#result').html('');
                 }
             });
        });
    </script>
</head>
<?php require "header.php"?>
<h1 class ="f1">All Recipes</h1>
<div class="grid">
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search" id="search" aria-label="Recipient's username">
  </div>
  </div>
  <div id = "result"></div>
        <?php foreach($recipes as $recipe):?>
            <div class="grid">
            <div>
                <img src="welcome.jpg" alt="Welcome" width="100px" height="100px">
            </div>
            <div>
                <a href="recipe.php?id=<?=$recipe['id'];?>" style="text-decoration:none;"> <?=$recipe['title']?></a>
                <p> <?=$recipe['type']?></p>
            </div>
        </div>
            <?php endforeach; ?>    
        <?php
require 'footer.php';
?>
