<?php
  session_start();
  require_once '../Objects/Services.php';
  require_once '../Models/ServicesModel.php';

  $servicesModel = new ServicesModel();
  $services = $servicesModel->getAllServices();
  
  
  $page = 'add_request_form';// for the components/sidebar.html
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Request Form</title>
  <?php require_once 'components/required_css.html' ?>
  
</head>
<style>
  .container{
    height: 100%;
  }
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

  <?php require_once 'components/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php require 'components/sidebar.html';
  ?>

  <main id="main" class="main">
    
    
    <div class="pagetitle">
      <h1>Request Form</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Request Form</li>
          <li class="breadcrumb-item active">Add Request Form</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-md-12">

          <div class="card">
            <div class="card-body">
              <hr>
              <div class="container">
                <header>Add Request Form</header>
                <form id="request_form" enctype="multipart/form-data">
                  <input type="number" name="user_id" id="user_id" value="<?php echo $_SESSION['id'] ?>" hidden>  
                  <div class="form first">
                    <div class="details personal">
                    <label>Date</label>
                      <input type="text" name="request_date" class="form-control" id="inputName5" readonly>
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

                          document.getElementById("inputName5").value = c_date;
                        </script>
                      <div class="fields">
                        <div class="input-field">
                          <label>Lastame</label>
                          <input type="text" id='last_name' name="request_lastname" placeholder="Enter your Lastame" required>
                        </div>
                        <div class="input-field">
                          <label>Firstname</label>
                          <input type="text" id="first_name" name="request_firstname" placeholder="Enter your Firstname" required>
                        </div>
                        <div class="input-field">
                          <label>Gender</label>
                          <select required name="request_gender" id="gender" >
                            <option disabled selected>Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="input-field">
                          <label>Date of Birth</label>
                          <input type="date" id="dob" name="request_birthdate" placeholder="Enter birth date" required>
                        </div>
                        <div class="input-field">
                          <label>Age</label>
                          <input type="number" onmousemove="FindAge()" id="age" name="request_age" placeholder="Your age " required>
                        </div>
                        <div class="input-field">
                          <label>Mobile Number</label>
                          <input type="tel" id='mobile_number' name="request_phone" pattern="[0-9]{11}" placeholder="Enter mobile number" required>
                        </div>

                        <div class="input-field">
                          <label>Province</label>
                          <select required name="request_province" id="province">
                            <option disabled selected>Select Province</option>


                          </select>
                        </div>
                        <div class="input-field">
                          <label>City</label>
                          <select required name="request_city" id="city">
                            <option disabled selected>Select City</option>


                          </select>
                        </div>
                        <div class="input-field">
                          <label>Barangay</label>
                          <select required name="request_barangay" id="barangay">
                            <option disabled selected>Select Barangay</option>


                          </select>
                        </div>
                        <div class="input-field">
                          <label>Purok</label>
                          <input type="text" id="purok" name="request_purok" placeholder="Enter your Purok" required>
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
                                      <h5>Prices:</h5>
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
                                            <select class="form-select" id="test1" name="request_test[]" aria-label="Default select example">
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
                                            <select class="form-select" id="test2" name="request_test[]" aria-label="Default select example">
                                              <option  disabled selected >Choose Test</option>
                                              <?php 
                                                foreach($services as $service):
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php endforeach ?>
                                             
                                                  </option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test3" name="request_test[]" aria-label="Default select example">
                                              <option  disabled selected>Choose Test</option>

                                              <?php foreach($services as $service): ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php endforeach ?>
                                              
                                                </option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test4" name="request_test[]" aria-label="Default select example">
                                              <option  disabled selected>Choose Test</option>
                                              <?php 
                                                foreach($services as $service){
                                              ?>
                                                <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price?>"><?php echo $service->name ?></option>
                                              <?php }?>
                                              
                                                </option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-select" id="test5" name="request_test[]" aria-label="Default select example">
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
                                            <select class="form-select" id="test6" name="request_test[]" aria-label="Default select example">
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
                                            <select class="form-select" id="test7" name="request_test[]" aria-label="Default select example">
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
                                            <select class="form-select" id="test8" name="request_test[]" aria-label="Default select example">
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
                                 <div class="form-group">

                                   <div class="row mb-3">
                                     <label for="inputNumber" class="col-sm-8 col-form-label">Upload Image of your ID</label>
                                     <div class="col-sm-6">
                                       <input class="form-control" name="fileToUpload" type="file" id="fileToUpload">
                                       
                                     </div>
                                   </div>
                                 </div>                   


                              </div>
                              <div class="total mb-5">
                              <div class="row mb-3">
                                <label for="" style=" margin-top: 35px;  font-size: 30px;">Total Amount</label>
                                <label for="" style="position: absolute; margin-top: 80px;  font-size: 40px;">&#x20B1;</label>
                                <div class="col-sm-10 end-0">
                                  <input type="text" style="font-size: 30px; text-indent: 45px;" id="total" name="request_amount" class="form-control" readonly>

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
            </form>
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
  
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


  <!-- Template Main JS File -->
  <script src="assets2/js/main.js"></script>
  <script src="assets2/js/script3.js"></script>
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
 <script>
document.addEventListener("DOMContentLoaded", function () {
    // Loop through test1 to test8
    for (var i = 1; i <= 8; i++) {
        var select = document.getElementById("test" + i);
        select.addEventListener("change", function () {
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
        totalInput.value =  total.toFixed(2);
    }

    // Initial calculation
    updateTotalPrice();
    const form = document.getElementById('request_form');


    form.addEventListener('submit', async function (event) {
      
      event.preventDefault();

      
      const formData = new FormData(form);
      console.log('hello')
      const { value: accept } = await Swal.fire({
        title: "Terms and conditions",
        input: "checkbox",
        inputValue: 0,
        grow: 'row',
        inputPlaceholder: `
          I agree that my information will be seen by the clinic personnels.
        `,
        confirmButtonText: `
          Continue&nbsp;<i class="fa fa-arrow-right"></i>
        `,
        inputValidator: (result) => {
          return !result && "You need to agree with T&C";
        }
      });
      if(accept){

        fetch('utils/add_request.php', {
          method: 'POST', 
          body: formData,
          
        })
          .then(() => {
            Swal.fire({
              title: "New Request Added",
              icon: "success"
            }).then(() => {
              window.location.href = 'patient-request-table.php'
            })
          })
      }
    });
});
</script>






</body>

</html>
