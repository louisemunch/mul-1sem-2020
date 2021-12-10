<?php 
session_start();
//Når vi siger session_destroy, "ødelægger" den al data der er knyttet til session(start). 
//Den sletter ikke dataen, man skal blot bruge session(start), altså logge ind for at hente ny data
session_destroy();
header('location:login.php'); 

?>