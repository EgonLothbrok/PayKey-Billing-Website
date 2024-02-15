<?php
require_once('../dbconnection.php');
$userId = $_GET['__id'];
$service_id = $_GET['service_id'];

// taking info from users
$userSql = "SELECT * FROM `users` WHERE user_id = $userId";
$users = $db1->query($userSql);

// taking infor from services
$serviceSql = "SELECT * FROM `services` WHERE service_id = $service_id";
$services = $db1->query($serviceSql);

// Assgin Values
foreach ($users as $user) {
        $_userId = $user['user_id'];
        $_userName = $user['username'];
        $_userEmail = $user['user_email'];
        $_userPassword = $user['user_password'];
        $_userPocket = $user['amount'];
}

foreach ($services as $service) {
        $_service_id = $service['service_id'];
        $_service_fees = $service['fees'];
}


// Submiting Requests
if (isset($_POST["btnSubmit"])) {
        $inpPassword = $_POST["userPassword"];

        // Password varification
        if (password_verify($inpPassword, $_userPassword)) {
                $amount = $_POST['amount'];
                $note   = $_POST['note'];

                // Withdrawed Amount Verification
                if ($amount < 10 || $amount > 100000) {
                        echo "<script>alert('Amount Must Be Greater Than 0 and less than 100000, Invalid Withdraw')</script>";
                // Varification With Service fees
                } elseif ($amount + $_service_fees > $_userPocket) {
                        echo "<script>alert('Your Account Has Only $ $_userPocket, Invalid Withdraw')</script>";
                } else {
                        $total_amount = $_userPocket - ($amount + $_service_fees);
                        echo $total_amount.'<br>';  
                        // Inserting User Activities

                        $insertRequest = $db1 ->prepare("INSERT INTO `user_activities`(`user_id`, `service_id`, `fees`,`amount`, `note`) VALUES ('$_userId','$_service_id','$_service_fees','$amount',:note)");
                        $insertRequest -> bindParam(":note",$note);
                        $insertRequest->execute();
                        // Updating User Activites
                        $updateUserAmount = "UPDATE `users` SET `amount`='$total_amount' WHERE user_id = $_userId";
                        $db1->query($updateUserAmount);
                        
                        header("location:../user/userDashboard.php");
                }
        } else {
                echo "<script>alert('Wrong Password, Try Again')</script>";
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cash Out</title>
        <!-- External Css for Forms -->
        <link rel="stylesheet" href="./form.css">
</head>

<body>
        <div class="container d-flex justify-content-center align-item-center">
                <div class="border row p-0 shadow-sm rounded w-75 m-lg-5 m-2  bg-light animate__animated animate__fadeInUp">
                        <!-- Background Animation -->
                        <div class="d-none d-lg-flex col-lg-5 col-12 d-flex flex-column justify-content-center align-items-center border rounded  cashout-process-bg">


                        </div>
                        <div class="col-12 col-lg-7">
                                <form method="POST" class="p-2 m-md-4 m-0 p-0">
                                        <!-- Title -->
                                        <div class="fs-1 fw-bold text-uppercase ">
                                                Cash Out
                                        </div>
                                        <p class="small text-muted text-muted d-md-block d-none">Withdraw a certain amount of bills with validation.<a href="../userDashboard.php" class="text-decoration-none"> Return Dashboard</a></p>

                                        <!-- User Email - disabled -->
                                        <div class="mb-md-3 m-1">
                                                <label for="userEmail" class="form-label text-muted">Email</label>
                                                <input type="email" class="form-control" id="userEmail" aria-describedby="userEmail" value="<?php echo $_userEmail; ?>" disabled>
                                        </div>

                                        <!-- User Password -->
                                        <div class="mb-md-3 m-1">
                                                <label for="Password" class="form-label text-muted">Password</label>
                                                <input type="password" class="form-control" id="Password" name="userPassword" required>
                                        </div>

                                        <!-- Cashoutted Amount -->
                                        <div class="mb-md-3 m-1">
                                                <label for="CashoutAmount" class="form-label text-muted">Amount</label>
                                                <input type="number" class="form-control" id="CashoutAmount" aria-describedby="ReqAmount" name="amount" required>
                                        </div>

                                        <!-- Not For Cashout -->
                                        <div class="mb-md-3 m-1">
                                                <label for="Note" class="form-label text-muted">Note</label>
                                                <textarea name="note" class="form-control" cols="30" rows="3" id="note" required></textarea>
                                        </div>

                                        <!-- Check Box -->
                                        <div class="mb-md-3 m-1 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div>

                                        <!-- Submit Buttoms -->
                                        <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary mx-2" name="btnSubmit">Submit</button>
                                                <button type="reset" class="btn btn-primary mx-2" c>Clear</button>

                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</body>

</html>