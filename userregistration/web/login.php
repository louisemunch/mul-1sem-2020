<html>
<head>
<title>User login and Registration</title>
<link rel="stylesheet" href="style.css">
<!--Link til bootstrapo cdn-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <!--Baggrundsvideo med loop, uden lyd-->
<video autoplay muted loop id="myVideo">
  <source src="img/video.mp4" type="video/mp4">
</video>
<!--Flere af knapperne er stylet internt, da det overskriver den styling bootstrap har-->
<a href="index.html"><button style="background-color: #27476D; border-color: black; margin-top: 20px;" class="btn btn-primary btn-lg">HOME</button></a>

<h1>Please fill out the inputs below</h1>

    <!--Her opretter vi en form hvor vi kan logge ind-->
    <!--Der er brugt en Default container, som gør at den ændrer sig ved hvert breakpoint-->
    <div class="container">
<div class="login-box">
  <!--Vi bruger row, når vi gerne vil lave kolonner. Nu laves der et gitter med 12 kolonner.-->
<div class="row">
  <!--Her opdeler jeg siden i 2, da jeg laver en kolonne som fylder 6/12 kolonner-->
  <!--Når jeg bruger col-md-6, laver vi et Medium breakpoint på 768px -->
<div class="col-md-6 login-left">
<h2>Login Here</h2>
<!--Her refererer vi til vores validation php fil-->
<form action="validation.php" method="post">
  <!--form-group er en bootstrap klasse-->
    <div class="form-group">
    <label>Username</label>
    <input type="text" name="user" class="form-control" required>
    </div>
    <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
    </div>
<button style="background-color: #27476D; border-color: black;" type="submit" class="btn btn-primary">Login</button>
</form>
</div>

<!--Her laver vi igen en kolonne som fylder den anden halvdel af siden-->
<div class="col-md-6 login-right">
<h2>Register Here</h2>
<!--Her refererer vi til vores registration.php fil-->
<form action="registration.php" method="post">
<div class="form-group">
<label>Username</label>
<input type="text" name="user" class="form-control" required>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>
<button style="background-color: #27476D; border-color: black;" type="submit" class="btn btn-primary">Register</button>



</form>
</div>

</div>

</div>
</div>

</body>
</html>