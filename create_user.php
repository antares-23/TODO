<?php

   $title_page="Create TODO";
   include_once "./common/header.php";
   include_once './db/database.php';
   include_once './obj/user.php';
  


   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
   
   if($_POST){
    $user=new User($db);
    $user->name= $_POST['name'];
    $user->email= $_POST['email'];
    $user->password= $_POST['pass'];


     if($user->create())
     {
      echo "<div class='alert alert-success'>User Created!!!</div>";
     }
     else{
      echo "<div class='alert alert-danger'>Error!</div>";
     }

   }
   




   //$stmt= $task->read();

?>
<div class="container mt-5">
  <div class="row">



  <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
  <div class="card">
  <div class="card-header bg-secondary text-white"><h3>CREATE A USER<h3></div>
  <div class="card-body">

   <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter full username " name="name" required>
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
      </div>

      <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email " name="email" required>
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
      </div>

      <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Password</label>
        <input type="text" class="form-control" id="pass" placeholder="Enter password " name="pass" required>
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
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