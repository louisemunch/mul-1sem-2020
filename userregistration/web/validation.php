<?php 
session_start();
//Her opretter jeg forbindelse til min database i PhpMYAdmin
$con = mysqli_connect('louisemunch.dk.mysql:3306', 'louisemunch_dkuserregistration', 'userregistration');
//Her connecter den til den specifikke database
mysqli_select_db($con, 'louisemunch_dkuserregistration');

$name = $_POST['user'];
$pass = $_POST['password'];

//Her laver vi en variabel, som matcher det der står i databasen
$s = "select * from usertable where name ='$name' && password = '$pass'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1) {
    $_SESSION['username'] = $name;
header('location:home.php');  
}
else {
header('location:login.php');
}
?>