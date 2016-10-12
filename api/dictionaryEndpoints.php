<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/7/2016
 * Time: 2:55 PM
 */


//Includes DB files
$config = include("../config.php");


try{
    $db = new PDO ($config["connectionString"], $config["username"], $config["password"]);

    //ser the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


require '../models/DictionaryAdapter.php';

$adapter = new DictionaryAdapter($db);

//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    // Retrieve all words
    case "GET":
        $result = $adapter->getAllWords();
        break;

    // Add word
    case "POST":
        $word = $_POST['word'];
        $definition = $_POST['definition'];

        $adapter->submitWord($word, $definition);

        //Initializing array to hold possible errors
        //$error = array();
        //$error = $adapter->validateWord($word, $definition);
        //If error array has no errors then submit the post
        //if (count($error) == 0) {
        //}

        $result = $error;
        break;

    // Update word
    case "PUT":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);

        $id = $_PUT['id_update'];
        $word = $_PUT['word'];
        $definition = $_PUT['definition'];

        $adapter->updateWord($id, $word, $definition);


        $result = $_PUT;
        break;

    // Delete word
    case "DELETE":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE["id"];

        $adapter->deleteWord($id);

        $result = $_DELETE;
        break;
}

//set header to JSON
header("Content-Type: application/json");

//transform PHP array to JSON
echo json_encode($result);