<?php

    //model class for user table
    class User{

        private $conn = null;
        private $table = "user_tbl";

        //table fileds
        public $user_id;
        public $user_fname;
        public $user_lname;
        public $user_email;
        public $user_mobile;
        public $user_state; 
		public $user_city;
		public $user_password;
        public $createdBy;
        public $createdDt;
        public $updatedBy;
        public $updatedDt;

        public function __construct($db){

            $this->conn = $db;
           
        }

        

        //TO DO: to check product already exist or not
        public function isAlreadyExist()
        {
           
          $isExistSql = "SELECT `user_fname` 
                         FROM `user_tbl` 
                         WHERE `user_email` = :email";
          $stmt = $this->conn->prepare($isExistSql);
          $stmt->bindParam(":email",$this->email);
          $stmt->execute();
          if($stmt->rowCount() > 0){

              return true;
          }
          else
          {
              return false;
          }
        
        }

      //TO DO: create  method
      public function register()
      {
          if($this->isAlreadyExist()){
              return false;
          }
        
              $sql = "INSERT INTO `user_tbl` (`user_fname`,`user_lname`, `user_email`, `user_mobile`, `user_state`,`user_city`, `password`) VALUES(:fname, :lname, :email, :mobile, :state, :city, :password)";

              $stmt = $this->conn->prepare($sql);

              $stmt->bindParam(":fname",$this->user_fname);
			  $stmt->bindParam(":lname",$this->user_lname);
              $stmt->bindParam(":email",$this->user_email);
              $stmt->bindParam(":mobile",$this->user_mobile);
              $stmt->bindParam(":state",$this->user_state);
			  $stmt->bindParam(":city",$this->user_city);
              $stmt->bindParam(":password",$this->user_password);

              $isInserted = $stmt->execute() or die(print_r($stmt->errorInfo(), true));
             
              return $isInserted;
         
      }

     
    }