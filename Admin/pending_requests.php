<?php
require_once 'utils/is_login.php';
require_once '../Models/EmployeeModel.php';
require_once '../Models/PatientModel.php';
require_once '../Models/RequestModel.php';
$head_title = 'Patient List';
$page_title = 'Dashboard';
$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_SESSION['id']);

$requestModel = new RequestModel();
$pendingRequests = $requestModel->getPendingRequests();
?>

<!DOCTYPE html>
<html lang="en">
<?php require 'components/head.html' ?>
<style>
  table {
    text-align: center;
  }

  .container {
    padding: 2rem 0rem;
  }

  h4 {
    margin: 2rem 0rem 1rem;
  }

  td,
  th {
    vertical-align: middle;
    font-size: 15px;
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
  <?php require 'components/header.html' ?>

  <!-- ======= Sidebar ======= -->
  <?php require 'components/sidebar.html' ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Pending Request Forms</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Request Forms</li>
          <li class="breadcrumb-item active">Pending Request Forms</li>
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
                <h5 class="card-title">List of Pending Forms</h5>
                <div class="col-5 position-absolute top-0 end-0">
                  <div class="search">
                    <form class="search-form">
                      <input type="text" placeholder="Search Patient By Name" id="search-bar" onchange='filterRequests()' />
                      <input type="submit" value="Search" />
                    </form>
                  </div>
                </div>
              </div>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Request ID</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Number Of Test</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pendingRequests as $request) { ?>
                    <tr id="request-row-<?php echo $request->patient->id ?>">
                      <td><?php echo $request->id ?></td>
                      <td><?php echo $request->patient->last_name ?></td>
                      <td><?php echo $request->patient->first_name ?></td>
                      <td><?php echo count($request->services) ?></td>
                      <td><?php echo $request->status ?></td>
                      <td>
                        <a href=<?php echo "request_details.php?patient_id=$request->patient_id&request_id=$request->id" ?> style="color: #ffff; text-decoration: none"><button type="button" name="submit" class="btn btn-primary">
                            <i class="bi bi-eye-fill"></i>
                          </button></a>
                        <a href="edit_request.php?request_id=<?php echo $request->id ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <button class="btn btn-danger" onclick='<?php echo "deleteRequest($request->id)" ?>'> <i class="bi bi-trash3-fill"></i></button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- General Form Elements -->
      </div>
    </section>
  </main>
  <!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const requests = <?php echo json_encode($pendingRequests) ?>;
    for (const request of requests) {
      request.patient.fullName = `${request.patient.first_name} ${request.patient.last_name}`
    }

    function filterRequests() {
      var searchValue = $('#search-bar').val().toLowerCase();
      console.log(requests);
      // Loop through requests and hide/show based on search input
      requests.forEach(function(request) {
        var patientName = request.patient.fullName.toLowerCase();
        var row = $('#request-row-' + request.id);

        if (patientName.includes(searchValue)) {
          row.show();
        } else {
          row.hide();
        }
      });
    }

    function deleteRequest(id) {
      postData = {
        id: id,
        object: 'request'
      }
      swalAnimate =

        console.log('hello')
      //confirm('hello');
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
                text: "The request has been deleted.",
                icon: "success",

              }).then(() => {
                location.reload();
              })
            }
          })

        }
      });
    }



    $('#search-bar').on('input', filterRequests);
  </script>
</body>

</html>