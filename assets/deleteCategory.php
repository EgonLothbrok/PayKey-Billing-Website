<?php
// Code Review - Done
require_once("../dbconnection.php");
// Getting Services 
$categories_id =  $_GET['id'];
$categories_sql = "SELECT * FROM `categories` WHERE category_id = $categories_id";
$categories = $db1->query($categories_sql);

// Getting Admin Passwrod
$getAdminPassword = "SELECT user_password FROM users WHERE role = 'admin'";
$adminPassword = $db1->query($getAdminPassword);
$adminPassword = $adminPassword->fetchAll(PDO::FETCH_ASSOC);
$adminPass = $adminPassword[0]["user_password"];


// Deleting Process
if (isset($_POST["btnDelete"])) {
    $adminInp = $_POST['userPassword'];
    if (password_verify($adminInp, $adminPass)) {
        echo $categories_id;
        $deleteCategory = $db1->prepare("DELETE FROM `categories` WHERE category_id = $categories_id");
        var_dump($deleteCategory);
        $deleteCategory->execute();

        // var_dump($editServiceSql);
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
        <!-- Modal Accepting Admin Passwrod -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5  fst-italic font-monospace fw-bold" id="exampleModalLabel">Enter Your Admin Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="InpPass" class="form-label text-muted">Password</label>
                                <input type="password" class="form-control" id="InpPass" name="userPassword">
                                <!-- Returning Error Message -->
                                <div class="small form-text text-danger fw-medium">
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
                    <h5 class="my-5 fst-italic font-monospace fw-bold   ">Delete Category</h5>
                    <!-- Quering Category -->
                    <?php
                    foreach ($categories as $category) {
                    ?>      
                        <form method="post" action="">

                            <!-- Getting Service Name -->
                            <div class="mb-3">
                                <label for="InpName" class="form-label text-muted">Category Name</label>
                                <input type="text" class="form-control" id="InpName" aria-describedby="textHelp" name="service_name" value="<?php echo $category['category_name']; ?>" required disabled>
                            </div>

                            <!-- Remarks -->
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label text-muted">Remark</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="service_remark" disabled><?php
                                                                                                                                echo $category['remark'];
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