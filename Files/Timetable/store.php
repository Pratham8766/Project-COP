<?php
// session_start();
include "../conn.php";
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $course=$_POST['course'];
    $main=$_SESSION['var'];
    $table=$_SESSION['table'];

    $i=0;
    foreach ($main as $key => $value) {
        foreach ($value as $key1 => $value1) 
        {
            // echo $key1;
            if($key1=='day' || $key1== 'batch')
                continue;
            else{
                $main[$key][$key1]=$course[$i];
                $i++;
            } 
        }     
    }
    $count=3;
    foreach ($main as $key => $value) {
        if($main[$key]['9-10']!= 'NULL' || $count%3==0) $ts1= $main[$key]['9-10'];
        if($main[$key]['10-11']!= 'NULL'|| $count%3==0) $ts2= $main[$key]['10-11'];
        if($main[$key]['11-12']!= 'NULL'|| $count%3==0) $ts3= $main[$key]['11-12'];
        if($main[$key]['12-13']!= 'NULL'|| $count%3==0) $ts4= $main[$key]['12-13'];
        if($main[$key]['13-14']!= 'NULL'|| $count%3==0) $ts5= $main[$key]['13-14'];
        if($main[$key]['14-15']!= 'NULL'|| $count%3==0) $ts6= $main[$key]['14-15'];
        if($main[$key]['15-16']!= 'NULL'|| $count%3==0) $ts7= $main[$key]['15-16'];
        if($main[$key]['16-17']!= 'NULL'|| $count%3==0) $ts8= $main[$key]['16-17'];
        if($main[$key]['17-18']!= 'NULL'|| $count%3==0) $ts9= $main[$key]['17-18'];

        $day = $main[$key]['day'];
        $batch = $main[$key]['batch'];
        $sql="UPDATE `$table` SET `9-10`='$ts1', `10-11`='$ts2', `11-12`='$ts3' , `12-13`='$ts4' , `13-14`='$ts5' , `14-15`='$ts6' , `15-16`='$ts7' , `16-17`='$ts8' , `17-18`='$ts9' where batch='$batch' AND day='$day'";
        $result=mysqli_query($conn,$sql);
        $count++;
    }
    if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Courses added successfully</strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Unkonwn error occured!!</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>TimeTable</title>
  </head>
  <body>
    <h2 style="text-align: center;">Timetable</h2>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <?php
                $tt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `$table`"));
                foreach ($tt as $key => $value) {
                    echo '<td>' . $key . '</td>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                    $count=0;
                    $result=mysqli_query($conn, "SELECT * FROM `$table`");
                    while($tt = mysqli_fetch_assoc($result))
                    {
                        foreach ($tt as $key => $value) {
                            if($key=='day')
                            {
                                if ($count == 0 || $count % 3 == 0)
                                    echo '<td rowspan="3" style="vertical-align : middle;">' . $value . '</td>';
                                else 
                                    continue;
                            }
                            else
                            echo '<td>' . $value . '</td>';
                        }echo '<tr>';
                        $count++;
                    }
                ?>
            </tr>
        </tbody>
    </table>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>