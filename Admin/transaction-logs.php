<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/AppointmentModel.php';
require_once '../Models/RequestModel.php';
$head_title = 'Dashboard';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$appointmentModel = new AppointmentModel();
$appointments = $appointmentModel->getAppointments();
$requestModel = new RequestModel();
$requests = $requestModel->getRequests();



$date_now = date("F d, Y");
$date_now_format = date_create_from_format("F d, Y", $date_now);
?>
<!DOCTYPE html>
<html lang="en">
<?php require 'components/head.html' ?>
<style>
  .search input {
    width: 850px;
    text-indent: 25px;
  }

  .search button {
    margin-top: -65px;
    margin-left: 850px;
  }

  .search i {
    position: absolute;
    margin-top: 3px;
    margin-left: 10px;
    font-size: 20px;
  }
</style>

<body>

  <?php require 'components/header.html' ?>

  <?php require 'components/sidebar.html' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Transaction Logs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Transaction Logs</li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->



    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Transaction Logs</h5>
              <div class="col-12">
                <div class="container">
                  <div class="flex-container">
                    <button type="button" class="btn btn-secondary" style="right: 0;" onclick="onPrint()"><i class="bi bi-printer"></i> Print</button>

                  </div>
                  <div class="filter" ">
                    <a class=" icon" style="float:right" href=" #" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>

                      <li><a class="dropdown-item" onclick="handleDateFilter('today')">Today</a></li>
                      <li><a class="dropdown-item" onclick="handleDateFilter('month')">This Month</a></li>
                      <li><a class="dropdown-item" onclick="handleDateFilter('year')">This Year</a></li>
                    </ul>
                  </div>
                  <br>

                  <table id="example" class="table table-striped table-bordered" style="width:100%">

                    <thead>
                      <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Test</th>
                        <th>Age</th>
                        <th>Total Amount</th>
                        <th>Bill Date</th>
                        <th>Time Started</th>
                        <th>Time Ended</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($requests as $request) {
                      ?>
                        <?php
                        $started_time = date('H:i', strtotime($request->request_date));
                        $started_date = date("F d, Y", strtotime($request->request_date));

                        if ($request->result_date != null) {

                          $result_time = date('H:i', strtotime($request->result_date));
                        } else {
                          echo $request->result_date;
                          $result_time = "N/A";
                        }

                        ?>
                        <tr class="table_row">
                          <td><?php echo $request->patient->first_name ?> </td>
                          <td><?php echo $request->patient->last_name ?></td>
                          <td><?php foreach ($request->services as $service) {
                                echo $service->name . ', ';
                              } ?></td>
                          <td><?php echo $request->patient->age ?></td>
                          <td><?php echo $request->total ?></td>
                          <td class="started_date"><?php echo $started_date ?></td>
                          <td><?php echo $started_time ?></td>
                          </td>
                          <td><?php echo $result_time ?></td>



                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>





                </div>
              </div>





              </tbody>
              </table>
            </div>
          </div>
        </div>



        <!-- Line Chart -->

      </div>
      </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="assets/js/table.js"></script>
  <script src="../assets/js/admin/transaction-logs.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="../assets/js/main.js"></script>
  <script>
    function onPrint() {
      location.href = "utils/printing/transaction_logs.php"
    }
  </script>
</body>

</html>