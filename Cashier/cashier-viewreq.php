<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/AppointmentModel.php';
require_once '../Models/RequestModel.php';
$head_title = 'Request Forms List';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$requestModel = new RequestModel();
$request = $requestModel->getRequestById($_GET['request_id']);
?>

<!DOCTYPE html>
<html lang="en">
<?php require 'components/head.html'; ?>
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

  @media only screen and (min-width: 150px) and (max-width: 780px) {}

  .search {
    width: 95%;
    margin: 0 auto;
  }

  label {
    font-weight: 600;
  }
</style>

<body>
  <!-- ======= Header ======= -->
  <?php require 'components/header.html' ?>
  <?php require 'components/sidebar.html' ?>


  <main id="main" class="main">
    <div class="row align-items-top">
      <div class="col-lg-4">

        <!-- Default Card -->
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="../assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-s.ico" alt="Profile" class="rounded-circle" style="width: 200px" />
            <div class="col-md-12">
              <input type="text" class="form-control" style="
                      font-weight: 800;
                      font-size: 20px;
                      text-align: center;
                    " id="inputName5" value="<?php echo $request->patient->getFullName() ?>" readonly />
            </div>
            <h3>Patient No.</h3>
            <div class="col-md-4">
              <input type="text" class="form-control" style="
                      font-weight: 800;
                      font-size: 20px;
                      text-align: center;
                    " id="inputName5" value="<?php echo $request->id ?>" readonly />
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Personal Details</h5>
            <input type="date" class="form-control" id="inputName5" value="<?php echo $request->request_date ?>" readonly />
            <hr />
            <!-- Multi Columns Form -->
            <form action="#" class="row g-3">
              <div class="col-md-4">
                <label for="inputName5" class="form-label">Lastname</label>
                <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->last_name ?>" readonly />
              </div>
              <div class="col-md-4">
                <label for="inputName5" class="form-label">Firstname</label>
                <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->first_name ?>" readonly />
              </div>
              <div class="col-md-4">
                <label for="inputName5" class="form-label">Gender</label>
                <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->gender ?>" readonly />
              </div>
              <div class="col-md-4">
                <label for="inputName5" class="form-label">Date Of Birth</label>
                <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->birthdate ?>" readonly />
              </div>
              <div class="col-md-4">
                <label for="inputName5" class="form-label">Age</label>
                <input type="number" class="form-control" id="inputName5" value="<?php echo $request->patient->age ?>" readonly />
              </div>
              <div class="col-md-4">
                <label for="inputName5" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->mobile_number ?>" readonly />
              </div>

              <div class="col-md-6">
                <label for="inputName5" class="form-label">Province</label>
                <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->province ?>" readonly />
              </div>
              <div class="col-md-6">
                <label for="inputName5" class="form-label">City</label>
                <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->city ?>" readonly />
              </div>
              <div class="col-md-6">
                <label for="inputEmail5" class="form-label">Barangay</label>
                <input type="email" class="form-control" id="inputEmail5" value="<?php echo $request->patient->barangay ?>" readonly />
              </div>
              <div class="col-md-6">
                <label for="inputPassword5" class="form-label">Purok</label>
                <input type="text" class="form-control" id="inputPassword5" value="<?php echo $request->patient->purok ?>" readonly />
              </div>
              <div class="col-12">
                <label for="inputName5" class="form-label">Service Avail</label>
                <input type="text" class="form-control" style="height: 100px" id="inputPassword5" value=" <?php foreach ($request->services as $service) {
                                                                                                            echo $service->name . ', ';
                                                                                                          }  ?>" readonly />
              </div>
              <div class="col-md-6">
                <label for="inputPassword5" class="form-label">Total Amount</label>
                <input type="text" class="form-control" id="inputPassword5" value="<?php echo $request->total ?>" readonly />
              </div>

              <hr />
              <div class="text-center">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#disablebackdrop" value='pay'>
                  Pay
                </button>
                <a href="cashier-request-modal.php" type="button" name="reset" class="btn btn-danger">Cancel</a>


              </div>
              <hr />
            </form>
            <!-- End Multi Columns Form -->
          </div>
        </div>
      </div>
    </div>

    <!-- Disabled Backdrop Modal -->

    <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" id="payment-form" onsubmit="submitForm(event)">
            <div class="modal-body">
              <label for="inputPassword5" class="form-label">Money</label>
              <input type="number" class="form-control" id="number1" oninput="calculateChange()" placeholder="Input Money" name="payment" required />
              <label for="inputPassword5" class="form-label">Total Amount</label>
              <input type="number" name="total_amount" class="form-control" id="number2" value="<?php echo $request->total ?>" readonly />
              <label for="inputPassword5" class="form-label">Change</label>
              <input type="number" class="form-control" id="result" readonly />
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="cancel">
                Close
              </button>
              <button type="submit" name="pay" class="btn btn-primary" id="printButton" value='pay'>
                Pay
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Disabled Backdrop Modal-->
  </main>
  <!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function submitForm(e) {
      e.preventDefault();
      const paymentForm = e.target
      const change = paymentForm.elements['result'].value
      const payment = paymentForm.elements['payment'].value
      if (change >= 0) {
        fetch('utils/pay_request.php', {
          method: 'POST',
          body: JSON.stringify({
            payment: payment,
            id: <?php echo $request->id ?>,
          })
        }).then(() => {
          var pdfWindow = window.open("generatePdf.php?request_id=<?php echo $request->id ?>", "_blank");
          pdfWindow.print();
          window.location.href = "cashier-payment-list.php";
        });


      } else {
        Swal.fire({
          title: 'Insufficient',
          text: 'Insufficient Money',
          icon: 'warning'
        })
      }
    }


    function calculateChange() {
      var number1 = parseFloat(document.getElementById("number1").value);
      var number2 = parseFloat(document.getElementById("number2").value);
      var result = number1 - number2;
      document.getElementById("result").value = result.toFixed(2);
    }
  </script>
</body>
</body>

</html>