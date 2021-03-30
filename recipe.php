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
$recipe = new Recipe($row['id'], $row['title'],$row['step1'],$row['step2'],$row['step3'],$row['type'], $row['user_id'], $row['rating']);
$stmt = $link->prepare("SELECT * FROM ingridients WHERE recipe_id = ? ");
$id =$recipe->getId();
$stmt->bind_param("i", $id);
/* execute query */
$stmt->execute();

/* Get the result */
$result = $stmt->get_result();
$ingrids = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JSON Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="homepage1.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
            <link rel="stylesheet" href="recipe5.css" >
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
            $("#delete").click(function(){
                event.preventDefault();
                $.ajax('delete.php', {
                    type: 'POST',  // http method
                    data: { id: <?php echo $recipe->getId()?> },  // data to submit
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
            $(".fa").click(function(){
                event.preventDefault();
                var th = this.id;
                if (th == 6){
                    $.ajax('wish.php', {
                    type: 'POST',  // http method
                    data: { id: <?php echo $recipe->getId()?> },  // data to submit
                    accepts: 'application/json; charset=utf-8',
                    success: function (data) {
                        if (data.message == 'success') {
                            alert("Added to wish list");
                        }
                    },
                    error: function (errorData, textStatus, errorMessage) {
                        var msg = (errorData.responseJSON != null) ? errorData.responseJSON.errorMessage : '';
                        $("#errormsg1").text('Error: ' + msg + ', ' + errorData.status);

                        $("#errormsg1").show();
                    }
                });
                }else{
                    $.ajax('rate.php', {
                        type: 'POST',  // http method
                        data: { id: <?php echo $recipe->getId()?> ,
                            rate: $(this).data('rating') },  // data to submit
                        accepts: 'application/json; charset=utf-8',
                        success: function (data) {
                            if (data.message == 'success') {
                                $("#3").prop('disabled', false);
                            }
                        },
                        error: function (errorData, textStatus, errorMessage) {
                            var msg = (errorData.responseJSON != null) ? errorData.responseJSON.errorMessage : '';
                            $("#errormsg1").text('Error: ' + msg + ', ' + errorData.status);

                            $("#errormsg1").show();
                        }
                    });
                }
            })
            
        });
            </script>
</head>
<?php require "header.php";?>
<?php if($recipe===null): ?>
 <h2>No recipe has been found</h2>
<?php else:?>
    <div class="grid">
                <div>
                    <h2 id="title"><?= $recipe->getTitle();?></h2>
                    <br>
                    <span>
                        <button class="fa fa-star " id="1" data-rating="1" onclick="set(1)"></button>
                        <button class="fa fa-star " id="2" data-rating="2" onclick="set(2)"></button>
                        <button class="fa fa-star " id="3" data-rating="3" onclick="set(3)"></button>
                        <button class="fa fa-star " id="4" data-rating="4" onclick="set(4)"></button>
                        <button class="fa fa-star " id="5" data-rating="5" onclick="set(5)"></button>
                        <br>
                        <br>
                        <div><button class="fa fa-heart " id="6" onclick="set(6)" ></button></div>
                        
                    </span>
                    <div>Rating:<?= $recipe->getRating()?></div>
                    
                    <div class="grid1">
                        <div>
                            <h2>12</h2> 
                            ingridients
                        </div>
                        <div>
                            <h2>40</h2> 
                            minutes
                        </div>
                        <div>
                            <h2>270</h2> 
                            calories
                        </div>
                    </div>
                    <p>Vegetarianism is the practice of abstaining from the consumption of meat (red meat, poultry, seafood, and 
                        the flesh of any other animal), and may also include abstention from by-products of animal slaughter.
                        Vegetarianism may be <span id="dots">...</span><span id="more"> 
                            adopted for various reasons. Many people object to eating meat out of respect for sentient life. Such ethical 
                            motivations have been codified under various religious beliefs, as well as animal rights advocacy. Other 
                            motivations for vegetarianism are health-related, political, environmental, cultural, aesthetic, economic, or 
                            personal preference. There are variations of the diet as well: an ovo-lacto vegetarian diet includes both eggs 
                            and dairy products, an ovo-vegetarian diet includes eggs but not dairy products, and a lacto-vegetarian diet 
                            includes dairy products but not eggs. A strict vegetarian diet – referred to as vegan – excludes all animal products, 
                            including eggs and dairy.</span></p>
                        <button onclick="myFunction()" id="myBtn" class="btn btn-big">Read more</button>
                </div>
                <div>
                    <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/warm-roasted-cauliflower-and-spinach-salad-wd-0220-1578088222.jpg?crop=0.712xw:0.475xh;0.193xw,0.426xh&resize=980:*" alt="pizza">
                </div>
            </div>
            <div style="background-color: wheat; width: 100%;">
            <h1 style="text-align: center;">Ingredients</h1>
            <div class="grid">
                <div>
                    <ul>
                        <?php foreach($ingrids as $ingrid):?>
                        <li>
                        <p><?=$ingrid['ingrid_name'];?>, <?=$ingrid['quantity'];?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <ul>
                        <?php foreach($ingrids as $ingrid):?>
                        <li>
                        <p><?=$ingrid['ingrid_name'];?>, <?=$ingrid['quantity'];?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
            <h1 style="text-align: center;">Preparation</h1>
            <div class="grid">
                <div>
                    <h1>Step 1</h1>
                    <p><?= $recipe->getStep1();?></p>
                </div>
                <div>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSGTZWLUuHQ2w2ZV4gY75qiAT2k1ujod6sYCOfzcFPDYQRwQUYP" alt="st1">
                </div>
            </div>
            <div class="grid">
                <div>
                    <img src="https://media.arkansasonline.com/img/photos/2020/03/04/194328769_ONE-POT-SEAFOOD-5-5_t800.jpg?90232451fbcadccc64a17de7521d859a8f88077d" alt="st2">
                </div>
                <div>
                    <h1>Step 2</h1>
                    <p><?= $recipe->getStep2();?></p>
                </div>
            </div>
            <div class="grid">
                <div>
                    <h1>Step 3</h1>
                    <p><?= $recipe->getStep3();?> </p>
                </div>
                <div>
                    <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/warm-roasted-cauliflower-and-spinach-salad-wd-0220-1578088222.jpg?crop=1.00xw:0.334xh;0,0.144xh&resize=1200:*" alt="st3">
                </div>
            </div>
                <?php if ($_SESSION['user']['id'] == $recipe->getUserId()):?>
                    <form action="">
                <button class="bb"><a href="editrecipe.php?id=<?=$recipe->getId();?>">Edit</a></button><br>
                        <button class="bb" id="delete">DELETE</button></form>
                <?php endif;?>
            <div class="tutorial">
                <h1>Here you can find online tutorial!</h1>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/yc8nkYgA4AM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
    
  
<?php endif;
    require 'footer.php';?>
