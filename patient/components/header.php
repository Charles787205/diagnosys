<?php

require_once '../Models/UserModel.php';
require_once '../Objects/User.php';

$user_id = $_SESSION['id'];
$user = new User();
$userModel = new UserModel();
$user = $userModel->getUserById($user_id);
$userModel->close();

require_once '../Models/RequestModel.php';
$requestModel = new RequestModel();
$approvedRequest = $requestModel->getRequestTodayByStatusAndUserId(Request::APPROVED, $user_id);
$requestModel = new RequestModel();
$rejectedRequest = $requestModel->getRequestTodayByStatusAndUserId(Request::REJECT, $user_id);

$results = [];
$requestModel = new RequestModel();
$request_with_results = [];
$paidRequests = $requestModel->getRequestTodayByStatusAndUserId(Request::PAID, $user_id);
foreach ($paidRequests as $request) {
  $services = [];
  foreach ($request->services as $service) {
    if (count($service->results) != 0) {
      $services[] = $service;
    }
  }
  if (count($services) != 0) {
    $request->services = $services;
  }
  $request_with_results[] = $request;
}

?>

<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="../assets/img/log.png" alt="" style="width:40px; height:60px;" />
      <span class="d-none d-lg-block">Diagnosys </span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
  <!-- End Logo -->

  <!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle" href="#">
          <i class="bi bi-search"></i>
        </a>
      </li>
      <!-- End Search Icon-->

      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <?php if (count($approvedRequest) || count($rejectedRequest) || count($request_with_results)) : ?>
            <span class="badge bg-primary badge-number"><?php echo (count($approvedRequest) + count($rejectedRequest) + count($request_with_results)) ?></span>
        </a>
      <?php endif ?>

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          You have
          <?php echo count($approvedRequest) + count($rejectedRequest) + count($request_with_results) ?>
          new notifications
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <?php foreach ($approvedRequest as $request) : ?>
          <li>
            <hr class="dropdown-divider" />
          </li>

          <a href="patient-request-table.php">
            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4 style="color: black">
                  Request
                  <?php echo $request->id ?>
                </h4>
                <p><?php echo $request->patient->getFullName() ?></p>
              </div>
            </li>
          </a>

          <li>
            <hr class="dropdown-divider" />
          </li>
        <?php endforeach ?>
        <?php foreach ($request_with_results as $request) : ?>
          <li>
            <hr class="dropdown-divider" />
          </li>

          <a href="patient-request-table.php">
            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4 style="color: black">
                  Results For Request
                  <?php echo $request->id ?>
                </h4>
                <p><?php echo $request->patient->getFullName() ?></p>
              </div>
            </li>
          </a>

          <li>
            <hr class="dropdown-divider" />
          </li>
        <?php endforeach ?>
        <?php foreach ($rejectedRequest as $request) : ?>
          <li>
            <hr class="dropdown-divider" />
          </li>

          <a href="patient-request-table.php">
            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-danger"></i>
              <div>
                <h4 style="color: black">
                  Request
                  <?php echo $request->id ?>
                </h4>
                <p><?php echo $request->patient->getFullName() ?></p>
              </div>
            </li>
          </a>

          <li>
            <hr class="dropdown-divider" />
          </li>
        <?php endforeach ?>
      </ul>
      <!-- End Notification Dropdown Items -->
      </li>
      <!-- End Notification Nav -->

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="../assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg" alt="Profile" class="rounded-circle" />
          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user->getFullName() ?></span> </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $user->getFullName() ?></h6>
            <span>User</span>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>


          <li>
            <hr class="dropdown-divider" />
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="sign-out.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>
        </ul>
        <!-- End Profile Dropdown Items -->
      </li>
      <!-- End Profile Nav -->
    </ul>
  </nav>
  <script>
    const req = <?php echo json_encode($paidRequests) ?>;
    console.log(req);
  </script>
  <!-- End Icons Navigation -->
</header>