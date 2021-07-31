<?php
    session_start();

    //import class files
    include("../config/database.php");
    include("../models/user.php");

    //create database object
    $database = new Database;
    $db =  $database->connect();
    
    //Create user model class object
    $user = new User($db);
    

   //5. Insert data into database
   $user->user_fname      = $_POST['user_fname'];
   $user->user_lname      = $_POST['user_lname'];
   $user->user_email      = $_POST['user_email'];
   $user->user_mobile     = $_POST['user_mobile'];
   $user->user_state      = $_POST['user_state'];
   $user->user_city       = $_POST['user_city'];
   $user->user_password   = $_POST['user_password'];

     if($user->register())
    {
        $response = array();
        $_SESSION['username'] = $_POST['user_fname'];
        $response["success"]  = true;
        $response["message"]  = "User Registered Successfully...";
       
        // show products data in json format
        echo json_encode($response);

    }
    else{

        $response = array(
            "success" => false,
            "message" => "Sorry! Failed to registration!"
        );
        // show products data in json format
        echo json_encode($response);
    }