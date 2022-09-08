<?php
   include_once "./common/header.php";
   include_once './db/database.php';
   //include_once './obj/user.php';
   include_once './obj/task.php';

   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
   $task = new Task($db);

   $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
   $status=isset($_GET['status']) ? $_GET['status'] : die('ERROR: Record status not found.');

   if($task->checkTask($status,$id)){
        header('Location: list.php?action=cheked');
    }else{
       die('Unable to udate record.');
    }