<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/RequestModel.php';
require_once '../Models/PatientModel.php';
require_once '../Models/ServicesModel.php';
require_once '../Models/AppointmentModel.php';
$head_title = 'Dashboard';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$requestModel = new RequestModel();
$salesRequest = $requestModel->getRequestsByStatus(Request::PAID);
$requestModel = new RequestModel();
$salesRequestToday = $requestModel->getRequestTodayByStatus(Request::PAID);
$patientModel = new PatientModel();
$patients = $patientModel->getAllPatients();
$servicesModel = new ServicesModel();
$services = $servicesModel->getServiceSales();
$servicesModel = new ServicesModel();
$servicesSales = $servicesModel->getServicesByDateAndName();
$servicesModel->close();
$appointmentModel = new AppointmentModel();
$appointments = $appointmentModel->getAppointments();

$revenue = 0;
foreach ($salesRequest as $sales) {
  $revenue += $sales->total;
}

?>
<!DOCTYPE html>
<html lang="en">

<?php require 'components/head.html' ?>
<style>


</style>

<body>

  <?php require 'components/header.html' ?>

  <?php require 'components/sidebar.html' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#" onclick="filterPatientCount('today')">Today</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterPatientCount('month')">This Month</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterPatientCount('year')">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Patients <span>| <span id="patient_count_indicator">
                        Today
                      </span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="patient_count"><?php echo count($patients) ?></h6>


                    </div>
                  </div>

                </div>
              </div>

            </div>

            <!-- Sales Card -->
            <div class="col-xxl- col-md-4">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#" onclick="filterRequestForm('today')">Today</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterRequestForm('month')">This Month</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterRequestForm('year')">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title"> Request <span>| <span id="request_form_indicator">
                        Today
                      </span> </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <svg width="40" height="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1Z"></path>
                        <path d="M12 11h4"></path>
                        <path d="M12 8h4"></path>
                        <path d="M8 20V4"></path>
                      </svg>
                    </div>
                    <div class="ps-3">
                      <h6 id="request_form_count"><?php echo count($salesRequestToday) ?></h6>


                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
            <!--start appointment card-->
            <div class="col-xxl- col-md-4">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#" onclick="filterAppointmentForm('today')">Today</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterAppointmentForm('month')">This Month</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterAppointmentForm('year')">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Appointments <span>| <span id="appointment_form_indicator">
                        Today
                      </span> </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <svg width="40" height="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1Z"></path>
                        <path d="M12 11h4"></path>
                        <path d="M12 8h4"></path>
                        <path d="M8 20V4"></path>
                      </svg>
                    </div>
                    <div class="ps-3">
                      <h6 id="appointment_form_count"><?php echo count($appointments) ?></h6>


                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!--end appointment card-->
            <!-- Revenue Card 
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#" onclick="filterProfits('today')">Today</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterProfits('month')">This Month</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterProfits('year')">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title"> Profits <span>| <span>| <span id="profits_indicator">
                          Today
                        </span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class='fa-solid fa-peso-sign'></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="profits_total"><?php echo $revenue ?></h6>
                      <div id="percentage_difference">

                        <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>End Revenue Card -->

            <!-- Customers Card -->
            <!-- End Customers Card -->

            <!-- Reports -->
            ~<!-- End Reports -->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Sales Reports</h5>

                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Start</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="start_date" onchange="filterBarchartDate()">
                    </div>
                    <label for="inputDate" class="col-sm-2 col-form-label">End</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="end_date" onchange="filterBarchartDate()">
                    </div>
                  </div>
                  <!-- Bar Chart -->
                  <div id="BarChart" style="min-height: 400px;" class="echart"></div>


                  <!-- End Bar Chart -->

                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Services Availed</h5>
                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Start</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="services_start_date" onchange="filterServicesAvailedChart()">
                    </div>
                    <label for="inputDate" class="col-sm-2 col-form-label">End</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="services_end_date" onchange="filterServicesAvailedChart()">
                    </div>
                  </div>
                  <!-- Bar Chart -->
                  <div id="servicesAvailedChart"></div>

                  <script>

                  </script>
                  <!-- End Bar Chart -->

                </div>
              </div>
            </div>
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>



              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">



              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">


          <div class="card-body pb-0">


          </div><!-- End sidebar recent posts-->

        </div>
      </div><!-- End News & Updates -->

      </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script>
    const salesRequestsData = [<?php foreach ($salesRequest as $request) {
                                  echo "$request->total,";
                                } ?>];
    const appointments = <?php echo json_encode($appointments); ?>;
    const services = <?php echo json_encode($services); ?>;
  </script>
  <script src="../assets/js/admin/dashboard.js"></script>
</body>

</html>