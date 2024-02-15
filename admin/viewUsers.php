<?php
// Database Connection - Code Review Done
require_once("../dbconnection.php");

// ---------- Getting Data Start ----------//

// User Login Verification
if (!empty($_SESSION["userId"])) {

    $_userId = $_SESSION['userId'];

    // Accepting Username
    if (isset($_GET['searchName']) && !empty($_GET['Keyword'])) {

        $keyword = $_GET['Keyword'];
        $user_sql = "SELECT * FROM `users` WHERE username LIKE :keyword";
        $stmt = $db1->prepare($user_sql);
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        $_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_users_count = count($_users);

    } else { //Users

        $user_sql = "SELECT * FROM `users`";
        $usersStatement = $db1->query($user_sql);
        $_users = $usersStatement->fetchAll(PDO::FETCH_ASSOC);
        $_users_count = count($_users);
    }

    // Validation User Count
    if ($_users_count != 0) {
        // Return Empty Error Message
        $errorMessage = "";
    } else {
        // Return Empty Error Message
        $errorMessage = "False";
    }

} else {

    header('location:../login.php');

}

// ---------- Getting Data Start ----------//

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
                    <!-- Searching Filters Container -->
                    <div class="w-100">
                            <p class="d-inline-flex gap-1 text-end my-0">
                                <div class="w-100 d-flex justify-content-between">
                                <!-- User Count -->
                                <div class="  btn shadow-sm border font-monospace fw-bold bg-white">
                                    Count : 
                                    <?php
                                    echo $_users_count;
                                    ?>
                                </div>
                                <a class="btn btn-dark rounded d-flex justify-content-between  rounded-pill  align-items-center" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa-solid fa-caret-down"></i>
                                </a>
                                </div>

                            </p>
                            <div class="collapse" id="collapseExample">
                            <div class="card card-body bg-light border-0">
                                <div class="d-flex justify-content-center row">
                                    <!-- By Dates -->
                                    <form action="#" method="GET" class="d-flex col-auto col-md-7 col-lg-5  mx-6  mx-md-1">
                                        <input type="text" class="form-control mx-1" name="Keyword"  title="Please enter a valid username" placeholder="Enter Your Name">
                                        <button class="btn btn-dark" type="submit" name="searchName"><i class="fa-solid fa-magnifying-glass"></i></button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" d-flex  px-1 rounded">
                        <div class="col-1  d-lg-flex d-none mx-1 fw-bold text-start  text-muted fst-italic  font-monospace">User</div>
                        <div class="col-2 ms-5  d-lg-flex d-none fw-bold text-start  text-muted fst-italic  font-monospace">Email</div>
                        <div class="col-1  d-lg-flex d-none fw-bold text-start  text-muted fst-italic  font-monospace">Role</div>
                        <div class="col-2  d-lg-block d-none fw-bold text-lg-center text-start text-muted fst-italic  font-monospace">Pocket</div>
                        <div class="col-3  d-lg-block d-none fw-bold text-center  text-muted fst-italic  font-monospace">Created</div>
                        <div class="col  d-lg-block d-none fw-bold text-end  text-muted fst-italic  font-monospace">Action</div>

                    </div>


                    <?php
                    foreach ($_users as $user) {
                        $test = $user['created_at'];
                        $dateObject = new DateTime($test);
                        $formattedDate = $dateObject->format('Y-m-d');

                    ?>
                    <!-- Users Searching -->
                        <div class="w-100 my-2 d-flex  py-4 p-2  bg-white shadow-sm border   rounded-3 justify-content-between justify-content-lg-center align-items-center animate__animated animate__fadeInUp">
                            <div class="col-2 col-md-1 mx-1  fw-bold font-monospace text-muted   ">
                                <?php
                                echo $user['username'];
                                ?>
                            </div>
                            <div class=" col  d-none d-md-block  fw-bold   ">
                                <?php
                                echo $user['user_email'];
                                ?>
                            </div>
                            <div class="col-md-1 col  text-muted font-monospace text-center text-md-start  fw-bold   ">
                                <?php
                                echo $user['role'];
                                ?>
                            </div>
                            <div class="col-md-2 col text-lg-center text-center fw-semibold  text-muted d-none d-sm-block">
                                $
                                <?php
                                echo $user['amount'];
                                ?>
                            </div>
                            <div class="col-3 d-none d-lg-block fw-semibold text-muted text-center">
                                <?php
                                echo $formattedDate;
                                ?>
                            </div>
                            <div class="col text-end">
                                <div class="dropup-center dropup">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-up-right-from-square"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../assets/editUser.php?id=<?php echo $user['user_id']; ?>">Edit</a></li>
                                        <li><a class="dropdown-item" href="../assets/deleteUser.php?id=<?php echo $user['user_id']; ?>">Delete</a></li>
                                    </ul>
                                </div>
                            </div>



                        </div>

                    <?php
                    }
                    ?>
                    <div class="w-100 text-center my-4">

                        <?php
                        if (!empty($errorMessage)) {
                        ?>
                            <div class="w-100 border bg-white rounded py-3 shadow-sm fw-bold text-muted animate__animated animate__fadeInUp">
                                There is no user with this email
                            </div>
                        <?php
                        }

                        ?>

                    </div>
                    <div class="text-end animate__animated animate__fadeInUp">
                        <div>
                            <a href="../assets/addUser.php">
                                <button class="btn btn-primary p-3 rounded-pill"><i class="fa-solid fa-plus"></i></button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>