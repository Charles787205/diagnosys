<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DIAGNOSYS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/log.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-clock"></i> Monday - Saturday, 6AM to 5PM
      </div>
      <div class="d-flex align-items-center">
        <i class="bi bi-phone"></i> Call us now (084) 217 3824
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" style="height: 18%;" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.php" class="logo me-auto"><img src="../assets/img/log.png" alt="" style="width: 70px"></a>
      <div class="search">
        <input type="text" class="form-control" style="width: 15rem;" placeholder="Search services" id="serviceSearch">
        <ul class="card" id="serviceList" style="position: absolute; width: 15rem; display: none; list-style-type:none;">
          <!-- List items will be dynamically added here based on $services array -->
        </ul>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Laboratory Rates</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->


      <?php if (!isset($_SESSION['id'])) { ?>


        <a href="register.php" class="SignUp-btn"><span class="d-none d-md-inline"></span> Sign Up</a>
        <a href="login.php" class="LogIn-btn"><span class="d-none d-md-inline"></span>Log In</a>


      <?php } else {
        echo '<a href="patient-request.php" class="LogIn-btn"><span class="d-none d-md-inline"></span>Patient Request</a>';
      } ?>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(../assets/img/bg1\ \(1\).jpg)">
          <div class="container">
            <h2>Welcome to <span>Panabo City Diagnostic Center!</span></h2>
            <p>With our extensive health care resources, you may discover a healthier self. We give the knowledge you need to make educated decisions about your health, from professional medical insights to wellness suggestions. Explore articles, tips, and resources on a variety of health subjects to help you on your path to optimal health.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(../assets/img/bg1\ \(2\).jpg)">
          <div class="container">
            <h2>Welcome to <span>Panabo City Diagnostic Center!</span></h2>
            <p>Our innovative laboratory center provides accurate and quick diagnostic services. Your health answers begin here.
            </p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(../assets/img/bg1\ \(3\).jpg)">
          <div class="container">
            <h2>Welcome to <span>Panabo City Diagnostic Center!</span></h2>
            <p>With our diagnostic laboratory services, you may usher in a new era of medical clarity. We are committed to providing you with the information you require for proactive health management.
            </p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-heartbeat"></i></div>
              <h4 class="title"><a href="">Empowering Health through Precision</a></h4>
              <p class="description">Discover precise and dependable diagnostic solutions at our cutting-edge laboratory. Our top focus is your well-being.
              </p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-pills"></i></div>
              <h4 class="title"><a href="">Unveiling Wellness Insights</a></h4>
              <p class="description">Join us on an advanced diagnostics trip in our advanced laboratory, where science meets compassion.
              </p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="fas fa-thermometer"></i></div>
              <h4 class="title"><a href="">Precision Diagnostics Caring Results</a></h4>
              <p class="description">Our diagnostic laboratory is dedicated to providing clarity for improved health by utilizing cutting-edge technology and a patient-centered approach.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="fas fa-dna"></i></div>
              <h4 class="title"><a href="">Where Answers Meet Discovery</a></h4>
              <p class="description">Discover a wide range of diagnostic services at our laboratory center, which is committed to solving the secrets of health.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="text-center">
          <h3>Take the first step, sign up today!</h3>

          <a class="cta-btn scrollto" href="signup.html">Sign Up Now</a>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
          <p>Panabo City Diagnostic Center was started on February 18, 2013, it was founded by Elpidio C. Nuyad and Evelyn Nuyad. The center is located at Door 8, Ground floor, Nbl Building National Highway, Brgy. San Francisco Panabo City, Davao del Norte, and open from Monday to Saturday starting from 6:00 am to 5:00 pm. </p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right">
            <img src="../assets/img/pcdc.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
            <p>
              Additionally, it has a total of seven employees with their specified expertise. The business has Pathologist, Medical technologist, Phlebotomist, Medical Clerk, and Liaison officer.
            </p>
            <p class="fst-italic">
              Six valuable features of Panabo City Diagnostic Center:
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i>Accurate and Timely Results</li>
              <li><i class="bi bi-check-circle"></i>Customized Testing Solutions</li>
              <li><i class="bi bi-check-circle"></i>Telemedicine Integration</li>
              <li><i class="bi bi-check-circle"></i>Test Package Services</li>
              <li><i class="bi bi-check-circle"></i>Expert Employees Profile</li>
              <li><i class="bi bi-check-circle"></i>Advance Technology</li>
            </ul>

          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->


    <!-- ======= Services Section ======= -->
    <section id="services" class="services services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>
            The business offered the following laboratory rate services: Hematology, Urinalysis, Fecalysis, Blood chemistry and Electrolytes, Hepatitis Profile for qualitative and quantitative, Thyroid tests, Tumor Markers, Special tests, and other lab tests.
          </p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon"><i class="bi bi-eyedropper"></i></div>
            <h4 class="title"><a href="">Hematology</a></h4>
            <p class="description">The study of blood and blood problems is known as hematology. Blood and bone marrow cells are examples of this.
            </p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon"><i class="bi bi-trash2"></i></div>
            <h4 class="title"><a href="">Urinalysis</a></h4>
            <p class="description">A urinalysis is a test that examines several components of a urine sample. A thorough urinalysis includes visual, chemical, and microscopic examinations.
            </p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon"><i class="bi bi-file-post"></i></div>
            <h4 class="title"><a href="">Fecalysis</a></h4>
            <p class="description">A fecalysis is a series of tests performed on a stool sample to aid in the diagnosis of certain digestive system diseases.
            </p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon"><i class="bi bi-droplet-half"></i></div>
            <h4 class="title"><a href="">Blood Chemistry and Electrolytes</a></h4>
            <p class="description">A blood chemistry analysis is a technique in which a blood sample is examined to determine the levels of specific compounds produced into the blood by the body's organs and tissues.</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon"><i class="fas fa-notes-medical"></i></div>
            <h4 class="title"><a href="">Hepatitis Profile</a></h4>
            <p class="description">The hepatitis virus panel is a set of blood tests used to detect present or previous hepatitis A, B, or C infection.</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon"><i class="bi bi-person-bounding-box"></i></div>
            <h4 class="title"><a href="">Tumor Marks</a></h4>
            <p class="description">Tumor marker tests are most commonly utilized following a cancer diagnosis. Tumor markers, when combined with other tests, may aid in determining whether cancer has spread to other places of your body.
            </p>

          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Laboratory Rates</h2>
        </div>

        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="box" data-aos="fade-up" data-aos-delay="100">
              <table class="table table-borderless table-sm table table-striped table-hover">
                <thead class="table table-primary">
                  <tr>
                    <th scope="col">Services</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="fw-bold">
                    <td>Hematology</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>CBC, Platelet count</td>
                    <td>₱ 200.00</td>
                  </tr>
                  <tr>
                    <td>Complete Blood Count (CBC)</td>
                    <td>₱ 100.00</td>
                  </tr>
                  <tr>
                    <td>Hemoglobin count</td>
                    <td>₱ 50.00</td>
                  </tr>
                  <tr>
                    <td>Platelet count</td>
                    <td>₱ 100.00</td>
                  </tr>
                  <tr>
                    <td>Hematocrit count </td>
                    <td>₱ 50.00</td>
                  </tr>
                  <tr>
                    <td>Blood Typing with Rhesus (RH) Type</td>
                    <td>₱ 80.00</td>
                  </tr>
                  <tr>
                    <td>CTBT(Clotting time, Bleeding time)</td>
                    <td>₱ 80.00</td>
                  </tr>
                  <tr>
                    <td>Glycocelated Hemoglobin(HBA1c)</td>
                    <td>₱ 700.00</td>
                  </tr>
                  <tr>
                    <td>Prothrombin Time(PT) with INR </td>
                    <td>₱ 800.00</td>
                  </tr>
                  <tr>
                    <td>Active Partial Tromboplastin Time(APTT)</td>
                    <td>₱ 900.00</td>
                  </tr>
                  <tr>
                    <td>Erythrocytes Sedimentation Rat(ESR)</td>
                    <td>₱ 300.00</td>
                  </tr>
                  <tr class="fw-bold">
                    <td>Hepatitis Profile-Qualitative</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Hepa B Virus (HBsAg)</td>
                    <td>₱ 200.00</td>
                  </tr>
                  <tr>
                    <td>Anti-HBs</td>
                    <td>₱ 300.00</td>
                  </tr>
                  <tr>
                    <td>Hepa A Virus (Anti-HAV)</td>
                    <td>₱ 400.00</td>
                  </tr>
                  <tr>
                    <td>Hepa C Virus (Anti-HCV)</td>
                    <td>₱ 300.00</td>
                  </tr>
                  <tr class="fw-bold">
                    <td>Hepatitis Profile-Quantitative</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Hepa B Virus (HBsAg)</td>
                    <td>₱ 550.00</td>
                  </tr>
                  <tr>
                    <td>Anti-HBs</td>
                    <td>₱ 700.00</td>
                  </tr>
                  <tr>
                    <td>Anti-HAV lgM or lgG</td>
                    <td>₱ 900.00</td>
                  </tr>
                  <tr>
                    <td>Anti-HCV</td>
                    <td>₱ 800.00</td>
                  </tr>
                  <tr>
                    <td>HBeAg</td>
                    <td>₱ 750.00</td>
                  </tr>
                  <tr class="fw-bold">
                    <td>Urinalysis</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Urine Examination Manual</td>
                    <td>₱ 40.00</td>
                  </tr>
                  <tr>
                    <td>Urine Examination Cytometry</td>
                    <td>₱ 100.00</td>
                  </tr>
                  <tr>
                    <td>Urine Examination (Micral Test)</td>
                    <td>₱ 450.00</td>
                  </tr>
                  <tr>
                    <td>Urine Examination with 10 parameters</td>
                    <td>₱ 100.00</td>
                  </tr>
                  <tr class="fw-bold">
                    <td>Fecalysis</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Stool Examination</td>
                    <td>₱ 40.00</td>
                  </tr>
                  <tr>
                    <td>Occult Blood / FOBT</td>
                    <td>₱ 250.00</td>
                  </tr>
                  <tr>
                    <td>Stool Examination with Salmonella</td>
                    <td>₱ 900.00</td>
                  </tr>
                  <tr class="fw-bold">
                    <td>Blood Chemistry and Electrolytes</td>
                    <td></td>
                  </tr>
                  <td>FBS/RBS/2 hours Post Prandial</td>
                  <td>₱ 100.00</td>
                  </tr>
                  <tr>
                    <td>OGTT 2 takes</td>
                    <td>₱ 300.00</td>
                  </tr>
                  <tr>
                    <td>OGTT 3/4 takes</td>
                    <td>₱ 450.00</td>
                  </tr>
                  <tr>
                    <td>OGCT after 1hour</td>
                    <td>₱ 250.00</td>
                  </tr>
                  <tr>
                    <td>Lipid Profile (total cholesterol, Triglycerides,HDL,LDL)</td>
                    <td>₱ 650.00</td>
                  </tr>
                  <tr>
                    <td>Total Cholesterol</td>
                    <td>₱ 150.00</td>
                  </tr>
                  <tr>
                    <td>Triglycerides</td>
                    <td>₱ 300.00</td>
                  </tr>
                  <tr>
                    <td>HDL - Good Cholesterol</td>
                    <td>₱ 300.00</td>
                  </tr>
                  <tr>
                    <td>Serum Uric Acid</td>
                    <td>₱ 150.00</td>
                  </tr>
                  <tr>
                    <td>Serum Creatinine</td>
                    <td>₱ 150.00</td>
                  </tr>
                  <tr>
                    <td>SGPT/ALT</td>
                    <td>₱ 200.00</td>
                  </tr>
                  <tr>
                    <td>SGOT/AST</td>
                    <td>₱ 200.00</td>
                  <tr>
                    <td>BUN - Urea</td>
                    <td>₱ 300.00</td>
                  </tr>
                  <tr>
                    <td>Alkaline phosphatase</td>
                    <td>₱ 300.00</td>
                  </tr>
                  <td>Acid phosphatase </td>
                  <td>₱ 300.00</td>
                  </tr>
                  <tr>
                    <td>B1B2-Billirubin Test</td>
                    <td>₱ 450.00</td>
                  </tr>
                  <tr>
                    <td>TPAG Ratio</td>
                    <td>₱ 450.00</td>
                  </tr>
                  <td>Total Protein</td>
                  <td>₱ 300.00</td>
                  </tr>
                  <td>Albumin</td>
                  <td>₱ 300.00</td>
                  </tr>
                  <td>GGT</td>
                  <td>₱ 500.00</td>
                  </tr>
                  <td>Amylase</td>
                  <td>₱ 400.00</td>
                  </tr>
                  <td>Ck-MB</td>
                  <td>₱ 700.00</td>
                  </tr>
                  <tr>
                    <td>Lipase</td>
                    <td>₱ 800.00</td>
                  </tr>
                  <tr>
                    <td>Cholinesterase (RBC/Serum)</td>
                    <td>₱ 550.00</td>
                  </tr>
                  <tr>
                    <td>Electrolytes Package (K,Na,tCa,CI)</td>
                    <td>₱ 1,000.00</td>
                  </tr>
                  </tr>
                  <td>Potassium (K) </td>
                  <td>₱ 300.00</td>
                  </tr>
                  </tr>
                  <td>Sodium (Na) </td>
                  <td>₱ 300.00</td>
                  </tr>
                  </tr>
                  <td>Total Calcium (tCa) </td>
                  <td>₱ 300.00</td>
                  </tr>
                  </tr>
                  <td>Ionized Calcium (iCa)</td>
                  <td>₱ 300.00</td>
                  </tr>
                  </tr>
                  <td>Chloride (CI)</td>
                  <td>₱ 300.00</td>
                  </tr>
                  </tr>
                  <td>Phosphorous (P) </td>
                  <td>₱ 300.00</td>
                  </tr>
                  </tr>
                  <td>Ferritin (Fe) </td>
                  <td>₱ 800.00</td>
                  </tr>
                  </tr>
                  <td>Magnesium (Mg)</td>
                  <td>₱ 300.00</td>
                  </tr>
                  </tr>
                  <td>pH </td>
                  <td>₱ 300.00</td>
                  </tr>
                  </tr>



                  </tr>
                  <tr class="fw-bold">
                    <td>Thyroid test</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Thyroid Package ( TSH,T3,T4)</td>
                    <td>₱ 1,800.00</td>
                  </tr>
                  <tr>
                    <td>TSH</td>
                    <td>₱ 650.00</td>
                  </tr>
                  <tr>
                    <td>T3</td>
                    <td>₱ 650.00</td>
                  </tr>
                  <tr>
                    <td>T4</td>
                    <td>₱ 650.00</td>
                  </tr>
                  <tr>
                    <td>fT4</td>
                    <td>₱ 700.00</td>
                  </tr>
                  <tr>
                    <td>fT3</td>
                    <td>₱ 850.00</td>
                  </tr>
                  <tr>
                    <td>FSH</td>
                    <td>₱ 900.00</td>
                  </tr>
                  <tr>
                    <td>Growth Hormone</td>
                    <td>₱ 1,300.00</td>
                  </tr>
                  <tr>
                    <td>T uptake </td>
                    <td> ₱ 600.00</td>
                  </tr>
                  <tr class="fw-bold">
                    <td>Tumor Markers</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>PSA (Prostate)</td>
                    <td>₱ 960.00</td>
                  </tr>
                  <tr>
                    <td>CEA (Colon)</td>
                    <td>₱ 810.00</td>
                  </tr>
                  <tr>
                    <td>AFP (Liver)</td>
                    <td>₱ 850.00</td>
                  </tr>
                  <tr>
                    <td>LDH (Lactate Dehydrogenase)</td>
                    <td>₱ 680.00</td>
                  </tr>
                  <tr>
                    <td>CA 125 ll (Ovary)</td>
                    <td>₱ 1,200.00</td>
                  </tr>
                  <tr>
                    <td>CA 15-3 (Breast) </td>
                    <td>₱ 1,200.00</td>
                  </tr>
                  <tr>
                    <td>CA 19-9 (Pancreas)</td>
                    <td>₱ 1,100.00</td>
                  </tr>
                  <tr>
                    <td>CA 72.4 (Gastro Intestinal tract)</td>
                    <td>₱ 1,250.00</td>
                  </tr>
                  <tr>
                    <td>LH </td>
                    <td> ₱ 900.00</td>
                  </tr>

                  <tr class="fw-bold">
                    <td>Special test</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Pregnancy test (HCG-Urine)</td>
                    <td>₱ 150.00</td>
                  </tr>
                  <td>Pregnancy test (HCG-Serum)</td>
                  <td>₱ 200.00</td>
                  </tr>
                  <td>RPR/VDRL (Syphilis)</td>
                  <td>₱ 200.00</td>
                  </tr>
                  <td>H. pylori</td>
                  <td>₱ 550.00</td>
                  </tr>
                  <td>BSMP (Malarial Parasites)</td>
                  <td>₱ 150.00</td>
                  </tr>
                  <td>Semenalysis</td>
                  <td>₱ 200.00</td>
                  </tr>
                  <td>Peripheral smear</td>
                  <td>₱ 600.00</td>
                  </tr>
                  <td>Typhi-Dot (Typhoid Fever)</td>
                  <td>₱ 600.00</td>
                  </tr>
                  <td>Widal test </td>
                  <td>₱ 400.00</td>
                  </tr>
                  <tr>
                    <td>Gram Stain</td>
                    <td>₱ 200.00</td>
                  </tr>
                  <td>AFB for Employment</td>
                  <td>₱ 100.00</td>
                  </tr>
                  <td>Pap's Smear Reading Only</td>
                  <td>₱ 150.00</td>
                  </tr>
                  <tr>
                    <td>Active Partial Tromboplastin Time (APTT)</td>
                    <td>₱ 900.00</td>
                  </tr>
                  <tr class="fw-bold">
                    <td>Other Test</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Rheumatoid Factor-Qualitative test</td>
                    <td>₱ 450.00</td>
                  </tr>
                  <tr>
                    <td>Rheumatoid Factor-Quantitative test</td>
                    <td>₱ 550.00</td>
                  </tr>
                  <tr>
                    <td>ASO with titer</td>
                    <td>₱ 750.00</td>
                  </tr>
                  <tr>
                    <td>Dengue-Dot</td>
                    <td>₱ 850.00</td>
                  </tr>
                  <tr>
                    <td>Trop I </td>
                    <td>₱ 850.00</td>
                  </tr>
                  <tr>
                    <td>Trop T </td>
                    <td>₱ 850.00</td>
                  </tr>
                  <tr>
                    <td>CRP with titer</td>
                    <td>₱ 800.00</td>
                  </tr>
                  <tr>
                    <td>Chest X-Ray-APL</td>
                    <td>₱ 180.00</td>
                  </tr>
                  <tr>
                    <td>Chest X-Ray-ALV</td>
                    <td>₱ 150.00</td>
                  </tr>
                  <tr>
                    <td>ECG</td>
                    <td>₱ 200.00</td>
                  </tr>
                  <tr>
                    <td>Drug Test</td>
                    <td>₱ 250.00</td>
                  </tr>


                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

    </section><!-- End Pricing Section -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

      </div>

      <div>
        <iframe style="border:0; width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.3956554579117!2d125.68409506008038!3d7.309370321667385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f945b2470803d7%3A0x558feabfd6cfb9a3!2sPanabo%20City%20Diagnostic%20Center!5e0!3m2!1sen!2sph!4v1692317008270!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <div class="container">

        <div class="row mt-5">

          <div class="col-lg-14">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p>Door 8, Ground floor, Nbl Building National Highway, Brgy. San Francisco Panabo City, Davao del Norte</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <a href="https://www.facebook.com/profile.php?id=100063945191267"><i class="bi bi-facebook"></i></a>
                  <h3>Facebook Account</h3>
                  <p>Panabo City Diagnostic Center</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p>(084) 217 3824</p>
                </div>
              </div>
              <div class="col-md-12 mt-4">
                <div class="info-box">
                  <i class="bx bxs-envelope"></i>
                  <h3>Our Email Address</h3>
                  <p>Panabo.diagnostic@yahoo.com</p>
                  <p>Panabo.diagnostic@gmail.com</p>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
    <section id="copy" class="copy">

      <div class="text-center">
        <p class="p"><i class="bi bi-c-circle"></i>&nbsp;Copy right 2023 DIAGNOSYS. All rights reserved.</p>
      </div>
    </section><!-- End Cta Section -->

  </main><!-- End #main -->



  <div id="preloader"></div>
  <a href="index.html" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Templatein JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $services = [
      'CBC',
      'Hemoglobin',
      'Platelet Count',
      'Blood Typing',
      'HBsAG',
      'VDRL/Syphilis',
      'HA1c',
      'TSH',
      'T3',
      'URINE ANALYSIS',
      'Fecalysis',
      'FBS',
      'RBS',
      'LIPID PROFILE',
      'CHOLESTEROL',
      'SUA',
      'GREATININE',
      'SGPT/ALT',
      'SGOT/AST',
      'BUN',
      'ELECTROLYTES'
    ];
    $(document).ready(function() {
      // Your array of services
      var services = [
        'CBC', 'Hemoglobin', 'Platelet Count', 'Blood Typing', 'HBsAG', 'VDRL/Syphilis',
        'HA1c', 'TSH', 'T3', 'URINE ANALYSIS', 'Fecalysis', 'FBS', 'RBS',
        'LIPID PROFILE', 'CHOLESTEROL', 'SUA', 'GREATININE', 'SGPT/ALT', 'SGOT/AST',
        'BUN', 'ELECTROLYTES'
      ];

      var serviceSearch = $('#serviceSearch');
      var serviceList = $('#serviceList');

      // Initial population of the list based on services array


      serviceSearch.on('input', function() {
        serviceList.empty();

        var searchTerm = $(this).val().toLowerCase();
        var showedServices = [];
        for (service of services) {
          if (service.toLowerCase().includes(searchTerm)) {
            $('<li class="">' + service + '</li>').appendTo(serviceList);
          }
        }
        console.log(serviceList.children().length);
        if (serviceList.children().length > 0) {
          serviceList.css('display', 'absolute');
          serviceList.show();
        }
      });




      serviceSearch.on('blur', function() {
        // Hide the list when the input loses focus
        serviceList.hide();
      });
    });
  </script>
</body>

</html>