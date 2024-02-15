<?php
// Database Connection - Code Review Done
require_once("../dbconnection.php");
if (empty($_SESSION['userName'])) {
    header('location: ./userDashboard.php');
}else{
// Getting User ID and Assigning User ID
if(!empty($_GET['userId'])){
    $_SESSION['userID'] = $_GET['userId'];
    $userID   = $_SESSION['userID'];

}else{
    $userID   = $_SESSION['userID'];
}

// Getting User Info
$userSql = "SELECT * FROM users WHERE user_id = $userID";
$users = $db1->query($userSql);
foreach ($users as $user) {
    $_username = $user['username'];
    $_userEmail = $user['user_email'];
    $_timeFormat = $user['updated_at'];
    $_created_at = $user['created_at'];//formating Date
    $dateObject = new DateTime($_timeFormat);
    $_updated_at = $dateObject->format('h:i:s');
    $_userRole = $user['role'];
}
// Accepting Requests
if (isset($_GET['btnSend'])) {
    $_insertRequest = $db1 -> prepare("INSERT INTO `requests`(`user_id`, `topic`, `detail_info`) VALUES ('$userID',:topic,:detail)");
    $_insertRequest -> bindParam(":topic",$_GET['userTopic']);
    $_insertRequest -> bindParam(":detail", $_GET['detailInfo']);
    $_insertRequest->execute();
    // echo $_insertRequest;

}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>

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
            <div class="col-lg-9 col-12 rounded  p-0 d-flex flex-column align-items-center justify-content-start bg-light" id="Home">
                <!-- User Navigation Menu -->
                <div class="userNav w-100 sticky-top bg-light">
                    <?php
                    require_once("../layout/userNav.php");
                    ?>
                </div>

                <!-- Main Panel -->

                <div class="w-100 d-flex row  m-0">
                    <div class="col d-flex flex-column justify-content-center align-items-center animate__animated animate__fadeInUp">
                        <!-- User Information -->
                        <div class="border-0 step-card m-2 p-3 rounded shadow-sm bg-white w-100 animate__animated animate__fadeInUp">
                            <div class="fs-5 fw-bold font-monospace">User Information</div>
                            <hr>
                            <!-- Name -->
                            <div class=" my-3 ">
                                <div class="text-muted my-1 ms-1 small fst-italic ">Name</div>
                                <div class="w-100 font-monospace ">
                                    <input type="text" value="<?php echo $_username;?>" class="form-control fst-italic text-muted" disabled>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class=" my-3 ">
                                <div class="text-muted my-1 ms-1 small fst-italic ">Email</div>
                                <div class="w-100 font-monospace">
                                    <input type="Email" value="<?php echo $_userEmail;?>" class="form-control fst-italic text-muted" disabled>
                                </div>
                            </div>
                            <!-- Role -->
                            <div class=" my-3 ">
                                <div class="text-muted my-1 ms-1 small fst-italic ">Role</div>
                                <div class="w-100 font-monospace">
                                    <input type="text" value="<?php echo strtoupper($_userRole);?>" class="form-control fst-italic text-muted" disabled>
                                </div>
                            </div>
                            <!-- Logout -->
                            <div class=" my-3 w-100 d-flex justify-content-center">
                               <a href="../assets/logout.php"><div class="btn btn-dark btn-sm">Logout</div></a>
                            </div>
                        </div>
                        <!-- Metadata -->
                        <div class="border-0 step-card m-2 p-3 rounded shadow-sm bg-white w-100 animate__animated animate__fadeInUp">
                            <div class="fs-5 fw-bold font-monospace">Active Time</div>
                            <hr>
                            <!-- Created At -->
                            <div class=" my-4 ">
                                <div class="text-muted my-1 ms-1 small fst-italic">Created </div>
                                <div class="w-100">
                                    <input type="Email" value="<?php echo $_created_at;?>" class="form-control fw-bold fst-italic text-muted" disabled>
                                </div>
                            </div>
                            <!-- Delete At -->
                            <div class=" my-4 ">
                                <div class="text-muted my-1 ms-1 small fst-italic">Last Active </div>
                                <div class="w-100">
                                    <input type="Email" value="<?php echo $_updated_at;?>" class="form-control fw-bold fst-italic text-muted" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-center align-items-center flex-column animate__animated animate__fadeInUp">
                        <div class="border m-1 p-3 bg-white shadow-sm rounded">
                        <h3 class=" fw-bold font-monospace">Reguest Form</h3>
                        <p class="my-4 text-muted fst-italic" align="justify">Request Admin to change one of your information or other cases</p>
                        <form method="GET" action="#">
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label fst-italic text-muted">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="userEmail" aria-describedby="emailHelp" disabled value="<?php echo $_userEmail ?>">
                            </div>
                            <!-- Topic -->
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label fst-italic text-muted">Topic</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="userTopic" aria-describedby="emailHelp" required>
                            </div>
                            <!-- Detail -->
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label fst-italic text-muted">Detail</label>
                                <textarea name="detailInfo" id="" cols="20" rows="5" class="form-control"  required></textarea>
                            </div>
                            <!-- Accept -->
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label text-muted font-monospace small" for="exampleCheck1">I Accept Terms And Conditions</label>
                            </div>
                            <button type="submit" class="btn btn-dark my-1" name="btnSend">  <i class="fa-solid fa-paper-plane text-white mx-1"></i></button>   
                        </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>