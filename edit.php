<?php
    $title_page="Edit TODO";
   include_once "./common/header.php";

   $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');


   include_once './db/database.php';
   include_once './obj/user.php';
   include_once './obj/task.php';
   $idUser= $_SESSION["id"];

   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
   $task = new Task($db);
   $task->id=$id;

   $task->readOne();


   
   if($_POST){
    
     $task->name= $_POST['name'];
     $task->description=$_POST['description'];
     $task->due=$_POST['due'];
     $task->idUser=$idUser;

     if($task->update())
     {
      //echo "<div class='alert alert-success'>TODO Created!!!</div>";
      header('Location: list.php?action=edited');
     }
     else{
      echo " 
      <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>ERROR</strong>
      </div>";
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



  <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id={$id}")?>" method="post">
  <div class="card">
  <div class="card-header bg-secondary text-white"><h3>Edit A TODO<h3></div>
  <div class="card-body">

   <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Title</label>
        <input type="text" class="form-control" id="name" placeholder="Enter TODO title " name="name" required value="<?php echo $task->name?>">
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
      </div>

      <div class="mb-3 mt-3">
        <label for="uname" class="form-label">Description</label>
        <textarea class="form-control" rows="5" id="description" name="description" required><?php echo $task->description?></textarea>

        <!--input type="text" class="form-control" id="description" placeholder="Enter TODO description " name="description" required value="<?php //echo $task->description?>"-->
        <!--div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div-->
      </div>

      <div class="col-lg-3 col-sm-6">
            <label for="startDate">Due date <?php echo $task->due?></label>
            <input id="startDate" class="form-control" type="date" name="due" required value="<?php echo $task->due?>"/>
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