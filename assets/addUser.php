<?php
// Database Connection - Code Review Done
require_once("../dbconnection.php");

//----- Register Process - Start -----//

// Error Messages
$nameErrorMsg = "";
$emailErrorMsg = "";
$passwordErrorMsg = "";

// For Adding Roles
$gettingRole = "SELECT DISTINCT role FROM users";
$userRole = $db1->query($gettingRole);
$userRoles = $userRole->fetchAll(PDO::FETCH_ASSOC);
// Process Start - Code Review - Done
if (isset($_POST["btnRegister"])) {

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
                $userRole = $_POST['userRole'];
                // Database Inserting
                $sql = "INSERT INTO users (username,user_email,user_password,role) values('$userName','$userEmail','$userPassword','$userRole')";
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
// End Process


//----- Register Process - Start -----//
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <div>
        <!-- Register PHP -->
        <div class="bg-light h-100 d-flex justify-content-center align-items-start py-lg-5 px-lg-5 p-3 registerbg">
            <!-- Main Form -->
            <div class="signIn  border rounded-3 shadow p-lg-4 p-1 bg-white animate__animated animate__bounceInUp">
                <div class="form m-1">
                    <!-- Header -->
                    <h5 class="my-3 font-monospace fw-bold">Add New User</h5>

                    <!-- Form -->
                    <form method="post" action="">

                        <!-- Getting User Emal -->
                        <div class="mb-3">
                            <label for="InpEmail" class="form-label text-muted">Email address</label>
                            <input type="email" class="form-control" id="InpEmail" aria-describedby="emailHelp" name="userEmail">
                            <!-- Returning Error Message -->
                            <div class="small form-text text-danger fw-medium">
                                <?php echo $emailErrorMsg; ?>
                            </div>
                        </div>

                        <!-- Getting User Name-->
                        <div class="mb-3">
                            <label for="InpName" class="form-label text-muted">Name</label>
                            <input type="text" class="form-control" id="InpName" aria-describedby="emailHelp" name="userName">
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

                        <!-- Getting User Password -->

                        <div class="mb-3">
                            <label for="InpPass" class="form-label text-muted">Role</label>
                            <!-- Returning Error Message -->
                            <select name="userRole" class="form-control" id="">
                                <?php
                                foreach ($userRoles as $userRole) {
                                ?>
                                    <option value="<?php echo $userRole['role'] ?>"><?php echo $userRole['role'] ?></option>
                                <?php
                                }
                                ?>
                            </select>                          
                        </div>

                        <!-- Accepting Terms and Condition -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="Terms" required>
                            <label class="form-check-label text-muted small" for="Terms">I agree Terms and Condition </label>
                        </div>

                        <!-- Submiting Date -->
                        <button type="submit" class="btn btn-primary px-3 rounded-pill" name="btnRegister">Sign In</button>

                        <!-- Navigating To Login -->
                        <div class="text-muted small my-3">Return To Admin Panel -<a href="../admin/adminDashboard.php">Admin</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php


?>