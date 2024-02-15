<?php
// Database Connection - Code Review - Done
require_once("dbconnection.php");

// Error Messages
$nameErrorMsg = "";
$emailErrorMsg = "";
$passwordErrorMsg = "";

// ---------- Register Start ----------//
if (isset($_POST["btnRegister"])) {

    // Accepting Inputs
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPassword = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);
    $userRe_password = $_POST['userRe_password'];

    // Input Validation //
    if (empty($userName)) {
        $nameErrorMsg = "Name Cannot be Empty";
    } else if (empty($userEmail)) {
        $emailErrorMsg = "Email Cannot be Empty";
    } else if (empty($userPassword) || empty($userRe_password)) {
        $passwordErrorMsg = "Password Cannot be Empty";
    } else {
        //Password Validation
        if (password_verify($userRe_password, $userPassword)) {
            // Checking Strong Password
            if (preg_match('/^(?=.*[A-Z])(?=.*\d).{7,}$/', $userRe_password)) {
                // Database Inserting
                $sql = "INSERT INTO users (username,user_email,user_password) values('$userName','$userEmail','$userPassword')";
                $db1->exec($sql);
                header("location:login.php");
            } else {
                $passwordErrorMsg = "Must Be More Then 6 Words With One Uppercase";
            }
        } else {
            $passwordErrorMsg = "Password Must Be The Same";
        }
    }
    // Input Validation // 

}
// ---------- Register End ----------//

?>

<!-- ========== Start UI ========== -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Register PHP -->
    <title>Register</title>
</head>

<body>
    <div>
        <div class="bg-light h-100 d-flex justify-content-center align-items-start py-lg-5 px-lg-5 p-3 registerbg">
            <!-- ========== Start Main Form ========== -->            
            <div class="signIn  border rounded-3 shadow p-lg-4 p-1 bg-white animate__animated animate__bounceInUp ">
                <div class="form m-5">
                    <!-- Heading -->
                    <h5 class="my-3">Register</h5>

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

                        <!-- Accepting Terms and Condition -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="Terms" required>
                            <label class="form-check-label text-muted small" for="Terms">I Agree Terms And Conditions </label>
                        </div>

                        <!-- Submiting Date -->
                        <button type="submit" class="btn btn-primary px-3 rounded-pill" name="btnRegister">Sign In</button>

                        <!-- Navigating To Login -->
                        <div class="text-muted small my-3">Already Have Account? <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ========== End Main Form ========== -->
        </div>
    </div>
</body>

</html>
<!-- ========== End  UI ========== -->
