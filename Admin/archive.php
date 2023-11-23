
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
  $requests = $requestModel->getRequests();
  $appointmentModel = new AppointmentModel();
  $appointments = $appointmentModel->getAppointments();
  $dates = [];
  foreach($requests as $request){
    if(!isset($dates[$request->request_date])){
      $dates[$request->request_date] = $request->request_date;
      
    }
  }
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

  .container {
    margin: 1rem;
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
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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


             
                    <h5 class="card-title">Filter Data</h5>
                    <div class="col-lg">
                      <select id="typeSelect" class="form-select">
                        <option selected>Type</option>
                        <option value='request'>Request Form</option>
                        <option value='appointment'>Appointment Form</option>
                      </select>
                    </div>
                    <div class="col-lg">
                      <select id="dateSelect" class="form-select">
                        <option selected>Date</option>
                        <?php foreach($dates as $date) {
                          echo "<option>$date</option>";
                        } ?>
                      </select>
                    </div>
          



              <br>


              <table class="table table-striped">
                <thead>
                  <tr>
                    <th></th>
                    <th scope="col">ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>

                  </tr>
                </thead>
                <tbody>

                <?php foreach($requests as $request){ ?> 
                  <tr class="data-row" data-type="request" data-date="<?php echo $request->request_date ?>">
                    <th>
                      <div class="form-check">
                        <input class="form-check-input" onclick="checkMe()" type="checkbox" id="gridCheck1">
                      </div>
                    </th>
                    <th scope="row"><?php echo $request->id ?></th>
                    <td>Request Form</td>
                    <td><?php echo $request->patient->getFullName() ?></td>
                    <td><?php echo $request->request_date ?></td>

                  </tr>
                <?php } ?>
                <?php foreach($appointments as $appointment){ ?> 
                  <tr class="data-row" data-type="appointment" data-date="<?php echo $appointment->appointment_date ?>">
                    <th>
                      <div class="form-check">
                        <input class="form-check-input" onclick="checkMe()" type="checkbox" id="gridCheck1">
                      </div>
                    </th>
                    <th scope="row"><?php echo $appointment->id ?></th>
                    <td>Appointment Form</td>
                    <td><?php echo $appointment->patient->getFullName() ?></td>
                    <td><?php echo $appointment->appointment_date ?></td>

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
  
  document.addEventListener('DOMContentLoaded', function () {
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
</script>

</body>

</html>