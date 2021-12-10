<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header('location:login.php');
}


?>

<html>

<head>
<title>Home Page</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<video autoplay muted loop id="myVideo">
  <source src="img/video.mp4" type="video/mp4">
</video>
<!-- Bootstrap NAVBAR START-->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <!-- Her laver vi en knap, som fører brugeren til logout.php, og der har vi 
    en header(); som fører os videre til login.php og sørger for at lave en session_destroy() så brugeren er logget ud igen-->
    <a style=" font-size: 30px; margin-left: 240px;" class="navbar-brand" href="logout.php">LOG OUT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a style="font-size: 20px;" class="nav-link active" aria-current="page" href="snake.html">SNAKE GAME</a>
        </li>
        <li class="nav-item">
          <a style="font-size: 20px;"  class="nav-link" href="#">TIC TAC GAME</a>
        </li>
        <li class="nav-item">
          <a style="font-size: 20px;"  class="nav-link" href="crud.php">SUGGESTIONS</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Bootstrap NAVBAR SLUT-->
<!-- Når man er logget ind, er der en beskrivelse med dit brugernavn. Brugernavnet hentes med php-->
    <h1 class="logged-in" >Hello <strong> <?php echo $_SESSION['username'];?></strong>, </br> <br>  You are now logged in <br> Are You ready to play?</h1>
    <div class="container">
  <div class="row align-items-start">
    <div style="margin-top: 50px; margin-left: 210px;" class="col">
    <a  href="snake.html"><button style=" background-color: #27476D; border-color: black; "  class="btn btn-primary btn-lg">PLAY SNAKE GAME</button></a>
    </div>
    <div style="margin-top: 50px; margin-left: -400px;" class="col">
    <a href="#"><button style=" background-color: #27476D; border-color: black; "  class="btn btn-primary btn-lg">PLAY TIC TAC GAME</button></a>
    </div>
  </div>
   


    </div>

</body>
</html>