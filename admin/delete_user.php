<?php
    $title_page ="delete";
    $adminPage=1;
   include_once "../common/header.php";
   include_once '../db/database.php';
   include_once '../obj/user.php';
  

   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
  
   $user =  new User($db);

   $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

   if($user->delete($id)){
        header('Location: ../admin/list_users.php?action=deleted');
    }else{
        die('REcord not found!.');
    }