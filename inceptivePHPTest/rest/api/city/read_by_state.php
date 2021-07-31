<?php

    //set required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: GET");
    header("Content-Type: application/json; charset=UTF-8");
  
    //import class files
    include("../config/database.php");
    include("../models/city.php");
	

    //create database object
    $database = new Database;
    $db =  $database->connect();
    //Create subject model class object
    $city = new City($db);
    // Read request body data
    $city->stateId = isset($_GET["stateId"]) ? $_GET["stateId"] : die();
    //Fetch chapter Records from category table
    $stmt = $city->readByState();
    $rowCount = $stmt->rowCount();
    //Covert chapters records from subject table into JSON Object Response
    if($rowCount > 0)
    {

        $response = array();

        $response["recordcount"] = $rowCount;
        $response["records"] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $singleCity = array(
                "id" => $row["city_id"], 
                "name" => $row["city_name"]
            );        
            
            array_push($response["records"], $singleCity);
        }

        //echo "<pre>"; print_r($response);
        // set response code - 200 OK
        http_response_code(200);
        // show chapters data in json format
        echo json_encode($response);

    }
    else{

        $response = array(
            "message" => "No city found in database!"
        );

        // set response code - 400 Some Error
        http_response_code(400);
        // show chapters data in json format
        echo json_encode($response);
    }