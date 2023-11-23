<?php
session_start();
if(!isset($_SESSION['id'])){
  header('Location: index.php');
}

$page = 'add_appointment'; //for the components/sidebar.html
require_once '../Objects/Services.php';
  require_once '../Models/ServicesModel.php';

  $servicesModel = new ServicesModel();
  $services = $servicesModel->getAllServices();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Appointment</title>
  <?php require_once 'components/required_css.html'?>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
  .packages input {
    display: inline;

  }

  .tot span {
    font-size: 20px;
    font-weight: 800;
    margin-left: 750px;
  }

  .tot input {
    font-size: 25px;
    height: 50px;
    background-color: rgba(0, 0, 0, 0);
    width: 140px;
    border: none;
    font-weight: 700;
    text-align: right;
    margin-left: 750px;
  }

  .tet {
    margin-top: 26px;
    margin-left: 750px;
    width: 140px;
    height: 50px;
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.20);
    position: absolute;
  }

  th {
    top: 0;
    z-index: 2;
    position: sticky;
    background-color: white;
  }

  td {
    font-weight: 500;
  }

  .total {

    position: relative;

    margin-top: -70px;
    margin-left: 77%;
    z-index: 1;
  }






  .input-field label {
    font-size: 15px;
  }

  .tbl-scroll {
    overflow: hidden;
    overflow-y: scroll;
    height: 220px;
  }
</style>

