<div class="w-100 p-2 py-3 d-flex justify-content-between align-items-center px-4 shadow-sm sticky-top bg-white">
    <!-- Welcome Message -->
    <!-- Code Review - Done -->

    <div>
        <div class=" fw-bold fs-5 font-monospace fst-italic">
            Hello,
            <?php
            echo $_SESSION['userName'];
            ?>
        </div>
    </div>
    <!-- For Mobile -->
    <div class="">
        <!-- Toggle Btn -->
        <a class="btn btn-outline-dark d-block d-md-block d-lg-none " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <i class="fa-solid fa-align-left"></i>
        </a>
        <!-- Check Condition For Admin Or client -->
        <?php
        if ($_SESSION['role'] != "client") {
        ?>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-start w-100 fw-bold fst-italic font-monospace" id="offcanvasExampleLabel">Welcome Mate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div>
                            <!-- Home -->
                            <a href="./adminDashboard.php#Home" class="text-decoration-none  w-100 mb-5">
                                <div class="w-100 text-center px-4 py-3 rounded-3   text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-solid fa-circle-user me-2"></i> Dashboard
                                </div>
                            </a>
                            <!-- Activities -->
                            <a href="./viewActivities.php" class="text-decoration-none w-100 mb-5">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-brands fa-creative-commons-sampling me-2"></i> Activites
                                </div>
                            </a>
                            <!-- Cash In Request -->
                            <a href="./viewBillRequest.php" class="text-decoration-none w-100 mb-5">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-solid fa-file-invoice-dollar me-2"></i> Bill Requests
                                </div>
                            </a>
                            <!-- Services -->
                            <a href="./viewServices.php" class="text-decoration-none w-100 mb-5">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-solid fa-comment-dollar me-2"></i> Services
                                </div>
                            </a>
                            <!-- Users -->
                            <a href="./viewUsers.php" class="text-decoration-none w-100 mb-4">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-solid fa-user-astronaut me-2"></i> Users
                                </div>
                            </a>
                            <!-- Requests -->
                            <a href="./viewRequest.php" class="text-decoration-none w-100 mb-5">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Request
                                </div>
                            </a>
                        </div>
                        <div class="text-center">
                            <a href="../assets/logout.php">
                                <button class="btn btn-dark btn-sm p-2">Logout</button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-center w-100 fst-italic" id="offcanvasExampleLabel">Welcome, Mate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div>
                            <!-- Home -->
                            <a href="./userDashboard.php#Home" class="text-decoration-none w-100 mb-2">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-solid fa-circle-user me-2"></i> Dashboard
                                </div>
                            </a>
                            <!-- Services -->
                            <a href="./userDashboard.php#Services" class="text-decoration-none w-100 mb-2">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-solid fa-comment-dollar me-2"></i> Services
                                </div>
                            </a>
                            <!-- Transcation -->
                            <a href="./userActivities.php" class="text-decoration-none w-100 mb-2">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-brands fa-creative-commons-sampling me-2"></i> Activites
                                </div>
                            </a>
                            <!-- Setting -->
                            <a href="./userSetting.php?userId=<?php echo $_userId; ?>" class="text-decoration-none w-100 mb-2">
                                <div class="w-100 text-center px-4 py-3 rounded-3  text-muted btn btn-outline-dark outline-none border-none menu-hover" data-bs-dismiss="offcanvas" aria-label="Close">
                                    <i class="fa-solid fa-gear me-2"></i> Setting
                                </div>
                            </a>
                        </div>
                        <div class="text-center">
                            <a href="../assets/logout.php">
                                <button class="btn btn-dark btn-sm p-2">Logout</button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        <?php
        }
        ?>

    </div>
    <!-- For Time -->
    <div class="d-lg-flex d-md-none d-none justify-content-between">

        <div class="shadow-sm border-0 text-dark fw-bold font-monospace rounded p-2">
            <?php
            $date = $_SESSION['lastOnline'];
            $dateObject = new DateTime($date);
            $formattedDate = $dateObject->format('h:s A');
            echo $formattedDate;
            ?>
            </button>

        </div>
    </div>