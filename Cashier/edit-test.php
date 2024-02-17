<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/AppointmentModel.php';
require_once '../Models/RequestModel.php';
require_once '../Models/ServicesModel.php';
$head_title = 'Request Forms List';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$requestModel = new RequestModel();
$appointmentModel = new AppointmentModel();
$requests = $requestModel->getRequestsByStatus(Request::APPROVED);
$requestModel = new RequestModel();
$requestModel->getRequestsByStatus(Request::APPROVED);
$appointmentModel->getAppointments();
$servicesModel = new ServicesModel();
$packages = $servicesModel->getAllPackages();
$servicesModel = new ServicesModel();
$services = $servicesModel->getAllServices(); ?>

<!DOCTYPE html>
<html lang="en">
<?php require 'components/head.html' ?>
<style>
    .search {
        border: 2px solid #fff;
        overflow: auto;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.2);
    }

    .search input[type="text"] {
        border: 0px;
        width: 67%;
        padding: 10px 10px;
    }

    .search input[type="text"]:focus {
        outline: 0;
    }

    .search input[type="submit"] {
        border: 0px;
        background: none;
        background-color: #0d6efd;
        color: #fff;
        float: right;
        padding: 10px;

        -moz-border-radius-top-right: 5px;
        -webkit-border-radius-top-right: 5px;

        -moz-border-radius-bottom-right: 5px;
        -webkit-border-radius-bottom-right: 5px;
        cursor: pointer;
    }

    table {
        align-items: center;
    }

    /* ===========================
   ====== Medua Query for Search Box ====== 
   =========================== */

    @media only screen and (min-width: 150px) and (max-width: 780px) {}

    .search {
        width: 95%;
        margin: 0 auto;
    }

    .checkbox-inline {
        -webkit-columns: 3;
        -moz-columns: 3;
        columns: 3;
    }
</style>

