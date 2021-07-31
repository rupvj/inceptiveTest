
<?php 

session_start();

if(!isset($_SESSION['username'])){
    header('location:index.php');
}

if(isset($_REQUEST["btnLogout"])){
    session_reset();
    session_destroy();
    header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

     <!--bootstrap css-->
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper">

            <div class="main-panel">

                <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand">Hello, <?=$_SESSION['username']?> you are logged in!!</a>
                    
                    <form class="d-flex">
                    
                    <button name="btnLogout" class="btn btn-outline-success" type="submit">Logout</button>
                    </form>
                </div>
                </nav>
            </div>
        </div>
    </div>

</body>
</html>