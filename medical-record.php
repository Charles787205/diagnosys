<?php 
  require_once 'utils/is_login.php';
  require_once '../Models/EmployeeModel.php';
  require_once '../Models/PatientModel.php';
  require_once '../Models/RequestModel.php';
  $head_title = 'Patient List';
  $page_title = 'Dashboard';
  $employeeModel = new EmployeeModel();
  $employee = $employeeModel->getEmployeeById($_SESSION['id']);
  $patientModel = new PatientModel();
  $patients = [];
  $requestModel = new RequestModel();
  $approvedRequests = $requestModel->getRequestsByStatus(Request::PAID);
  
   ?>
<!DOCTYPE html>
<html lang="en">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<?php require_once 'components/head.html' ?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Inter', sans-serif;
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
  .formbold-form-input[type='date']::-webkit-datetime-edit-text,
  .formbold-form-input[type='date']::-webkit-datetime-edit-month-field,
  .formbold-form-input[type='date']::-webkit-datetime-edit-day-field,
  .formbold-form-input[type='date']::-webkit-datetime-edit-year-field {
    color: rgba(83, 99, 135, 0.5);
  }

  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-form-label {
    color: #07074D;
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
    content: 'Upload file';
    display: inline-block;
    background: #EEEEEE;
    border: 0.5px solid #FBFBFB;
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
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
   <!-- ======= Header ======= -->
    <?php require 'components/header.html' ?>

    <!-- ======= Sidebar ======= -->
    <?php require 'components/sidebar.html' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Laboratory Result</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Patient</li>
          <li class="breadcrumb-item active">Laboratory result</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <h3>Patient information</h3>
              <div class="row mb-3">

                <div class="col-sm-12">
                  <select class="form-select" id="patient-select" aria-label="Default select example">
                    <option selected>--------Select Patient---------</option>
                      <?php foreach($approvedRequests as $request){
                        $p_fullName = $request->patient->getFullName();
                        echo "<option class='form-option' value='$request->id'>$p_fullName</option>";
                      }?>
                    
                  </select>
                </div>
              </div>
              <img src="../assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-s.ico" alt="Profile" class="rounded-circle" style="width: 200px;">

            </div>
          </div>
        </div>
        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <table class="table table-bordered">

                <tbody>
                  <tr>
                    <td scope="row" >Firstname</td>
                    <th data-type='first_name' class='table-data'>Brandon </th>
                    <td>Family name</td>
                    <th data-type='last_name' class='table-data'>Jacob</th>
                  </tr>
                  <tr>
                    <td scope="row">Address</td>
                    <th data-type='address' class='table-data'>Panabo City, Davao del Norte </th>
                    <td>Age/Gender</td>
                    <th data-type='age_gender' class='table-data'>22/Male</th>
                  </tr>
                  <tr>
                    <td scope="row">Date Performed</td>
                    <th data-type='request_date' class='table-data'>June 11, 2023 </th>
                    <td>Physician</td>
                    <th>MD</th>
                  </tr>
                  <tr>
                    <td scope="row">Mode of Test</td>
                    <th data-type='address' class='table-data'>Quantitaive </th>
                    <td>Time</td>
                    <th data-type='age_gender' class='table-data'></th>
                  </tr>
                  <tr>
                    <td scope="row">Examination Taken</td>
                    <th data-type='address' class='table-data'>FBS, Cholesterol, SUA, Creatinine</th>
                    <td>Specimen</td>
                    <th data-type='age_gender' class='table-data'>Serum</th>
                  </tr>


                </tbody>
              </table>
            </div>
          </div>
        </div>
        
          <div class="col-xl-12">
              <div class="container-fluid">
            <div class="card mt-1">
                <div class="card-header">
                    Input Result
                </div>
                <div class="card-body">
                    <form id="input-form">
                        <div id="result_1" class="row input-row ">
                            <div class="col-md-4">
                                <label>Services</label>
                                <select  class="service-select form-control" style='margin-top:0;'  aria-label="Default select example">
                                  
                                </select>
                            </div>
                           
                            <div class="col-md-4">
                                <label>Result</label>
                                <input type="text" class="form-control" data-type="result">
                            </div>
                            <div class="col-md-4">
                                <label>Normal Value</label>
                                <input type="text" class="form-control" data-type="normal_value">
                            </div>
                           
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                 
                    <button onclick="submit_form()" id="#third" class="btn btn-info">Save</button>
                </div>
            </div>
              </div>
        </div>

              </div>
          </div>
          </div>
</section>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>
 <script>
  
  var counter = 1;

  function add_more() {
      counter++;
      var originalDiv = document.getElementById('result_1');
      var newDiv = originalDiv.cloneNode(true); // true indicates deep cloning with children
      newDiv.id = 'result_' + counter;

      // Remove all label elements from the cloned div
      var labels = newDiv.getElementsByTagName('label');
      for (var i = labels.length - 1; i >= 0; i--) {
          labels[i].parentNode.removeChild(labels[i]);
      }

      // Update the button's onclick attribute to call a different function
      var deleteButton = newDiv.querySelector('[onclick^="delete_row"]');
      deleteButton.setAttribute('onclick', 'delete_row_dynamic(' + counter + ')');

      var form = document.getElementById('input-form');
      form.appendChild(newDiv);
  }

// Updated delete_row function to accept a parameter
  function delete_row_dynamic(rowId) {
      var row = document.getElementById('result_' + rowId);
      row.parentNode.removeChild(row);
  }

  
  function submit_form() {
    const inputRows = document.getElementsByClassName('input-row');
    const results = [];
    for (const row of inputRows) {
        const select = row.getElementsByTagName('select')[0];
        const resultInput = row.querySelector('[data-type="result"]');
        const testInput = row.querySelector('[data-type="test"]');
        const normalValueInput = row.querySelector('[data-type="normal_value"]');
        const requestSelect = document.getElementById('patient-select');
        // Access the values of the selected elements
        const selectedOptionValue = select.value;
        const resultInputValue = resultInput.value;
        const normalValueInputValue = normalValueInput.value;
        const requestId = requestSelect.value;
        const test = testInput.value;
        const data = {
          service_id: selectedOptionValue,
          result: resultInput.value,
          normal_value: normalValueInputValue,
          request_id: requestId,
          test: test
        }
        
        results.push(data);
    }
    fetch("utils/add_result.php",{
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(results)
    }).then(() =>{
      Swal.fire({
        title: "Result Saved",
        
        icon: "success"

        
      });
    })
    
  }









  requests = <?php echo json_encode($approvedRequests)?>;
  document.addEventListener('DOMContentLoaded', function() {
  const patientSelect = document.getElementById('patient-select');
  patientSelect.addEventListener('change', changeData);
  
  const inputRow = document.getElementsByClassName('input-row');
  function changeData() {
  const serviceSelect = document.getElementsByClassName('service-select');
  const tableData = document.getElementsByClassName('table-data');

  var chosenRequest = null;
  for (const request of requests) {
    if (request.id == patientSelect.value) {
      chosenRequest = request;
    }
  }
  if (chosenRequest != null) {
    for (const select of serviceSelect) {
      // Clear existing options
      select.innerHTML = '';

      for (const service of chosenRequest.services) {
        const newOption = document.createElement('option');
        newOption.value = service.id;
        newOption.textContent = service.name;
        select.appendChild(newOption);
      }
    }
    for (const data of tableData) {
      const dataType = data.getAttribute('data-type');
      switch (dataType) {
        case 'first_name':
          data.textContent = chosenRequest.patient.first_name;
          break;
        case 'last_name':
          data.textContent = chosenRequest.patient.last_name;
          break;
        case 'address':
          data.textContent = `${chosenRequest.patient.purok}, ${chosenRequest.patient.barangay}, ${chosenRequest.patient.city}, ${chosenRequest.patient.province}`;
          console.log(chosenRequest);
          break;
        case 'age_gender':
          data.textContent = `${chosenRequest.patient.age} / ${chosenRequest.patient.gender}`
          break;
        case 'request_date':
          data.textContent = chosenRequest.request_date;
          break;
      }
    }
  } else {
    for (const select of serviceSelect) {
      // Clear existing options
      select.innerHTML = '';
    }
    for (const data of tableData) {
      const dataType = data.getAttribute('data-type');
      data.textContent = ""
    }
  }
}

  })



  
 </script>
 

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>