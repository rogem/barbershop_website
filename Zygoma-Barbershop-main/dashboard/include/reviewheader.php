<!DOCTYPE html>
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

        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />



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