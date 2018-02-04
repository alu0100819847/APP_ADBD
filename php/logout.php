<?php
session_start();
        $_SESSION['USER'] = "";
        header('Refresh: 0; URL= ../index.html');
?>
