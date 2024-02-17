<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/AppointmentModel.php';
$head_title = 'Appointments';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$appointmentModel = new AppointmentModel();
$appointments = $appointmentModel->getAppointments();

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

  /* ===========================
   ====== Medua Query for Search Box ====== 
   =========================== */

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
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Appointments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Appointments</li>
          <li class="breadcrumb-item">Appointments List</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <hr />
              <div class="position-relative">
                <h5 class="card-title">List of Appointments</h5>
                <div class="col-5 position-absolute top-0 end-0">
                  <div class="search">
                    <form class="search-form">
                      <input type="text" placeholder="Search Patient By Name" id="search-bar" onchange='filterAppointments()' />
                      <input type="submit" value="Search" />
                    </form>
                  </div>
                </div>
              </div>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Appointment ID</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Age</th>
                    <th scope="col">Test</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($appointments as $appointment) { ?>
                    <tr id="appointment-row-<?php echo $appointment->id; ?>">
                      <td><?php echo $appointment->id ?></td>
                      <td><?php echo $appointment->patient->last_name ?></td>
                      <td><?php echo $appointment->patient->first_name ?></td>
                      <td><?php echo $appointment->patient->age ?></td>
                      <td><?php
                          $servicesString = '';
                          foreach ($appointment->services as $services) {
                            $servicesString .= $services->name . ", ";
                          }
                          echo $servicesString;
                          ?></td>
                      <td><?php echo $appointment->status ?></td>
                      <td>
                        <a href=<?php echo "appointment_detail.php?patient_id=$appointment->patient_id&appointment_id=$appointment->id" ?> style="color: #ffff; text-decoration: none">
                          <button type="button" name="submit" class="btn btn-primary">
                            <i class="bi bi-eye-fill"></i>
                          </button>
                        </a>
                    
                        <button onclick='<?php echo "deleteAppointment($appointment->id)" ?>' type="button" class="btn btn-danger">
                          <i class="bi bi-trash3"></i>
                        </button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const appointments = <?php echo json_encode($appointments) ?>;
  </script>
  <script src="../assets/js/admin/appointment_forms.js"></script>

</body>

</html>