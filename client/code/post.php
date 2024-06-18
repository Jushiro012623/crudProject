
<?php

    // Register post
    
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $date_time = date("Y/m/d h:i:s");
        if(!empty($username) AND !empty($password) AND !empty($email)){
            if(strlen($username)<8){
                echo 'your username is too short';
            }
            else{
                if($password != $confirm_password){
                    echo 'password don\'t match';
                }else{
                    $query = "SELECT * FROM `user_account` WHERE `username` = '$username' OR `email` = '$email'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);

                    if ($row['username'] == $username){
                        echo 'username is taken';
                    }else if($row['email'] == $email){
                        echo 'email is taken';
                    }else{ 
                        $query = "INSERT INTO user_account (`username`,`password`,`email`,`status`) VALUES ('$username','$password','$email','active')";
                        $result = mysqli_query($conn, $query);
                        echo "registered successfully";     
                        header('Location: /crudapp/client/index.php');
                    }
                }
            }
        }else{
            echo 'all field must be filled';
        }
    }
    
    session_start();
    require('./code/conn.php');

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM `user_account` WHERE `username` = '$username' AND `password` = '$password'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result)){
            
        $row = mysqli_fetch_assoc($result);
        if($row['status'] == 'active'){
            echo 'active ';
            echo 'success';
            $_SESSION['username'] = $row['username'] ;
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['mobile'] = $row['mobile'];
            $_SESSION['bday'] = $row['bday'];

        }else{
            echo 'inactive';
        }
        }else{
            echo 'no users found';
        }
        
    }


    //Profile post 

    if (isset($_POST['edit_profile'])){
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $bday = $_POST['bday'];
        if(strlen($firstname) == 1 AND !empty($firstname) ){
            echo ' invalid firstname';
        }else{
            echo ' valid firstname';
        }
    }
?>