<?php 
  require_once 'utils/is_login.php';
  require_once '../Models/EmployeeModel.php';
  require_once '../Models/RequestModel.php';
  $head_title = 'Request Forms List';
  $page_title = 'Dashboard';
  $employeeModel = new EmployeeModel();
  $employee = $employeeModel->getEmployeeById($_SESSION['id']);
  $requestModel = new RequestModel();
  $requests = $requestModel->getRequests();
  ?>
<!DOCTYPE html>
<html lang="en">

<?php require 'components/head.html' ?>
<style>
  table{
    font-size: 15px;
  }
  
  
</style>
<body>

  <!-- ======= Header ======= -->
  <?php require_once 'components/header.html' ?>
  

    <!-- ======= Sidebar ======= -->
    <?php require 'components/sidebar.html' ?><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Request Form</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Request Forms</li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Request Form</h5>
                    <button id="archive" style="display: none;" class=""><svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="m20.54 5.23-1.39-1.68C18.88 3.21 18.47 3 18 3H6c-.47 0-.88.21-1.16.55L3.46 5.23C3.17 5.57 3 6.02 3 6.5V19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6.5c0-.48-.17-.93-.46-1.27ZM6.24 5h11.52l.81.97H5.44l.8-.97ZM5 19V8h14v11H5Zm8.45-9h-2.9v3H8l4 4 4-4h-2.55v-3Z"></path>
</svg></button>
                    <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                           
                              <th>Name</th>
                              <th>Date</th>
                              <th>Status</th>  
                          </tr>
                      </thead>
                      <tbody>
                          
                          <?php
                            foreach($requests as $request){
                          ?>
                             
                             
                                
                          <td><?php echo $request->patient->getFullName() ?></td>
                          <td><?php echo $request->request_date ?></td>
                          <td><?php echo $request->status ?></td>
                        
                      
                      </tr>
                              <?php } ?>
                         
                      </tbody>
                      
                  </table>
                 

             
      
             
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="../assets/js/table.js"></script>
<script>
  function checkMe(){
    var cb = document.getElementById("gridCheck1");
    var input = document.getElementById("archive");
    if(cb.checked==true){
      input.style.display = "block";

    } else{
      input.style.display = "none";
    }
  }
</script>
</body>

</html>