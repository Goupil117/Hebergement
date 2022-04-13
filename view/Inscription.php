<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="public\css\style.css"/>
        <title></title>
    </head>

    <body>
        <form method="post" action="index.php?action=Inscription" id="Inscription">
            <div class="formContainer">

                <div class="sliderSection">
                    <img src="public\img\logo_1.png" alt="Logo">
                </div>
    
                <div class="formSection">
    
                    <h1>Inscription</h1>

                    <div class="inputRow">
                        <div class="inputIcon">
                            <img src="public\img\User.png" alt="User_logo">
                        </div>
    
                        <input type="text" name="Name" id="Nom" placeholder="Nom" maxlength="30" required>
                    </div>

                    <div class="inputRow">
                        <div class="inputIcon">
                            <img src="public\img\User.png" alt="User_logo">
                        </div>
    
                        <input type="text" name="First_Name" id="Prenom" placeholder="Prenom" maxlength="30" required>
                    </div>
    
                    <div class="inputRow">
                        <div class="inputIcon">
                            <img src="public\img\Email.png" alt="User_logo">
                        </div>
    
                        <input type="email" name="Email" id="Email" placeholder="Email" maxlength="30" required>
                    </div>
    
                    <div class="inputRow">
                        <div class="inputIcon">
                            <img src="public\img\Lock.png" alt="Lock_logo">
                        </div>
    
                        <input type="password" name="Password" id="Password" placeholder="Password" maxlength="30" required>
                    </div>

                    <div class="inputRow">
                        <div class="inputIcon">
                            <img src="public\img\User.png" alt="User_logo">
                        </div>
    
                        <input type="text" name="Pseudo" id="Pseudo" placeholder="Pseudo" maxlength="30" required>
                    </div>

                    <div class="btnRow">
                        <input type="submit" name="inscriptionV" value="Sign on" class="btn" id="sign_onBtn">
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