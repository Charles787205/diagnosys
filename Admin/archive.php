<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/PatientModel.php';
require_once '../Models/RequestModel.php';
require_once '../Models/AppointmentModel.php';
$head_title = 'Patient List';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$requestModel = new RequestModel();
$requests = $requestModel->getRequestsByStatus(Request::PAID);

$patientModel = new PatientModel();
$patients = $patientModel->getAllPatients();
$inactivePatients = [];
foreach ($patients as $patient) {
  if ($patient->status == 'Inactive') {
    $inactivePatients[] = $patient;
  }
}
$dates = [];
foreach ($requests as $request) {
  if (!isset($dates[$request->request_date])) {
    $dates[$request->request_date] = $request->request_date;
  }
}
?>
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

  @media only screen and (min-width: 150px) and (max-width: 780px) {}

  .search {
    width: 95%;
    margin: 0 auto;
  }
</style>

<body>

  <!-- ======= Header ======= -->
  <?php require 'components/header.html' ?>
  <?php require 'components/sidebar.html' ?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Archive</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Archive</li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">



          <div class="card">
            <div class="card-body">


              <br>
              <hr>

              <button id="archive" style="display: none;" class=""><svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="m20.54 5.23-1.39-1.68C18.88 3.21 18.47 3 18 3H6c-.47 0-.88.21-1.16.55L3.46 5.23C3.17 5.57 3 6.02 3 6.5V19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6.5c0-.48-.17-.93-.46-1.27ZM6.24 5h11.52l.83 1H5.42l.82-1ZM5 19V8h14v11H5Zm3-5h2.55v3h2.9v-3H16l-4-4-4 4Z"></path>
                </svg></button>




              <!---<div class="col-lg">
                      <select id="typeSelect" class="form-select">
                        <option selected>Type</option>
                        <option value='request'>Request Form</option>
                        <option value='appointment'>Appointment Form</option>
                      </select>
                    </div>--->
              <!---- <div class="col-lg">
                      <select id="dateSelect" class="form-select">
                        <option selected>Date</option>
                       <?php foreach ($dates as $date) {
                          echo "<option>$date</option>";
                        } ?>
                      </select>
                    </div> ---->

              <div class="col-5 position-absolute top-1 end-0">
                <div class="search">
                  <form class="search-form">
                    <input type="text" placeholder="Search Patient By Name" id="search-bar" onchange='filterPatients()' />
                    <input type="submit" value="Searh" />
                  </form>
                </div>
              </div>
              <br>
              <br>

              <table class="table table-hover" style="cursor:pointer;">
                <thead>
                  <tr>

                    <th scope="col">ID</th>

                    <th scope="col">Patient Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($inactivePatients as $patient) { ?>

                    <tr class="data-row" onclick="" data-type="request" data-date="<?php echo $request->request_date ?>">

                      <th scope="row"><?php echo $patient->id ?></th>

                      <td><?php echo $patient->getFullName() ?></td>
                      <td><?php echo $patient->status ?></td>
                      <td><a class="btn btn-secondary">Retrieve</a></td>
                    </tr>
                  <?php } ?>




                </tbody>
              </table>
            </div>
          </div>
        </div>


      </div>
      </div>
      </div>
      </div>
    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function checkMe() {
      var cb = document.getElementById("gridCheck1");
      var input = document.getElementById("archive");
      if (cb.checked == true) {
        input.style.display = "block";

      } else {
        input.style.display = "none";
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      const typeSelect = document.getElementById('typeSelect');
      const dateSelect = document.getElementById('dateSelect');

      typeSelect.addEventListener('change', filterData);
      dateSelect.addEventListener('change', filterData);

      function filterData() {
        const selectedType = typeSelect.value;
        const selectedDate = dateSelect.value;

        const rows = document.getElementsByClassName('data-row');

        for (const row of rows) {
          const rowType = row.getAttribute('data-type');
          const rowDate = row.getAttribute('data-date');
          console.log(selectedType);

          const typeMatch = selectedType === 'Type' || selectedType === rowType;
          const dateMatch = selectedDate === 'Date' || selectedDate === rowDate;

          if (typeMatch && dateMatch) {
            row.style.display = 'table-row';
          } else {
            row.style.display = 'none';
          }
        }
      }
    });
    requests = <?php echo json_encode($requests); ?>;

    function openLabResults(id) {
      for (request of requests) {
        if (request.id == id) {
          const table = getTable(request.services);
          Swal.fire({
            title: 'Patient Information',
            html: table,
            confirmButtonText: 'Close',
            grow: 'row'
          });

        }
      }
    }

    function getTable(services) {
      let tableHtml = '<table class="table">';
      tableHtml += '<thead><tr><th>Patient Name</th><th>Test</th><th>Status</th></tr></thead>';
      tableHtml += '<tbody>';

      services.forEach(service => {
        tableHtml += `<tr class="data-row"><td>${service.name}</td>
                  <td>${service.test == '' ? 'Not specified' : service.test}</td>
                  <td>${service.result == '' ? 'Not specified' : service.result}</td>
                
                  </tr>`;
      });
      tableHtml += '</tbody></table>';
      return tableHtml;

    }
  </script>

</body>

</html>