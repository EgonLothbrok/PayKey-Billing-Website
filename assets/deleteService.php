<?php
require_once("../dbconnection.php");

// Getting Services 
$service_id =  $_GET['id'];
$service_sql = "SELECT * FROM `services` WHERE service_id = $service_id";
$services = $db1->query($service_sql);
$getAdminPassword = "SELECT user_password FROM users WHERE role = 'admin'";
$adminPassword = $db1->query($getAdminPassword);
$adminPassword = $adminPassword->fetchAll(PDO::FETCH_ASSOC);
$adminPass = $adminPassword[0]["user_password"];
$categories_and_service_sql = "SELECT * FROM categories";
$categories_and_services = $db1->query($categories_and_service_sql);
$_categories_and_services = $categories_and_services->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["btnDelete"])) {
    $adminInp = $_POST['userPassword'];
    if (password_verify($adminInp, $adminPass)) {
        echo $service_id;
        $deleteService = $db1->prepare("DELETE FROM `services` WHERE service_id = $service_id");
        var_dump($deleteService);
        $deleteService->execute();

        var_dump($editServiceSql);
        header("location:../admin/viewServices.php");
    } else {
        echo "<script>alert('Wrong Password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <!-- Edit Service PHP -->
    <title>Edit Service</title>
</head>

<body>
    <div>
        <!-- Main Page -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Your Admin Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="InpPass" class="form-label text-muted">Password</label>
                                <input type="password" class="form-control" id="InpPass" name="userPassword">
                                <!-- Returning Error Message -->
                                <div class="small form-text text-danger fw-medium" >
                                    This Serices Will Be Removed From The System and Its Record Will Still In Database.
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btnDelete">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-light h-100 d-flex justify-content-center align-items-start py-lg-5 px-lg-5 p-3 loginBg">
            <!-- Form -->
            <div class="signIn  border rounded-3 shadow p-lg-4 p-1 bg-white animate__animated animate__bounceInUp">
                <div class="form m-5">
                    <!-- Header -->
                    <h5 class="my-5">Deleting Services</h5>
                    <?php
                    foreach ($services as $service) {
                    ?>
                        <form method="post" action="">

                            <!-- Getting Service Name -->
                            <div class="mb-3">
                                <label for="InpName" class="form-label text-muted">Service Name</label>
                                <input type="text" class="form-control" id="InpName" aria-describedby="textHelp" name="service_name" value="<?php echo $service['service_name']; ?>" required disabled>
                            </div>

                            <!-- Getting Service Fees -->
                            <div class="mb-3">
                                <label for="Fees" class="form-label text-muted">Fees</label>
                                <input type="number" class="form-control" id="Fees" name="service_fee" value="<?php echo $service['fees']; ?>" required disabled>

                            </div>

                            <!-- Category   -->
                            <div class="mb-3">
                                <label for="InpPass" class="form-label text-muted">Category</label>
                                <select class="form-select" aria-label="Default select example" name="category_id" disabled>
                                    <?php
                                    foreach ($_categories_and_services as $category) {
                                        if ($category['category_id'] == $service['category_id']) {
                                    ?>
                                            <option value="<?php echo $category['category_id'] ?>" selected>
                                                <?php echo $category['category_name']; ?>
                                            </option>
                                        <?php

                                        } else {

                                        ?>
                                            <option value="<?php echo $category['category_id'] ?>">
                                                <?php echo $category['category_name']; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>




                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Remarks -->
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Textarea</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="service_remark" disabled><?php
                                                                                                                                echo $service['remark'];
                                                                                                                                ?>
                                </textarea>
                            </div>

                            <!-- Submiting Date -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Delete
                            </button>

                            <!-- Navigating To Register -->
                            <div class="text-muted small my-3">Return Into Admin Dashboard <a href="../admin/adminDashboard.php">Admin Dashboard</a></div>


                        </form>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>