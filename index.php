<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

    require_once('controller/Controller_Connexion&Inscription.php');

    /*  Routeur  */
    try
    {
        /*  Choix de route  */
        if(isset($_GET['action']))
        {
            switch($_GET['action'])
            {
                /*  Route pour la page de connection  */
                case 'Connection':
                    if(!isset($_POST['Email']) && !isset($_POST['Password']))
                    {
                        Connection_Page();
                    }
                    else
                    {
                        Connection_Control($_POST['Email'], $_POST['Password']);
                    }
                    break;
            
                /*  Route pour la page de d'inscription  */
                case 'Inscription':
                    if(!isset($_POST['Name']) && !isset($_POST['First_Name']) && !isset($_POST['Email']) && !isset($_POST['Password']) && !isset($_POST['Pseudo']))
                    {
                        Inscription_Page();
                    }
                    else
                    {
                        Inscription_Control($_POST['Name'], $_POST['First_Name'], $_POST['Email'], $_POST['Password'], $_POST['Pseudo']);
                    }
                    break;
            
                case 'Logout':
                    Logout();
                    break;

                case 'Change_Password':
                    if(isset($_POST['Change_Password']))
                    {
                        Change_Password_Control($_POST['Change_Password']);
                    }
                    break;

                case 'Delete_account':
                    Delete_account_Control();
                    break;

                /*  Route pour la page de Space  */
                case 'Space':
                    if(!isset($_SESSION['Email']) && !isset($_SESSION['Password']))
                    {
                        Connection_Page();
                    }
                    else
                    {
                        Space_Control();
                     /*   if(!isset($_GET['pathLien']))
                        {
                            Space_Control();
                        }
                        else
                        {
                            Space_Control_Folder($_GET['pathLien']);
                        }*/
                    }
                    break;
            }
        }
        /*  Route par defaut  */
        else
        {
            Connection_Page();
        }
    }
    catch(Exception $e)
    {
        echo 'Erreur : '.$e->getMessage();
    }

