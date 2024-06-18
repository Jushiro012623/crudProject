<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'crudtest'
    );
    if(!$conn){
        die('Error'. mysqli_connect_error());
    }
    
    date_default_timezone_set('Asia/Manila');
    // else{
    //     echo 'Connection Success';
    // }

?>