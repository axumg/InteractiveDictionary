<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/5/2016
 * Time: 12:27 AM
 */

session_start();

//Includes DB files

$config = include("../config.php");

try {
    $db = new PDO ($config["connectionString"], $config["username"], $config["password"]);

    //set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

require '../models/AdminAdapter.php';

$adapter = new AdminAdapter($db);

//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    //get all admins
    case "GET":
        $string = $_GET['string'];
        if (string ==  null) {
            $result = $adapter->getAdmins();
        }
        else {
            $result = $adapter->getOneAdmin($_SESSION['admin_id']);
        }
        break;

    // admin login
    case "POST":
        $adminUsername = strtolower($_POST['adminUsername']);
        $adminPassword = md5($_POST['adminPassword']);

        $user = $adapter->loginFunction($adminUsername, $adminPassword);

        if ($user != null) {
            $_SESSION['admin_id'] = $user->user_id;
            $_SESSION['priority'] = $user->priority;
            $_SESSION['first_name'] = $user->first_name;
            $_SESSION['name'] = $user->first_name . ' ' . $user->last_name;
            echo $user->priority;
        }
        break;


    // Update admin
    case "PUT":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);
        $first_name = $_PUT['first_name'];
        $last_name = $_PUT['last_name'];
        $old_pass_code = md5($_PUT['old_pass_code']);
        $old_pass = $_PUT['old_pass'];
        $new_pass_code = md5($_PUT['new_pass_code']);
        if ($old_pass == $old_pass_code){
            $_SESSION['name'] = $first_name." ".$last_name;
            $_SESSION['first_name'] = $first_name;
            $result = $adapter->updateAdmin($first_name, $last_name, $new_pass_code, $_SESSION['admin_id']);
        } else {
            $result = "Incorrect Password.";
        }
        break;

    // Delete teacher
    case "DELETE":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_DELETE);
        //TODO
        // $result = $_DELETE;
        break;
}


//transform PHP array to JSON
echo json_encode($result);

