<?php
session_start();
$enroll = $_SESSION['enrollid'];
include("../conn.php");
// $conn = mysqli_connect("localhost", "root", "", "cop");
if (!$conn) {
	echo "connection not successful";
	exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$course = $_POST['course'];
	$sql = "SELECT * FROM $course where enrollment = $enroll";
	$result = mysqli_query($conn, $sql);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Hello, world!</title>
</head>

<body>
	<section>
		<h1 class="display-3" style="text-align: center;">Result</h1>
		<div class="container mb-3">

			<form action="result_fetch.php" method="POST">

				<table class="table table-striped table-hover">
					<tr>
						<th>Enrollment_No</th>
						<th>Assignment_1</th>
						<th>Assignment_2</th>
						<th>Practical_1</th>
						<th>Practical_2</th>
						<th>Practical_3</th>
						<th>PT_1</th>
						<th>PT_2</th>
						<th>Final_Theory</th>
					</tr>
					<?php 
					while ($rows = $result->fetch_assoc()) {
					?>
						<tr>
							<!--FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN-->
							<td><?php echo $rows['enrollment']; ?></td>
							<td><?php echo $rows['Assignment_1']; ?></td>
							<td><?php echo $rows['Assignment_2']; ?></td>
							<td><?php echo $rows['Practical_1']; ?></td>
							<td><?php echo $rows['Practical_2']; ?></td>
							<td><?php echo $rows['Practical_3']; ?></td>
							<td><?php echo $rows['PT_1']; ?></td>
							<td><?php echo $rows['PT_2']; ?></td>
							<td><?php echo $rows['Final_Theory']; ?></td>
						</tr>
					<?php
					}
					?>
				</table>
			</form>
		</div>
		<!-- TABLE CONSTRUCTION-->

	</section>
</body>

</html>