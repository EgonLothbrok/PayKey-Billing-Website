<?php
require_once("../dbconnection.php");

// Getting Services 
$categories_id =  $_GET['id'];
$categories_sql = "SELECT * FROM `categories` WHERE category_id = $categories_id";
$categories = $db1->query($categories_sql);




if (isset($_POST["btnEdit"])) {
    $categoryName = $_POST['category_name'];
    $remark = $_POST['category_remark'];

    $editCategorySql = $db1->prepare("UPDATE `categories` SET `category_name` = :categoryName,`remark` = :remark WHERE category_id = $categories_id");

    $editCategorySql->bindParam(":categoryName", $categoryName);
    $editCategorySql->bindParam(":remark", $remark);
    // $editCategorySql->bindParam(":category_id", $categories_id);

    $editCategorySql->execute();

    var_dump($editCategorySql);
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
                    <h5 class="my-5">Editing Category</h5>
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <form method="post" action="">

                            <!-- Getting Service Name -->
                            <div class="mb-3">
                                <label for="InpName" class="form-label text-muted">Category Name</label>
                                <input type="text" class="form-control" id="InpName" aria-describedby="textHelp" name="category_name" value="<?php echo $category['category_name']; ?>" required>
                            </div>


                            <!-- Remarks -->
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Textarea</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="category_remark"><?php
                                                                                                                                echo $category['remark'];
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