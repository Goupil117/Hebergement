<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="public\css\style.css"/>
        <title>Connexion</title>
    </head>

    <body>
        <form method="post" action="index.php?action=Connection" id="Connexion">
            <div class="formContainer">

                <div class="sliderSection">
                    <img src="public\img\logo_1.png" alt="Logo">
                </div>
    
                <div class="formSection">
    
                    <h1>Connexion</h1>
    
                    <div class="inputRow">
                        <div class="inputIcon">
                            <img src="public\img\User.png" alt="User_logo">
                        </div>
    
                        <input type="email" name="Email" id="Email" placeholder="Email" maxlength="30" required>
                    </div>
    
                    <div class="inputRow">
                        <div class="inputIcon">
                            <img src="public\img\Lock.png" alt="Lock_logo">
                        </div>
    
                        <input type="password" name="Password" id="Password" placeholder="Password" maxlength="30" required>
                    </div>
    
                    <div class="row">
                        <div class="col">
                            <input type="checkbox" name="RemenberMe" id="RemenberMe">
                            <label for="RemenberMe">Remenber me</label>
                        </div>
    
                        <a href="#" id="forgotPassword">Forgot Password</a>
                    </div>
    
                    <div class="btnRow">
                        <input type="submit" value="Login" class="btn" id="loginBtn">
                    </div>
    
                    <div class="btnRow">
                        <a href="index.php?action=Inscription" id="signBtn" class="btn">Sign</a>
                    </div>

                    <?php 
                        if(!empty($erreur))
                        {
                            ?> 
                            <h2>
                                <?=$erreur; ?>
                            </h2> 
                            <?php
                        }
                    ?>
                </div>
            </div>
        </form>
    </body>
</html>