<?php
session_start();
require_once '../Objects/Services.php';
require_once '../Models/ServicesModel.php';
require_once '../Models/RequestModel.php';
$servicesModel = new ServicesModel();
$services = $servicesModel->getAllServices();
$page = 'add_request_form'; // forthe components/sidebar.html 
$requestModel = new RequestModel();
$requests = $requestModel->getRequestWithResult($_SESSION['id'])
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Result</title>
  <?php require_once 'components/required_css.html' ?>
</head>
<style>
  .container {
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
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.2);
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

  .input-field label {
    font-size: 15px;
  }

  .tbl-scroll {
    overflow: hidden;
    overflow-y: scroll;
    height: 250px;
  }
</style>

<body>
  <?php require_once 'components/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php require 'components/sidebar.html';
  ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Result</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>

          <li class="breadcrumb-item active">Result</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-4">
              <div class="row">
                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <!--src="assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-s.ico"-->
                    <img src="../assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-s.ico" alt="Profile" class="rounded-circle" style="width: 200px" />
                    <h2>Patient No.</h2>
                    <h3>77</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-8">
              <div class="card">
                <div class="card-body pt-3">
                  <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                        Laboratory Result
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                      <div class="row mb-3">
                        <!-- Change Password Form 
					  <div class="details personal">
					<label>Filter Date</label>
					  <input type="date" class="form-control" id="inputName5">
							</div>-->

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Lastname</th>
                              <th scope="col">Firstname</th>

                              <th scope="col">Date</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php foreach ($requests as $request) : ?>
                              <tr scope="row">

                                <td><?php echo $request->patient->last_name ?></td>
                                <td><?php echo $request->patient->first_name ?></td>
                                <td><?php echo date("F d, Y", strtotime($request->result_date)) ?></td>

                                <td>
                                  <button type="button" class="btn btn-primary" onclick='seeResult(<?php echo $request->id ?>)'>
                                    <i class="bi bi-eye-fill"></i>
                                  </button>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row card card-body" id="result_table_container">
        <table class="table" id="result_table">
          <thead>
            <tr>
              <th scope="col">Service Name</th>
              <th scope="col">Result</th>

              <th scope="col">Normal Value</th>

            </tr>
          </thead>
          <tbody>

            <?php foreach ($requests as $request) : ?>
              <tr scope="row">

                <td><?php echo $request->patient->last_name ?></td>
                <td><?php echo $request->patient->first_name ?></td>
                <td><?php echo date("F d, Y", strtotime($request->result_date)) ?></td>


              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main2.js"></script>
  <script src="assets/js/script3.js"></script>
  <script>
    const requests = <?php echo json_encode($requests); ?>;
    console.log(requests);
    const resultTable = $("#result_table");
    $("#result_table_container").hide();

    function seeResult(requestId) {
      const tbody = $(resultTable).find("tbody").get(0);

      $(tbody)
        .find("tr")
        .each(function() {
          $(this).remove();
        }); //remove all the row first

      for (const request of requests) {
        if (request.id === requestId) {
          let colorClass = checkIfNormal(request.services[0].results[0]["result"], request.services[0].normal_value) ? "text-success" : "text-danger";
          request.services.map((service, index) => {
            const tableRow = document.createElement("tr");
            tableRow.innerHTML = `<td>${service.name}</td>
                             <td class="${colorClass}">${service.results[0]["result"]}</td>
                             <td>${service.normal_value}</td>`;

            tbody.appendChild(tableRow);
          });
        }
      }
      $("#result_table_container").show();
    }

    function checkIfNormal(value, normalValueStr) {
      //normal value is a string and it differs some has range and some has single value
      //we need to check if the value is within the range or equal to the normal value
      //if the value is within the range, return true, else return false
      const normalValStr = normalValueStr.split(" ")[0]; //ex. 20-30 ml -> [20-30, ml] or 20 mg -> [20, mg]
      if (normalValStr.includes("-")) {
        const range = normalValStr.split("-").map(val => parseInt(val));
        return value >= range[0] && value <= range[1];
      } else {
        return value === parseInt(normalValStr);
      }
    }
  </script>

</body>

</html>