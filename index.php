<?php
  session_start();
  if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $email = $user["email"];
    $username = $user["username"];
  } else {
    $user = null;
    $email = null;
    $username = null;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tanglaw University Center</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/font.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <!-- =======================================================
  * Created by Dela Cruz, Eleccion, Juacalla
  * IT135-8L
  * For Tanglaw University Center
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo me-auto"><a href="index.php">Tanglaw University Center</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#activities">Activities</a></li>
          <li><a class="nav-link scrollto" href="#events">Events</a></li>
          <?php
            if(!isset($_SESSION["user"])){
            } else {
              echo "<li><a class='nav-link scrollto' href='my-events.php'>My Events</a></li>";
            }
          ?>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <?php
            if(!isset($_SESSION["user"])){
              echo "<li><a class='login' href='authentication/login.php'>LOGIN</a></li>";
            } else {
              echo "<li><a class='nav-link scrollto' href='account-details.php'>Account</a></li>";
              echo "<li><a class='login' href='authentication/logout.php'>LOGOUT</a></li>";
            }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <?php
            if(!is_null($username)){
              echo "<h1 style='color: #ffc95b;'>Welcome ".$username."</h1>";
            }
          ?>
          <h1 style="color: #ffc95b;">Youth, Let Your Light Shine.</h1>
          <h2 style="font-family: Montserrat;">Tanglaw University Center is a venue of KALFI (Kalinangan Youth Foundation), which organizes activities with the primary purpose of providing cultural, academic, and spiritual development to high school, university students, and young professional women.</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <?php 
              if(!isset($_SESSION["user"])){
                echo "<a href='authentication/signup.php' class='btn-volunteer-now'>Volunteer Now</a>";
              }
            ?>
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 main-img-1" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets/img/main-img-1.jpg" class="img-fluid animated" alt="" style="border-radius: 20px;">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row justify-content-center" data-aos="zoom-in">

          <div class="col-lg-2 col-md-8 col-3 d-flex align-items-center justify-content-center">
            <a href="https://kalfilead.org" target="_blank"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></a>
          </div>

          <div class="col-lg-2 col-md-8 col-3 d-flex align-items-center justify-content-center">
          <a href="#" target="_blank"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></a>
          </div>

          <div class="col-lg-2 col-md-8 col-3 d-flex align-items-center justify-content-center">
            <a href="https://www.facebook.com/opalclub/" target="_blank"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></a>
          </div>

        </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

    

        <div class="row content">
          <div class="col-lg-6">
            <div class="section-title">
              <h2 class="header-text-1">VISION</h2>
            </div>
            <p class="body-text">
              Tanglaw, as a center of KALFI, envisions empowered young women with integrity, achieving their personal best and contributing positively to society.
            </p>
          </div>
          
          <div class="col-lg-6 pt-4 pt-lg-0">
            <div class="section-title">
              <h2 class="header-text-1">MISSION</h2>
            </div>
            <p class="body-text">
              We provide personalized mentoring
              and meaningful programs that
              empower young women. These aim to:
            </p>
            <ul class="body-text">
              <li><i class="ri-check-double-line"></i> Hone the mind</li>
              <li><i class="ri-check-double-line"></i> Enrich the spirit</li>
              <li><i class="ri-check-double-line"></i> Cultivate leadership and life skills</li>
              <li><i class="ri-check-double-line"></i> Instill social responsibility and</li>
              <li><i class="ri-check-double-line"></i> Broaden world view</li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="activities" class="services section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2 class="header-text-1">ACTIVITIES</h2>
        </div>

        <div class="row">
          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 20px;">
            <div class="icon-box">
              <h4 style="color: #e78000;">Opal</h4>
              <p class="body-text">Opal is a club for high school girls aged 11-17, offering
                activities which aim to build character through sports,
                different forms of arts, home making skills, recreation and
                faith formation.</p>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="200" style="margin-bottom: 20px;">
            <div class="icon-box">
              <h4 style="color: #e78000;">KALFI LEAD</h4>
              <p class="body-text">KALFI LEAD is a long-term character formation through
                personalized mentoring, delivery of project management
                modules, constant outreach participation, and regular
                exposure to talks, workshops, and interactions with fellow
                program beneficiaries.</p>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300" style="margin-bottom: 20px;">
            <div class="icon-box">
              <h4 style="color: #e78000;">ETC</h4>
              <p class="body-text">ETC or enriching talks on Culture are informal talks or
                get-togethers on diverse topics which are relevant and
                interesting to the young audience. </p>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="500" style="margin-bottom: 20px;">
            <div class="icon-box">
              <h4 style="color: #e78000;">Life Coaching</h4>
              <p class="body-text">Mentoring is a one on one converation with an adult.
                It aims to accompany the mentee in her present
                circumstance. Mentors are caring adults who cares and
                desires to listenes, offer support and encouragement to
                mentees. It usually gears towards knowing, accepting and
                improving oneself and others.</p>
            </div>
          </div>


          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="500" style="margin-bottom: 20px;">
            <div class="icon-box">
              <h4 style="color: #e78000;">Outreach</h4>
              <p class="body-text">Regular outreach activities are being done to the nearby
                community. Volunteers teach children and visit the
                families of the beneficiaries. Visit to the sick, elderly, and
                the poor are also regularly organized.</p>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="600" style="margin-bottom: 20px;">
            <div class="icon-box">
              <h4 style="color: #e78000;">Faith centered activities</h4>
              <p class="body-text">Tanglaw has a regular class about the catholic faith.
                It also offers monthly recollection, weekly confession, and
                weekly guided prayer and benediction. The doctrinal and
                spiritual activities are entrusted to Opus Dei, a Personal
                Prelature of the Catholic Church, which helps people strive
                for holiness in ordinary everyday life.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3 style="color: #ffc95b;">Call To Action</h3>
            <p>We offer activities for women youth development focusing on character building and social service. Volunteers are very much appreciated.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="authentication/signup.php">Volunteer Now</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Events Section ======= -->
    <section id="events" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Events</h2>
          <p>Weekly activities are being organized to ensure the development of the women youth.</p>
        </div>

          <?php

          include 'db-connector.php';
          //Retrieve data from database
          $getEvents = "SELECT * FROM events";
          $events = $pdo_obj->query($getEvents);
          
            //Get rows to display
            if($events->rowCount() > 0)
            {
                //Loop through all the rows
                while($row = $events->fetch(PDO::FETCH_ASSOC))
                {
                   echo '
                   <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                   <div class="col-lg-4 col-md-6 portfolio-item filter-app">';

                   if (strlen($row['event_image']) > 0){
                      echo '<div class="portfolio-img"><img src="data:image/*;base64,' . $row['event_image'] . '" class="img-fluid" alt="image"></div>';
                   }else{
                      echo '<div class="portfolio-img"><img src="assets/img/placeholder.jpg" class="img-fluid" alt="image"></div>';
                   }
                   echo '
                   <div class="portfolio-info">
                     <h4>'.$row['event_name'] .'</h4>
                     <a href="content-details.php?id='.$row['event_id'] .'&type=user" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                   </div>
                 </div>';
                }
            }

            //If database is empty
            else 
            {
                echo 'There are no current events.';
            }
        ?>

      </div>
    </section><!-- End Events Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <p>Meet the people behind the scenes!</p>
        </div>

        <div class="row">

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Jovel Nabia</h4>
                <span>Head Event Organizer</span>
                <p>Helps with on-field organization, hands-on activities and preparations, and head representative of each events.</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href="https://web.facebook.com/jovel.nabia?_rdc=1&_rdr" target="_blank"><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Bless Villegas</h4>
                <span>Social Media Manager</span>
                <p>Manages Facebook posts, creates pubmats and weekly schedules.</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href="https://web.facebook.com/blessmvillegas" target="_blank"><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="400">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-4.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div> -->

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Testimonies Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Testimonies</h2>
          <p>Various testimonies provided by volunteers involved in activities, volunteer work, and participants.</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <h3>Jane Doe</h3>
              <h4>A Safe Space<span>Volunteer in one of the events</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultriciespan></li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendreritpan></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box featured">
              <h3>John Doe</h3>
              <h4>A Step to a Better Society<span>Volunteer in one of the events</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <h3>Joy Doe</h3>
              <h4>Great Environment<span>Volunteer in one of the events</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p>Here are some of the frequently asked questions that we have provided the answers to!</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Non consectetur a erat nam at lectus urna duis <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>For any questions, sponsorship, or general inquiries, please use the contact form below to reach out to us.</p>
        </div>

        <div class="row">
        <?php
          $query = "SELECT * FROM org_info";
          $statement = $pdo_obj->query($query);
          $rowsReturned = $statement->rowCount();

          if ($rowsReturned > 0) {
              while ($org_details = $statement->fetch(PDO::FETCH_ASSOC)) {
                  $org_addressnum = $org_details["org_addressnum"];
                  $org_street = $org_details["org_street"];
                  $org_brgy_mncplty = $org_details["org_brgy_mncplty"];
                  $org_city_state_province = $org_details["org_city_state_province"];
                  $org_country = $org_details["org_country"];
                  $org_email = $org_details["org_email"];
                  $org_map = $org_details["org_map"];
                  $org_contactnum = $org_details["org_contactnum"];
              }
          } else {
              $org_addressnum = "";
              $org_street = "";
              $org_brgy_mncplty = "";
              $org_city_state_province = "";
              $org_country = "";
              $org_email = "";
              $org_map = "";
              $org_contactnum = "";
          }
        ?>

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location</h4>
                <p><?php echo $org_addressnum." ".$org_street." ".$org_brgy_mncplty." ".$org_city_state_province." ".$org_country; ?></p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email</h4>
                <p><?php echo $org_email; ?></p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call</h4>
                <p><?php echo $org_contactnum; ?></p>
              </div>

              <!-- Tanglaw University Center in Google Maps -->
              <iframe src="<?php echo $org_map; ?>" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit" name="send">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Tanglaw University</h3>
            <?php
              echo  "<p>
                      ".$org_addressnum." ".$org_street."<br>
                      ".$org_brgy_mncplty."<br>
                      ".$org_city_state_province."<br>
                      ".$org_country."<br>
                      <strong>Phone:</strong>".$org_contactnum."<br>
                      <strong>Email:</strong>".$org_email."<br>
                    </p>";
            ?>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Feel free to reach us using our socials!</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Tanglaw University Center</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>