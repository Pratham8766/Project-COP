<?php
session_start();
$hotsname = "localhost";
    $username = "id16934540_cop";
    $password = "Teamshadow@000";
    $dbname = "id16934540_cmcop";
    $conn = mysqli_connect($hotsname,$username,$password,$dbname);
    date_default_timezone_set('Asia/Kolkata');
    if(!$conn){
        echo "error in connecting to database";
    }
$result = mysqli_query($conn, "DELETE FROM cancelled_classes WHERE (`date`-CURDATE())>0");
$result = mysqli_query($conn, "DELETE FROM extra_classes WHERE (`date`-CURDATE())>0");
?>
<html>
<style>
    body {
        font-family: 'Josefin Sans', sans-serif;
        box-sizing: border-box;
    }

    
    .container-fluid {
        height: 100%;
        margin: 0;
        padding: 0;
        width: 100%;
        background: #FFF;
    } 

    /* ============= Animation background ========= */
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
    }

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
        margin-top: 15%;
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
        width: 350px;
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

    /* Animate Background*/
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

<body>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">

    <!-- Background & animion & navbar & title -->
    <div class="container-fluid">
        <!-- Background animtion-->
        <div class="background">
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
        </div>
        <header>
            <section class="header-content">
                <h1>Login</h1>
                <div class="wrap">
                    <!-- <h4 style="text-align: left;">Enter credentials:</h4> -->
                    <form class="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input name="enroll_id" type="number" style="width: 300px; color: black;" placeholder="Enter ID" required />
                        <input name="pass_id" type="password" style="width: 300px; color: black;" placeholder="Password" required/>
                        <button type="submit" name="login" style="margin-top: 10px; width: 145px; margin-right: 10px" class="get-started-btn scrollto">login</button><button type="button" class="get-started-btn scrollto" onclick="window.location.href='signup.php'"> Signup </button>
                        <!--<input name  = "enroll_id" type="number" style="width: 300px; color: black;" placeholder="Enrollment">-->
                        <!--<input name="pass_id" type="password" style="width: 300px; color: black;" placeholder="Password">-->
                        <!-- <button type="submit" id="login-button">Login</button><button type="submit" id="login-button">Signup</button> -->
                        <!--<button type="submit" name="login" style="margin-top: 10px; width: 145px; margin-right: 10px" class="get-started-btn scrollto">Submit</button>-->
                        <!--<button name="signup" style="margin-top: 10px; width: 145px;" class="get-started-btn scrollto">Signup</button>-->
                    </form>
                </div>
            </section>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $enrollid = $_POST['enroll_id'];
            $_SESSION['enrollid'] = $enrollid;
            $passid = $_POST['pass_id'];
            //   $conn = mysqli_connect('localhost', 'root', '', 'COP');
            $sql = "SELECT * FROM `students` WHERE `enrollment`= '$enrollid' AND `password` = '$passid'";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);
            $teachers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `teachers` WHERE `teacher_id`= $enrollid AND `password` = '$passid'"));
            $admin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `admin` WHERE `admin_id`= $enrollid AND `password` = '$passid'"));
            if ($total == 1) {
                //   header("Location: loginhome.php");
                echo '<meta http-equiv="refresh" content="0;url=StudentHome.php">';
            } else if ($teachers == 1) {
                //   header("location: teacherhome.php");
                echo '<meta http-equiv="refresh" content="0;url=TeacherHome.php">';
            } else if ($admin == 1) {
                //   header("location: teacherhome.php");
                echo '<meta http-equiv="refresh" content="0;url=AdminHome.php">';
            } else{
            //     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            //  <strong>Invalid credentials!!</strong>
            //  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //  </div>';
            
            echo '<script>
            alert("invalid password");
            </script>';
            }
        }
        ?>
        </header>
        <script src="https:cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </div>
</body>

