<?php
require_once("../dbconnection.php");

// Validation
$wifi_billing = false;
$phone_billig = false;

// Getting User Information
$userId = $_GET['__id'];
$user_sql = "SELECT * FROM `users` WHERE user_id = $userId";
$users = $db1->query($user_sql);
foreach ($users as $user) {
    $_userId = $user['user_id'];
    $_userName = $user['username'];
    $_userEmail = $user['user_email'];
    $_userPassword = $user['user_password'];
    $_userPocket = $user['amount'];
}

// Getting Services Information
$service_id = $_GET['service_id'];
$serviceSql = "SELECT * FROM `services` WHERE service_id = $service_id";
$services = $db1->query($serviceSql);
foreach ($services as $service) {
    $_service_id = $service['service_id'];
    $_service_fees = $service['fees'];
    $_service_name = $service['service_name'];
}

// Service type check
if ($_service_name == "Wifi Billing") {
    $wifi_billing = true;
} elseif ($_service_name == "Phone Billing") {
    $phone_billig = true;
}

// 
if (isset($_POST["btnSubmit"])) {
    $inpPassword = $_POST["userPassword"];
    if (password_verify($inpPassword, $_userPassword)) {

        $service_medium = $_POST["medium"];
        $service_medium_length = strlen($service_medium);
        $amount = $_POST["amount"];

        if ($amount + $_service_fees > $_userPocket) {
            echo "<script>alert('Your Account Has Only $ $_userPocket, Invalid Transfer')</script>";
        } else {

            echo $_userId . "<br>";
            echo $_service_id . "<br>";
            echo $_service_fees . "<br>";
            echo $amount . "<br>";
            echo $service_medium;
            
            $completeNote = $service_medium . " - ".$_service_name;
            $insertRequest = $db1->prepare("INSERT INTO `user_activities`(`user_id`, `service_id`, `fees`,`amount`, `note`) VALUES ('$_userId','$_service_id','$_service_fees','$amount',:note)");
            $insertRequest->bindParam(":note", $completeNote);
              $insertRequest->execute();

              $updateUserAmount = $_userPocket - ($amount + $_service_fees);
              $giver_sql  = "UPDATE `users` SET `amount`='$updateUserAmount' WHERE user_id = $_userId";
              $db1->query($giver_sql);
            header("location:../user/userDashboard.php");
        }
    } else
        echo "<script>alert('Wrong Password, Try Again')</script>";
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
    <div class="container d-flex justify-content-center align-item-center animate__animated animate__bounceInUp">
        <div class="reqform border row p-0 shadow-sm rounded w-75 m-lg-2 m-2  bg-light">
            <div class="d-none d-lg-flex col-lg-5 col-12 d-flex flex-column justify-content-center align-items-center border rounded  billing-process-bg">


            </div>
            <div class="col-12 col-lg-7">
                <!-- Form -->
                <form method="POST" class="p-2 m-md-4 m-0 p-0">
                    <div class="fs-1 fw-bold text-uppercase ">
                        <!-- Title -->
                        <?php
                        echo $_service_name;
                        ?>
                    </div>
                    <p class="small text-muted text-muted d-md-block d-none">Transfer a certain amount of bills with recipient's Email<a href="../user/userDashboard.php" class="text-decoration-none"> Return Dashboard</a> </p>

                    <!-- User Email -->
                    <div class="mb-md-3 m-1">
                        <label for="userEmail" class="form-label text-muted">User Email</label>
                        <input type="email" class="form-control" id="userEmail" aria-describedby="userEmail" value="<?php echo $_userEmail; ?>" disabled>
                    </div>

                    <!-- User Password -->
                    <div class="mb-md-3 m-1">
                        <label for="Password" class="form-label text-muted">Password</label>
                        <input type="password" class="form-control" id="Password" name="userPassword" required>
                    </div>

                    <!-- Services Checking -->
                    <!-- Wifi Billing -->
                    <?php
                    if ($wifi_billing) {
                    ?>
                        <!-- Medium  -->
                        <div class="mb-md-3 m-1">
                            <label for="deviceName" class="form-label text-muted">Wifi Device Name</label>
                            <input type="text" class="form-control" id="deviceName" name="medium" pattern="[A-Za-z]{3}[0-9]{3}" required>
                        </div>

                        <!-- Paying Process -->
                        <label for="deviceName" class="form-label text-muted">Services</label>

                        <!-- Types -->
                        <div class="d-flex justify-content-around row m-0 mx-2">
                            <div class="form-check col col-md-12 col-lg-auto m-1 border bg-white rounded shadow-sm  px-5  p-2">
                                <input class="form-check-input" type="radio" name="amount" id="flexRadioDefault1" value="100" required>
                                <label class="form-check-label " for="flexRadioDefault1">
                                    $ 100 - 1 Month
                                </label>
                            </div>

                            <div class="form-check col col-md-12 col-lg-auto m-1 border bg-white rounded shadow-sm  px-5  p-2">
                                <input class="form-check-input" type="radio" name="amount" id="flexRadioDefault1" value="200" required>
                                <label class="form-check-label " for="flexRadioDefault1">
                                    $ 200 - 2 Month
                                </label>
                            </div>

                            <div class="form-check col col-md-12 col-lg-auto m-1 border bg-white rounded shadow-sm  px-5  p-2">
                                <input class="form-check-input" type="radio" name="amount" id="flexRadioDefault1" value="300" required>
                                <label class="form-check-label " for="flexRadioDefault1">
                                    $ 300 - 3 Month
                                </label>
                            </div>

                            <div class="form-check col col-md-12 col-lg-auto m-1 border bg-white rounded shadow-sm  px-5  p-2">
                                <input class="form-check-input" type="radio" name="amount" id="flexRadioDefault1" value="400" required>
                                <label class="form-check-label " for="flexRadioDefault1">
                                    $ 400 - 4 Month
                                </label>
                            </div>
                        </div>

                        <!-- PH Billing -->
                    <?php
                    } elseif ($phone_billig) {
                    ?>

                        <div class="mb-md-3 m-1">
                            <label for="phoneNumber" class="form-label text-muted">Phone Number</label>
                            <input type="tel" id="phone" name="medium" pattern="(09)?[0-9]{11}" required class="form-control" />
                        </div>

                        <div class="d-flex justify-content-around row m-0 mx-2">
                            <div class="form-check col col-md-12 col-lg-auto m-1 border bg-white rounded shadow-sm  px-5  p-2">
                                <input class="form-check-input" type="radio" name="amount" id="flexRadioDefault1" value="100">
                                <label class="form-check-label " for="flexRadioDefault1">
                                    $ 100
                                </label>
                            </div>
                            <div class="form-check col col-md-12 col-lg-auto m-1 border bg-white rounded shadow-sm  px-5  p-2">
                                <input class="form-check-input" type="radio" name="amount" id="flexRadioDefault1" value="200">
                                <label class="form-check-label " for="flexRadioDefault1">
                                    $ 200
                                </label>
                            </div>
                            <div class="form-check col col-md-12 col-lg-auto m-1 border bg-white rounded shadow-sm  px-5  p-2">
                                <input class="form-check-input" type="radio" name="amount" id="flexRadioDefault1" value="300">
                                <label class="form-check-label " for="flexRadioDefault1">
                                    $ 300
                                </label>
                            </div>
                        </div>

                    <?php
                    }
                    ?>


                    <!-- For Check Out -->
                    <div class="mb-md-3 m-1 my-4 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mx-2" name="btnSubmit">Submit</button>
                        <button type="reset" class="btn btn-primary mx-2">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
</body>

</html>