<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- <meta http-equiv="refresh" content="2"> -->
	<link rel="stylesheet" href="Addons/update.css">
	<title>Add Details</title>
</head>
<body>		
	
	<div class="tags">
		<ul>
			<li>Smart-Card No: </li>
			<li>Reg No: </li>
			<li>Name: </li>
			<li>Classs/Division:</li>
			<li>Roll No:</li>
			<li>Mobile Number: </li>
			<li>Address: </li>
		</ul>
	</div>
	
	<?php

		fetch();
		function fetch() {
			$user = 'student';
			$pass = 'sakec';
			$db = 'students';

			$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to server".$db);

			$get_all = "select * from profile where UserId=\"".$_GET['id']."\"";
				
			$data = mysqli_query($conn, $get_all) or die("No records found.");

			$row = mysqli_fetch_assoc($data);

			echo'<div class="container">
				<form action="update.php?update=true&&id='.$_GET["id"].'" method="POST">
					<br><ul>
					<li>'.$row["UserId"].'</li>
					<li>'.$row["RegNo"].'</li>
					<li><span>'.$row["Fname"].' '.$row["Lname"].'</span><br></li>
					<li><span>'.$row["Class"].' '.$row["Division"].'</span><br></li>
					<li><span>'.$row["RollNo"].'</span><br></li>
					<li><input type="number" name="MobNo" value="'.$row["MobNo"].'"><br></li>
					<li><input type="text" name="Addr" value="'.$row["Addr"].'"><br></li>
					<li><input type="submit" value="Update"></li>
				</form> 
			</div>';

			mysqli_close($conn);
		}

		if (isset($_GET['update'])) {update();}
	
		function update() {


			$user = 'student';
			$pass = 'sakec';
			$db = 'students';

			$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to server".$db);


			$sql = "UPDATE `profile` SET MobNo=".$_POST['MobNo'].", Addr=\"".$_POST['Addr']."\" WHERE UserId=\"".$_GET['id']."\"";

			echo $sql;

			if (mysqli_query($conn, $sql)) {
				echo "Added details.";
			}
	
			else {
				echo "Error: ".mysqli_error($conn);
			}

			mysqli_close($conn);
			header('Location: update.php?id='.$_GET['id']);	
		}
		
		?>

</body>
</html>