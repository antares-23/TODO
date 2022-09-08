<?php

  $adminPage=1;
  $title_page="Create TODO";
   include_once "../common/header.php";
   include_once '../db/database.php';
   include_once '../obj/user.php';
   
   $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');


   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
   $user=new User($db);
    $user->readOne($id);
   
   
   if($_POST){
   
    $user->id=$id;
    $user->name= $_POST['name'];
    $user->email= $_POST['email'];
    $user->password= $_POST['pass'];


    
     if($user->update())
     {
      echo "
      <div class='alert alert-success alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>Success!</strong> User Edited!!!
      </div>";

     }
     else{
      echo "
      <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>Error!</strong> Error!
      </div>";
     }

   }
   




   //$stmt= $task->read();

?>
<div class="container mt-5">

<div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6 ">
      <a href="./list_users.php" class="btn btn-success float-end">Return</a>
    </div>
  </div>


  <div class="row">



  <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id={$id}")?>" method="post">
  <div class="card">
  <div class="card-header bg-secondary text-white"><h3>Edit  USER<h3></div>
  <div class="card-body">

   <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter full username " name="name" value= "<?php echo $user->name; ?>"required>
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
      </div>

      <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email " name="email" value= "<?php echo $user->email; ?>" required>
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
      </div>

      <div class="mb-3 mt-3">
        <label for="uname" class="form-label">New Password (blank for no change!!)</label>
        <input type="password" class="form-control" id="pass" placeholder="Enter password (blank for no change!)" name="pass">
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
include_once "../common/footer.php";
?>