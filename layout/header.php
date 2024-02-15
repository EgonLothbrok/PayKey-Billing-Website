<!DOCTYPE html>
<html lang="en">
<!-- Code Review - Done -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sticky-top bg-white shadow-sm navigation">
        <!-- Navigation Start -->
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light py-4">
                <div class="container-fluid p-0">
                    <!-- Icon -->
                    <a class="navbar-brand font-monospace fw-bold" href="#" onClick="window.location.reload();">PayKey</a>

                    <!-- Mobile Sized Btn -->
                    <button class="btn btn-dark d-lg-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">

                        <i class="fa-solid fa-caret-left"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Nav Bars -->
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item ms-3">
                                <a class="nav-link fw-bold" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item ms-3 fw-bold">
                                <a class="nav-link" aria-current="page" href="#About">About</a>
                            </li>
                            <li class="nav-item ms-3 fw-bold">
                                <a class="nav-link" aria-current="page" href="#Services">Services</a>
                            </li>
                            <li class="nav-item ms-3 fw-bold">
                                <a class="nav-link" aria-current="page" href="#Contact">Contact</a>
                            </li>
                            <li class="nav-item ms-4 fw-bold">
                                <a class="nav-link" aria-current="page" href="login.php">Get Started</a>
                            </li>
                        </ul>

                    </div>

                    <!-- Mobile Size OffCanvas -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                        aria-labelledby="offcanvasExampleLabel">
                        <!-- Header -->
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title font-monospace fw-bold fst-italic" id="offcanvasExampleLabel">Wellcome, Mate</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>

                        </div>

                        <div class="offcanvas-body  h-100 d-flex flex-column justify-content-between">
                            <div class="d-flex flex-column justify-content-between">
                                <!-- Home -->
                                <div class="w-100 text-center my-3">
                                    <!-- offcanvas-Home btn -->
                                    <button data-bs-dismiss="offcanvas" aria-label="Close"
                                        class="btn btn-outline-white">
                                        <a href="#" class="nav-link text-muted fw-bold font-monospace">Home</a>
                                    </button>
                                </div>
                                <!-- About -->
                                <div class="w-100 text-center my-3">
                                    <!-- offcanvas-About btn -->
                                    <button data-bs-dismiss="offcanvas" aria-label="Close"
                                        class="btn btn-outline-white">
                                        <a href="#About" class="nav-link text-muted fw-bold font-monospace">About</a>
                                    </button>
                                </div>
                                <!-- Service -->
                                <div class="w-100 text-center my-3">
                                    <!-- offcanvas-Service btn -->
                                    <button data-bs-dismiss="offcanvas" aria-label="Close"
                                        class="btn btn-outline-white">
                                        <a href="#Services" class="nav-link text-muted fw-bold font-monospace">Services</a>
                                    </button>
                                </div>
                                <!-- Contact -->
                                <div class="w-100 text-center my-3">
                                    <!-- offcanvas-Contact btn -->
                                    <button data-bs-dismiss="offcanvas" aria-label="Close"
                                        class="btn btn-outline-white">
                                        <a href="#Contact" class="nav-link text-muted fw-bold font-monospace">Contact</a>
                                    </button>
                                </div>

                            </div>
                            <!-- To Customer Side -->
                            <div class="getstarted text-center mt-5">
                                <a href="login.php">
                                    <button class="btn-dark font-monospace btn">Get Started</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navigation End -->
    </div>