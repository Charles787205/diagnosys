<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/PatientModel.php';
require_once '../Models/RequestModel.php';
require_once '../Models/AppointmentModel.php';
require_once '../Objects/Services.php';
$head_title = 'Patient List';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$patientModel = new PatientModel();
$patient = $patientModel->getPatientById($_GET['patient_id']);
$requestModel = new RequestModel();

$requests = $requestModel->getRequestsByStatusAndUserId(Request::PAID, $patient->id);
$appointmentModel = new AppointmentModel();
$appointments = $appointmentModel->getAppointmentFromPatientId($patient->id);





?>
<!DOCTYPE html>
<html lang="en">
<?php require 'components/head.html' ?>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap");

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: "Inter", sans-serif;
  }

  .formbold-mb-3 {
    margin-bottom: 15px;
  }

  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    max-width: 570px;
    width: 100%;
    background: white;
  }

  .formbold-img {
    display: block;
    margin: 0 auto 45px;
  }

  .formbold-input-wrapp>div {
    display: flex;
    gap: 20px;
  }

  .formbold-input-flex {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
  }

  .formbold-input-flex>div {
    width: 50%;
  }

  .formbold-form-input {
    width: 100%;
    padding: 13px 22px;
    border-radius: 5px;
    border: 1px solid #dde3ec;
    background: #ffffff;
    font-weight: 500;
    font-size: 16px;
    color: #536387;
    outline: none;
    resize: none;
  }

  .formbold-form-input::placeholder,
  select.formbold-form-input,
  .formbold-form-input[type="date"]::-webkit-datetime-edit-text,
  .formbold-form-input[type="date"]::-webkit-datetime-edit-month-field,
  .formbold-form-input[type="date"]::-webkit-datetime-edit-day-field,
  .formbold-form-input[type="date"]::-webkit-datetime-edit-year-field {
    color: rgba(83, 99, 135, 0.5);
  }

  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-form-label {
    color: #07074d;
    font-weight: 500;
    font-size: 14px;
    line-height: 24px;
    display: block;
    margin-bottom: 10px;
  }

  .formbold-form-file-flex {
    display: flex;
    align-items: center;
    gap: 20px;
  }

  .formbold-form-file-flex .formbold-form-label {
    margin-bottom: 0;
  }

  .formbold-form-file {
    font-size: 14px;
    line-height: 24px;
    color: #536387;
  }

  .formbold-form-file::-webkit-file-upload-button {
    display: none;
  }

  .formbold-form-file:before {
    content: "Upload file";
    display: inline-block;
    background: #eeeeee;
    border: 0.5px solid #fbfbfb;
    box-shadow: inset 0px 0px 2px rgba(0, 0, 0, 0.25);
    border-radius: 3px;
    padding: 3px 12px;
    outline: none;
    white-space: nowrap;
    -webkit-user-select: none;
    cursor: pointer;
    color: #637381;
    font-weight: 500;
    font-size: 12px;
    line-height: 16px;
    margin-right: 10px;
  }

  .formbold-btn {
    text-align: center;
    width: 100%;
    font-size: 16px;
    border-radius: 5px;
    padding: 14px 25px;
    border: none;
    font-weight: 500;
    background-color: #6a64f1;
    color: white;
    cursor: pointer;
    margin-top: 25px;
  }

  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-w-45 {
    width: 45%;
  }
</style>

