<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/19/2016
 * Time: 8:07 PM
 */
session_start();
$thisPage = 'Class';

if ($_SESSION['class_code'] == null) {
    header("Location: aboutController.php");
} else {

    require '../views/gradeView.php';
}
