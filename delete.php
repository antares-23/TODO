<?php
    $title_page ="delete";
   include_once "./common/header.php";
   include_once './db/database.php';
   //include_once './obj/user.php';
   include_once './obj/task.php';

   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
   $task = new Task($db);

   $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

   if($task->deleteTask($id)){
        header('Location: list.php?action=deleted');
    }else{
        die('Cannot Delete!!');
    }