<body>
  <!-- ======= Header ======= -->
  <?php require 'components/header.html' ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php require 'components/sidebar.html' ?><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Patient Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Patient Table </li>
          <li class="breadcrumb-item active">Patient Details</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <!--src="assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-s.ico"-->
              <img src="../assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-s.ico" alt="Profile" class="rounded-circle" style="width: 200px" />
              <h2>Patient No.</h2>
              <h3><?php echo $patient->id ?></h3>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                    Patient Info
                  </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                    Request List
                  </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">
                    Appointment List
                  </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">
                    Laboratory Result
                  </button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patient->getFullName(); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patient->gender ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patient->birthdate ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Age</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patient->age ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">
                      <?php echo $patient->getFullAddress() ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patient->mobile_number ?></div>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <!-- Profile Edit Form -->
                  <form>
                    <div class="row mb-3">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Request ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Services</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($requests as $request) : ?>
                            <tr>
                              <th scope="row"><?php echo $request->id ?></th>
                              <td><?php echo $request->request_date ?></td>
                              <td>
                                <?php if (count($request->services) > 1) { ?>
                                  <div class="btn-group">
                                    <button type="button" style="padding:0px;" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      See services taken
                                    </button>
                                    <ul class="dropdown-menu">
                                      <?php foreach ($request->services as $services) { ?>
                                        <li><a class="dropdown-item" href="#"><?php echo $services->name ?></a></li>

                                      <?php } ?>
                                    </ul>
                                  </div>
                                <?php } else {
                                  echo $request->services[0]->name;
                                } ?>


                              </td>
                              <td><?php echo $request->status ?></td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </form>
                  <!-- End Profile Edit Form -->
                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">
                  <!-- Settings Form -->
                  <form>
                    <div class="row mb-3">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Appointment ID</th>
                            <th scope="col">Appointment Date</th>
                            <th scope="col">Services</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($appointments as $appointment) { ?>
                            <tr>
                              <th scope="row"><?php echo $appointment->id ?></th>
                              <td><?php echo $appointment->appointment_date ?></td>
                              <td>
                                <?php if (count($appointment->services) > 1) { ?>
                                  <div class="btn-group">
                                    <button type="button" style="padding:0px;" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      See services taken
                                    </button>
                                    <ul class="dropdown-menu">
                                      <?php foreach ($appointment->services as $services) { ?>
                                        <li><a class="dropdown-item" href="#"><?php echo $services->name ?></a></li>
                                      <?php } ?>
                                    </ul>
                                  </div>
                                <?php } elseif (isset($appointment->services[0])) { // Check if the array is not empty
                                  echo $appointment->services[0]->name;
                                } else {
                                  echo "No services taken";
                                } ?>
                              </td>
                              <td><?php echo $appointment->status ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </form>
                  <!-- End settings Form -->
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>
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
                            <th scope="col">Test</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($requests as $request) : ?>

                            <tr scope="row">
                              <td><?php echo $patient->last_name ?></td>
                              <td><?php echo $patient->first_name ?></td>
                              <td>
                                <button type="button" style="padding:0px;" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  See tests
                                </button>
                                <ul class="dropdown-menu">
                                  <?php foreach ($request->services as $services) : ?>
                                    <li><a class="dropdown-item" href="#"><?php echo $services->name ?></a></li>

                                  <?php endforeach ?>
                                </ul>
                              </td>
                              <td><?php echo $request->request_date ?></td>
                              <td>
                                <button type="button" class="btn btn-secondary" onclick=<?php echo "print($request->id)" ?>>
                                  <i class="bi bi-printer-fill"></i> Print
                                </button>
                              </td>
                            </tr>

                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </form>
                  <!-- End Change Password Form -->

                </div>
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


  <?php require 'components/required_js.html' ?>
  <script>
    const requests = <?php echo json_encode($requests); ?>

    function print(id) {
      console.log(requests);
      const chosenRequest = requests.find((request) => request.id === id);
      //types of result that will be displayed;
      let normal = false;
      let cbc = false;
      let hemoglobinDetermination = false;
      let hemoglobinCount = false;
      let urinalysis = false;
      let bcs = false;
      for (const service of chosenRequest.services) {
        const name = service.name;

        if (name == "FBS" || name.includes("Cholesterol") || name.toLowerCase().includes("serum") || name.includes("Creatinine")) {
          normal = true;

        }
        if (name == "Urine Analysis") {
          urinalysis = true;
        }
        if (name.toLowerCase().includes("hemoglobin determination")) {
          hemoglobinDetermination = true;
        }
        if (name.toLowerCase().includes("cbc") || name.toLowerCase() == "complete blood count") {
          cbc = true;
        }
        if (name.toLowerCase() == "sgpt") {
          normal = false;
          bcs = true;
        }
        if (name.toLowerCase() == "hemoglobin count") {
          hemoglobinCount = true;
        }
      }


      if (normal) {
        window = window.open(`result-pdf.php?request_id=${id}`, '_blank');
        console.log("normal")
      }
      if (bcs) {

        window.open(`results/blood-chem-sgpt-pdf.php?request_id=${id}`, '_blank');
        console.log("fasle")
      }
      if (cbc) {
        window.open(`results/CBC.php?request_id=${id}`, '_blank');
        console.log("cbc")
      }
      if (urinalysis) {
        window.open(`results/urine-analysis.php?request_id=${id}`, '_blank');
      }
      if (hemoglobinDetermination) {
        window.open(`results/hemoglobin-determination-pdf.php?request_id=${id}`, '_blank')
      }
      if (hemoglobinCount) {
        window.open(`results/hemoglobin-count.php?request_id=${id}`, '_blank')
      }


      console.log({
        normal,
        urinalysis,
        cbc,
        hemoglobin,
        bcs
      })

    };
  </script>
</body>

</html>