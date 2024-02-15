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

    // Getting Primary Services
    $primary_services_sql = "SELECT * FROM `services` WHERE category_id = 1";
    $primary_services_statement = $db1->query($primary_services_sql);
    $_primary_services = $primary_services_statement->fetchAll(PDO::FETCH_ASSOC);
    $primary_services_count = count($_primary_services);

    // Getting Billing Services
    $billing_services_sql = "SELECT * FROM `services` WHERE category_id = 2";
    $billing_services_statement = $db1->query($billing_services_sql);
    $_billing_services = $billing_services_statement->fetchAll(PDO::FETCH_ASSOC);
    $billing_services_count = count($_billing_services);

    // Getting Category
    $categories_sql = "SELECT * FROM `categories`";
    $categories_statement = $db1->query($categories_sql);
    $_categories = $categories_statement->fetchAll(PDO::FETCH_ASSOC);
    $categories_count = count($_categories);
}

// ---------- Getting Data End ----------//

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>


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
            <div class="col-lg-9 col-12 rounded  p-0 d-flex flex-column align-items-center justify-content-start bg-light ">
                <!-- User Navigation Menu -->
                <div class="userNav w-100 sticky-top bg-light">
                    <?php
                    require_once("../layout/userNav.php");
                    ?>
                </div>

                <!-- Main Panel -->
                <!-- Primary Services Section -->
                <div class="w-100 bg-l my-5 px-2 bg-light ">
                    <!-- Primary Services Header -->
                    <div class="w-100 my-4 px-3  d-flex justify-content-between">
                        <div class="btn text-muted icon shadow-sm border font-monospace fw-bold bg-white fst-italic">Primary Services</div>
                        <!-- Primary Services Count -->
                        <div>
                            <button class="btn shadow-sm border font-monospace fw-bold bg-white">
                                <?php
                                echo $primary_services_count;
                                ?>
                            </button>
                        </div>
                    </div>
                    <!-- Primary Services -->
                    <div class="row m-0">
                        <?php
                        foreach ($_primary_services as $service) {

                        ?>
                            <div class="col d-flex justify-content-center my-2">
                                <div class="card shadow-sm" style="width: 18rem;">
                                    <img src="../imgs/services.gif" class="card-img-top " height="160px" alt="...">
                                    <div class="card-body">
                                        <p class="card-title fw-bold font-monospace fs-5"><?php echo $service['service_name'] ?></p>
                                        <p class="card-text text-muted fst-italic small"><?php echo $service['remark'] ?></p>
                                    </div>
                                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="btn btn-sm btn-danger p-0 px-1 fw-bold ">
                                                Primary Services
                                            </div>
                                            <div class="btn btn-sm btn-dark  p-0 px-1 fw-bold ">
                                                <?php
                                                echo '$' . $service['fees'];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-pen-to-square "></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="../assets/editServices.php?id=<?php echo $service['service_id'] ?>">Edit</a></li>
                                                <li><a class="dropdown-item" href="../assets/deleteService.php?id=<?php echo $service['service_id'] ?>">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                    </div>
                </div>
                <!-- Billing Section -->
                <div class="w-100 bg-l my-5 px-2 bg-light ">
                    <!-- Billing Services Header -->
                    <div class="w-100 my-4 px-3 d-flex justify-content-between">
                        <div class="btn text-muted icon shadow-sm border font-monospace fw-bold bg-white fst-italic">Billing Services</div>
                        <!-- Billing Services Count -->
                        <div>
                            <button class="btn shadow-sm border font-monospace fw-bold bg-white">
                                <?php
                                echo $billing_services_count;
                                ?>
                            </button>
                        </div>
                    </div>
                    <!-- Billing Services -->
                    <div class="row m-0">
                        <?php
                        foreach ($_billing_services as $service) {
                        ?>
                            <div class="col d-flex justify-content-center my-2 ">
                                <div class="card shadow-sm" style="width: 18rem;">
                                    <img src="../imgs/billing.gif" class="card-img-top " height="160px" alt="...">
                                    <div class="card-body">
                                        <p class="fs-5 font-monospace fw-bold"><?php echo $service['service_name'] ?></p>
                                        <p class="card-text text-muted fst-italic"><?php echo $service['remark'] ?></p>
                                    </div>
                                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="btn btn-sm btn-success  p-0 px-1 fw-bold ">
                                                Billing Services
                                            </div>
                                            <div class="btn btn-sm btn-dark  p-0 px-1 fw-bold ">
                                                <?php
                                                echo '$' . $service['fees'];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-pen-to-square "></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="../assets/editServices.php?id=<?php echo $service['service_id'] ?>">Edit</a></li>

                                                <li><a class="dropdown-item" href="../assets/deleteService.php?id=<?php echo $service['service_id'] ?>">Delete</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                    </div>
                </div>
                <!-- Categories Section -->
                <div class="w-100 bg-l my-5 px-2 bg-light ">
                    <!-- Categories -->
                    <div class="w-100 my-4 px-3 d-flex justify-content-between">
                    <div class="btn text-muted icon shadow-sm border font-monospace fw-bold bg-white fst-italic">Categories</div>
                      <!-- Billing Services Count -->
                        <div>
                            <button class="btn shadow-sm border font-monospace fw-bold bg-white">
                                <?php
                                echo $categories_count;
                                ?>
                            </button>
                        </div>
                    </div>
                    <!-- Categories -->
                    <div class="row m-0">
                        <?php
                        foreach ($_categories as $category) {
                            $test = $category['created At'];
                            $dateObject = new DateTime($test);
                            $formattedDate = $dateObject->format('Y-m-d');
                        ?>
                            <div class="col d-flex justify-content-center my-2 ">
                                <div class="card shadow-sm" style="width: 18rem;">
                                    <img src="../imgs/category.gif" class="card-img-top " height="160px" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title font-monospace fw-bold"><?php echo $category['category_name'] ?></h5>
                                        <p class="card-text text-muted fst-italic"><?php echo $category['remark'] ?></p>
                                    </div>
                                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                        <div class="btn btn-sm btn-primary p-0 px-1 fw-bold ">
                                            <?php
                                            echo $formattedDate;
                                            ?>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-pen-to-square "></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="../assets/editCategory.php?id=<?php echo $category['category_id'] ?>">Edit</a></li>
                                                <li><a class="dropdown-item" href="../assets/deleteCategory.php?id=<?php echo $category['category_id'] ?>">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
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
</body>

</html>