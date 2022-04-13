<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="public\css\style.css"/>
        <title>Espace personnel</title>
    </head>

    <body>
        <div id="main_wrapper">
            <header>
                <div class="Logo">
                    <img src="public\img\logo_1.png" alt="Logo">
                </div>

                <div class="Name_Page">
                    <h1>Espace d'hébergement</h1>
                </div>

                <div class="Account">
                    <div class="nameUser">
                        <h1> <?= $_SESSION['Name'].' '.$_SESSION['First_Name'] ?> </h1>
                    </div>

                    <img src="public\img\User.png" alt="User Logo">
                </div>

                <div class="Logout">
                    <a href="index.php?action=Logout">
                        <img src="public\img\Power_Off.png" alt="Logout Logo" title="Logout"/>
                    </a>
                </div>
            </header>

            <div class="File_Menu">
            </div>

            <div class="Info">
                <p>
                    FTP : ftp.herberge9.lan</br>
                    Nom utilsateur : <?=$_SESSION['Pseudo']?>
                </p>

                <form method="post" action="index.php?action=Change_Password" id="">
                    <label for="Change_Password" class="file-label">Change Password</label>
                    <input type="text" class="file-control" id="file-input" name="Change_Password"/>

                    <button type="submit" class="">Envoyer</button>
                </form>

                <a href="index.php?action=Delete_account">Supprimer le compte</a>
            </div>

            <div class="Storage">
                <ul>
                    <?php 
                        if(!empty($erreur))
                        {
                            ?>
                            <h2><?=$erreur;?></h2> 
                            <?php
                        }
                        else
                        {
                            
                            if(!empty($folder))
                            {
                                foreach($folder as $lien)
                                {
                                    if(isset($_GET['pathLien']))
                                    {
                                        echo '<li><img src="public\img\Folder_open.png" alt="Folder open"><a href="index.php?action=Space&pathLien='.$_GET['pathLien'].'/'.$lien.'">'.$lien.'</a></li>';
                                    }
                                    else
                                    {
                                        echo '<li><img src="public\img\Folder_open.png" alt="Folder open"><a href="index.php?action=Space&pathLien='.$lien.'">'.$lien.'</a></li>';
                                    }
                                    ?>
                
                                    <?php
                                }
                            }

                            if(!empty($file))
                            {
                                foreach($file as $lien)
                                {
                                    ?>
                                        <li><img src="public\img\File.png" alt="Folder open"><?=$lien;?></li>
                                    <?php
                                }
                            }
                        }
                    ?>
                </ul>
            </div>

            <form action="espace.php" method="POST" enctype="multipart/form-data">
                <label for="file-input" class="file-label"> Fichier à envoyé</label>
                <input type="file" class="file-control" id="file-input" name="File"/>

                <button type="submit" class="">Envoyer</button>
            </form>

            <footer>
            </footer>
        </div>
    </body>
</html>