<body>

  <!-- ======= Header ======= -->
  <?php require_once 'components/header.php' ?><!-- End Header -->

  <?php require_once 'components/sidebar.html' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Appointment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Appointment</li>
          <li class="breadcrumb-item active">Add Appointment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Appointment</h5>

              <div class="container">
                <header>Add Appointment</header>
                <form action="add_appoint.php" method="POST" enctype="multipart/form-data">
                  <div class="form first">
                    <div class="details personal">
                      <span class="title">Details</span>
                      <div class="fields">
                        <div class="input-field">
                          <label>Lastame</label>
                          <input type="text" name="appointment_lastname" placeholder="Enter your Lastame" required>
                        </div>
                        <div class="input-field">
                          <label>Firstname</label>
                          <input type="text" name="appointment_firstname" placeholder="Enter your Firstname" required>
                        </div>
                        <div class="input-field">
                          <label>Gender</label>
                          <select name="appointment_gender" required>
                            <option disabled selected>Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>

                          </select>
                        </div>
                        <div class="input-field">
                          <label>Date of Birth</label>
                          <input type="date" name="appointment_birthdate" id="dob" placeholder="Enter birth date" required>
                        </div>
                        <script>
                          function FindAge() {
                            var day = document.getElementById("dob").value;
                            var DOB = new Date(day);
                            var today = new Date();
                            var Age = today.getTime() - DOB.getTime();
                            Age = Math.floor(Age / (1000 * 60 * 60 * 24 * 365.25));
                            document.getElementById("age").value = Age;
                          }
                        </script>
                        <div class="input-field">
                          <label>Age</label>
                          <input type="number" onmousemove="FindAge()" id="age" name="appointment_age" placeholder="Your age" required>
                        </div>
                        <div class="input-field">
                          <label>Mobile Number</label>
                          <input type="number" name="appointment_phone" pattern="[0-9]{11}" placeholder="Enter mobile number" required>
                        </div>

                        <div class="input-field">
                          <label>Province</label>
                          <select required name="appointment_province" id="province">
                            <option selected>Select Province</option>


                          </select>
                        </div>
                        <div class="input-field">
                          <label>City</label>
                          <select required name="appointment_city" id="city">
                            <option selected>Select City</option>


                          </select>
                        </div>
                        <div class="input-field">
                          <label>Barangay</label>
                          <select required name="appointment_barangay" id="barangay">
                            <option selected>Select Barangay</option>


                          </select>
                        </div>

                        <div class="input-field">
                          <label>Purok</label>
                          <input type="text" name="appointment_purok" placeholder="Enter your Purok" required>
                        </div>
                        <div class="input-field">
                          <label>Appointment Date</label>
                          <input type="date" name="appointment_date" id="appointment_date" placeholder="Enter your Purok" required>
                        </div>
                        <script>
                          var d = new Date()
                          var yr = d.getFullYear();
                          var month = d.getMonth() + 1

                          if (month < 10) {
                            month = '0' + month
                          }
                          var date = d.getDate();
                          if (date < 10) {
                            date = '0' + date
                          }
                          var c_date = yr + "-" + month + "-" + date;

                          document.getElementById("appointment_date").value = c_date;
                        </script>

                        <div class="input-field">
                          <label></label>
                          <input type="hidden" placeholder="Enter your Purok" required>
                        </div>
                      </div>
                    </div>
                    

                    <div class="container">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">


                              <br>

                              <div class="row mb-3">
                                <div class="col-sm-5">

                                  <div class="card">
                                    <div class="card-body">
                                      <h5>Price:</h5>
                                      <div class="tbl-scroll">
                                        <table class="table">
                                          <thead>
                                            <tr>

                                              <th scope="col">Test</th>
                                              <th scope="col">Price</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php 
                                              foreach($services as $service){
                                            ?>
                                            <tr>
                                              <td><?php echo $service->name ?></td>
                                              <td><?php echo $service->price ?></td>
                                            </tr>
                                            <?php } ?>

                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-7">
                                  <div class="card">
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <h5>Select service</h5>
                                          <div class="form-group">
                                            <select class="form-select" id="test1" name="appointment_test[]" aria-label="Default select example">
                                              <option disabled selected>Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                             <!-- 
                                              $service = mysqli_query($conn, "SELECT * FROM service_offered");
                                              while ($c = mysqli_fetch_array($service)) {
                                              ?>
                                                <option value="<php echo $c['Test'] ?>" data-price="<php echo $c['Price'] ?>"><php echo $c['Test'] ?>

                                                } ?>
                                                --->
                                              </option>
                                              </select>
                                          </div>
                                        </div>



                                        <div class="col-sm-6">
                                          <br>
                                          <div class="form-group">
                                            <select class="form-select" id="test2" name="appointment_test[]" aria-label="Default select example">
                                              <option  disabled selected >Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                             <!-- <php
                                              $service = mysqli_query($conn, "SELECT * FROM service_offered");
                                              while ($c = mysqli_fetch_array($service)) {
                                              ?>
                                                <option value="<php echo $c['Test'] ?>" data-price="<php echo $c['Price'] ?>"><php echo $c['Test'] ?>

                                                  <php } ?>
                                                    --->
                                                  </option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test3" name="appointment_test[]" aria-label="Default select example">
                                              <option  disabled selected>Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                              <!--?php
                                              $service = mysqli_query($conn, "SELECT * FROM service_offered");
                                              while ($c = mysqli_fetch_array($service)) {
                                              ?>
                                                <option value="<php echo $c['Test'] ?>" data-price="<php echo $c['Price'] ?>"><php echo $c['Test'] ?>
                                                  
                                                  <php } ?> --->
                                                </option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test4" name="appointment_test[]" aria-label="Default select example">
                                              <option  disabled selected>Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                              <!--<option  disabled selected>Choose Test</option>
                                              <php
                                              $service = mysqli_query($conn, "SELECT * FROM service_offered");
                                              while ($c = mysqli_fetch_array($service)) {
                                              ?>
                                                <option value="<php echo $c['Test'] ?>" data-price="<php echo $c['Price'] ?>"><php echo $c['Test'] ?>

                                                  <php } ?>-->
                                                </option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test5" name="appointment_test[]" aria-label="Default select example">
                                              <option  disabled selected >Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                             <!-- <php
                                              $service = mysqli_query($conn, "SELECT * FROM service_offered");
                                              while ($c = mysqli_fetch_array($service)) {
                                              ?>
                                                <option value="<php echo $c['Test'] ?>" data-price="<php echo $c['Price'] ?>"><php echo $c['Test'] ?>

                                                  <php } ?>--->
                                                </option>
                                            </select> 
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test6" name="appointment_test[]" aria-label="Default select example">
                                              <option  disabled selected>Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                            <!--  <option  disabled selected>Choose Test</option>
                                              <php
                                              $service = mysqli_query($conn, "SELECT * FROM service_offered");
                                              while ($c = mysqli_fetch_array($service)) {
                                              ?>
                                                <option value="<php echo $c['Test'] ?>" data-price="<php echo $c['Price'] ?>"><php echo $c['Test'] ?>

                                                  <php } ?> --->
                                                </option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test7" name="appointment_test[]" aria-label="Default select example">
                                              <option  disabled selected>Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                             <!-- <option  disabled selected >Choose Test</option>
                                              <php
                                              $service = mysqli_query($conn, "SELECT * FROM service_offered");
                                              while ($c = mysqli_fetch_array($service)) {
                                              ?>
                                                <option value="<php echo $c['Test'] ?>" data-price="<php echo $c['Price'] ?>"><php echo $c['Test'] ?>

                                                  <php } ?> --->
                                                </option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test8" name="appointment_test[]" aria-label="Default select example">
                                              <option  disabled selected>Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                              
                                              </select>
                                              </option>
                                          </div>
                                        </div>
                                        
                                      </div>
                                    </div>
                                  </div>



                                        
                                      </div>
                                    </div>
                                  </div>

                                </div>

                                <div class="row mb-3">
                                  <label for="inputNumber" class="col-sm-8 col-form-label">Upload Image of your ID</label>
                                  <div class="col-sm-6">
                                    <input class="form-control" type="file" name='fileToUpload' id="fileToUpload">
                                  </div>
                                </div>


                              </div>
                            </div>

                            <div class="total">
                              <div class="row mb-3">
                                <div style="display:flex;">

                                
                                  <label for="" style=" margin-top: 15px;  font-size: 30px;"> Total Amount</label>
                                </div>
                                <div class="row-sm-10" style="display: flex; align-items:center;">
                                  <label for="" style="font-size: 40px;margin-right:20px;">&#x20B1;</label>
                                  <input type="text" name="appointment_amount" style=" font-size: 35px; text-indent: 45px;" id="total" class="form-control" readonly>

                                </div>

                              </div>
                              <button type="submit" name="submit" class="btn btn-primary">Submit</button>



                            </div>

                          </div>


                        </div>

                      </div>
                    </div>
                  </div>
              </div>

            </div>
          </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets2/js/main.js"></script>
  <script src="assets2/js/script3.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Loop through test1 to test8
      for (var i = 1; i <= 8; i++) {
        var select = document.getElementById("test" + i);
        select.addEventListener("change", function() {
          updateTotalPrice();
        });
      }

      function updateTotalPrice() {
        var total = 0;
        for (var i = 1; i <= 8; i++) {
          var select = document.getElementById("test" + i);
          var selectedOption = select.options[select.selectedIndex];
          var selectedPrice = parseFloat(selectedOption.getAttribute("data-price"));
          if (!isNaN(selectedPrice)) {
            total += selectedPrice;
          }
        }
        var totalInput = document.getElementById("total");
        totalInput.value = total.toFixed(2);
      }

      // Initial calculation
      updateTotalPrice();
    });
  </script>

</body>

</html>