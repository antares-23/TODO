<?php
  session_start(); 
  //echo rawurldecode($_SERVER['PHP_SELF']);
  
  if( $title_page!="login" && !isset($_SESSION["id"]) && !isset($_SESSION["name"]) )
    header("location: ./index.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_page; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     
</head>
<body style="background-color: gainsboro ;">

<?php
  if($title_page!='login'){
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./list.php"><i class="bi bi-dice-2-fill"></i> <i class="bi bi-dice-5-fill"></i> TODO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($adminPage)?'../list.php':'./list.php'?> " >My TODOs</a>
        </li>
        <?php if($_SESSION["admin"]){?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($adminPage)?'../admin/list_users.php':'./admin/list_users.php'?>">Users</a>
        </li>
        <?php } ?>
      </ul>
      <span style="color:#E5FFCC">Welcome, <?php echo  $_SESSION["name"]?></span> <a class="nav-link" href=" <?php echo isset($adminPage)?'../logout.php':'./logout.php'?> ">Logout</a>
    </div>
  </div>
</nav>
<?php
  }
?>