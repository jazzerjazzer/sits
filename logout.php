<?php

    function deleteSessionIfExists() 
    {
        if (session_id() != "")
         {
            $_SESSION = array();
            session_unset();
            session_destroy();
        }
    }

    session_start();

    deleteSessionIfExists();

    header('location:login.php');

    // redirect to index page of website
?>