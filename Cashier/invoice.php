 <?php
  require_once 'utils/is_login.php';
  require_once '../Models/EmployeeModel.php';
  require_once '../Models/AppointmentModel.php';
  require_once '../Models/RequestModel.php';
  $head_title = 'Request Forms List';
  $page_title = 'Dashboard';
  $employeeModel = new EmployeeModel();
  $employee = $employeeModel->getEmployeeById($_SESSION['id']);

  $requestModel = new RequestModel();
  $requests = $requestModel->getRequestsByStatus(Request::PAID);

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
     box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.20);


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

   @media only screen and (min-width : 150px) and (max-width : 780px) {}

   .search {
     width: 95%;
     margin: 0 auto;
   }
 </style>

 <body>

   <!-- ======= Header ======= -->
   <?php require 'components/header.html' ?><!-- End Header -->

   <!-- ======= Sidebar ======= -->
   <?php require 'components/sidebar.html' ?><!-- End Sidebar-->


   </aside><!-- End Sidebar-->

   <main id="main" class="main">

     <div class="pagetitle">
       <h1>Invoice List</h1>
       <nav>
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.html">Payment</a></li>
           <li class="breadcrumb-item" class="active">Invoice List</li>

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
                 <h5 class="card-title">List of Invoices</h5>
                 <div class="col-5 position-absolute top-0 end-0">
                  

                 </div>
               </div>
               <div class="col-lg-12">





                 <table class="table table-bordered">
                   <thead>
                     <tr>
                       <th scope="col">Invoice #</th>
                       <th scope="col">Lastname</th>
                       <th scope="col">Firstname</th>
                       <th scope="col">Actions</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php foreach ($requests as $request) : ?>
                       <tr id="request-row-<?php echo $request->id ?>">
                         <th scope="row">2024-<?php echo $request->id ?></th>
                         <td><?php echo $request->patient->last_name ?></td>
                         <td><?php echo $request->patient->first_name ?></td>
                         <td>

                           <button type="button" class="btn btn-secondary" onclick='print(<?php echo $request->id ?>)'><i class="bi bi-printer-fill"></i> Print</button>

                         </td>
                       </tr>
                     <?php endforeach ?>


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

   </main>


   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <!-- Vendor JS Files -->
   <?php require 'components/required_js.html' ?>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <script>
     function print(id) {
       var pdfWindow = window.open(`generatePdf.php?request_id=${id}`, "_blank");
       pdfWindow.print();

       window.location.href = "cashier-payment-list.php";
     }
     const requests = <?php echo json_encode($requests) ?>;
     console.log(requests);
     for (const request of requests) {
       request.patient.fullName = `${request.patient.first_name} ${request.patient.last_name}`
     }

     function filterRequests() {
       console.log('hello')
       var searchValue = $('#search-bar').val().toLowerCase();

       // Loop through requests and hide/show based on search input
       requests.forEach(function(request) {
         var requestName = request.patient.fullName.toLowerCase();
         var row = $('#request-row-' + request.patient.id);

         if (requestName.includes(searchValue)) {
           row.show();
         } else {
           row.hide();
         }
       });
     }
   </script>
 </body>

 </html>