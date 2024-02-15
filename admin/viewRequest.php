<?php
// Database Connection - Code Review Done
require_once("../dbconnection.php");

// ---------- Getting Data Start ----------//

// User Login Verification
if (empty($_SESSION["userName"])) {
    header('location:../login.php');
} else {

    // Getting Users
    $users_sql = "SELECT * FROM `users` WHERE role = 'client' ";
    $usersStatement = $db1->query($users_sql);
    $_users = $usersStatement->fetchAll(PDO::FETCH_ASSOC);

    // Seraching With Users
    if (isset($_GET['btnName']) && $_GET['btnName'] != "clear") {
        $user_id = $_GET['btnName'];
        $request_sql = $db1->prepare("SELECT requests.*, users.username FROM requests JOIN users ON users.user_id = requests.user_id WHERE requests.user_id=$user_id;");
        $request_sql->execute();
        $_requests = $request_sql->fetchAll(PDO::FETCH_ASSOC);
    } else {

        $request_sql = $db1->prepare("SELECT requests.*, users.username FROM requests JOIN users ON users.user_id = requests.user_id;");
        $request_sql->execute();
        $_requests = $request_sql->fetchAll(PDO::FETCH_ASSOC);

    }
}

// ---------- Getting Data End ----------//
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

                <div class="w-100 bg-l px-2 bg-light my-3 ">
                    <div class=" d-flex  px-1  align-items-center">
                        <div class="col-2 col-md-1  mx-4 mx-md-1  fw-bold   text-start d-none  d-lg-block">User</div>
                        <div class=" col-2 fw-bold text-start text-muted d-none  d-lg-block">Topic</div>
                        <div class="col-4  fw-bold text-start text-muted d-none  d-lg-block">Detail</div>
                        <div class="col-1  col-md-2 fw-bold text-start text-muted d-none  d-lg-block">Created</div>
                        <div class=" col text-end">
                            <form action="#" method="get" class="m-0 p-0">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-users"></i>
                                    </button>
                                    <ul class="dropdown-menu p-0" name="users">

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

                                <!-- Time -->


                            </form>
                        </div>
                    </div>


                    <?php
                    // Start Querying
                    foreach ($_requests as $request) {
                        $test = $request['created_at'];
                        $dateObject = new DateTime($test);
                        $formattedDate = $dateObject->format('Y-m-d');

                    ?>
                    <!-- User's Requests -->
                        <div class="w-100 my-2 d-flex  py-4 p-2  bg-white shadow-sm border   rounded-3 justify-content-between justify-content-lg-center align-items-center  animate__animated animate__fadeInUp">
                            <div class="col-2 col-md-1 mx-1  fw-bold   ">
                                <?php
                                echo $request['username'];
                                ?>
                            </div>
                            <div class="col-md-2 col text-muted fst-italic    fw-bold   ">
                                <?php
                                echo $request['topic'];
                                ?>
                            </div>
                            <div class="col-md-4 col fw-semibold  text-muted d-none d-sm-block">
                                <?php
                                echo $request['detail_info'];
                                ?>
                            </div>
                            <div class="col-md-2 col fw-semibold text-muted text-start">
                                <?php
                                echo $formattedDate;
                                ?>
                            </div>
                            <div class="col text-end">
                                <a href="../assets/deleteRequest.php?id=<?php echo $request['req_id']; ?>">
                                    <div class="btn btn-danger rounded-pill">
                                    <i class="fa-solid fa-x"></i>
                                    </div>
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
</body>

</html>