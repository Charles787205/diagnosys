<?php
  session_start();
  require_once '../Models/AppointmentModel.php';
  $appointmentModel = new AppointmentModel();
  $appointments = $appointmentModel->getAppointmentFromUserId($_SESSION['id']);
  $appointmentModel->close();
  $page = 'appointment'; // for the components/sidebar.html
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Appointment List</title>
  <?php require_once 'components/required_css.html' ?>

  
</head>
<style>
  .search
{
	border: 2px solid #fff;
	overflow: auto;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
  box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.20);

}

.search input[type="text"]
{
	border: 0px;
	width: 67%;
	padding: 10px 10px;
}

.search input[type="text"]:focus
{
	outline: 0;
}

.search input[type="submit"]
{
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
        cursor:pointer;
}

/* ===========================
   ====== Medua Query for Search Box ====== 
   =========================== */

@media only screen and (min-width : 150px) and (max-width : 780px)
{
	}
	.search
	{
		width: 95%;
		margin: 0 auto;
	}

</style>

<body>

  <!-- ======= Header ======= -->
  <?php require_once 'components/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php require_once 'components/sidebar.html' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Appointment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Appointment</li>
          <li class="breadcrumb-item active">Appointments</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
             <hr>
              <div class="position-relative">
                <h5 class="card-title">List of Appointments</h5>
                <div class="col-5 position-absolute top-0 end-0">
                  <div class="search">
                    <form class="search-form">
                      <input type="text" placeholder="Search">
                      <input type="submit" value="Search">
                    </form>
                  </div>
                </div>
              </div>
              
              <table class="table table-bordered">
                <thead>
                  <tr>
                
                    <th scope="col">Request ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                          <?php foreach($appointments as $appointment){ ?>
                          <tr>  
                            <td><?php echo $appointment->id?></td>    
                            <td><?php echo strtoupper($appointment->patient->getFullName()) ?></td>
                            <td><?php echo strtoupper($appointment->appointment_date) ?></td>
                            <td><?php if($appointment->status != Request::REJECT):
                              echo strtoupper($appointment->status);
                              else:?>
                                <button
                                type="button"
                                name="submit"
                                class="btn btn-primary"
                                onclick=<?php echo "viewComment($appointment->id)"?>
                              >
                                <i class="bi bi-eye-fill"></i>
                              </button>
                              <?php endif; ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    appointments = <?php echo json_encode($appointments) ?>;
    function viewComment(appointmentId){
      for(appointment of appointments){
        if(appointment.id == appointmentId){
          console.log(appointment);
          Swal.fire({
            title: "Rejected",
            text: "Admin: "+ appointment.comment,
            
            });
          break;
        }
      }
      
    }
  </script>
</body>

</html>