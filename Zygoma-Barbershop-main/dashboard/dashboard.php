<?php
include "admin_session_checker.php";
session_start();
$user_type = $_SESSION['type'];
$user_id = $_SESSION['id'];
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>

<!DOCTYPE html>
<style>
#container
{
    padding-left:45% ;
    text-align:center;
}
</style>
</style>
<?php
include "db_conn.php";
$connect = $conn;
 $query = "SELECT status, count(*) as number FROM bookings GROUP BY status";
 $result = mysqli_query($connect, $query);
 ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Zygoma Barbershop</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


        <!-- Line Chart-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


        <!-- Doughnut Chart-->
        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Status', 'Number'],

                          <?php
                          while($row = mysqli_fetch_array($result))
                          {
                               echo "['".$row["status"]."', ".$row["number"]."],";

                          }
                          ?>
                     ]);

            var options = {
              title: 'TOTAL OF PENDING AND DONE',
              width: '100%',
              height: '500px',
              pieHole: 0.8
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
          }
        </script>
<!-- SELECT staff_id,name,isAvailable, SUM(est_completion) as total_consumed FROM service_booking 
JOIN bookings on service_booking.booking_id = bookings.id 
JOIN clientusers on bookings.staff_id = clientusers.id
JOIN services on service_booking.services_id = services.service_id where date = '2022-06-16' GROUP BY staff_id -->


