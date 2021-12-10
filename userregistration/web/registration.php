<?php 
session_start();
header('location:login.php');
//Her laver jeg en variabel, som indeholdder en funktion der opretter forbindelsen til database serveren
$con = mysqli_connect('louisemunch.dk.mysql:3306', 'louisemunch_dkuserregistration', 'userregistration');
//Her er en funktion, som har parameterne "link" til database serveren og den specifikke databasenavn
mysqli_select_db($con, 'louisemunch_dkuserregistration');

//Her laver jeg 2 variabler som indeholder form-metoden "post" fra login siden
//Den første indeholder 'name= user'. 
//Så hver gang der bliver tastet noget i dette input, vil det blive gemt i denne variabel.
$name = $_POST['user'];
//Samme gælder for denne, blot med 'name=password'
$pass = $_POST['password'];


$s = "select * from usertable where name ='$name'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1) {
    //Her sørger jeg for, at hvis man indtaster noget som allerede står i databasen, så udprinter den denne besked
    echo "Username is already taken";
}
else {
//Her sørger jeg for, at når der indtastes noget i 'name' og 'password' under 'Register', så lægger den indholdet ind i databasen
    $reg = "insert into usertable(name, password) values('$name', '$pass')";
    mysqli_query($con, $reg);
    echo " Registration succesful";
}
?>