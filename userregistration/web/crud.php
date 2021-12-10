<html>
	<head>
	<title>Crud</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	</head>
	<body class="crud-body"> 
    <a href="home.php"><button style=" background-color: #27476D; border-color: black; margin-right: 1100px; margin-top: 30px;"  class="btn btn-primary btn-lg">Go back</button></a>
    <h2 style="color: white; display: flex; justify-content: center; ">MAKE A SUGGESTION</h2>
    <p style="color: white; font-size: 15px; text-align: center; margin-bottom: 10px; ">We would like to implement more games to our site <br> If you have some great ideas then please add them to the list below </p>
	<p style="color: white; font-size: 15px; font-style: italic; text-align: center;" >*Please dont delete any already existing ideas</p>

		<form class="crud-form" action="crud.php" method="post">
			<?php
			//Her opretter vi forbindelsen til databasen
				$conn = new mysqli("louisemunch.dk.mysql:3306", "louisemunch_dkuserregistration", "userregistration", "louisemunch_dkuserregistration");
			?>
			<?php 
            function findes($id, $c) 
            {
                $sql = $c->prepare("select * crud where id =?");
                $sql->bind_param("i", $id);
                $sql->execute();
                $result->$sql->get_result();
                if($result->num_rows > 0)
                {
                    return true; 
                }
                else {
                    return false;
                }
            }
            ?>
			<?php
          //Her starter vi CRUD 
				if($_SERVER['REQUEST_METHOD'] === 'POST')
				{
					// read
					if($_REQUEST['knap'] == "read")
					{
						$crudid = $_REQUEST['crudid'];
						if(is_numeric($crudid))
						{
							//Her henter vi dataen fra tabellen og får dem vist
							$sql =  $conn->prepare("select * from crud where id = ?");
							$sql->bind_param("i", $crudid);
							$sql->execute();
							$result = $sql->get_result();
							$row = $result->fetch_assoc();
							$crudid = $row["id"];
							$name = $row["name"];
							$gamename = $row["gamename"];
							$aar = $row["aar"];
						}
					}
					
					// create
					if($_REQUEST['knap'] == "create")
					{
						$crudid = $_REQUEST['crudid'];
						$name = $_REQUEST['name'];
						$gamename = $_REQUEST['gamename'];
						$aar = $_REQUEST['aar'];
						//Her sørger vi for, at hvis der ikke er tilføjet noget i inputfeltet, står der i stedet "ukendt"
						if($name == "") $name = "ukendt";
						if($gamename == "") $gamename = "ukendt";
						//Her sørger vi for, at hvis der ikke er tilføjet noget i inputfeltet, står der i stedet "-1"
						if($aar == "") $aar = -1;
						if(is_numeric($crudid) && is_integer(0 + $crudid))
						{
							$sql = $conn->prepare("insert into crud (id, name, gamename, aar) values (?, ?, ?, ?)");
							$sql->bind_param("issi", $crudid, $name, $gamename, $aar);
							$sql->execute();
						}
					}
					
					// delete
					if($_REQUEST['knap'] == "delete")
					{
						$crudid = $_REQUEST['crudid'];
						if(is_numeric($crudid))
						{
							//Her sørger vi for, at vi sletter alt fra den ID der bliver tastet ind
							//Man kan derfor kun slette, hvis man har tastet ID
							$sql = $conn->prepare("delete from crud where id = ?");
							$sql->bind_param("i", $crudid);
							$sql->execute();
						}
					}
					
					// update
					if($_REQUEST['knap'] == "update")
					{
						$crudid = $_REQUEST['crudid'];
						$name = $_REQUEST['name'];
						$gamename = $_REQUEST['gamename'];
						$aar = $_REQUEST['aar'];
						if($name == "") $name = "ukendt";
						if($gamename == "") $gamename = "ukendt";
						if($aar == "") $aar = -1;
						if(is_numeric($crudid))
						{
							//Her sørger vi for, at når vi ændrer noget i inputfelterne, at det bliver opdateret
							$sql = $conn->prepare("update crud set name = ?, gamename = ?, aar = ? where id = ?");
							$sql->bind_param("ssii", $name, $gamename, $aar, $crudid);
							$sql->execute();
						}
					}
						
					// clear
					if($_REQUEST['knap'] == "clear")
					{
						//Her sørger vi for, at når vi klikker på "clear", at den fjerner alt der er i inputfelterne
						$crudid = "";
						$name = "";
						$gamename = "";
						$aar = "";
					}
				}
			?>
			
			<?php
				$sql = "select * from crud";
				$result = $conn->query($sql);
				
				echo '<table border="5" cellpadding="5">';
				echo "<tr>";
				echo "<th>CrudID</th>";
				echo "<th>Name</th>";
				echo "<th>Gamename</th>";
				echo "<th>Aar</th>";
				echo "</tr>";
				
				if($result->num_rows > 0)
				{
					while($row = $result->fetch_assoc())
					{
						echo "<tr>";
						echo "<td>".$row["id"]."</td>";
						echo "<td>".$row["name"]."</td>";
						echo "<td>".$row["gamename"]."</td>";
						echo "<td>".$row["aar"]."</td>";
						echo "</tr>";
					}
				}
				else
				{
					echo "No games";
				}
				
				echo "</table>";
			?>
			
			<!--Her afslutter vi forbindelsen til databasen-->
			<?php
				$conn->close();
			?>
			<!--Her laver vi inputfelterne og knytter værdien(value) til dét der passer i tabellen i databasen-->
			<p class="input" >
				CrudID : <input type="text" name="crudid" value="<?php echo isset($crudid) ? $crudid :'' ?>" style="position: absolute; left: 655px; width:200px; height: 22px"><br/><br/>
				Name : <input type="text" name="name" value="<?php echo isset($name) ? $name :'' ?>" style="position: absolute; left: 655px; width: 200px; height: 22px"><br/><br/>
				Game Name : <input type="text" name="gamename" value="<?php echo isset($gamename) ? $gamename :'' ?>" style="position: absolute; left: 655px; width: 200px; height: 22px"><br/><br/>
				Aar : <input type="text" name="aar" value="<?php echo isset($aar) ? $aar :'' ?>" style="position: absolute; left: 655px; width: 200px; height: 22px"><br/><br/>
            </p>
			
			<!--Her laver vi knapperne til CRUD-->
			<!--"value" refererer til CRUD som fortæller hvad knapperne hver især skal gøre-->
			<p>
				<input type="submit" name="knap" value="read" style="width: 70px; background-color: #27476D; color: white;" <?php echo $butttonread?>>
				<input type="submit" name="knap" value="update" style="width: 70px; background-color: #27476D; color: white;" <?php echo $butttonupdate?>>
				<input type="submit" name="knap" value="create" style="width: 70px; background-color: #27476D; color: white;" <?php echo $butttoncreate?> >
				<input type="submit" name="knap" value="delete" style="width: 70px; background-color: #27476D; color: white;" <?php echo $butttondelete?>>
				<input type="submit" name="knap" value="clear" style="width: 70px; background-color: #27476D; color: white;"<?php echo $butttonclear?>>


			</p>
		</form>
	</body>
</html>