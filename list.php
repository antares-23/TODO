<?php

   $title_page="TODOs";
   include_once "./common/header.php";
   include_once './db/database.php';
   include_once './obj/user.php';
   include_once './obj/task.php';


   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
   $task = new Task($db);
 
  $idUser= $_SESSION["id"];

   $stmt= $task->listUser($idUser);
    
?>

<div class="container mt-5">  
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
        <th>Complete</th>
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
      <td> <input class="form-check-input" type="checkbox" name="remember" <?php if($status) echo "checked"?> disabled></td>
        <td><?php echo $name;?></td>
        <td><?php echo $description;?></td>
       
        <td><?php echo $dueDate;?></td>
        <td><a href='#' onclick='check_task(<?php echo $status;?>,<?php echo $id;?>);'  class='btn btn-danger'><i class="bi bi-check2-square"></i></a> </td>
        <td><a href='./edit.php?id=<?php echo $id?>' class='btn btn-danger'><i class="bi bi-file-earmark"></i></a> </td>
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
        // if user clicked ok,
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    }
}

function check_task( status, id ){
 
 var answer = confirm('Are you sure?');
 if (answer){
     // if user clicked ok,
     // pass the id to delete.php and execute the delete query
     window.location = 'check.php?status='+status+'&id=' + id;
 }
}
</script>

<?php
include_once "./common/footer.php";
?>