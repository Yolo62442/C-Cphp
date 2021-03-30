
<body>
    <header > 
        <nav>	
            <a class="logo" href="index.php"><img class="logo" src="logo.png" alt="logo" title="" height="50px" width="50px" /></a>	
           <ul class="nav__links" >
                <li ><a href="index.php">Home</a></li>
                <li><a  href="recipe.php?id=14">Recipe of day</a></li>
                <li><a href="Allrecipes.php">All Recipes</a></li>
                <?php if(!empty($_SESSION['user']['id'])): ?>
                    <li><a href="Mypage.php">My page</a></li>  
                <?php else: ?>
                    <li><a href="login.php">My page</a></li>
                <?php endif; ?>
                <?php if(!empty($_SESSION['user']['id'])): ?>
                    <li><a href="signout.php"><button type="button" >Sign out</button></a></li> 
                <?php else: ?>
                    <li><a href="login.php"><button type="button" >Log in</button></a></li>
                <?php endif; ?>
            </ul>  
        </nav>
        <div class="container" >
            
            Whenever we cook, we cook with our heart. <br>
            <hr>
            <h1>Love is the secret ingredient</h1>
            <hr>
            Are you hungry? Here you can find recipes for every situation and for every person
            or the  adresses of different cuisins in your city
        </div>
    </header>
    <main>