</head>
  <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <img src="image/logo.png" >
            <a class="navbar-brand ps-3" href="dashboard.php"> Zygoma Barbershop</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <span style="color:white"><?php echo $_SESSION['name']?> </span>
            <?php
              if($_SESSION['type'] != 'admin'){
              if($_SESSION['isAvailable'] == 1){

              
            ?>
            <span class="statusText" style="color:white">&nbsp|&nbspAvailable</span>
            <?php
              }
              else{

            ?>
              <span class="statusText" style="color:white">&nbsp| &nbspBusy</span>
              <?php
              }
            }
              ?>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="activity_log.php">Activity Log</a></li> -->
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <?php

              if($_SESSION['type'] != 'admin'){
              if($_SESSION['isAvailable'] == 1){

              
            ?>
           <li><a class="dropdown-item" style="cursor:pointer" onclick="toggleStatus(this)" isavailable="<?php echo $_SESSION['isAvailable'];?>">Set as busy</a></li>
            <?php
              }
              else{

            ?>
              <li><a class="dropdown-item" style="cursor:pointer" onclick="toggleStatus(this)" isavailable="<?php echo $_SESSION['isAvailable'];?>">Set as available</a></li>
              <?php
              }
            }
              ?>
                       
                    </ul>
                </li>
            </ul>
        </nav>



        <script>

            const toggleStatus = (e)=>{
              const currentStatus = e.getAttribute('isavailable')
              if(parseInt(currentStatus) === 1){
                e.setAttribute('isavailable','0')
                e.innerText = "Set as available"
                document.querySelector('.statusText').innerHTML = "&nbsp| &nbspBusy"
              }
              else{
                e.setAttribute('isavailable','1')
                e.innerText = "Set as busy"
                document.querySelector('.statusText').innerHTML = "&nbsp| &nbspAvailable"
              }
              setAccountStatus(currentStatus)
            }
            const setAccountStatus = async (currentStatus)=>{
              const request = await fetch(`user_route.php?currentStatus=${currentStatus}`,{method:"POST"})
              const response = await request.text()
              console.log(response)
            }
            

        </script>

        <div id="layoutSidenav">
            <?php include('include/navbar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <?php
                                        date_default_timezone_set("Asia/manila");
                                            $todayExp = $yesterdayExp = $weeklyExp = $monthlyExp = $yearlyExp = $totalExp = 0;

                                            $current_date = date("Y-m-d " , strtotime("now"));
                                            $yesterday_date = date("Y-m-d " , strtotime("yesterday"));
                                            $weekly_date = date("Y-m-d " , strtotime("-1 week"));
                                            $monthly_date = date("Y-m-d " , strtotime("-1 month"));
                                            $yearly_date =  date("Y-m-d " , strtotime("-1 year"));

                                            // database connection
                                            require_once "db_connection.php";
                                        // Today's expense------------------------------------------------------------------------------------------------
                                            $sql_command_todayExp = "select SUM(price) as total  from service_booking JOIN services on service_booking.services_id = services.service_id JOIN bookings on service_booking.booking_id = bookings.id where bookings.date = '$current_date' and bookings.status='done'";
                                            $result = mysqli_query($conn ,$sql_command_todayExp);
                                            $rows =  mysqli_num_rows($result);

                                            if($rows > 0){
                                                while ($rows = mysqli_fetch_assoc($result) ){
                                                    (int)$todayExp += (int)$rows["total"];
                                                }
                                            }

                                        // Yesterday's Expense--------------------------------------------------------------------------------------------------------
                                        $sql_command_yesterdayExp = "select SUM(price) as total  from service_booking JOIN services on service_booking.services_id = services.service_id JOIN bookings on service_booking.booking_id = bookings.id where bookings.date = '$yesterday_date' and bookings.status='done'";
                                        $result_y = mysqli_query($conn ,$sql_command_yesterdayExp);
                                        $rows_y =  mysqli_num_rows($result_y);

                                        if($rows_y > 0){
                                            while ($rows_y = mysqli_fetch_assoc($result_y) ){
                                                (int)$yesterdayExp += (int)$rows_y["total"];
                                            }
                                        }
                                        // weekly expense------------------------------------------------------------------------------------------------------------
                                        $sql_command_weeklyExp = "select SUM(price) as total  from service_booking JOIN services on service_booking.services_id = services.service_id JOIN bookings on service_booking.booking_id = bookings.id where bookings.date = '$current_date' AND bookings.date = '$weekly_date' and bookings.status='done'";
                                        $result_w = mysqli_query($conn , $sql_command_weeklyExp) ;
                                        $rows_w =  mysqli_num_rows($result_w);
                                        if($rows_w > 0){
                                            while ($rows_w = mysqli_fetch_assoc($result_w) ){
                                                (int)$weeklyExp += (int)$rows_w["total"];
                                            }
                                        }
                                        // monthly expense -----------------------------------------------------------------------------------------------------------
                                        $sql_command_monthlyExp = "select SUM(price) as total  from service_booking JOIN services on service_booking.services_id = services.service_id JOIN bookings on service_booking.booking_id = bookings.id where bookings.date = '$current_date' AND bookings.date = '$monthly_date' and bookings.status='done'";
                                        $result_m = mysqli_query($conn , $sql_command_monthlyExp) ;
                                        $rows_m =  mysqli_num_rows($result_m);
                                        if($rows_m > 0){
                                            while ($rows_m = mysqli_fetch_assoc($result_m) ){
                                                (int)$monthlyExp += (int)$rows_m["total"];
                                            }
                                        }
                                        // yearly expense----------------------------------------------------------------------------------------------------------
                                        $sql_command_yearlyExp = "select SUM(price) as total  from service_booking JOIN services on service_booking.services_id = services.service_id JOIN bookings on service_booking.booking_id = bookings.id where bookings.date = '$current_date' AND bookings.date = '$yearly_date' and bookings.status='done' ";
                                        $result_year = mysqli_query($conn , $sql_command_yearlyExp) ;
                                        $rows_year =  mysqli_num_rows($result_year);
                                        if($rows_year > 0){
                                            while($rows_year = mysqli_fetch_assoc($result_year)){
                                            (int)$yearlyExp += (int)$rows_year['total'];
                                            }
                                        }
                                        // total expense------------------------------------------------------------------------------------------------------
                                        $sql_command_totalExp = "select SUM(price) as total  from service_booking JOIN services on service_booking.services_id = services.service_id JOIN bookings on service_booking.booking_id = bookings.id where bookings.status='done'";
                                        $result_t = mysqli_query($conn , $sql_command_totalExp) ;
                                        $rows_t =  mysqli_num_rows($result_t);
                                        if($rows_t > 0){
                                            while ($rows_t = mysqli_fetch_assoc($result_t) ){
                                            (int)$totalExp += (int)$rows_t["total"];
                                            }
                                        }

                                    ?>
                             <!-- Stat Box Pending-->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <a class="small-box " href="Datatables.php?filter=pending" style="text-decoration:none; color:black;">
                                      <div class="inner">
                                        <i class="fa-solid fa-user"></i>
                                        <?php
                                        require 'datatables/donependingcon.php';
                                        $query = "SELECT * from bookings WHERE status ='pending'";
                                        if($user_type == 'staff'){
                                            $query = "SELECT * from bookings WHERE status ='pending' AND staff_id = $user_id";
                                        }
                                       
                                        $query_run = mysqli_query($connection, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h3>'.$row.'<h3>';
                                        ?>
                                        <p>PENDING</p>
                                      </div>

                                </a>
                            </div>
                              <!-- Stat Box Done-->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <a class="small-box " href="Datatables.php?filter=done" style="text-decoration:none; color:black;">
                                  <div class="inner">
                                    <i class="fa-solid fa-user"></i>
                                    <?php
                                        require 'datatables/donependingcon.php';
                                        $query = "SELECT * from bookings WHERE status ='done'";
                                        if($user_type == 'staff'){
                                            $query = "SELECT * from bookings WHERE status ='done' AND staff_id =$user_id";
                                        }
                                        $query_run = mysqli_query($connection, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h3>'.$row.'<h3>';
                                        ?>
                                    <p>DONE</p>
                                  </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <a class="small-box " href="Datatables.php?filter=total" style="text-decoration:none; color:black;">
                                    <div class="inner">
                                        <i class="fa-solid fa-user"></i>
                                        <?php
                                            require 'datatables/donependingcon.php';
                                            $query = "SELECT * from bookings";
                                            if($user_type == 'staff'){
                                                $query = "SELECT * from bookings WHERE staff_id = $user_id";
                                            }
                                            $query_run = mysqli_query($connection, $query);
                                            $row = mysqli_num_rows($query_run);
                                            echo '<h3>'.$row.'<h3>';
                                            ?>
                                        <p>TOTAL APPOINMENTS</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                 <div id="chart_wrap">
                                    <div id="piechart"> </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <p>TODAY'S INCOME</p>
                                                <div class="d-inline-block">
                                                    <h2 class="text-white"><i class="fa-solid fa-peso-sign"></i><?php echo $todayExp; ?></h2>
                                                    <p class="text-white mb-0"><?php echo date("jS F " , strtotime("now")); ?></p>
                                                </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <p>YERTERDAY'S INCOME</p>
                                            <div class="d-inline-block">
                                                <h2 class="text-white"><i class="fa-solid fa-peso-sign"></i><?php echo $yesterdayExp; ?></h2>
                                                <p class="text-white mb-0"><?php echo date("jS F " , strtotime("yesterday")); ?></p>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <p>LAST 7 DAY'S INCOME</p>
                                            <div class="d-inline-block">
                                                <h2 class="text-white"><i class="fa-solid fa-peso-sign"></i><?php echo $weeklyExp; ?></h2>
                                                <p class="text-white mb-0"><?php echo date("jS F" , strtotime("-7 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <p>LAST 30 DAY'S INCOME</p>
                                            <div class="d-inline-block">
                                                <h2 class="text-white"><i class="fa-solid fa-peso-sign"></i><?php echo $monthlyExp; ?></h2>
                                                <p class="text-white mb-0"><?php echo date("jS F" , strtotime("-30 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                        <div class = "col-3">

                    </div>
                        <div class="col-lg-3 col-6">
                                <!-- small box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <p>ANNUAL INCOME</p>
                                            <div class="d-inline-block">
                                                <h2 class="text-white"><i class="fa-solid fa-peso-sign"></i><?php echo $yearlyExp; ?></h2>
                                                <p class="text-white mb-0"><?php echo date("d F Y" , strtotime("-1 year")); echo " - " . date("d F Y" , strtotime("now")); ?></p>
                                            </div>

                                        </div>
                                    </div>
                        </div>
                        <div class="col-lg-3 col-6">
                                <!-- small box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <p>TOTAL INCOME</p>
                                            <div class="d-inline-block">
                                                <h2 class="text-white"><i class="fa-solid fa-peso-sign"></i><?php echo $totalExp; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                        </div>

                                <table class="table table-bordered">
                                    <tr>
                                        <th scope="col">TODAY'S INCOME</th>
                                        <th scope="col">YESTERDAY INCOME</th>
                                        <th scope="col">LAST 7 DAY'S INCOME</th>
                                        <th scope="col">LAST 30 DAY'S INCOME</th>
                                        <th scope="col">ANNUAL INCOME</th>
                                        <th scope="col">TOTAL INCOME</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $todayExp; ?></td>
                                        <td><?php echo $yesterdayExp; ?></td>
                                        <td><?php echo $weeklyExp; ?></td>
                                        <td><?php echo $monthlyExp; ?></td>
                                        <td><?php echo $yearlyExp; ?></td>
                                        <td><?php echo $totalExp; ?></td>
                                    </tr>
                                    </table>
                                    <div id="container">
                                        <button onclick="window.print()" class="btn btn-primary">Print Report</button>

                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('include/footer.php');?>
            </div>
        </div>
        <?php include('include/scripts.php');?>
        </body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>