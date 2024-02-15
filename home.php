<?php
//--- For Connection ---//
require_once('./dbconnection.php');

//--- For Header ---//
require_once('./layout/header.php');
$services_sql = $db1->query("SELECT * FROM `services` WHERE service_id != 1 ");
$services = $services_sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ========== Start Landing Page ========== -->

<!-- Home -->
<div class="shadow-lg">
    <div class="container ">
        <div class="  home-bg ">
            <div class="row">
                <!-- Description For Web -->
                <div class="col-12 col-lg-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="lh-lg py-0 px-4 py-md-3 d-flex justify-content-center justify-content-lg-start  flex-column align-items-center align-items-lg-start">
                        <!-- Descirption -->
                        <div class="fs-5 fst-italic fw-bolder text-muted font-monospace">Online Billing Services.</div>
                                <h4 class="text-start fw-bolder roboto-thin my-2">The Smartest Way For Online Payment</h4>
                                <p align="justify" class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci voluptatibus
                                    Lorem ipsum dolor sit. Lorem ipsum dolor sit amet. sunt officiis
                                    laboriosam quidem, numquam provident qui.
                                </p>
                                <!-- Sign In -->
                                <a href="#" class="nav-link p-0">
                                    <button class="btn  btn-dark rounded-pill px-4 my-3"> CONNECT
                                        <i class="fa-solid fa-paper-plane text-white mx-1"></i>
                                    </button>
                                </a>
                                <div class="w-100 d-flex justify-content-start my-5 d-none d-md-flex">
                                    <div class="p-2 w-50 rounded d-flex justify-content-center align-items-center animate__animated animate__fadeInUp">
                                        <div class=""><i class="fa-solid fa-store fs-2 p-3 icon text-primary shadow rounded-3"></i></div>
                                        <div class="mx-2">
                                            <small>Company</small>
                                            <h5>850K+</h5>
                                        </div>
                                    </div>
                                    <div class="p-2 w-50 rounded d-flex justify-content-center align-items-center animate__animated animate__fadeInUp">
                                        <div class=""><i class="fa-solid fa-user-shield fs-2 p-3 icon text-success shadow rounded-3"></i>
                                        </div>
                                        <div class="mx-2">
                                            <small>Member</small>
                                            <h5>100K+</h5>
                                        </div>
                                    </div>
                                    <div class="p-2 w-50 rounded d-flex justify-content-center align-items-center animate__animated animate__fadeInUp">
                                        <div class=""><i class="fa-regular fa-calendar-check fs-2 p-3 text-secondary shadow  rounded-3 icon"></i>
                                        </div>
                                        <div class="mx-2">
                                            <small>Event</small>
                                            <h5>10+</h5>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div>
                <!-- Image For Desc -->
                <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-end p-5 p-lg-1 p-md-3">
                    <img src="./imgs/phone_img.png" alt="" class="img-fluid w-75 animate__animated animate__fadeInUp px-lg-2 px-xl-5 p-md-2">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->
