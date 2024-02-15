<?php
require_once("../dbconnection.php");

// Getting Services 
$user_id =  $_GET['id'];
$user_sql = "SELECT * FROM `users` WHERE user_id = $user_id";
$user_info = $db1->query($user_sql);

// Error Messages
$nameErrorMsg = "";
$emailErrorMsg = "";
$passwordErrorMsg = "";



if (isset($_POST["btnEdit"])) {

    // Assigning User Names
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];

    // Hashing Password
    $userPassword = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);
    $userRe_password = $_POST['userRe_password'];

    // Name Validation
    if (empty($userName)) {
        $nameErrorMsg = "Name Cannot be Empty";

        // Email Validation
    } else if (empty($userEmail)) {
        $emailErrorMsg = "Email Cannot be Empty";

        // Password Validation
    } else if (empty($userPassword) || empty($userRe_password)) {
        $passwordErrorMsg = "Password Cannot be Empty";

        // Truth Case
    } else {

        // Verifying Password
        if (password_verify($userRe_password, $userPassword)) {

            // Checking Strong Password
            if (preg_match('/^(?=.*[A-Z])(?=.*\d).{7,}$/', $userRe_password)) {

                // Database Inserting
                $sql = "UPDATE users SET username='$userName',user_email='$userEmail', user_password='$userPassword' WHERE user_id = $user_id";
                $db1->exec($sql);
                header("location:../admin/viewUsers.php");
            } else {

                $passwordErrorMsg = "must Be more then 6 words with one uppercase";
            }
        } else {

            $passwordErrorMsg = "Password Must Be The Same";
        }
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
        <div class="bg-light h-100 d-flex justify-content-center align-items-start py-lg-5 px-lg-5 p-3 loginBg">
            <!-- Form -->
            <div class="signIn  border rounded-3 shadow p-lg-4 p-1 bg-white animate__animated animate__bounceInUp">
                <div class="form m-5">
                    <!-- Header -->
                    <h5 class="my-5">Editing User</h5>
                    <?php
                    foreach ($user_info as $user) {
                    ?>
                        <form method="post" action="">


                            <!-- Getting User Emal -->
                            <div class="mb-3">
                                <label for="InpEmail" class="form-label text-muted">Email address</label>
                                <input type="email" class="form-control" id="InpEmail" aria-describedby="emailHelp" name="userEmail" value="<?php echo $user['user_email'];?>">
                                <!-- Returning Error Message -->
                                <div class="small form-text text-danger fw-medium">
                                    <?php echo $emailErrorMsg; ?>
                                </div>
                            </div>

                            <!-- Getting User Name-->
                            <div class="mb-3">
                                <label for="InpName" class="form-label text-muted">Name</label>
                                <input type="text" class="form-control" id="InpName" aria-describedby="emailHelp" name="userName" value="<?php echo $user['username'];?>" >
                                <!-- Returning Error Message -->
                                <div class="small form-text text-danger fw-medium">
                                    <?php echo $nameErrorMsg; ?>
                                </div>
                            </div>

                            <!-- Getting User Password -->
                            <div class="mb-3">
                                <label for="InpPass" class="form-label text-muted">Password</label>
                                <input type="password" class="form-control" id="InpPass" name="userPassword">
                                <!-- Returning Error Message -->
                                <div class="small form-text text-danger fw-medium">
                                    <?php echo $passwordErrorMsg; ?>
                                </div>
                            </div>
                            <!-- Getting User Password -->

                            <div class="mb-3">
                                <label for="InpPass" class="form-label text-muted">Re-Enter Password</label>
                                <!-- Returning Error Message -->
                                <input type="password" class="form-control" id="InpPass" name="userRe_password">
                                <div class="small form-text text-danger fw-medium">
                                    <?php echo $passwordErrorMsg; ?>
                                </div>
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