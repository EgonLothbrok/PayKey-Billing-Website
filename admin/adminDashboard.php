<?php

// Database Connection - Code Review - Done

require_once("../dbconnection.php");

// ---------- Getting Data Start ----------//

// User Session Verification
if (empty($_SESSION['userName'])) {
    header('location:../login.php');
} else {

    // For User Information
    $_userId = $_SESSION['userId'];

    // Getting Services
    $servicesSql = "SELECT * FROM `services`";
    $servicesStatement = $db1->query($servicesSql);
    $_services = $servicesStatement->fetchAll(PDO::FETCH_ASSOC);
    $_totalServices = count($_services);

    // Getting Users
    $usersSql = "SELECT * FROM `users` WHERE role = 'client'";
    $usersStatement = $db1->prepare($usersSql);
    $usersStatement->execute();
    $_users = $usersStatement->fetchAll(PDO::FETCH_ASSOC);
    $_userCount = $usersStatement->rowCount();


    // Getting Transitions
    $activitiesSql = "SELECT * FROM `user_activities` WHERE user_id = $_userId";
    $activitiesStatment = $db1->prepare($activitiesSql);
    $activitiesStatment->execute();
    $_activites = $activitiesStatment->rowCount();
}

// ---------- Getting Data End  ----------//

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>


    <!-- Chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <!-- Main Contrainer -->
    <div class="container-fluid">
        <div class="row h-100 ">
            <!-- Main Navigation -->
            <div class="col-lg-3 d-none d-lg-flex d-flex justify-content-between flex-column bg-white border">
                <!-- Navigation -->
                <div class="position-sticky top-0 mx-auto">
                    <!-- Panel -->
                    <div class="d-flex w-100 mb-auto flex-column justify-content-center align-items-center ">
                        <!-- Topic -->
                        <div class="w-100 text-center my-3 fw-bold ">
                            <a href="" onClick="window.location.reload();" class="text-decoration-none text-dark">
                                <h5 class="fs-4 fw-bolder">Admin Dashboard</h5>
                            </a>

                        </div>
                        <!-- Home -->
                        <a href="./adminDashboard.php#Home" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-solid fa-circle-user me-2"></i> Dashboard
                            </div>
                        </a>
                        <!-- Activities -->
                        <a href="./viewActivities.php" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-brands fa-creative-commons-sampling me-2"></i> Activites
                            </div>
                        </a>
                        <!-- Cash In Request -->
                        <a href="./viewBillRequest.php" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-solid fa-file-invoice-dollar me-2"></i> Bill Requests
                            </div>
                        </a>
                        <!-- Services -->
                        <a href="./viewServices.php" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-solid fa-comment-dollar me-2"></i> Services
                            </div>
                        </a>
                        <!-- Users -->
                        <a href="./viewUsers.php" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-solid fa-user-astronaut me-2"></i> Users
                            </div>
                        </a>
                        <a href="./viewRequest.php" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-solid fa-paper-plane me-2"></i> Request
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Logout Butom -->
                <div class="w-100 p-2  text-center position-sticky fixed-bottom top-0">
                    <a href="../assets/logout.php" class="text-decoration-none m">
                        <button class="btn btn-dark btn-sm rounded-3 p-2">
                            Logout
                        </button>
                    </a>
                </div>
            </div>

            <!-- User Main Panel -->
            <div class="col-lg-9 col-12  rounded shadow-sm  p-0 d-flex flex-column align-items-center justify-content-start bg-light " id="Home">
                <!-- User Navigation Menu -->
                <div class="userNav w-100 sticky-top ">
                    <?php
                    require_once("../layout/userNav.php");
                    ?>
                </div>

                <!-- Main Panel -->
                <div class="row m-0  w-100 animate__animated animate__fadeInUp">
                    <!-- Overviews -->
                    <div class="col p-3  d-flex flex-column justify-content-around ">
                        <!-- Total User -->
                        <div class="card mx-md-3 m-2 shadow border-none rounded card-desp step-card">
                            <div class="m-3 text-start fw-bold fst-italic font-monospace text-muted">
                                Total User
                            </div>
                            <div class="card-body border-bottom-0">
                                <div class="fw-bold text-center fs-2 ">
                                    <!-- Insert PHP -->
                                    <div class="font-monospace ">
                                        <?php
                                        echo $_userCount;
                                        ?>
                                    </div>

                                </div>
                                <div class="w-100 text-end">
                                    <div class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-users-line"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Total Services -->
                        <div class="card mx-md-3 m-2 shadow border-none rounded card-desp step-card">
                            <div class="m-3 text-start fw-bold fst-italic font-monospace text-muted">
                                Total Services
                            </div>
                            <div class="card-body border-bottom-0">
                                <div class="fw-bold text-center fs-2 ">
                                    <!-- Insert PHP -->
                                    <div class="font-monospace ">
                                        <?php
                                        echo $_totalServices;
                                        ?>
                                    </div>

                                </div>
                                <div class="w-100 text-end">
                                    <div class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-keyboard"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Chart For Service_used -->
                    <div class="col-md-7 col-12 p-3 px-3 d-flex flex-column justify-content-around align-items-center ">
                        <!-- Canvas -->

                        <canvas id="LineChart" class="shadow-sm p-2 bg-white text-white w-100 h-100 border-0 rounded "></canvas>

                        <script>
                            // For Chart 1
                            userCount = [];
                            UserServiced_Count = [];
                            // For Chart 2
                            service_count = [];
                            service_name = [];
                            var barColors = [
                                "#D24F0E",
                                "#E2A20E",
                                "#6AD20E",
                                "#6AD20E",
                                "#14CF97",
                                "#1497CF",
                                "#1C14CF"
                            ];
                        </script>

                        <!-- Quering From Database -->
                        <?php
                        foreach ($_users as $user) {
                            $_users_id = $user["user_id"];
                            $_username = $user['username'];

                            $services_and_activitiesSql = "SELECT user_activities.*  FROM `user_activities` JOIN services ON services.service_id = user_activities.service_id WHERE user_activities.user_id ='$_users_id'";

                            $services_and_activities_statment = $db1->prepare($services_and_activitiesSql);
                            $services_and_activities_statment->execute();
                            // For Values
                            $totalForEach = $services_and_activities_statment->rowCount();

                        ?>
                            <script>
                                // Pushing The Data
                                userCount.push(<?php echo json_encode($totalForEach) ?>);
                                UserServiced_Count.push(<?php echo json_encode($_username) ?>);
                            </script>
                        <?php
                        }
                        ?>
                        <!-- Adding Services -->
                        <script>
                            var ctx = document.getElementById('LineChart').getContext('2d');

                            //data for the line chart
                            var data = {
                                labels: UserServiced_Count,
                                datasets: [{
                                    label: "Total Used Services",
                                    data: userCount,
                                    backgroundColor: "", // Line color
                                    borderWidth: 2, // Line width
                                    borderRadius: '5',
                                    outerWidth: '10',
                                    fill: "green" // To disable filling area under the line
                                }]
                            };

                            // Chart configuration
                            var options = {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                title: {
                                    display: true,
                                    text: "Products In the Inventory",
                                    weight: 'bold',
                                    position: 'bottom',
                                }
                            };

                            // Create the line chart
                            var LineChart = new Chart(ctx, {
                                type: 'bar',
                                data: data,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: false,
                                            grid: {
                                                display:false
                                            }
                                        },
                                        x:{
                                            grid: {
                                                display:false
                                            }
                                        }
                                    }
                                },
                            });
                        </script>
                    </div>
                </div>

                <!-- Banner Chart -->
                <div class="lh-lg  w-100 my-5 animate__animated animate__fadeInUp">
                    <!-- Chart Session -->
                    <div class="chart p-4 border m-3 bg-white shadow-sm rounded">
                        <canvas id="myLineChart" class=""></canvas>
                        <?php
                        // Services + User Activites Configuration
                        foreach ($_services as $service) {
                            $service_id = $service["service_id"];
                            $service_name = $service['service_name'];
                            $services_and_activities = "SELECT services.service_name, services.service_id, user_activities.*
                        FROM `user_activities` 
                        JOIN services ON services.service_id = user_activities.service_id 
                        WHERE user_activities.service_id =$service_id";
                            $services_and_activities_statment = $db1->prepare($services_and_activities);
                            $services_and_activities_statment->execute();
                            $totalForEach = $services_and_activities_statment->rowCount();
                        ?>
                            <script>
                                service_count.push(<?php echo json_encode($totalForEach) ?>);
                                service_name.push(<?php echo json_encode($service_name) ?>);
                            </script>
                        <?php
                        }
                        ?>
                        <!-- Chart Configuration -->
                        <script>
                            var ctx = document.getElementById('myLineChart').getContext('2d');
                            var data = {
                                labels: service_name,
                                datasets: [{
                                    label: 'Serives Used',
                                    data: service_count,
                                    borderColor: "black ", // Line color
                                    backgroundColor: "white",
                                    borderWidth: 3, // Line width
                                    fill: false, // To disable filling area under the line
                                
                                }]
                            };
                            // Chart configuration
                            var options = {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                            beginAtZero: true,
                                            display:false,
                                            grid: {
                                                display:false,
                                              
                                            },
                                        },
                                        x:{
                                            grid: {
                                                display:false
                                            },
                                            
                                        }
                                }
                            };

                            // Create the line chart
                            var myLineChart = new Chart(ctx, {
                                type: 'line',
                                data: data,
                                options: options
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>