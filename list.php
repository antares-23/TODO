<?php

   $title_page="TODOs";
   include_once "./common/header.php";
   include_once './db/database.php';
   include_once './obj/user.php';
   include_once './obj/task.php';
echo "<div class='container mt-5'>  ";
  // echo $_SESSION["id"];

   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
   $task = new Task($db);
 
  $idUser= $_SESSION["id"];
 
  if($_SESSION['admin'])
    $stmt= $task->listAll();
  else
   $stmt= $task->listUser($idUser);
  
   if(isset($_GET['action'])){
    if($_GET['action']=='created'){
      echo "
      <div class='alert alert-success alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>Success!</strong> TODO Created!
      </div>";
    }

    if($_GET['action']=='cheked'){
      echo "
      <div class='alert alert-success alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>Success!</strong> TODO Checked!
      </div>";
    }
    if($_GET['action']=='deleted'){
      echo "
      <div class='alert alert-success alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>Success!</strong> TODO Deleted!
      </div>";
   }

   if($_GET['action']=='edited'){
    echo "
    <div class='alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <strong>Success!</strong> TODO Edited!
    </div>";
    }
  }   

   
?>





  <div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6 ">
      <a href="./create.php" class="btn btn-success float-end">Create a TODO</a>
    </div>
  </div>

  <div class="row mt-5">



  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>Completed</th>
        <th>Name</th>
        <th>Description</th>           
        <th>Due</th>
        
        <th>Edit</th>
        <th>Delete</th>
        
      </tr>
    </thead>
    <tbody>

    <?php

if($stmt->rowCount()>0){
       while($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
       
    ?>
    
      <tr>
      <td> <input class="form-check-input"  onclick='check_task(<?php echo $status;?>,<?php echo $id;?>);' type="checkbox" name="check" <?php if($status) echo "checked"?>></td>
        <td><?php echo $name;?></td>
        <td><?php echo $description;?></td>
       
        <td <?php 
       

       $date1 = new DateTime(date("Y-m-d"));
        $date2 = new DateTime($dueDate);
        if( $date1 > $date2 && $status==0 )
          echo "style='background-color: crimson !important'"; ?> >
        <?php 


        echo $dueDate;?>
        
        </td>
        
        <td><a href='./edit.php?id=<?php echo $id?>' class='btn btn-primary'><i class="bi bi-file-earmark"></i></a> </td>
        <td><a href='#' onclick='delete_task(<?php echo $id;?>);'  class='btn btn-danger'><i class="bi bi-x-circle"></i></a> </td>


        
      </tr>
     <?php
     }
    }
    else { echo " <tr><td colspan='7'>NO RESULTS FOUND</td></tr>";}
     ?>
    </tbody>
  </table>



     
    

  </div>
</div>

<script type='text/javascript'>
// confirm record deletion
function delete_task( id ){
 
    var answer = confirm('Are you sure?');
    if (answer){
        window.location = 'delete.php?id=' + id;
    }
}

function check_task( status, id ){
 
 //var answer = confirm('Change TODO status');
 //if (answer)
 {
   
     window.location = 'check.php?status='+status+'&id=' + id;
 }
}
</script>

<?php
include_once "./common/footer.php";
?>