<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

    function DB_Connect()
    {
        try
        {
            $mysqlClient = new PDO('mysql:host=172.31.0.56;dbname=hb;charset=utf8','root','root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return $mysqlClient;
        }
        catch(Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }
    }

    function Connection($Email, $Password) : bool
    {
        $DB = DB_Connect();

        /* Vérification de l'email et du mot de passe */
        $request = $DB->prepare("SELECT Email, Password FROM user WHERE Email = :email AND Password = :password");
        $request->execute(['email'=>$Email, 'password'=>$Password]);
        $response = $request->fetchAll();

        if(count($response) > 0)
        {
            $request->closeCursor();
            return TRUE;
        }
        else
        {
            $request->closeCursor();
            return FALSE;
        }
    }

    function Inscription_Check($Email, $Pseudo) : bool
    {
        $DB = DB_Connect();

        /* Vérification de doublon */
        $request = $DB->prepare("SELECT Email, Pseudo FROM user WHERE Email = :email AND Pseudo =:pseudo");
        $request->execute(['email'=>$Email, 'pseudo'=>$Pseudo]);
        $response = $request->fetchAll();

        if(count($response) < 1)
        {
            $request->closeCursor();
            return TRUE;
        }
        else
        {
            $request->closeCursor();
            return FALSE;
        }
    }

    function Inscription_insertion($Name, $First_Name, $Email, $Password, $Pseudo)
    {
        $DB = DB_Connect();

        /* Insertion dans la base de donnée */
        $request = $DB->prepare("INSERT INTO user(Nom, Prenom, Email, Password, Pseudo) VALUE(:nom, :prenom, :email, :password, :pseudo)");
        $request->execute(['nom'=>$Name, 'prenom'=>$First_Name, 'email'=>$Email, 'password'=>$Password, 'pseudo'=>$Pseudo]);

        $request->closeCursor();
    }



    function Get_Profile($Email, $Password)
    {
        $DB = DB_Connect();

        $request = $DB->prepare("SELECT Nom, Prenom, Pseudo FROM user WHERE Email = :email AND Password = :password");
        $request->execute(['email'=>$Email, 'password'=>$Password]);
        $response = $request->fetchAll();

        $request->closeCursor();
        return $response;
    }

    function Change_Password($Password)
    {
        $DB = DB_Connect();

        $request = $DB->prepare("UPDATE user SET Password = :password WHERE Pseudo = :pseudo");
        $request->execute(['password'=>$Password, 'pseudo'=>$_SESSION['Pseudo']]);

        $request->closeCursor();
    }

    function Delete_account()
    {
        $DB = DB_Connect();

        $request = $DB->prepare("DELETE FROM user WHERE Pseudo = :pseudo");
        $request->execute(['pseudo'=>$_SESSION['Pseudo']]);

        $request->closeCursor();
    }

    /* GLPI */

    function SERVER_Inscription_insertion($Name, $First_Name, $Email, $Password, $Pseudo)
    {
        $DB = SERVER_DB_Connect();

        /* Insertion dans la base de donnée */
        $request = $DB->prepare("INSERT INTO glpi_users(Nom, Prenom, Email, Password, is_active, authtype) VALUE(:nom, :prenom, :email, :password, 1, 1)");
        $request->execute(['nom'=>$Name, 'prenom'=>$First_Name, 'email'=>$Email, 'password'=>$Password]);

        $request = $DB->prepare("SELECT ID FROM glpi_users WHERE Pseudo = :pseudo");
        $request->execute(['pseudo'=>$Pseudo]);

        $request->closeCursor();
    }

    function SERVER_DB_Connect()
    {
        try
        {
            $sqlClient = new PDO('mysql:host=172.31.0.56;dbname=hb;charset=utf8','glpi','glpi', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return $sqlClient;
        }
        catch(Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }
    }