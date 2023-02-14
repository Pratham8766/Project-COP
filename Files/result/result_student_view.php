<?php
// session_start();
include("../conn.php");
$enroll = $_SESSION['enrollid'];

$sql = "SELECT * FROM results where enrollment = $enroll";
$result = mysqli_query($conn, $sql);
?>


<!-- <!DOCTYPE html> -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <style>
        .agileits_w3layouts {
            background: url(../assets/img/result1.jpg)no-repeat;
            background-size: cover;
            background-attachment: fixed;
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

        .color {
            color: #ffc451;
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
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body class="agileits_w3layouts" style="background-color: black;">
    <ul class="breadcrumbs">
        <li class="breadcrumbsitem">
            <a href="../StudentHome.php" class="breadcrumbslink">Home</a>
        </li>

        <li class="breadcrumbsitem">
            <a href="/result/result_student_view.php" class="breadcrumbslink breadcrumbs__link--active">Result</a>
        </li>
    </ul>
    <h1 class="agile_head" style="text-align: center;">RESULT</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <div class=" w3layouts_main wrap">
        <div style="color:white;">
            <table class="table table-bordered">

                <tr>
                    <th class="color">Course Name</th>
                    <th class="color" style="text-align:center">Assignment</th>
                    <th class="color" style="text-align:center">Practical</th>
                    <th class="color" style="text-align:center">PT</th>
                    <th class="color" style="text-align:center">Final_Theory</th>
                    <th class="color" style="text-align:center">Result</th>
                </tr>
                <?php
                while ($rows = $result->fetch_assoc()) {

                    $ass_avg = $rows['Assignment_1'] + $rows['Assignment_2'];
                    $ass_avg_avg = ceil($ass_avg / 2);
                    
                    $prac_avg = $rows['Practical_1'] + $rows['Practical_2'] + $rows['Practical_3'];
                    $prac_avg_avg = ceil($prac_avg / 3);
                    
                    $pt_avg = $rows['PT_1'] + $rows['PT_2'];
                    $pt_avg_avg = ceil($pt_avg / 2);
                    
                    $final_theory = $rows['Final_Theory'];
                    
                    $sql2 = "select course_name from courses where course_id= '" . $rows['course_name'] . "'";
                    $res1 = mysqli_query($conn, $sql2);
                    $course_name = mysqli_fetch_assoc($res1);
                    
                    $assaddition= $rows["Assignment_1"] + $rows["Assignment_2"];
                    $pracaddition = $rows["Practical_1"] + $rows["Practical_2"]+ $rows["Practical_3"];
                    $ptaddition =  $rows["PT_1"] + $rows["PT_2"];
                    echo '<tr>
                        <td style="color:white;">' .  $course_name['course_name'] . ' (' . $rows['course_name'] . ') </td>
                        <td style="color:white; text-align:center">' . $assaddition . '</td>
                        <td style="color:white; text-align:center">' .  $pracaddition . '</td>
                        <td style="color:white; text-align:center">' .$ptaddition . '</td>
                        <td style="color:white; text-align:center">' . $rows["Final_Theory"] . '</td>';

                    $a = $ass_avg_avg > 10 && $prac_avg_avg > 10 && $pt_avg_avg > 14 && $final_theory > 33;
                    if ($a) {
                        echo '<td style="color:white; text-align:center"> Pass </td>';
                    } else {
                        echo '<td style="color:white; text-align:center"> Fail  </td>';
                    }
                    echo '</tr>';
                }
                ?>

            </table>
        </div>
    </div>
</body>

</html>