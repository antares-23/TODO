<?php

include_once "./common/header.php";
    session_destroy();
    
   header("Location: ./index.php");

?>