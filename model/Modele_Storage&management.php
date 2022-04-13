<?php

    function Storage_Space_Check($Name, $First_Name):bool
    {
        $path = "Data/".$Name.$First_Name;

        if(!is_dir($path))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    
    function Create_Storage_Space()
    {
        $path = "Data/".$_SESSION['Name'].$_SESSION['First_Name'];

        if(mkdir($path, 0755, true) == FALSE)
        {
            throw new Exception('Unable to create directory');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function test()
    {
        if(isset($_FILES['File']) && $_FILES['File']['error'] == 0)
        {
            if($_FILES['File']['size'] <= 8000000)
            {
                $FILE_INFO = pathinfo($_FILES['File']['name']);
                $FILE_EXTENSION = $FILE_INFO['extension'];
                $EXTENSION_AUTORISER = ['html','css','php','js','jpg','jpeg','gif','png'];
    
                if(in_array($FILE_EXTENSION, $EXTENSION_AUTORISER))
                {
                    move_uploaded_file($_FILES['File']['tmp_name'], 'uploads/'.basename($_FILES['File']['name']));
                }
            }
        }
    }
