<?php
    if(!isset($_SESSION['id']) AND !isset($_SESSION['username']) AND  !isset($_SESSION['email'])){
        header('Location: /crudapp/client/index.php');
        exit;
    }   
?>