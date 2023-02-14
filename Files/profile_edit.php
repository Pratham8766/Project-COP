<?php
// session_start();
include("conn.php");
$enroll = $_SESSION['enrollid'];
// $conn = mysqli_connect('localhost', 'root', '', 'cop');
// echo $conn;
if (!$conn) {
    echo "not connected";
    exit();
} else {
    $user=0;
    $sql1 = "select * from `students` where enrollment = $enroll";
    $res1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($res1);
    if(!isset($row1))
    {
        $sql1 = "select * from `teachers` where teacher_id = $enroll";
        $res1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($res1);
        $user++;
        if(!isset($row1))
        {
            $sql1 = "select * from `admin` where admin_id = $enroll";
            $res1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $user++;
        }
    }
}
?>

<?php
$fname = $midname = $lname = $dob = $email = $address = $phone = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['fname'] != "") {
        // echo $_POST['fname'];
        $fname = $_POST['fname'];
    } else {
        $fname = $row1['first name'];
    }

    if ($_POST['midname'] != "") {

        $midname = $_POST['midname'];
    } else {
        $midname = $row1['middle name'];
    }

    if ($_POST['lname'] != "") {

        $lname = $_POST['lname'];
    } else {
        $lname = $row1['last name'];
    }

    if ($_POST['dob'] != "") {

        $dob = $_POST['dob'];
    } else {
        $dob = $row1['dob'];
    }

    if ($_POST['email'] != "") {

        $email = $_POST['email'];
    } else {
        $email = $row1['email'];
    }

    if ($_POST['phone'] != "") {

        $phone = $_POST['phone'];
    } else {
        $phone = $row1['mobile number'];
    }

    if ($_POST['address'] != "") {

        $address = $_POST['address'];
    } else {
        $address = $row1['address'];
    }

    $sql2 = "UPDATE `students` SET `first name` = '$fname', `middle name` = '$midname', `last name` = '$lname', `dob` = '$dob', `email`='$email', `mobile number` = '$phone', `address` = '$address' WHERE `enrollment` = '$enroll'";
    $res2 = mysqli_query($conn, $sql2);
    if ($res2) {
        echo '<div class="alert alert-success" role="alert">
                Profile Updated successfully!!
                </div>';
    } else {
        echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                Unable to edit your Profile
            </div>
            </div>';
    }
}
?>



<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        .agileits_w3layouts {
            background: url(/assets/img/tempbg.jpg)no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        .wrap {
            padding: 2.3em;
            width: 50%;
            margin: 2em auto;
            background: rgba(1, 14, 21, 0.62);
        }

        .w3layouts_main h3 {
            font-size: 1em;
            color: #e6cfcf;
            line-height: 1.5;
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
            /* color: #fff; */
        }

        h1.agile_head {
            padding-top: 1em;
            font-size: 2.5em;
            text-transform: uppercase;
            color: #fff;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 6px;
            line-height: 1.5;
        }

        .breadcrumbs {
            /* padding: 40px; */
            font-family: 'Roboto', sans-serif;

        }

        .breadcrumbs__item {
            display: inline-block;
            margin-top: 20px;
        }

        .breadcrumbs__item:not(:last-of-type)::after {
            content: '\203a';
            margin: 0 5px;
            color: #ffc451;
        }

        .breadcrumbs__link {
            text-decoration: none;
            color: white;
        }

        .breadcrumbs__link:hover {
            color: white;
        }

        .breadcrumbs__link--active {
            color: #ffc451;
            font-weight: 500;
        }
    </style>
</head>


<body class="agileits_w3layouts" style="background-color: white;">
    <?php
    if($user == 0){
        echo '<ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="StudentHome.php" class="breadcrumbs__link">Home</a>
            </li>
    
            <li class="breadcrumbs__item">
                <a href="profile_edit.php" class="breadcrumbs__link breadcrumbs__link--active">Edit Profile</a>
            </li>
        </ul>';
    }
    
    else if($user ==1){
        echo '<ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="TeacherHome.php" class="breadcrumbs__link">Home</a>
            </li>
    
            <li class="breadcrumbs__item">
                <a href="profile_edit.php" class="breadcrumbs__link breadcrumbs__link--active">Edit Profile</a>
            </li>
        </ul>';
    }
    
    else if($user == 2){
        echo '<ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="AdminHome.php" class="breadcrumbs__link">Home</a>
            </li>
    
            <li class="breadcrumbs__item">
                <a href="profile_edit.php" class="breadcrumbs__link breadcrumbs__link--active">Edit Profile</a>
            </li>
        </ul>';
    }
    ?>
    <h1 class="agile_head text-center"> EDIT PROFILE</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <div class=" w3layouts_main wrap">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <div class="container mb-3">
            <!-- <h1 class="display-3" style="text-align: center; color:#ffc451;">Edit Profile</h1> -->
            <form action="profile_edit.php" method="POST">
                <div class="mb-3">
                    <label class="form-label" style='font-size: 20px; color:#ffc451'>First Name</label>
                    <input name="fname" type="text" class="form-control" placeholder="<?php echo $row1['first name'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" style='font-size: 20px; color:#ffc451'>Middle Name</label>
                    <input name="midname" type="text" class="form-control" placeholder="<?php echo $row1['middle name'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" style='font-size: 20px; color:#ffc451'>Last Name</label>
                    <input name="lname" type="text" class="form-control" placeholder="<?php echo $row1['last name'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" style='font-size: 20px; color:#ffc451'>DOB</label>
                    <input name="dob" type="date" class="form-control" placeholder="<?php echo $row1['dob'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" style='font-size: 20px; color:#ffc451'>Email address</label>
                    <input name="email" type="email" class="form-control" placeholder="<?php echo $row1['email'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" style='font-size: 20px; color:#ffc451'>Mobile Number</label>
                    <input name="phone" type="tel" class="form-control" placeholder="<?php echo $row1['mobile number']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" style='font-size: 20px; color:#ffc451'>Address</label>
                    <input name="address" type="text" class="form-control" placeholder="<?php echo $row1['address'] ?>">
                </div>
                <center>
                    <button type="submit" class="get-started-btn" style="background-color: #343a40;">Submit</button>
                </center>

            </form>
        </div>
    </div>
</body>

</html>