<body>
    <!-- ======= Header ======= -->
    <?php require_once 'components/header.html' ?>

    <?php require_once 'components/sidebar.html' ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Request Forms</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Request Forms</li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <hr>
                            <div class="container">
                                <header>Edit Request Form</header>
                                <form id="request_form" enctype="multipart/form-data">

                                    <div class="form first">
                                        <div class="details personal">

                                            <div class="fields">
                                                <div class="input-field">
                                                    <label>Lastname*(Jr.Sr. and etc...)</label>
                                                    <input type="text" id='last_name' name="request_lastname" placeholder="Enter your Lastame" required>
                                                </div>

                                                <div class="input-field">
                                                    <label>Firstname*</label>
                                                    <input type="text" id='first_name' name="request_firstname" placeholder="Enter your Firstname" required>
                                                </div>
                                                <div class="input-field">
                                                    <label>Middlename</label>
                                                    <input type="text" id='first_name' name="request_midname" placeholder="Enter your Middlename">
                                                </div>
                                                <div class="input-field">
                                                    <label>Sex*</label>
                                                    <select id='gender' required name="request_gender">
                                                        <option disabled selected>Select Sex</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="input-field">
                                                    <label>Date of Birth*</label>
                                                    <input type="date" id="dob" name="request_birthdate" placeholder="Enter birth date" required>
                                                </div>
                                                <div class="input-field">
                                                    <label>Age*</label>
                                                    <input type="number" onmousemove="FindAge()" id="age" name="request_age" placeholder="Your age " required>
                                                </div>
                                                <div class="input-field">
                                                    <label>Mobile Number*</label>
                                                    <input type="tel" id='mobile_number' name="request_phone" pattern="[0-9]{11}" pmaxlength="11" oninput="validateNumber(event)" placeholder="Enter mobile number" required>
                                                </div>

                                                <div class="input-field">
                                                    <label>Building/ House Number</label>
                                                    <input type="text" id="house_no" name="request_house_no" placeholder="Enter your Building/ House Number">
                                                </div>
                                                <div class="input-field">
                                                    <label>Subdivision/Street Name</label>
                                                    <input type="text" id="subdivision" name="request_subdivision" placeholder="Enter your Subdivision/Street Name">
                                                </div>
                                                <div class="input-field">
                                                    <label>Purok*</label>
                                                    <input type="text" id="purok" name="request_purok" placeholder="Enter your Purok" required>
                                                </div>
                                                <div class="input-field">
                                                    <label>Province*</label>
                                                    <select required name="request_province" id="province">
                                                        <option disabled selected>Select Province</option>


                                                    </select>
                                                </div>
                                                <div class="input-field">
                                                    <label>City*</label>
                                                    <select required name="request_city" id="city">
                                                        <option disabled selected>Select City</option>


                                                    </select>
                                                </div>
                                                <div class="input-field">
                                                    <label>Barangay*</label>
                                                    <select required name="request_barangay" id="barangay">
                                                        <option disabled selected>Select Barangay</option>


                                                    </select>
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


                                                                <!--  <div class="col-lg-12">

                                  <div class="row">
                                    <div class="col-sm-6">
                                      <h5>Select service</h5>
                                      <div class="form-group">
                                        <select class="form-select" id="test1" name="request_test[]" aria-label="Default select example">
                                          <option disabled selected>Choose Test</option>
                                          <?php
                                            foreach ($services as $service) {
                                            ?>
                                            <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>"><?php echo $service->name ?></option>
                                          <?php } ?>

                                          </option>
                                        </select>
                                      </div>
                                    </div>



                                    <div class="col-sm-6">
                                      <br>
                                      <div class="form-group">
                                        <select class="form-select" id="test2" name="request_test[]" aria-label="Default select example">
                                          <option disabled selected>Choose Test</option>
                                          <?php
                                            foreach ($services as $service) {
                                            ?>
                                            <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>"><?php echo $service->name ?></option>
                                          <?php } ?>

                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <select class="form-select" id="test3" name="request_test[]" aria-label="Default select example">
                                          <option disabled selected>Choose Test</option>
                                          <?php
                                            foreach ($services as $service) {
                                            ?>
                                            <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>"><?php echo $service->name ?></option>
                                          <?php } ?>

                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <select class="form-select" id="test4" name="request_test[]" aria-label="Default select example">
                                          <option disabled selected>Choose Test</option>
                                          <?php
                                            foreach ($services as $service) {
                                            ?>
                                            <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>"><?php echo $service->name ?></option>
                                          <?php } ?>

                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <select class="form-select" id="test5" name="request_test[]" aria-label="Default select example">
                                          <option disabled selected>Choose Test</option>
                                          <?php
                                            foreach ($services as $service) {
                                            ?>
                                            <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>"><?php echo $service->name ?></option>
                                          <?php } ?>

                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <select class="form-select" id="test6" name="request_test[]" aria-label="Default select example">
                                          <option disabled selected>Choose Test</option>
                                          <?php
                                            foreach ($services as $service) {
                                            ?>
                                            <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>"><?php echo $service->name ?></option>
                                          <?php } ?>

                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <select class="form-select" id="test7" name="request_test[]" aria-label="Default select example">
                                          <option disabled selected>Choose Test</option>
                                          <?php
                                            foreach ($services as $service) {
                                            ?>
                                            <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>"><?php echo $service->name ?></option>
                                          <?php } ?>

                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <select class="form-select" id="test8" name="request_test[]" aria-label="Default select example">
                                          <option disabled selected>Choose Test</option>
                                          <?php
                                            foreach ($services as $service) {
                                            ?>
                                            <option value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>"><?php echo $service->name ?></option>
                                          <?php } ?>

                                        </select>
                                        </option>
                                      </div>
                                    </div>

                                  </div>
                                </div> !-->
                                                                <fieldset class="checkbox-inline">
                                                                    <legend class="control-label" for="course_details"> </legend>
                                                                    <?php
                                                                    foreach ($services as $service) {
                                                                    ?>
                                                                        <div class="col-sm-12" style="font-size: 15px;">
                                                                            <input class="form-check-input" style="border-color: black; font-size: 17px;" name="request_test[]" type="checkbox" id="gridCheck1" value="<?php echo $service->id ?>" data-price="<?php echo $service->price ?>">
                                                                            <label class="form-check-label" for="gridCheck1"> <b> <?php echo $service->name ?></b>-(Php&nbsp;<?php echo $service->price ?>.00) </label>
                                                                        </div>
                                                                    <?php } ?>

                                                                </fieldset>
                                                            </div>

                                                        </div>
                                                        <input hidden id="user_id" type='number' name="user_id" value=<?php echo $_SESSION['id'] ?>>


                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-4" style="margin-left:auto">
                                                            <label for="" class="row" style="  font-size: 30px;">Total Amount</label>
                                                            <label class="col" for="" style=" font-size: 40px;">&#x20B1;</label>
                                                            <input class="col-sm-10" type="text" style="border:none; font-size: 30px; text-indent: 45px;" id="total" name="request_amount" class="form-control" value="0.00" readonly>
                                                            <button type="submit" id="third" name="submit" class="btn btn-primary">Submit</button>
                                                        </div>
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
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/js/script3.js"></script>
    <?php require 'components/required_js.html' ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Loop through test1 to test8
            for (var i = 1; i <= 8; i++) {
                var select = document.getElementById("test" + i);
                select.addEventListener("change", function() {
                    updateTotalPrice();
                });
            }
        });

        //FUNCTIONS


        function FindAge() {
            var day = document.getElementById("dob").value;
            var DOB = new Date(day);
            var today = new Date();
            var Age = today.getTime() - DOB.getTime();
            Age = Math.floor(Age / (1000 * 60 * 60 * 24 * 365.25));
            document.getElementById("age").value = Age;
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


        const form = document.getElementById('request_form');


        form.addEventListener('submit', function(event) {

            event.preventDefault();


            const formData = new FormData(form);
            console.log('hello')

            fetch('utils/edit_request.php', {
                    method: 'POST',
                    body: formData,

                })
                .then(() => {
                    Swal.fire({
                        title: "Request Edited",
                        icon: "success",
                    }).then(() => {
                        window.location.href = 'pending_requests.php'
                    })
                })
        });

        const user_id = <?php echo $_SESSION['id'] ?>;
        const request = <?php echo json_encode($request) ?>;
        document.addEventListener("DOMContentLoaded", () => {
            const appointmentSelect = document.getElementById('appointment-select');
            changeData();
            console.log(request.id);

            function changeData() {

                $('#request_date').val(request.request_date.split(' ')[0]);
                $('#last_name').val(request.patient.last_name);
                $('#first_name').val(request.patient.first_name);
                $('#gender').val(request.patient.gender);
                $('#dob').val(request.patient.birthdate);
                $('#age').val(request.patient.age)
                $('#mobile_number').val(request.patient.mobile_number);
                $('#province').html(`<option value="${request.patient.province}">${request.patient.province}</option>`);
                $('#city').html(`<option value="${request.patient.city}">${request.patient.city}</option>`);
                $('#barangay').html(`<option value="${request.patient.barangay}">${request.patient.barangay}</option>`);
                $('#purok').val(request.patient.purok);
                $('#total').val(request.total);
                $('#user_id').val(request.user_id)
                $('#subdivision').val(request.patient.subdivision);
                $('#house_no').val(request.patient.house_no);
                for (var i = 0; i < request.services.length; i++) {
                    $(`#test${i+1}`).val(request.services[i].id).change();

                }



            }
        })
    </script>
    <script>
        function validateNumber(event) {
            const input = event.target;
            const regex = /^[0-9]*$/; // Regular expression to match only numbers

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            }

            // Limit input to 11 digits
            if (input.value.length > 11) {
                input.value = input.value.slice(0, 11);
            }
        }
    </script>



</body>

</html>