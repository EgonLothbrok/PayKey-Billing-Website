<?php
require_once("../dbconnection.php");

// Getting Services 
$service_id =  $_GET['id'];
$service_sql = "SELECT * FROM `services` WHERE service_id = $service_id";
$services = $db1->query($service_sql);

$categories_and_service_sql = "SELECT * FROM categories";
$categories_and_services = $db1->query($categories_and_service_sql);
$_categories_and_services = $categories_and_services->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["btnEdit"])) {
    $serviceName = $_POST['service_name'];
    $service_fees = $_POST['service_fee'];
    $category_id = $_POST["category_id"];
    $remark = $_POST['service_remark'];

    $editServiceSql = $db1->prepare("UPDATE `services` SET `service_name` = :serviceName, `category_id` = :category_id, `remark` = :remark, `fees` = :service_fees WHERE service_id = :service_id");

    $editServiceSql->bindParam(":serviceName", $serviceName);
    $editServiceSql->bindParam(":category_id", $category_id);
    $editServiceSql->bindParam(":remark", $remark);
    $editServiceSql->bindParam(":service_fees", $service_fees);
    $editServiceSql->bindParam(":service_id", $service_id);

    $editServiceSql->execute();

    var_dump($editServiceSql);
    header("location:../admin/viewServices.php");
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
        <div class="bg-light h-100 d-flex justify-content-center align-items-start py-lg-5 px-lg-5 p-3 loginBg">
            <!-- Form -->
            <div class="signIn  border rounded-3 shadow p-lg-4 p-1 bg-white animate__animated animate__bounceInUp">
                <div class="form m-5">
                    <!-- Header -->
                    <h5 class="my-5">Editing Services</h5>
                    <?php
                    foreach ($services as $service) {
                    ?>
                        <form method="post" action="">

                            <!-- Getting Service Name -->
                            <div class="mb-3">
                                <label for="InpName" class="form-label text-muted">Service Name</label>
                                <input type="text" class="form-control" id="InpName" aria-describedby="textHelp" name="service_name" value="<?php echo $service['service_name']; ?>" required>
                            </div>

                            <!-- Getting Service Fees -->
                            <div class="mb-3">
                                <label for="Fees" class="form-label text-muted">Fees</label>
                                <input type="number" class="form-control" id="Fees" name="service_fee" value="<?php echo $service['fees']; ?>" required>

                            </div>

                            <!-- Category   -->
                            <div class="mb-3">
                                <label for="InpPass" class="form-label text-muted">Category</label>
                                <select class="form-select" aria-label="Default select example" name="category_id">
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
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="service_remark"><?php
                                                                                                                                echo $service['remark'];
                                                                                                                                ?>
                                </textarea>
                            </div>

                            <!-- Submiting Date -->
                            <button type="submit" class="btn btn-primary px-3 rounded" name="btnEdit">Edit</button>

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