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


// Submiting Transfers
if (isset($_POST["btnSubmit"])) {
    $inpPassword = $_POST["userPassword"];

    // Verifying Passwword
    if (password_verify($inpPassword, $_userPassword)) {
        $amount = $_POST['amount'];
        $note   = $_POST['note'];
        $recipient = trim($_POST['recipient']);

        //Verifying transferred amount
        if ($amount < 10 || $amount > 10000) {
            echo "<script>alert('Amount Must Be Greater Than 10 and less than 100000, Invalid Withdraw')</script>";
        } elseif ($amount + $_service_fees > $_userPocket) {
            echo "<script>alert('Your Account Has Only $ $_userPocket, Invalid Transfer')</script>";
        } else {

            // reciving bills
            $recipientSql = "SELECT * FROM `users` WHERE user_email = '$recipient'";
            $_recipient = $db1->query($recipientSql);
            // Get reciver id
            foreach ($_recipient as $recipient) {
                $_recipient_name = $recipient["username"];
                $_recipient_id = $recipient["user_id"];
                $_recipient_pocket = $recipient["amount"];
            }


            if (!empty($_recipient_id) && $_recipient_id !== $_userId) {
                $completeNote = "$note [$_recipient_name]";
                $insertRequest = $db1 ->prepare("INSERT INTO `user_activities`(`user_id`, `service_id`, `fees`,`amount`, `note`) VALUES ('$_userId','$_service_id','$_service_fees','$amount',:note)");
                        $insertRequest -> bindParam(":note",$completeNote);
                        $insertRequest->execute();
                
                $updateUserAmount = $_userPocket - ($amount + $_service_fees);
                $giver_sql  = "UPDATE `users` SET `amount`='$updateUserAmount' WHERE user_id = $_userId";
                $db1->query($giver_sql);

                $updateReciverAmount = $_recipient_pocket + $amount;
                $reciver_sql = "UPDATE `users` SET `amount`='$updateReciverAmount' WHERE user_id = $_recipient_id";
                $db1->query($reciver_sql);

                header("location:../user/userDashboard.php");
            } else {
                echo  "<script>alert('User not Found, Invalid Reciver')</script> ";
            }
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
    <title>Document</title>
    <link rel="stylesheet" href="./form.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-item-center animate__animated animate__jackInTheBox">
        <div class="reqform border row p-0 shadow-sm rounded w-75 m-lg-2 m-2  bg-light">
            <div class="d-none d-lg-flex col-lg-5 col-12 d-flex flex-column justify-content-center align-items-center border rounded  transfer-process-bg ">


            </div>
            <div class="col-12 col-lg-7">
                <form method="POST" class="p-2 m-md-4 m-0 p-0">
                    <div class="fs-1 fw-bold text-uppercase ">
                        Transfer
                    </div>
                    <p class="small text-muted text-muted d-md-block d-none">Transfer a certain amount of bills with recipient's Email<a href="../userDashboard.php" class="text-decoration-none"> Return Dashboard</a> </p>

                    <!-- User Email -->
                    <div class="mb-md-3 m-1">
                        <label for="userEmail" class="form-label text-muted">User Email</label>
                        <input type="email" class="form-control" id="userEmail" aria-describedby="userEmail" value="<?php echo $_userEmail; ?>" disabled>
                    </div>

                    <!-- Receiver Email -->
                    <div class="mb-md-3 m-1">
                        <label for="userEmail" class="form-label text-muted">Receiver's Email</label>
                        <input type="email" class="form-control" id="userEmail" aria-describedby="userEmail" name="recipient">
                    </div>

                    <!-- User Password -->
                    <div class="mb-md-3 m-1">
                        <label for="Password" class="form-label text-muted">Password</label>
                        <input type="password" class="form-control" id="Password" name="userPassword" required>
                    </div>

                    <!-- Amount of transfer -->
                    <div class="mb-md-3 m-1">
                        <label for="ReqAmount" class="form-label text-muted">Amount</label>
                        <input type="number" class="form-control" id="ReqAmount" aria-describedby="ReqAmount" name="amount" required>
                    </div>

                    <!-- Note For Transfer -->
                    <div class="mb-md-3 m-1">
                        <label for="Note" class="form-label text-muted">Note</label>
                        <textarea name="note" class="form-control" cols="30" rows="3" id="note" required></textarea>
                    </div>

                    <!-- For Check Out -->
                    <div class="mb-md-3 m-1 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mx-2" name="btnSubmit">Submit</button>
                        <button type="reset" class="btn btn-primary mx-2" c>Clear</button>

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