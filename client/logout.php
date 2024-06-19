<?php
    session_start();
    session_destroy();
    header('Location: /crudapp/client/index.php');
    exit();
?>