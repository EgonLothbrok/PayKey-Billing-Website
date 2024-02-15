<?php
// Database Connection - Code Review - Done
require_once("dbconnection.php");

// Error Messages
$emailErrorMsg = '';
$passwordErrorMsg = '';


// ---------- Sign Start ----------//
if (isset($_POST["btnSign"])) {

    // Getting Information
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];

    // Email Validation
    if (empty($email)) {
        $emailErrorMsg = 'Email Cannot Be empty';
        // Password Validation
    } else if (empty($password)) {
        $passwordErrorMsg = "Password Cannot Be Empty";
    } else {
        // Email Checking
        $query = "SELECT * FROM users WHERE user_email = '$email'";
        $statement = $db1->query($query);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {

            // Password Verifying
            if (password_verify($password, $user['user_password'])) {

                echo $user['role'];
                $lastOnline = date('Y-m-d H:i:s');
                $query = "UPDATE `users` SET `updated_at`='$lastOnline' WHERE user_email = '$email'";
                $statement = $db1->query($query);

                //Accepting User Data
                $_SESSION['userId'] = $user['user_id'];
                $_SESSION['userName'] = $user['username'];
                $_SESSION['userEmail'] = $user['user_email'];
                $_SESSION['amount'] = $user['amount'];
                $_SESSION['role'] = $user['role'];

                // Last Online Data
                $_SESSION['lastOnline'] = $lastOnline;

                if ($user['role'] != "client") {
                    // To AdminDashboard
                    header('Location:./admin/adminDashboard.php');
                } else {

                    // To UserDashboard
                    header('Location:./user/userDashboard.php');
                }
            } else {
                // Returning Error Message
                echo '<script>alert("No User With This Email");</script>';
            }
        }
    }
}
// ---------- Sign End ----------//

?>


<!-- ========== Start UI ========== -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Login PHP -->
    <title>Login</title>
</head>

<body>
    <div>
        <!-- Main Page -->
        <div class="bg-light h-100 d-flex justify-content-center align-items-start py-lg-5 px-lg-5 p-3 loginBg">
            <!-- Form -->
            <div class="signIn  border rounded-3 shadow p-lg-4 p-1 bg-white animate__animated animate__bounceInUp">
                <div class="form m-5">
                    <!-- Header -->
                    <h5 class="my-5">Welcome Back</h5>
                    <form method="post" action="">

                        <!-- Getting User Email -->
                        <div class="mb-3">
                            <label for="InpEmail" class="form-label text-muted">Email address</label>
                            <input type="email" class="form-control" id="InpEmail" aria-describedby="emailHelp" name="userEmail">
                            <!-- Returning Error Message -->
                            <div class="small form-text text-danger fw-medium">
                                <?php echo $emailErrorMsg; ?>
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

                        <!-- Getting Terms and Condition Assessment -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label text-muted small" for="exampleCheck1">I Agree Terms and
                                Conditions</label>
                        </div>

                        <!-- Submiting Date -->
                        <button type="submit" class="btn btn-primary px-3 rounded-pill" name="btnSign">Sign In</button>

                        <!-- Navigating To Register -->
                        <div class="text-muted small my-3">Create An Account? <a href="register.php">Register</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- ========== End UI ========== -->
