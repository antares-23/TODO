<?php
 //   session_start(); 
    $title_page="login";
    include_once "./common/header.php";
    include_once './db/database.php';
    include_once './obj/user.php';

    $database= new Database();
    $database->setConfig( $todoHost,$todoDB, $todoUser,  $todoPass);
    $db= $database->GetConn();

    if($_POST){
        $user = new User($db);

        if($user->check($_POST['email'],$_POST['password']))
        {
           // unset($_SESSION["id"]);
           // unset($_SESSION["name"]);
            $_SESSION["id"]=$user->id;
            $_SESSION["name"]=$user->name;

            //echo $user->name;
            if($user->isAdmin){
                $_SESSION["admin"]=1;
              //  echo "Admin";
            }
            header("location: ./list.php");
                

        }
        else
        echo "<div class='alert alert-danger'>User not found!</div>";
       //print_r($user);
        
    }
?>
<div class="container mt-5">
  <div class="row">
  <div class="col-sm-3"></div>
    <div class="col-sm-6 text-center">

            <div class="card">
            <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <div class="card-header">
                <h1 class=""><i class="bi bi-dice-2-fill"></i> <i class="bi bi-dice-5-fill"></i></h1>
                    <h1>Login</h1>
                </div>
                <div class="card-body">
                <div class="mt-2">
                    <input type="text"    class="form-control" placeholder="Email" name="email">
                </div>
                
                <div class="mt-2">
                <input type="password" class="form-control" placeholder="password" name="password">
                </div>
                
                    

                </div>
                <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button></div>
                </form>
            </div>

    </div>
  </div>
</div>

<?php
?>