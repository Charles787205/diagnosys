<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/PatientModel.php';
$head_title = 'Patient List';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);
$patientModel = new PatientModel();
$patients = $patientModel->getAllPatients(); ?>
<!DOCTYPE html>
<html lang="en">
<?php require 'components/head.html' ?>
<style>
  table {
    text-align: center;
  }

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

  <!-- ======= Sidebar ======= -->
  <?php require 'components/sidebar.html' ?>
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Patient List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Patient</li>
          <li class="breadcrumb-item active">Patient Table</li>
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
              <button id="archive" style="display: none" class="">
                <svg width="30" height="30  " fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="m20.54 5.23-1.39-1.68C18.88 3.21 18.47 3 18 3H6c-.47 0-.88.21-1.16.55L3.46 5.23C3.17 5.57 3 6.02 3 6.5V19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6.5c0-.48-.17-.93-.46-1.27ZM6.24 5h11.52l.81.97H5.44l.8-.97ZM5 19V8h14v11H5Zm8.45-9h-2.9v3H8l4 4 4-4h-2.55v-3Z"></path>
                </svg>
              </button>
              <div class="position-relative">
                <h5 class="card-title">List of Patients</h5>
                <div class="col-5 position-absolute top-0 end-0">
                  <div class="search">
                    <form class="search-form">
                      <input type="text" placeholder="Search Patient By Name" id="search-bar" onchange='filterPatients()' />
                      <input type="submit" value="Searh" />
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <table class="table table-striped">
                  <thead>
                    <tr>

                      <th scope="col">Patient ID</th>
                      <th scope="col">Lastname</th>
                      <th scope="col">Firstname</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($patients as $patient) { ?>
                      <tr id="patient-row-<?php echo $patient->id ?>">

                        <th scope="row"><?php echo $patient->id ?></th>
                        <td><?php echo strtoupper($patient->last_name) ?></td>
                        <td><?php echo strtoupper($patient->first_name) ?></td>
                        <td class="text-<?php if ($patient->status == "Active") {
                                          echo "success";
                                        } else {
                                          echo "danger";
                                        } ?>"><?php echo $patient->status ?></td>

                        <td>
                          <a href=<?php echo "patient-view.php?patient_id=" . $patient->id ?>>
                            <button type="button" class="btn btn-primary">
                              <i class="bi bi-eye-fill"></i>
                            </button></a>
                          <a href="<?php echo "edit_patient.php?patient_id=" . $patient->id ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                          <button class="btn btn-danger" onclick='<?php echo "deletePatient($patient->id)" ?>'> <i class="bi bi-trash3-fill"></i></button>


                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
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

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $('#search-bar').on('input', filterPatients);

    function checkMe() {
      var cb = document.getElementById("gridCheck1");
      var input = document.getElementById("archive");
      if (cb.checked == true) {
        input.style.display = "block";
      } else {
        input.style.display = "none";
      }
    }


    const patients = <?php echo json_encode($patients) ?>;
    for (const patient of patients) {
      patient.fullName = `${patient.first_name} ${patient.last_name}`
    }

    function filterPatients() {
      var searchValue = $('#search-bar').val().toLowerCase();

      // Loop through patients and hide/show based on search input
      patients.forEach(function(patient) {
        var patientName = patient.fullName.toLowerCase();
        var row = $('#patient-row-' + patient.id);

        if (patientName.includes(searchValue)) {
          row.show();
        } else {
          row.hide();
        }
      });
    }

    function deletePatient(id) {
      postData = {
        id: id,
        object: 'patient'
      }
      swalAnimate =
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            fetch('utils/delete_object.php', {
              method: 'POST',
              body: JSON.stringify(postData)
            }).then((response) => {
              if (response.ok) {

                Swal.fire({
                  title: "Deleted!",
                  text: "The patient information has been deleted.",
                  icon: "success",

                }).then(() => {
                  location.reload();
                })
              }
            })

          }
        });
    }
  </script>
</body>

</html>