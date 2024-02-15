<?php
// Database Connection - Code Review - Done
require_once("../dbconnection.php");

// ---------- Getting Data Start ----------//

// User Login Verification
if (empty($_SESSION['userName'])) {

    header('location:../login.php');
    exit;
} else {

    // For User Information
    $_userId = $_SESSION['userId'];

    // Services Query
    $servicesSql = "SELECT * FROM `services`";
    $serviceStatement = $db1->query($servicesSql);
    $_services = $serviceStatement->fetchAll(PDO::FETCH_ASSOC);

    // Users Query
    $userSql = "SELECT * FROM `users` WHERE user_id = '$_userId'";
    $_users = $db1->query($userSql);
    foreach ($_users as $user) {
        $_userAmount = $user["amount"];
    }

    // Transtions Query
    $activities_sql = "SELECT * FROM `user_activities` WHERE user_id = $_userId";
    $total_activities = $db1->prepare($activities_sql);
    $total_activities->execute();
    $_activites = $total_activities->rowCount();
}

// ---------- Getting Data End  ----------//

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <!-- Chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row h-100">
            <!-- Main Navigation -->
            <div class="col-lg-3 d-none d-lg-flex d-flex justify-content-between flex-column bg-white border">
                <!-- Navigation -->
                <div class="position-sticky top-0 mx-auto">
                    <!-- Panel -->
                    <div class="d-flex w-100 mb-auto flex-column justify-content-center align-items-center ">
                        <!-- Topic -->
                        <div class="w-100 text-center my-3 fw-bold ">
                            <a href="" onClick="window.location.reload();" class="text-decoration-none text-dark">
                                <h5 class="fs-4 fw-bolder">Pay Key</h5>
                            </a>

                        </div>
                        <!-- Home -->
                        <a href="./userDashboard.php#Home" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-solid fa-file-contract me-2"></i> Dashboard
                            </div>
                        </a>
                        <!-- Services -->
                        <a href="./userDashboard.php#Services" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-solid fa-comment-dollar me-2"></i> Services
                            </div>
                        </a>
                        <!-- Transcation -->
                        <a href="./userActivities.php" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-brands fa-creative-commons-sampling me-2"></i> Activites
                            </div>
                        </a>
                        <!-- Setting -->
                        <a href="./userSetting.php?userId=<?php echo $_userId; ?>" class="text-decoration-none w-100 mb-2">
                            <div class="w-100 text-start px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover">
                                <i class="fa-solid fa-user-gear me-2"></i> Setting
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Logout Butom -->
                <div class="w-100 p-2  text-center position-sticky fixed-bottom top-0">
                    <a href="../assets/logout.php" class="text-decoration-none">
                        <button class="btn btn-dark btn-sm rounded-3 p-2">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </a>
                </div>
            </div>

            <!-- User Main Panel -->
            <div class="col-lg-9 col-12  rounded shadow-sm  p-0 d-flex flex-column align-items-center justify-content-center bg-light " id="Home">
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
                        <!-- Total Amount -->
                        <div class="card mx-md-3 m-2 shadow border-none rounded card-desp">
                            <div class="m-3 text-start fw-bold fst-italic font-monospace text-muted">
                                Total Amount
                            </div>
                            <div class="card-body border-bottom-0">
                                <div class="fw-bold text-center fs-2 ">
                                    <!-- Insert PHP -->
                                    <div class="font-monospace">
                                        $
                                        <?php
                                        echo $_userAmount;
                                        ?>
                                    </div>

                                </div>
                                <div class="w-100 text-end">
                                    <div class="btn btn-sm btn-primary">
                                        <i class="fa-regular fa-credit-card"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Total Transatction -->
                        <div class="card mx-md-3 m-2 shadow border-none rounded card-desp">
                            <div class="m-3 text-start fw-bold fst-italic font-monospace text-muted">
                                Total Transatction
                            </div>
                            <div class="card-body border-bottom-0">
                                <div class="fw-bold text-center fs-2 ">
                                    <!-- Insert PHP -->
                                    <div class="font-monospace">
                                        <?php
                                        echo $_activites;
                                        ?>
                                    </div>

                                </div>
                                <div class="w-100 text-end">
                                    <div class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-list-check"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Chart For Used Service -->
                    <div class="col-md-7 col-12 p-3 px-3 d-flex flex-column justify-content-around align-items-center">
                        <!-- Canvas -->

                        <canvas id="LineChart" class="shadow-sm p-2 bg-white w-100 h-100 border rounded"></canvas>
                        <script>
                            service_count = [];
                            service_name = [];
                            var barColors = [
                                "#810FB4",
                                "#8183B4",
                                "#81eFB4",
                                "#81s8FC4",
                                "#2D4596",
                                "#9AD0C2",
                                "#2D9596"
                            ];
                        </script>
                        <!-- Quering From Database -->
                        <?php
                        foreach ($_services as $service) {
                            $service_id = $service["service_id"];
                            $service_name = $service['service_name'];
                            $services_and_activities = "SELECT services.service_name, services.service_id, user_activities.*
                                                        FROM `user_activities` 
                                                        JOIN services ON services.service_id = user_activities.service_id 
                                                        WHERE user_activities.user_id = $_userId AND user_activities.service_id =$service_id";
                            $services_and_activities_statment = $db1->prepare($services_and_activities);
                            $services_and_activities_statment->execute();
                            // For values
                            $totalForEach = $services_and_activities_statment->rowCount();

                        ?>
                            <script>
                                // Pushing Data
                                service_count.push(<?php echo json_encode($totalForEach) ?>);
                                service_name.push(<?php echo json_encode($service_name) ?>);
                            </script>
                        <?php
                        }
                        ?>

                        <script>
                            var ctx = document.getElementById('LineChart').getContext('2d');

                            // data for the line chart
                            var data = {
                                labels: service_name,
                                datasets: [{
                                    label: "Total Used Services",
                                    data: service_count,
                                    backgroundColor: "", // Line color
                                    borderWidth: 1, // Line width
                                    borderRadius: 10,
                                    fill: "blue" // To disable filling area under the line
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
                                    text: "",
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
                                                display: false
                                            }
                                        },
                                        x: {
                                            grid: {
                                                display: false
                                            }
                                        }
                                    }
                                },
                            });
                        </script>
                    </div>
                </div>

                <!-- Banner -->
                <div class="lh-lg  w-100 mb-5 animate__animated animate__fadeInUp">
                    <!-- Chart Session -->
                    <div class="chart p-4 border m-3 bg-white shadow-sm rounded ">
                        <canvas id="myLineChart" class=""></canvas>
                        <!-- Chart Configuration -->
                        <script>
                            var ctx = document.getElementById('myLineChart').getContext('2d');
                            var data = {
                                labels: service_name,
                                datasets: [{
                                    label: 'My Line Chart',
                                    data: service_count,
                                    borderColor: "dark", // Line color
                                    backgroundColor: barColors,
                                    borderWidth: 1, // Line width
                                    fill: false // To disable filling area under the line
                                }]
                            };

                            // Chart configuration
                            var options = {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        display: false,
                                        grid: {
                                            display: false,

                                        },
                                    },
                                    x: {
                                        display: false,
                                        grid: {
                                            display: false
                                        },

                                    }
                                }
                            };

                            // Create the line chart
                            var myLineChart = new Chart(ctx, {
                                type: 'polarArea',
                                data: data,
                                options: options
                            });
                        </script>
                    </div>
                </div>

                <!-- Services -->
                <div class="services shadow-sm  bg-light  shadow w-100 my-1 " id="Services">
                    <div class="mx-3">
                        <div class="my-5">
                            <h3>Services</h3><br>
                            <div class=" ">
                                <div class=" d-flex  px-2 rounded">
                                    <div class="col-4 col-md-2 fw-bold  text-start text-muted font-monospace fst-italic">Name</div>
                                    <div class="col-6 fw-bold text-start d-none text-muted d-md-block fst-italic">Remark</div>
                                    <div class="col-md-1 col-4 fw-bold text-muted  text-md-start text-center fst-italic">fee</div>

                                </div>
                                <?php
                                $a;
                                foreach ($_services as $service) {

                                    $a = $service['service_id'];
                                ?>
                                    <div class="w-100 my-3 d-flex  py-3 p-2 border bg-white shadow-sm rounded-3 justify-content-center align-items-center animate__animated animate__fadeInUp">
                                        <div class="col-4 col-md-2 fw-bold  font-monospace">
                                        <i class="fa-solid fa-bars-staggered d-none d-lg-inline"></i>
                                            <?php
                                            echo $service['service_name']
                                            ?>
                                        </div>
                                        <div class="col-6 d-none fst-italic text-muted fw-medium d-md-block ">
                                            <?php
                                            echo $service['remark']
                                            ?>
                                        </div>
                                        <div class="col-4 fw-bold col-md-1 fst-italic text-md-start text-center text-muted">
                                            $
                                            <?php
                                            echo $service['fees']
                                            ?>
                                        </div>

                                        <div class="col text-end">
                                            <a href="./toForm.php?service_id=<?php echo $a; ?>&userId=<?php echo $_userId; ?>">
                                                <!-- Action  -->
                                                <button class="btn btn-danger" name="">Apply</button>
                                            </a>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>


                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>