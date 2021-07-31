<?php

    //model class for city table
    class City{

        private $conn = null;
        private $table = "city_tbl";
        private $relTable = "state_tbl";

        //table fileds
        public $cityId;
        public $stateId;
        public $cityName;
        
        public function __construct($db){

            $this->conn = $db;
           
        }

        //TODO :read city by state from database
        public function readByState(){

            $readSql = "SELECT c.*
                    FROM ". $this->table ." c LEFT JOIN ". $this->relTable ." s ON c.state_id = s.state_id
                    WHERE c.state_id  = :stateId";

            $stmt = $this->conn->prepare($readSql);
            $stmt->bindParam(":stateId", $this->stateId);

            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            return $stmt;
        }

    }
?>  
