<?php

    class Database{

        private $conn;

        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "inceptive_db";

        public function connect()
        {
            try
            {
                $this->conn = new PDO("mysql:host=$this->host; dbname=$this->database",$this->username,$this->password);
            }
            catch(PDOException $ex){
                echo "Error in connecting database : ".$ex->getMessage();
            }

            return $this->conn;
        }
    }