<?php
session_start();

$authenticated = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <title>Register & Login</title>
        <link rel="shortcut icon" href="/assets/OIP.jpg" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand"href="/index.php">
                <img src="/assests/cllll.jpg" alt="assests"
                alt="Logo" width="50" height="50">
                Being Ready </a>
        <button class="navbar-toggler" type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle_navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" 
        id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link text-dark"href="/index.php">Home</a>
            </li>
        </ul>
        
        
<?php
    if ($authenticated){
?>
     <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"
            role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Admin
</a>
<ul class="dropdown-menu">
    <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
    <li><a class="dropdown-item" href="/logout.php">logout</a></li>
    <li><hr class="drpodown-divider"></li>
    <li><a class="dropdown-item" href="#"> Something else here</a></li>
</ul>
</li>
</ul>
    <?php
        } else {
            ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/layout/register.php" class="btn
                    btn-outline-primary me-2">Register</a>
                </li>
                <li class="nav-items">  
                    <a href="/login.php" class="btn btn-primary">Login</a> 
                </li> 
            </ul>
            <?php } ?>  
        </div>
    </nav>
