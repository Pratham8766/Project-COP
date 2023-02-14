<?php session_start();
	$enroll = $_SESSION['enrollid'];
	include("../conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Result Storing</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<h1 class="display-3" style="text-align: center;">Enter results for students:</h1>

	<div class="container mb-3">
		<form action="result1.php" method="post">
			<?php
			// $conn = mysqli_connect("localhost", "root", "", "COP");
			if (!$conn) {
				echo "connection not successful";
				exit();
			}
			$sql1 = "select * from courses where teacher_id = $enroll";
			$res1 = mysqli_query($conn, $sql1); ?>
			<select name="course" class="form-select" style="margin-top: 30px;">
				<option selected>Select Course</option>
				<?php

				// $sql1 = "SELECT course_id, course_name FROM courses";
				// $res1 = mysqli_query($conn, $sql1);
				if ($res1) {
					$total1 = mysqli_num_rows($res1);
					echo $total1;
					while ($row1 = mysqli_fetch_assoc($res1)) {
						// echo '<option  value="' . $row1["course_id"] . '">' . $row1["course_id"] . '-' . $row1["course_name"] . '</option>';
						echo '<option  value="' . $row1["course_id"] . '">' . $row1["course_name"] . '</option>';
					}
				}
				?>
			</select>
			<select name="Type_of_Result" class="form-select" style="margin-top: 40px;">
				<option selected>Type of Result</option>
				<option value="ass"> Assignments</option>
				<option value="prac"> Practicals</option>
				<option value="pt"> Progressive Test</option>
				<option value="th"> Final theory</option>

			</select>
			<input style="margin-top: 40px;" class="btn btn-outline-primary" type="submit" value="Submit">


		</form>

	</div>

	<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$sub = $_POST['subject'];
		$course = $_POST['course'];
	}

	?>
</body>

</html>