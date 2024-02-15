<?php
require_once("../dbconnection.php");

// Getting Services 
$user_id =  $_GET['id'];
$user_sql = "SELECT * FROM `users` WHERE user_id = $user_id";
$user_info = $db1->query($user_sql);

// Admins
$getAdminPassword = "SELECT user_password FROM users WHERE role = 'admin'";
$adminPassword = $db1->query($getAdminPassword);
$adminPassword = $adminPassword->fetchAll(PDO::FETCH_ASSOC);
$adminPass = $adminPassword[0]["user_password"];




if (isset($_POST["btnDelete"])) {
    $adminInp = $_POST['adminPass'];
    if (password_verify($adminInp, $adminPass)) {
        $gettingUserActivties = $db1->prepare("SELECT * FROM `user_activities` WHERE user_id = $user_id");
        $gettingUserRequest = $db1->prepare("SELECT * FROM `requests` WHERE user_id = $user_id");
        $gettingUserRequest->execute();
        $gettingUserActivties->execute();
        $useractivites = $gettingUserActivties->fetch(PDO::FETCH_ASSOC);
        $userRequest = $gettingUserRequest ->fetch(PDO::FETCH_ASSOC);
        if(!empty($useractivites) || !empty($userRequest)) {
        $deleteUserActivities =$db1->prepare("DELETE FROM `user_activities` WHERE user_id = $user_id");
        $deleteUserActivities->execute();
        $deleteUserRequest =$db1->prepare("DELETE FROM `requests` WHERE user_id = $user_id");
        $deleteUserRequest->execute();  
        echo "Here smth";
        }else{
            echo "False Nth here";
        }
        $deleteUser = $db1->prepare("DELETE FROM `users` WHERE user_id = $user_id");
        $deleteUser->execute();

       

        header("location:../admin/viewUsers.php");   
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
                                <input type="password" class="form-control" id="InpPass" name="adminPass">
                                <!-- Returning Error Message -->
                                <div class="small form-text text-danger fw-medium" >
                                    This User Will Be Removed From The System and Its Record Will Still In Database.
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
        <!-- Main Page -->
        <div class="bg-light h-100 d-flex justify-content-center align-items-start py-lg-5 px-lg-5 p-3 loginBg">
            <!-- Form -->
            <div class="signIn  border rounded-3 shadow p-lg-4 p-1 bg-white animate__animated animate__bounceInUp">
                <div class="form m-5">
                    <!-- Header -->
                    <h5 class="my-5">Deleting User</h5>
                    <?php
                    foreach ($user_info as $user) {
                    ?>
                        <form method="post" action="">


                            <!-- Getting User Emal -->
                            <div class="mb-3">
                                <label for="InpEmail" class="form-label text-muted">Email address</label>
                                <input type="email" class="form-control" id="InpEmail" aria-describedby="emailHelp" name="userEmail" value="<?php echo $user['user_email'];?>" disabled>

                            </div>

                            <!-- Getting User Name-->
                            <div class="mb-3">
                                <label for="InpName" class="form-label text-muted">Name</label>
                                <input type="text" class="form-control" id="InpName" aria-describedby="emailHelp" name="userName" value="<?php echo $user['username'];?>" disabled>
                            </div>

                             <!-- Getting User Name-->
                             <div class="mb-3">
                                <label for="InpName" class="form-label text-muted">Amount</label>
                                <input type="text" class="form-control" id="InpName" aria-describedby="emailHelp" name="userName" value="<?php echo $user['amount'];?>" disabled>
                            </div>
                            

                             <!-- Getting User Name-->
                             <div class="mb-3">
                                <label for="InpName" class="form-label text-muted">Created</label>
                                <input type="text" class="form-control" id="InpName" aria-describedby="emailHelp" name="userName" value="<?php echo $user['created_at'];?>" disabled>
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