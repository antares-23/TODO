<?php

   $title_page="Create TODO";
   include_once "./common/header.php";
   include_once './db/database.php';
   include_once './obj/user.php';
   include_once './obj/task.php';
   $idUser= $_SESSION["id"];

   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();

   
   if($_POST){
    $task = new Task($db);
     $task->name= $_POST['name'];
     $task->description=$_POST['description'];
     $task->due=$_POST['due'];
     $task->idUser=$idUser;

     if($task->create())
     {
      header('Location: list.php?action=created');
      //echo "<div class='alert alert-success'>TODO Created!!!</div>";
     }
     else{
      echo "<div class='alert alert-danger'>Error!</div>";
     }

   }
   




   //$stmt= $task->read();

?>
<div class="container mt-5">

<div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6 ">
      <a href="./list.php" class="btn btn-success float-end">Return</a>
    </div>
  </div>



  <div class="row">



  <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
  <div class="card">
  <div class="card-header bg-secondary text-white"><h3>CREATE A TODO<h3></div>
  <div class="card-body">

   <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Title</label>
        <input type="text" class="form-control" id="name" placeholder="Enter TODO title " name="name" required>
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
      </div>

      <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" placeholder="Enter TODO description " name="description" required>
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
      </div>

      <div class="col-lg-3 col-sm-6">
            <label for="startDate">Due date</label>
            <input id="startDate" class="form-control" type="date" name="due" required />
            <span id="startDateSelected"></span>
        </div>
  </div>
  <div class="card-footer text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
</div>
  </form>




     
    

  </div>
</div>



<?php
include_once "./common/footer.php";
?>