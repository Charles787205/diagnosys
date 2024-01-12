<?php
  session_start();
  require_once '../Models/RequestModel.php';
  $requestModel = new RequestModel();
  $requests = $requestModel->getRequestFromUserId($_SESSION['id']);
  $page = 'request_form'; // for the components/sidebar.html
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Request Forms</title>
  <?php  require_once 'components/required_css.html' ?>

 
</head>
<style>
  .search input{
    width: 850px;
    text-indent: 25px;
  }
  .search button{
    margin-top: -65px;
    margin-left: 850px;
  }
  .search i {
    position: absolute;
    margin-top: 3px;
    margin-left: 10px;
    font-size: 20px;
  }
</style>
<body>

  <!-- ======= Header ======= -->
  
  <?php require 'components/header.php' ?>
  <!-- ======= Sidebar ======= -->
  <?php require 'components/sidebar.html' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Request Form</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Request Form</li>
          <li class="breadcrumb-item active">Request Form</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Request Form</h5>
              <div class="container">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-12">
                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                              <th>Name</th>
                              <th>Date</th>
                              <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($requests as $request){ ?>
                          <tr>      
                            <td><?php echo strtoupper($request->patient->first_name . ' ' . $request->patient->last_name) ?></td>
                            <td><?php echo strtoupper($request->request_date) ?></td>
                            <td><?php if($request->status != Request::REJECT):
                              echo strtoupper($request->status);
                              else:?>
                                <button
                                type="button"
                                name="submit"
                                class="btn btn-primary"
                                onclick=<?php echo "viewComment($request->id)"?>
                              >
                                <i class="bi bi-eye-fill"></i>
                              </button>
                              <?php endif; ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      
                      </table>
              <!-- Default Tabs -->
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    requests = <?php echo json_encode($requests) ?>;
    function viewComment(requestId){
      for(request of requests){
        if(request.id == requestId){
          console.log(request);
          Swal.fire({
            title: "Rejected",
            text: "Admin: "+ request.comment,
            
            });
          break;
        }
      }
      
    }
  </script>
</body>

</html>