<div class="bg-light border">
    <div class="container brand my-1 py-5 ">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="fw-bold fs-4 fw-bold text-center">Trusted by 25,000+ world-class brands
                <div class="d-flex justify-content-center">
                    <hr class="p-1 w-50 mx-1  border rounded bg-success">
                    <hr class="p-1 w-25 border rounded bg-success">
                </div>
            </div>
            <div class=" w-100 d-flex justify-content-center flex-column align-items-center">
                <div class="brands p-2 img-gp d-flex justify-content-center row w-100 my-md-3 my-0">
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center m-1 my-4"><img src="./imgs/brands.png" alt="" class="img-fluid w-75"></div>
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center  m-1 my-4"><img src="./imgs/brand1.png" alt="" class="img-fluid w-75"></div>
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center  m-1 my-4"><img src="./imgs/brand2.png" alt="" class="img-fluid w-75"></div>
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center  m-1 my-4"><img src="./imgs/brand3.png" alt="" class="img-fluid w-75"></div>
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center  m-1 d-none d-md-flex my-4"><img src="./imgs/brand4.png" alt="" class="img-fluid w-75"></div>
                </div>
                <div class="brands p-2 img-gp d-flex justify-content-center row w-100  my-md-3 my-0">
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center m-1 my-4"><img src="./imgs/brand7.png" alt="" class="img-fluid w-75"></div>
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center m-1 my-4"><img src="./imgs/brand8.png" alt="" class="img-fluid w-75"></div>
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center m-1 my-4"><img src="./imgs/brand10.png" alt="" class="img-fluid w-75"></div>
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center m-1 my-4"><img src="./imgs/brand5.png" alt="" class="img-fluid w-75"></div>
                    <div class="col-5 col-lg-2 col-md-2 d-flex justify-content-center m-1 d-none d-md-flex my-4"><img src="./imgs/brand6.png" alt="" class="img-fluid w-75"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="container my-5" id="About">
    <div class="row ">
        <div class="col-12 col-md-12 col-lg-5 d-flex justify-content-center align-items-start  flex-column ">
            <div class="my-lg-5 my-4">
                <h3 class="fw-bold my-1 font-monospace">All-In-One Platform.</h3>
                <p align="justify" class="text-muted">Tincidunt morbi penatibus non ridiculus commodo consectetuer faucibus. Malesuada sociosqu platea
                    phasellus pharetra consequat ultrices</p>
                <div class="my-4 d-flex justify-content-lg-around  justify-content-center align-items-center animate__animated animate__fadeInUp">
                    <i class="fa-solid fa-money-check-dollar fs-1 p-3 me-3 rounded-3 icon text-dark shadow-lg border"></i>
                    <div class="d-flex justify-content-center  align-items-center flex-column">
                        <div>
                            <b>Payment Solution</b><br>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        </div>
                    </div>
                </div>
                <div class="my-5 d-flex justify-content-lg-around  justify-content-center align-items-center animate__animated animate__fadeInUp">
                    <i class="fa-solid fa-briefcase fs-1 p-3 me-3 rounded-3 icon text-dark shadow-lg border"></i>
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div>
                            <b>Growth Business</b><br>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        </div>
                    </div>
                </div>
                <div class="my-lg-4 my-1  d-flex justify-content-lg-around justify-content-center  align-items-center animate__animated animate__fadeInUp">
                    <i class="fa-solid fa-people-line fs-1 p-3  me-3 rounded-3 icon text-dark shadow-lg border"></i>
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div>
                            <b>Connect People</b><br>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-7 d-flex justify-content-center align-items-center p-5">
            <div class="w-100 h-100 about-img d-flex justify-content-end rounded shadow animate__animated animate__fadeInUp">
                <img src="./imgs/wallet.png" alt="" srcset="" width="180px" height="380px !important" class="position-relative rounded shadow-lg animate__animated animate__fadeInUp" style="top:100px !important">
            </div>
        </div>

    </div>
</div>

