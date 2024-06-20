<?php

    $postErr = '';
    //USER POST POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['post'])){
        $post = mysqli_real_escape_string($conn, $_POST['status']);
        $postID = $_SESSION['id'];
        $poster = $_SESSION['username'];
        if(!empty($post)){
            $query = "INSERT INTO `post`(`body`,`poster`,`account_id`, `status`) VALUES ('$post','$poster', '$postID', 'active')";
            $result = mysqli_query($conn, $query);
        }else{
            $postErr = 'Post something';
        }
    }

    //ARCHIVE POST
    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['delete'])){
        $postid = $_POST['postid'];
        $query = "UPDATE `post` SET `status` = 'archive' WHERE `id` = $postid ";
        $result = mysqli_query($conn, $query);
    }

    //PERMANENT DELETE POST
    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['permadel'])){
        $postid = $_POST['postid'];
        $query = "DELETE FROM `post` WHERE `id` = $postid ";
        $result = mysqli_query($conn, $query);
        unset($_SESSION['body']);
        unset($_SESSION['postid']);
    }
     //RETRIEVE ARCHIVED POST
     if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['undo'])){
        $postid = $_POST['postid'];
        $query = "UPDATE `post` SET `status` = 'active' WHERE `id` = $postid ";
        $result = mysqli_query($conn, $query);
        unset($_SESSION['body']);
        unset($_SESSION['postid']);
        header('Location: /crudapp/client/home.php');
    }
    //EDIT POST
    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['edit'])){
        $postid = $_POST['postid'];

        $query = "SELECT * FROM `post` WHERE `id` = $postid ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)){
           $_SESSION['postid'] = $row['id'];
           $_SESSION['body'] = $row['body'];
        }else{
            $_SESSION['postid'] = '';
        }
        header('Location: /crudapp/client/editpost.php');
    }
    
    //UPDATE POST
    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['save'])){     
        $editstatus = $_POST['editstatus'];
        $query = "UPDATE `post` SET `body` = '$editstatus' WHERE `id` = $post ";
        $result = mysqli_query($conn, $query);
        $body =$editstatus;
        header('Location: /crudapp/client/home.php');
    }

    //CANCEL EDIT
    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['cancel'])){     
        
        unset($_SESSION['postid']);
        header('Location: /crudapp/client/home.php');
    }
?>