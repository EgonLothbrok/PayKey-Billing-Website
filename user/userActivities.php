<?php
// Database Connection - Code Review Done
require_once("../dbconnection.php");

// ---------- Getting Data Start ----------//

// User Login Verification
if (empty($_SESSION['userName'])) {

    header('location:../login.php');
    exit;
    
} else {

    // For User Information
    $_userId = $_SESSION['userId'];

    // Getting Services
    $services_sql = "SELECT service_id,service_name FROM `services`";
    $service_statement = $db1->query($services_sql);
    $services = $service_statement->fetchAll(PDO::FETCH_ASSOC);

    // Getting Services Types
    if (isset($_GET['btnSub']) && $_GET['btnSub'] != "clear") {
        $service_id = $_GET['btnSub'];
        // With Service Types
        $activities_sql = "SELECT users.username,services.service_name, user_activities.*
                            FROM user_activities
                            JOIN users ON user_activities.user_id = users.user_id
                            JOIN services ON user_activities.service_id = services.service_id
                            WHERE user_activities.user_id = '$_userId' && user_activities.service_id='$service_id'";
        $activities_statement = $db1->query($activities_sql);
        $_activites = $activities_statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Getting ALL
        $activities_sql = "SELECT users.username,services.service_name, user_activities.*
                            FROM user_activities
                            JOIN users ON user_activities.user_id = users.user_id
                            JOIN services ON user_activities.service_id = services.service_id
                            WHERE user_activities.user_id = '$_userId'";
        $activities_statement = $db1->query($activities_sql);
        $_activites = $activities_statement->fetchAll(PDO::FETCH_ASSOC);
    }
    $_activties_count = count($_activites);
}

// ---------- Getting Data End ----------//

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>activites</title>

</head>

<body>
    <div class="container-fluid">
        <div class="row h-100  ">
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
            <div class="col-lg-9 col-12 rounded  p-0 d-flex flex-column align-items-center justify-content-start bg-light" id="ome">
                <!-- User Navigation Menu -->
                <div class="userNav w-100 sticky-top bg-light">
                    <?php
                    require_once("../layout/userNav.php");
                    ?>
                </div>

                <!-- Main Panel -->

                <div class="w-100 bg-l px-2 bg-light my-3">
                <div class="w-100 d-flex my-3 justify-content-between">
                            <!-- Activities Count -->
                            <div class="  btn shadow-sm border font-monospace fw-bold bg-white">
                                Count : 
                                <?php
                                echo $_activties_count;
                                ?>
                            </div>                            
                        </div>
                    <div class=" d-flex  px-1 rounded">
                        <div class="col-2  fw-bold  text-start ms-1  d-none  d-lg-block font-monospace fst-italic text-muted" >Service</div>
                         <div class="col  fw-bold text-start  d-none  d-lg-block font-monospace fst-italic text-muted">fee</div>
                        <div class="col-4 col-md-2 fw-bold text-start d-none  d-lg-block font-monospace fst-italic text-muted">Amount</div>
                        <div class="col-4 fw-bold text-start  d-none  d-lg-block font-monospace fst-italic text-muted">Note</div>
                        <div class="col col-lg-2 fw-bold text-end ">
                            <form action="#" method="get" class="m-0 p-0">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Services
                                    </button>
                                    <ul class="dropdown-menu p-0" name="Services">

                                        <!-- Services_Assigning_services_id -->
                                        <?php
                                        foreach ($services as $service) {
                                        ?>
                                            <li class="w-100 btn-services-dp text-center py-2 rounded">
                                                <button class="btn btn-sm btn-services-dp fw-semibold text-muted" type="submit" value="<?php echo $service['service_id'] ?>" name="btnSub">
                                                    <?php
                                                    echo $service['service_name']
                                                    ?>
                                                </button>
                                            </li>

                                        <?php
                                        }
                                        ?>
                                        <li class="w-100 btn-services-dp text-center py-2 rounded">
                                            <button class="btn btn-outline-dark btn-sm" type="submit" value="clear" name="btnSub">
                                                clear
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Time -->


                            </form>
                        </div>

                    </div>
                

                    <?php
                    foreach ($_activites as $activity) {
                        $test = $activity['created_at'];
                        $dateObject = new DateTime($test);
                        $formattedDate = $dateObject->format('Y-m-d');

                    ?>
                        <div class="w-100 my-2 d-flex  py-4 p-2  bg-white shadow-sm border   rounded-3 justify-content-between justify-content-lg-center align-items-center animate__animated animate__fadeInUp">

                            <div class="col col-md-2   fw-bold font-monospace fst-italic ">
                                <?php
                                echo $activity['service_name'];
                                ?>
                            </div>
                           
                           
                            <div class="col  fw-semibold text-muted ">
                                $
                                <?php
                                echo $activity['fees'];
                                ?>
                            </div>
                            <div class="col-md-2 col-4 fw-semibold text-muted text-start">
                                $
                                <?php
                                echo $activity['amount'];
                                ?>
                            </div>
                            <div class="col-4  d-none fw-medium d-md-block fst-italic text-muted">
                                
                                <?php
                                echo $activity['note'];
                                ?>
                            </div>
                            <div class=" col-md-2 fw-bold fst-italic text-muted ">
                                <?php
                                echo $formattedDate;
                                ?>
                            </div>

                            
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</body>

</html>