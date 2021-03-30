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
    <link rel="stylesheet" href="homepa.css" >
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

    </script>

</head>
<?php require "header.php"?>


    <main>
        <div class="grid">
            <div>
                <img src="welcome.jpg" alt="Welcome" width="350px" height="350px">
            </div>
            <div class="item1">
                <h2>You're Welcome!</h2>
                Hello my dear friend, I'm happy to see in my site "Chef and Cook"
                That will help you to improve and expand your cooking skills.
                Everyone can cook but not everyone can find the dish that they like to cook.
                <br>
                Also in that period of quarantine time, 
                you can get in the mood by cooking with your lovelies or bring spice to that
                days by tasting several types of food. Stay st home, be safe and well-fed
            </div>
        </div>
    </main>
    <br>
    <div class="cl1">
        <h1 style="text-align: center;">C&C present </h1>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="slide1.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="slide2.jpg" style="width:100%">
        </div>
        
        <div class="mySlides fade">
            <img src="slide3.jpg" style="width:100%">
        </div>
        
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        
        </div>
        <br>
        
        <div style="background-color: thistle; text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span> 
        </div>         
        <script src="homepage.js" ></script>
    </div>
    <div class="grid1">
        <div>
            <button><a href="Recipe-1.html" style="text-decoration: none;">Meat Lover</a></button>
        </div>
        <div>
            <button><a href="Resipe-2.html" style="text-decoration: none;">Vegeterian</a></button>
        </div>
        <div>
            <button><a href="Recipe-4.html" style="text-decoration: none;">Dessert</a></button>
        </div>
        <div>
            <button><a href="Resipe-3.html" style="text-decoration: none;">Sushi</a></button>
        </div>
        <div>
            <img src="meatlover.png" alt="">
        </div>
        <div>
            <img src="vegeterian.png" alt="">
        </div>
        <div>
            <img src="dessert.jpg" alt="">
        </div>
        <div>
            <img src="sushi.jpg" alt="">
        </div>
        <div>
            <p>
            Meat is animal flesh that is eaten as food. Humans have hunted and killed animals for meat since prehistoric times. 
            The advent of civilization allowed the domestication of animals such as chickens, sheep, rabbits, pigs and cattle. 
            This eventually led to their use in meat production on an industrial scale with the aid of slaughterhouses.
            </p>
        </div>
        <div>
            <p>
            Vegetarianism is the practice of abstaining from the consumption of meat (red meat, poultry, seafood, and the flesh of any other animal),
            and may also include abstention from by-products of animal slaughter.
            Vegetarianism may be adopted for various reasons. Many people object to eating meat out of respect for sentient life. 
            Such ethical motivations have been codified under various religious beliefs, as well as animal rights advocacy.
            </p>
        </div>
        <div>
            <p>
            Dessert is a course that concludes a meal. The course usually consists of sweet foods, such as confections, 
            and possibly a beverage such as dessert wine or liqueur; however, in the United States it may include coffee, 
            cheeses, nuts, or other savory items regarded as a separate course elsewhere. In some parts of the world, such as much of 
            central and western Africa, and most parts of China, there is no tradition of a dessert course to conclude a meal.
            </p>
        </div>
        <div>
            <p>
            Sushi is a Japanese dish of prepared vinegared rice, usually with some sugar and salt, accompanying a variety of ingredients 
            , such as seafood, vegetables, and occasionally tropical fruits. Styles of sushi and its presentation vary widely, but the one 
            key ingredient is "sushi rice", also referred to as shari, or sumeshi.
            Sushi is traditionally made with medium-grain white rice, though it can be prepared with brown rice or short-grain rice.
            </p> 
        </div>
    </div>
    <?php
    require "footer.php";
    ?>