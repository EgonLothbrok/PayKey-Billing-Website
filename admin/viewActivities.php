<?php
// Database Connection - Code Review - Done
require_once("../dbconnection.php");

// ---------- Getting Data Start ----------//

// User Login Verification
if (empty($_SESSION['userName'])) {

    header('location:../login.php');
} else {

    // For User Information
    $_userId = $_SESSION['userId'];

    // Getting Services
    $services_sql = "SELECT service_id,service_name FROM `services`";
    $services_statement = $db1->query($services_sql);
    $_services = $services_statement->fetchAll(PDO::FETCH_ASSOC);

    // Getting Users
    $user_sql = "SELECT * FROM `users` WHERE role = 'client' ";
    $usersStatement = $db1->query($user_sql);
    $_users = $usersStatement->fetchAll(PDO::FETCH_ASSOC);

    // Accepting Date
    if (!empty($_GET['Keyword'])) { // Searching With Date
        
        $date = $_GET['Keyword'];
        $activities_sql = "SELECT users.username,services.service_name, user_activities.*
                            FROM user_activities
                            JOIN users ON user_activities.user_id = users.user_id
                            JOIN services ON user_activities.service_id = services.service_id
                            WHERE DATE(user_activities.created_at)='$date'";
        $activities_statement = $db1->query($activities_sql);
        $_activites = $activities_statement->fetchAll(PDO::FETCH_ASSOC);
        $activities_count = $activities_statement->rowCount();

    } elseif (isset($_GET['btnSub']) && $_GET['btnSub'] != "clear") { // Searching With Services Type
        
        $service_id = $_GET['btnSub'];
        $activities_sql = "SELECT users.username,services.service_name, user_activities.*
                            FROM user_activities
                            JOIN users ON user_activities.user_id = users.user_id
                            JOIN services ON user_activities.service_id = services.service_id
                            WHERE user_activities.service_id='$service_id'";
        $activities_statement = $db1->query($activities_sql);
        $_activites = $activities_statement->fetchAll(PDO::FETCH_ASSOC);
        $activities_count = $activities_statement->rowCount();

    } elseif (isset($_GET['btnName']) && $_GET['btnName'] != "clear") { // Searching With User Name DropDown

        
        $user_id = $_GET['btnName'];
        $activities_sql = "SELECT users.username,services.service_name, user_activities.*
                           FROM user_activities
                           JOIN users ON user_activities.user_id = users.user_id
                           JOIN services ON user_activities.service_id = services.service_id
                           WHERE user_activities.user_id='$user_id'";
        $activities_statement = $db1->query($activities_sql);
        $_activites = $activities_statement->fetchAll(PDO::FETCH_ASSOC);
        $activities_count = $activities_statement->rowCount();

    } else { // Quering Out All
        
        
        $activities_sql = "SELECT users.username,services.service_name, user_activities.*
        FROM user_activities
        JOIN users ON user_activities.user_id = users.user_id
        JOIN services ON user_activities.service_id = services.service_id";
        $activities_statement = $db1->query($activities_sql);
        $_activites = $activities_statement->fetchAll(PDO::FETCH_ASSOC);
        $activities_count = $activities_statement->rowCount();

    }
}

