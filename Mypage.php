<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    return;
}

require_once "link.php";
$stmt = $link->prepare("SELECT * FROM recipe WHERE user_id = ? and show_id = 1");
$stmt->bind_param("i", $_SESSION['user']['id']);
/* execute query */
$stmt->execute();

/* Get the result */
$result = $stmt->get_result();

$recipes = $result->fetch_all(MYSQLI_ASSOC);
$stmt = $link->prepare("SELECT * FROM wish WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user']['id']);
/* execute query */
$stmt->execute();

/* Get the result */
$result = $stmt->get_result();

$rows = $result->fetch_all(MYSQLI_ASSOC);
$array = array();
foreach($rows as $row){
    $stmt = $link->prepare("SELECT * FROM recipe WHERE id = ?");
    $stmt->bind_param("i", $row['recipe_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $recip = $result->fetch_assoc();
    array_push($array, $recip);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JSON Example</title>
    
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
            <link rel="stylesheet" href="Allrecipes.css" >
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
            </script>
</head>
<?php require "header.php";?>
    <div class="gr">
            <div>
                <?php if (!empty($_SESSION['user']['avatar'])):?>
                <img id="photo" src="<?php echo $_SESSION['user']['avatar']?>" width="350px" height="350px">
                <?php else:?>
                <img id="photo" src="welcome.jpg" width="350px" height="350px"  >
                <?php endif;?>
            </div>
            <div class="items1">
                <h1 ><?php echo $_SESSION['user']['name'], " ", $_SESSION['user']['surname'];?></h1>
                <div ><span><?php echo $_SESSION['user']['email']?></span></div><br>
                <div ><span><?php echo $_SESSION['user']['date']?></span></div><br>
                <a href="signout.php" class="btn ">Sign Out</a>
            </div>
    </div>
    <div class="grid">
<div><h1 class ="f1">My Recipe</h1></div>
<div><h1 class ="f1"></h1></div>
</div>
<?php if(empty($recipes)):?>
    <h1>No recipe</h1>
<?php else:?>
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
        <?php endif;?>
        <div class="grid">
            <div><h1 class ="f1">My wishes</h1></div>
            <div><h1 class ="f1"></h1></div>
            </div>
            <?php if(empty($array)):?>
                <h1>No wishes</h1>
            <?php else:?>
        <?php foreach($array as $arr):?>
            <div class="grid">
            <div>
                <img src="welcome.jpg" alt="Welcome" width="100px" height="100px">
            </div>
            <div>
                <a href="recipe.php?id=<?=$arr['id'];?>" style="text-decoration:none;"> <?=$arr['title']?></a>
                <p> <?=$arr['type']?></p>
            </div>
        </div>
            <?php endforeach; ?>    
        <?php endif;?>
        <div>
            <button class="f2"><a href="addrecipes.php" style="text-decoration: none;">Add recipe</a></button>
        </div> 

        <?php require "footer.php";
        ?> 

</body>
</html>
