<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

    require_once('model/Modele_Connexion&Inscription.php');
    require_once('model/Modele_Storage&management.php');

    function Connection_Control($Email, $Password)
    {
        if(Connection($Email, $Password) == TRUE)
        {
            /* Enregistrement de donnée sur la session */
            $_SESSION['Email'] = $Email;
            $_SESSION['Password'] = $Password;

            $Profile= Get_Profile($Email, $Password);

            if(!empty($Profile))
            {
                foreach($Profile as $Profile)
                {
                    $_SESSION['Name'] = $Profile['Nom'];
                    $_SESSION['First_Name'] = $Profile['Prenom'];
                    $_SESSION['Pseudo'] = $Profile['Pseudo'];
                }

                header('Location:index.php?action=Space');

                /*
                if(!Storage_Space_Check($_SESSION['Name'],$_SESSION['First_Name']))
                {
                    header('Location:index.php?action=Space');
                }
                else
                {
                    Create_Storage_Space();
                    header('Location:index.php?action=Space');
                }
                */
            }
            else
            {
                throw new Exception('First or last name not found');
            }
        }
        else
        {
            $erreur = "Identifiant ou mot de passe incorrecte !";
            require('view/Connection.php');
        }
    }

    function Inscription_Control($Name, $First_Name, $Email, $Password, $Pseudo)
    {
        if(Inscription_Check($Email, $Pseudo) == TRUE)
        {
            Inscription_insertion($Name, $First_Name, $Email, $Password, $Pseudo);

            shell_exec('creerUser.sh '.$Pseudo.' '.$Password);

            /* Enregistrement de donnée sur la session */
            $_SESSION['Email'] = $Email;
            $_SESSION['Password'] = $Password;
            $_SESSION['Name'] = $Name;
            $_SESSION['First_Name'] = $First_Name;
            $_SESSION['Pseudo'] = $Pseudo;

            /* Script shell */
            //shell_exec('');

            /* Création de l'espace de stockage*/
           /* Create_Storage_Space();*/

            header('Location:index.php?action=Space');
        }
        else
        {
            $erreur = "Email déjà existant";
            require('view/Inscription.php');
        }
    }

    function Connection_Page()
    {
        require('view/Connection.php');
    }

    function Inscription_Page()
    {
        require('view/Inscription.php');
    }

    function Logout()
    {
        session_destroy();
        header('Location:index.php');
    }

    function Delete_account_Control()
    {
        Delete_account();
        session_destroy();
        header('Location:index.php');
    }

    function Change_Password_Control($Password)
    {
        Change_Password($Password);
        Logout();
    }

    function Space_Control()
    {
        if(isset($_SESSION['Email']) && isset($_SESSION['Password']))
        {
            /* Création du chemin */
            $path = "Data/".$_SESSION['Name'].$_SESSION['First_Name'];

            /* Ouverture du dossier concerner */
            $folder = array();
            $file = array();

            //$dir = opendir($path);
/*
            while(($element = readdir($dir)) !== false)
            {
                if($element !='.' && $element != '..')
                {
                    if(!is_dir($path.'/'.$element))
                    {
                        $file[] = $element;
                    }
                    else
                    {
                        $folder[] = $element;
                    }
                }
            }

            closedir($dir);
            */

            require('view/Space.php');     
        }
        else
        {
            header('Location:index.php?action=Connection');
        }
    }

    function Space_Control_Folder($path_lien)
    {
        if(isset($_SESSION['Email']) && isset($_SESSION['Password']))
        {
            /* Création du chemin */
            $path = "Data/".$_SESSION['Name'].$_SESSION['First_Name']."/".$path_lien;

            /* Ouverture du dossier concerner */
            $folder = array();
            $file = array();

            
                if($dir = opendir($path))
                {
                    while(($element = readdir($dir)) !== false)
                    {
                        if($element !='.' && $element != '..')
                        {
                            if(!is_dir($path.'/'.$element))
                            {
                                $file[] = $element;
                            }
                            else
                            {
                                $folder[] = $element;
                            }
                        }
                    }

                    closedir($dir);
                }
            require('view/Space.php');     
        }
        else
        {
            header('Location:index.php?action=Connection');
        }
    }