<?php

  $adminPage=1;
   $title_page="TODOs";
   include_once "../common/header.php";
   include_once '../db/database.php';
   include_once '../obj/user.php';
   
echo "<div class='container mt-5'>  ";
  // echo $_SESSION["id"];

   $database= new Database();
   $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
   $db= $database->GetConn();
   $user = new User($db);
 
    $stmt = $user->listAll();

  
   if(isset($_GET['action'])){
   
    if($_GET['action']=='deleted'){
      echo "
      <div class='alert alert-success alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <strong>Success!</strong> user Deleted!
      </div>";
   }

   if($_GET['action']=='edited'){
    echo "
    <div class='alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <strong>Success!</strong> user Edited!
    </div>";
    }
  }   

   
?>





  <div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6 ">
      <a href="../admin/create_user.php" class="btn btn-success float-end">Create User</a>
    </div>
  </div>

  <div class="row mt-5">



  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>e-mail</th>
       
        
        
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
        
        <td><?php echo $name;?></td>
        <td><?php echo $email;?></td>
        
       
        
        
        <td><a href='../admin/edit_user.php?id=<?php echo $id?>' class='btn btn-primary'><i class="bi bi-file-earmark"></i></a> </td>
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
        window.location = '../admin/delete_user.php?id=' + id;
    }
}

</script>

<?php
include_once "../common/footer.php";
?>