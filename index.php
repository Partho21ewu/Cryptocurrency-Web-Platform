<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
</head>
<body>
   
    <div class="cryptos-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                  
                    <nav class="classy-navbar justify-content-between" id="cryptosNav">
                        <a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt=""></a>
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>
                        <div class="container">
        <h1>Welcome to Cryptos</h1>
        <a href="logout.php" class="btn btn-warning">No ID Please SignIn</a>
    </div>
    <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="order_form.html">buy crypto</a></li>
                                            <li><a href="charts.html">finance</a></li>
                                            <li><a href="messaging.html">chat</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Contact</a></li>
      <div class="container">
        <a href="logout.php" class="btn btn-warning">Log Out</a> 
   </div>

</body>
</html>