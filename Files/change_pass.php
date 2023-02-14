<?php
// session_start();
include "conn.php";
// $enroll = 1813003;
$enroll = $_SESSION['enrollid'];
if ($conn) {
    $user = 0;
    $sql1 = "select * from `students` where enrollment = $enroll";
    $res1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($res1);
    if (!isset($row1)) {
        $sql1 = "select * from `teachers` where teacher_id = $enroll";
        $res1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($res1);
        $user++;
        if (!isset($row1)) {
            $sql1 = "select * from `admin` where admin_id = $enroll";
            $res1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $user++;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentpass = $_POST['CURRENT'];
    $newpass = $_POST['NEW'];
    $confirm = $_POST['confirm'];

    switch ($user) {
        case 0:
            $originalpassquery = "SELECT `password` from students where `enrollment`=$enroll";
            break;
        case 1:
            $originalpassquery = "SELECT `password` from teachers where `teacher_id`=$enroll";
            break;
        case 2:
            $originalpassquery = "SELECT `password` from `admin` where `admin_id`=$enroll";
            break;
    }
    $originalpass = mysqli_fetch_assoc(mysqli_query($conn, $originalpassquery));
    // $originalpass = $originalpass['password'];

    if ($currentpass != $originalpass['password']) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Invalid old password</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } elseif ($newpass != $confirm) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Password does not match</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } else {
        switch ($user) {
            case 0:
                $updatequery = "UPDATE `students` set `password`='$newpass' where `enrollment`=$enroll";
                $res = mysqli_query($conn, $updatequery);
                // $change = mysqli_num_rows($res);
                if ($res) echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Password changed successfully</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                break;
            case 1:
                $updatequery = "UPDATE `teachers` set `password`='$newpass' where `teacher_id`=$enroll";
                $res = mysqli_query($conn, $updatequery);
                if ($res) echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Password changed successfully</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                break;
            case 2:
                $updatequery = "UPDATE `admin` set `password`='$newpass' where `admin_id`=$enroll";
                $res = mysqli_query($conn, $updatequery);
                if ($res) echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Password changed successfully</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                break;
        }
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: 'Josefin Sans', sans-serif;
        box-sizing: border-box;
    }

/* 
    .container-fluid {
        height: 100%;
        margin: 0;
        padding: 0;
        width: 100%;
        background: #FFF;
    } */

    /* ============= Animation background =========
    .background {
        background: linear-gradient(132deg, grey, black);
        background-size: 400% 400%;
        animation: Gradient 15s ease infinite;
        position: relative;
        height: 100vh;
        width: 100%;
        overflow: hidden;
        padding: 0;
        margin: 0px;
    }

    .cube {
        position: absolute;
        top: 80vh;
        left: 45vw;
        width: 10px;
        height: 10px;
        border: solid 1px #ffc451;
        transform-origin: top left;
        transform: scale(0) rotate(0deg) translate(-50%, -50%);
        animation: cube 6s ease-in forwards infinite;
    }

    .cube:nth-child(2n) {
        border-color: #ffc451;
    }

    .cube:nth-child(2) {
        animation-delay: 1s;
        left: 25vw;
        top: 40vh;
    }

    .cube:nth-child(3) {
        animation-delay: 2s;
        left: 75vw;
        top: 50vh;
    }

    .cube:nth-child(4) {
        animation-delay: 3s;
        left: 90vw;
        top: 10vh;
    }

    .cube:nth-child(5) {
        animation-delay: 4s;
        left: 10vw;
        top: 85vh;
    }

    .cube:nth-child(6) {
        animation-delay: 5s;
        left: 50vw;
        top: 10vh;
    } */

    /* ================= Header ============ */
    header {
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    /* Header content & title & button*/
    .header-content {
        margin-top: 5%;
        text-align: center;
        color: #EFEEF5;
    }

    /* .header-content h1 {
        text-transform: uppercase;
        font-size: 3em;
        letter-spacing: 1px;
    } */
    .wrap {
        padding: 2.3em;
        width: 400px;
        margin: 2em auto;
        /* border-radius: 25px; */
        background: rgba(1, 14, 21, 0.62);
    }

    .header-content h1 {
        /* padding-top: 1em; */
        font-size: 3em;
        text-transform: uppercase;
        color: #fff;
        font-weight: 600;
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 8px;
        line-height: 0.5;
    }

    .header-content p {
        font-size: 20px;
        line-height: 1.5;
        margin: 10px auto;
    }

    /* Animate Background
    @keyframes Gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    @keyframes cube {
        from {
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
            opacity: 1;
        }

        to {
            transform: scale(20) rotate(960deg) translate(-50%, -50%);
            opacity: 0;
        }
    }
 */

    /* form */
    form {
        padding: 0px 0;
        position: relative;
        z-index: 2;

    }

    form input {
        -webkit-appearance: none;
        -moz-appearance: none;
        /* color: black; */
        appearance: none;
        outline: 0;
        border: 1px solid rgba(255, 255, 255, 0.4);
        background-color: rgba(255, 255, 255, 0.2);
        width: 250px;
        border-radius: 3px;
        padding: 10px 15px;
        margin: 0 auto 10px auto;
        display: block;
        text-align: center;
        font-size: 18px;
        color: white;
        transition-duration: 0.25s;
        font-weight: 300;
    }

    form input:hover {
        background-color: rgba(255, 255, 255, 0.4);
    }

    form input:focus {
        background-color: white;
        width: 300px;
        color: black;
    }

    /* form button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        outline: 0;
        background-color: white;
        border: 0;
        padding: 10px 15px;
        color: #53e3a6;
        border-radius: 3px;
        width: 250px;
        cursor: pointer;
        font-size: 18px;
        transition-duration: 0.25s;
    }

    form button:hover {
        background-color: #f5f7f9;
    } */
    .get-started-btn {
        color: #fff;
        background-color: #343a40;
        border-radius: 4px;
        padding: 7px 25px 8px 25px;
        white-space: nowrap;
        transition: 0.3s;
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

    ::placeholder {
        /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #bfbfbf;
        opacity: 1;
        /* Firefox */
    }

    .breadcrumbs {
        padding: 10px;
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
        color: grey;
    }

    .breadcrumbs__link:hover {
        /* text-decoration: underline; */
        color: white;
    }

    .breadcrumbs__link--active {
        color: #ffc451;
        font-weight: 500;
    }
</style>

<body style="background-image: url('assets/img/change.jpg'); background-size: cover">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">

    <!-- Background & animion & navbar & title
    <div class="container-fluid"> -->
        <!-- Background animtion-->
        <!-- <div class="background">
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
        </div> -->
        <header>
            <?php
            if ($user == 0) {
                echo '<ul class="breadcrumbs">
                    <li class="breadcrumbs__item">
                        <a href="../StudentHome.php" class="breadcrumbs__link">Home</a>
                    </li>
            
                    <li class="breadcrumbs__item">
                        <a href="change_pass.php" class="breadcrumbs__link breadcrumbs__link--active">change password</a>
                    </li>
                </ul>';
            } else if ($user == 1) {
                echo '<ul class="breadcrumbs">
                    <li class="breadcrumbs__item">
                        <a href="../TeacherHome.php" class="breadcrumbs__link">Home</a>
                    </li>
            
                    <li class="breadcrumbs__item">
                        <a href="change_pass.php" class="breadcrumbs__link breadcrumbs__link--active">change password</a>
                    </li>
                </ul>';
            } else if ($user == 2) {
                echo '<ul class="breadcrumbs">
                    <li class="breadcrumbs__item">
                        <a href="../AdminHome.php" class="breadcrumbs__link">Home</a>
                    </li>
            
                    <li class="breadcrumbs__item">
                        <a href="change_pass.php" class="breadcrumbs__link breadcrumbs__link--active">change password</a>
                    </li>
                </ul>';
            }

            ?>
            <section class="header-content">
                <h1>Change Password</h1>
                <div class="wrap">
                    <!-- <h4 style="text-align: left;">Enter credentials:</h4> -->
                    <form class="form" action="change_pass.php" method="post">
                        <input type="Password" name="CURRENT" style="width: 300px; color: black;" placeholder="Current Password">
                        <input type="password" name="NEW" style="width: 300px; color: black;" placeholder="New Password">
                        <input type="password" name="confirm" style="width: 300px; color: black;" placeholder="Confirm new Password">
                        <!-- <button type="submit" id="login-button">Login</button><button type="submit" id="login-button">Signup</button> -->
                        <button name="login" style="margin-top: 10px; width: 145px; margin-right: 10px" class="get-started-btn scrollto">Save</button>
                    </form>
                </div>
            </section>
        </header>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>