// ---------- Getting Data End  ----------//
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>

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
            <div class="col-lg-9 col-12 rounded  p-0 d-flex flex-column align-items-center justify-content-start bg-light" id="ome">
                <!-- User Navigation Menu -->
                <div class="userNav w-100 sticky-top bg-light">
                    <?php
                    require_once("../layout/userNav.php");
                    ?>
                </div>

                <!-- Main Panel -->

                <div class="w-100 bg-l px-4 bg-light my-3">
                    <div class="w-100">
                        <p class="d-inline-flex gap-1 text-end my-0">
                        <div class="w-100 d-flex justify-content-between">
                            <!-- Activities Count -->
                            <div class="  btn shadow-sm border font-monospace fw-bold bg-white">
                                Count : 
                                <?php
                                echo $activities_count;
                                ?>
                            </div>
                            <!-- Toggle Button -->
                            <a class="btn btn-dark rounded d-flex justify-content-between  rounded-pill  align-items-center" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa-solid fa-caret-down"></i>
                            </a>
                        </div>

                        </p>
                        <!-- Searching filters -->
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body bg-light border-0">
                                <div class="d-flex justify-content-center row">
                                    <!-- By Dates -->
                                    <form action="#" method="GET" class="d-flex col-auto col-md-7 col-lg-5  mx-6  mx-md-1">
                                        <input type="text" class="form-control mx-1" name="Keyword" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a valid date in the format yyyy-mm-dd" placeholder="yyy-mm-dd">
                                        <button class="btn btn-dark" type="submit" name="searchName"><i class="fa-solid fa-magnifying-glass"></i></button>

                                    </form>
                                    <!-- By Users -->
                                    <form action="#" method="GET" class="m-0 p-0 col-2 col-md-auto d-flex justify-content-center">
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-id-card "></i>
                                            </button>
                                            <ul class="dropdown-menu p-0" name="Services">

                                                <!-- Services_Assigning_services_id -->
                                                <?php
                                                foreach ($_users as $user) {
                                                ?>
                                                    <li class="w-100 btn-services-dp text-center py-2 rounded">
                                                        <button class="btn btn-sm btn-services-dp fw-semibold text-muted" type="submit" value="<?php echo $user['user_id'] ?>" name="btnName">
                                                            <?php
                                                            echo $user['username'];
                                                            ?>
                                                        </button>
                                                    </li>

                                                <?php
                                                }
                                                ?>
                                                <li class="w-100 btn-services-dp text-center py-2 rounded">
                                                    <button class="btn btn-outline-dark btn-sm" type="submit" value="clear" name="btnName">
                                                        clear
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>



                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Labels -->
                    <div class=" d-flex  px-1 align-items-center ">
                        <div class="col-1  d-lg-flex d-none mx-1 fw-bold text-start  text-muted fst-italic  font-monospace">User</div>
                        <div class="col-2  d-lg-flex d-none fw-bold text-start text-muted  fst-italic  font-monospace">Service</div>
                        <div class="col-1 d-lg-flex d-none fw-bold text-start text-muted fst-italic  font-monospace" >Fee</div>
                        <div class="col-2  d-lg-flex d-none fw-bold text-start text-muted fst-italic  font-monospace">Amount</div>
                        <div class="col-3 d-lg-flex d-none fw-bold text-start text-muted  fst-italic  font-monospace">Note</div>
                        <div class="col fw-bold  text-end">
                            <!-- Service Filters -->
                            <form action="#" method="get" class="m-0 p-0">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Services
                                    </button>
                                    <ul class="dropdown-menu p-0" name="Services">

                                        <!-- Services_Assigning_services_id -->
                                        <?php
                                        foreach ($_services as $service) {
                                        ?>
                                            <li class="w-100 text-center py-2 rounded">
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
                            </form>
                        </div>

                    </div>


                    <?php
                    // Activties Formatted Query
                    foreach ($_activites as $activity) {
                        $test = $activity['created_at'];
                        $dateObject = new DateTime($test);
                        $formattedDate = $dateObject->format('Y-m-d');
                        $formattedDay = $dateObject->format('M');

                    ?>
                        <div class="w-100 my-2 d-flex  py-4 p-2  bg-white shadow-sm border   rounded-3 justify-content-between justify-content-lg-center align-items-center animate__animated animate__fadeInUp">
                            <!-- Users -->
                            <div class="col-2 col-md-1 mx-1  fw-bold  fst-italic text-muted  ">
                                <?php
                                echo $activity['username'];
                                ?>
                            </div>
                            <!-- Services -->
                            <div class="col-2    fw-bold   ">
                                <?php
                                echo $activity['service_name'];
                                ?>
                            </div>
                            <!-- Fees -->
                            <div class="col-1 fw-semibold  text-muted d-none d-sm-block">
                                $
                                <?php
                                echo $activity['fees'];
                                ?>
                            </div>
                            <!-- Amount -->
                            <div class="col-2  col-md-2  fw-bold  fst-italic text-start">
                                $
                                <?php
                                echo $activity['amount'];
                                ?>
                            </div>
                            <!-- Note -->
                            <div class="col-4  d-none fw-medium d-md-block fst-italic text-muted">

                                <?php
                                echo $activity['note'];
                                ?>
                            </div>
                            <!-- Date -md -->
                            <div class="col-2  d-md-block d-none fw-bold fst-italic ">
                                <?php
                                echo $formattedDate;
                                ?>
                            </div>
                            <!-- Date -sm -->
                            <div class="col-2 d-md-none d-block  fw-bold fst-italic text-muted">
                                <?php
                                echo $formattedDay;
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