<?php 
// ?DATABASE CONNECTION
include('../database/dbconn.php');
// ?CLASS
include('../class/BMI.php');
include('../class/Users.php');
$_users = new Users($pdo);
$_bmi = new BMI($pdo);
// ?Page
$page_action = isset($_GET['page'])?$_GET['page']:'home';
$page;
$title;
$index_page = '../template/index.html.php';

if($page_action == 'home'){
    $title = 'Home';
    $page = $index_page;
}

include('../template/layout.html.php');