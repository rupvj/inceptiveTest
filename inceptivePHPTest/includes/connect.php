<?php

//using PDO
try{                                                        

    $dsn       = "mysql:host=localhost;dbname=inceptive_db";
    $useruname = 'root';
    $password  = '';
    
    $con = new PDO($dsn,$useruname,$password);
    }catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
    }

?>