<!-- Tutorials -->
<div class="bg-light border Tutorials">
    <div class="container my-5  p-4">
        <div class="row ">
            <!-- Steps -->
            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-around align-items-center flex-column">
                <div class="card step-card border my-2 p-3 text-justify text-wrap shadow animate__animated animate__fadeInUp" style="text-align: justify;">
                    <h5 class="fw-bolder font-monospace my-4"><i class="fa-regular fa-circle text-primary"></i> Step 1 : Registering</h5>
                    <p class="text-muted fst-italic small">Register With Your Information In the reserved Form. Make Sure Your Password is strong for security of your finicial data.</p>
                </div>
                <div class="card step-card border my-2 p-3 text-justify text-wrap shadow animate__animated animate__fadeInUp" style="text-align: justify;">
                <h5 class="fw-bolder font-monospace my-4"><i class="fa-regular fa-circle text-primary"></i> Step 2 : Signing In</h5>
                    <p class="text-muted fst-italic small">Sign in With Your Information Which Are used in the registered form.Keep in secrat about your password and information for your security.</p>
                </div>
            </div>
            <!-- Imgs -->
            <div class="col-lg-4 d-lg-flex d-md-none d-flex justify-content-center">
                <img src="./imgs/iphone_img.png" alt="" srcset="" class="img-fluid w-75 animate__animated animate__fadeInUp  ">
            </div>
            <!-- Steps -->
            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-around align-items-center flex-column">
                <div class="card step-card border my-2 p-3 text-justify text-wrap shadow animate__animated animate__fadeInUp" style="text-align: justify;">
                    <h5 class="fw-bolder font-monospace my-4"><i class="fa-regular fa-circle text-primary"></i> Step 3 : Using Services</h5>
                    <p class="text-muted fst-italic small">Using the services that the system provide to the cilents easily and connect with other people by transferring bills for them.</p>
                </div>
                <div class="card step-card border my-2 p-3 text-justify text-wrap shadow animate__animated animate__fadeInUp" style="text-align: justify;">
                <h5 class="fw-bolder font-monospace my-4"><i class="fa-regular fa-circle text-primary"></i> Step 4 : Requesting</h5>
                    <p class="text-muted small">In order to change your personal information dealing will your account, you need to request to the office which is avaiable for 24/7.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- services -->
<div class="container my-3 p-md-4 p-0 animate__animated animate__fadeInUp" id="Services">
    <div class="row my-5 m-0 text-center">
        <h3 class="fw-bold  fst-italic">Smart Solution for Your Payment.</h3>
    </div>
    <div class="row m-md-4 m-0">
      <?php
      foreach ($services as $service) {

      ?>
        <div class="col-lg-6  col-12 d-flex justify-content-around align-items-around align-items-md-center flex-column">
            <div class="card m-md-3 m-0 my-3  card-desp shadow p-3 d-flex flex-column justify-content-start align-items-start lh-lg" style="width:400px;">
                <div class="border-0  p-2 rounded icon shadow-sm  text-start  text-dark"><i class="fa-solid fa-money-check fs-3"></i></div>
                <div class="fw-bold w-100 text-center fw-bolder font-monospace fs-3">
                    <?php
                    echo $service['service_name'];
                    ?>
                </div>
                <div class="w-100 text-center">
                <div class="text-success my-3 border-0 p-2 icon shadow small rounded fw-bold fst-italic"><?php
                    echo $service['remark'];
                    ?></div>
                </div>
            </div>
        </div>
      <?php
    }
    ?>

    </div>
</div>

<!-- Contact -->
<div class="bg-light">
    <div class="container py-5 " id="Contact">
        <div class="row ">
            <!-- News Paper Submitting -->
            <div class="col-12 d-flex flex-column align-items-center justify-content-center lh-lg">
                <div>
                    <h4 class="font-monspace fw-bold ">Contact Us.</h4>
                </div>
                <div class="fst-italic fw-bold text-success "">For Specific Info?</div>
                <div class="small text-muted lh-lg fst-italic">
                    Subscribe Us For News Letter By Entering Your Email:<br>
                </div>
                <div class="w-auto d-flex justify-content-center my-3 border p-1 bg-white rounded shadow">
                    <input type="text" name="" id="" class="form-control p-2  border-0" placeholder="Enter Your Email" style="width:300px;">
                    <button type="submit" class="btn btn-primary px-3 border-0" ><i class="fa-regular fa-paper-plane"></i></button>
                </div>
                    <div class="w-100 d-flex justify-content-center">
                        <div class="btn btn-dark px-3 py-2 fw-bold rounded m-3">Sign In</div>
                        <div class="btn btn-dark px-3 py-2 fw-bold rounded m-3">Register</div>
                    </div>

               
            </div>
        </div>
    </div>
</div>
</body>


<!-- footer -->
<?php
require_once('./layout/footer.php');
?>
<!-- ========== End Landing Page ========== -->