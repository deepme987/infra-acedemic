<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Details</title>
	<link rel="stylesheet" href="Addons/profile.css">
</head>
<body>		
	<?php
		if ($_SESSION['type']!="admin") {	
			exit("Not enough privilege.");
		}
	?>
	<div class="form">
		<form action="home.php?add_value=true" method="POST">
			<br>
			<input type="text" name="UserId" placeholder="User id">
			<input type="text" name="Fname" placeholder="First Name">
			<input type="text" name="Lname" placeholder="Last Name">
			<input type="number" name="RegNo" placeholder="Registration No">
			<input type="text" name="Class" placeholder="Class">
			<input type="number" name="Division" placeholder="Division">
			<input type="number" name="RollNo" placeholder="Roll No">
			<input type="number" name="MobNo" placeholder="Mobile Number">
			<input type="text" name="Addr" placeholder="Address">
			
			<input type="submit" name="confirm" id="confirm" value="Add Values!">
		</form> 

		<?php

			if (isset($_GET['add_value'])) {add();}
			
			function add() {

				$user = 'teacher';
				$pass = 'root';
				$db = 'students';

				$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to server".$db);

				$sql = "INSERT INTO `profile`(`UserId`, `Fname`, `Lname`, `RegNo`, `Class`, `Division`, `RollNo`, `MobNo`, `Addr`) VALUES (\"".$_POST['UserId']."\",\"".$_POST['Fname']."\",\"".$_POST['Lname']."\",".$_POST['RegNo'].",\"".$_POST['Class']."\",".$_POST['Division'].",".$_POST['RollNo'].",".$_POST['MobNo'].",\"".$_POST['Addr']."\")";

				if (mysqli_query($conn, $sql)) {
					echo "Added details.";
				}
				else {
					echo "Error: ".mysqli_error($conn);
				}

				mysqli_close($conn);

				header('Location: home.php?page=list.php');
			}
				
		?>
	</div>

	<div class="list">
		<?php
	
			$user = 'student';
			$pass = 'sakec';
			$db = 'students';

			$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to server".$db);

			$get_all = "select * from profile";
				
			$data = mysqli_query($conn, $get_all) or die("No records found.");

			echo "<div class=\"table\"><table><tr><th>User Id</th><th>First Name</th><th>Last Name</th><th>Reg No</th><th>Class</th><th>Div</th><th>Roll No</th><th>Mobile</th><th>Address</th>";

			while($row = mysqli_fetch_assoc($data)) {
				echo "<tr><td>".$row["UserId"]."</td><td>".$row["Fname"]."</td><td>".$row["Lname"]."</td><td>".$row["RegNo"]."</td><td>".$row["Class"]."</td><td>".$row["Division"]."</td><td>".$row["RollNo"]."</td><td>".$row["MobNo"]."</td><td>".$row["Addr"]."</td></tr>";
			}
			echo "</table></div>"; 

			mysqli_close($conn);
		?>

	</div>

</body>
</html>