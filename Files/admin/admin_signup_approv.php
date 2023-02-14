<?php
include("../conn.php");
$sql1 = "select * from pending_req";
$res1 = mysqli_query($conn, $sql1);
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $accept = $_POST['accept'];
    foreach($accept as $key=>$value){
        $sql2 = "select * from pending_req where enrollment = $key";
        $res2 = mysqli_query($conn,$sql2);
        if($res2){
            $row2 = mysqli_fetch_assoc($res2);
            // echo $row2['enrollment'];
            $enroll = $row2['enrollment'];
            $first_name = $row2['first name'];
            $middle_name = $row2['middle name'];
            $last_name = $row2['last name'];
            $dob = $row2['dob'];
            $email = $row2['email'];
            $mob = $row2['mobile number'];
            $addrress = $row2['address'];
            $pass_input = $row2['password'];
            $batch = $row2['batch'];
            $semester = $row2['semester'];

            $sql3 = "INSERT INTO `students` (`enrollment`,`first name`,`middle name`,`last name`,`dob`,`email`,`mobile number`,`address`, `password`, `batch`, `semester`) VALUES ('$enroll', '$first_name', '$middle_name', '$last_name', '$dob', '$email', '$mob', '$addrress', '$pass_input', '$batch', '$semester')";
            $res3 = mysqli_query($conn,$sql3);
            if($res3){
                $sql4 = "insert into `course_reg` (`enroll`) values ($enroll)";
                $res4 = mysqli_query($conn,$sql4);
                if($res4){
                    $sql5 = "delete from pending_req where enrollment = $key";
                    $res5 = mysqli_query($conn,$sql5);
                }
            }
        }
    }
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Students table updated successfully</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>

<!-- <!doctype html> -->
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Signup pending requests</title>
    <style>
        .agileits_w3layouts {
                background: url(feedbackbg.jpg)no-repeat;
                background-size: cover;
                background-attachment: fixed;
            }

        .wrap {
            padding: 2.3em;
            width: 85%;
            margin: 2em auto;
            background: rgba(1, 14, 21, 0.62);
        }

        .w3layouts_main h3 {
            font-size: 1em;
            color: #e6cfcf;
            line-height: 1.5;
        }

        .breadcrumbs {
            padding: 10px;
            font-family: 'Roboto', sans-serif;

        }

        .breadcrumbsitem {
            display: inline-block;
            margin-top: 10px;
        }

        .breadcrumbsitem:not(:last-of-type)::after {
            content: '\203a';
            margin: 0 5px;
            color: #ffc451;
        }

        .breadcrumbslink {
            text-decoration: none;
            color: grey;
        }

        .breadcrumbslink:hover {
            color: white;
        }

        .breadcrumbs__link--active {
            color: #ffc451;
            font-weight: 500;
        }
        
         .get-started-btn {
            color: #fff;
            border-radius: 4px;
            padding: 7px 25px 8px 25px;
            white-space: nowrap;
            transition: 0.3s;
            background-color: #343a40;
            font-size: 14px;
            display: inline-block;
            border: 2px solid #ffc451;
        }

        .get-started-btn:hover {
            background: #ffbb38;
            color: #343a40;
        }

        @media (max-width: 992px) {
            .get-started-btn {
                padding: 7px 20px 8px 20px;
                margin-right: 15px;
            }
        }
    </style>
</head>

<body class="agileits_w3layouts" style="background-color: black;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <ul class="breadcrumbs">
        <li class="breadcrumbsitem">
            <a href="../AdminHome.php" class="breadcrumbslink">Home</a>
        </li>

        <li class="breadcrumbsitem">
            <a href="/admin/admin_signup_approv.php" class="breadcrumbslink breadcrumbs__link--active">Signup Approve</a>
        </li>
    </ul>
    <h1 class="agile_head text-center" style="text-align: center; color:#ffc451">Pending Registration Requests</h1>
    <center>
    <div class=" w3layouts_main wrap">
        <form action="admin_signup_approv.php" method="POST">
            <?php
            echo '
                <table  class="table table-sm" id="myTable">
                <thead style = "color:#ffc451;">
                <th>Accept</th>
                <th>Enrollment</th>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th>
                <th>DOB</th>
                <th>Email</th>
                <th>Mobile No.</th>
                <th>Address</th>
                <th>Password</th>
                <th>Batch</th>
                <th>Semester</th>
                <th>Request date</th>
                </thead>
                <tbody>';
            while ($row1 = mysqli_fetch_assoc($res1)) {
                echo '<tr>';
                echo '<td> <input type="checkbox" name = "accept[' . $row1['enrollment'] . ']"   value = "1"> </td>';
                echo '<td>' . $row1["enrollment"] . '</td>';
                echo '<td>' . $row1["first name"] . '</td>';
                echo '<td>' . $row1["middle name"] . '</td>';
                echo '<td>' . $row1["last name"] . '</td>';
                echo '<td>' . $row1["dob"] . '</td>';
                echo '<td>' . $row1["email"] . '</td>';
                echo '<td>' . $row1["mobile number"] . '</td>';
                echo '<td>' . $row1["address"] . '</td>';
                echo '<td>' . $row1["password"] . '</td>';
                echo '<td>' . $row1["batch"] . '</td>';
                echo '<td>' . $row1["semester"] . '</td>';
                echo '<td>' . $row1["req_date"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>
                </table>
                <center>
                <button class="get-started-btn scrollto" type="submit">Submit form</button>
                </center>
                </form>
                </div>';
            ?>
    </center>
            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
            </script>




</body>

</html>