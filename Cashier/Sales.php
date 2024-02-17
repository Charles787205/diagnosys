<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/AppointmentModel.php';
require_once '../Models/RequestModel.php';
require_once '../Models/ServicesModel.php';
$head_title = 'Payment List';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$requestModel = new RequestModel();
$requests = $requestModel->getRequests();
$servicesModel = new ServicesModel();
$services = $servicesModel->getServiceSales();
$servicesModel = new ServicesModel();
$servicesSales = $servicesModel->getServicesByDateAndName();
$servicesModel->close();
$dates = [];
foreach ($servicesSales as $sales) {
  if (!isset($dates[$sales['date']])) {
    $dates[$sales['date']] = $sales['date'];
  }
}; ?>
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
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.20);


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

  /* ===========================
   ====== Medua Query for Search Box ====== 
   =========================== */

  @media only screen and (min-width : 150px) and (max-width : 780px) {}

  .search {
    width: 95%;
    margin: 0 auto;
  }
</style>

<body>


  <?php require 'components/header.html' ?>
  <?php require 'components/sidebar.html' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Sales</a></li>
          <li class="breadcrumb-item" class="active">Reports</li>

        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">



        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Services Availed</h5>

              <!-- Bar Chart -->
              <div id="barChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#barChart"), {
                    series: [{
                      data: [<?php foreach ($services as $service) {
                                echo $service->price . ',';
                              } ?>]
                    }],
                    chart: {
                      type: 'bar',
                      height: 350
                    },
                    plotOptions: {
                      bar: {
                        borderRadius: 4,
                        horizontal: true,
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    xaxis: {
                      categories: [<?php foreach ($services as $service) {
                                      echo "'$service->name',";
                                    } ?>],
                    }
                  }).render();
                });
              </script>
              <!-- End Bar Chart -->

            </div>
          </div>
        </div>

     

      



      </div>
      </div>
    </section>

  </main>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require_once 'components/required_js.html' ?>

</body>

</html>