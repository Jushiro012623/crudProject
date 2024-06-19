<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION['id']) AND !isset($_SESSION['username']) AND  !isset($_SESSION['email'])){
    header('Location: /crudapp/client/index.php');
    exit;
}
?>