<?php 
  require_once 'utils/is_login.php';
  require_once '../Models/EmployeeModel.php';
  require_once '../Models/AppointmentModel.php';
  $head_title = 'Dashboard';
  $page_title = 'Dashboard';
  $employeeModel = new EmployeeModel();
  $employee = $employeeModel->getEmployeeById($_SESSION['id']);
$appointmentModel = new AppointmentModel(); $appointments = $appointmentModel->getAppointments(); 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['c_password']) && isset($_POST['n_password1']) && isset($_POST['n_password2'])){ 
    if($_POST['c_password'] == $employee->password && $_POST['n_password1'] == $_POST['n_password2']){
      $employee->password = $_POST['n_password1'];
      $employeeModel = new EmployeeModel();
      $employeeModel->updateUser($employee); } 
    }else{
      $employeeModel = new EmployeeModel();
      $employee->last_name = strtoupper($_POST['last_name']); 
      $employee->first_name = strtoupper($_POST['first_name']); 
      $employee->address = strtoupper($_POST['address']); 
      $employee->mobile_number = strtoupper($_POST['mobile_number']); 
      $employeeModel->updateUser($employee); 
      $employee->position = strtoupper($_POST['position']);
    } }
?>
<!DOCTYPE html>
<html lang="en">
  <?php require 'components/head.html' ?>
  <body>
    <!-- ======= Header ======= -->
    <?php require 'components/header.html' ?>

    <?php require 'components/sidebar.html' ?>

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <section class="section profile">
        <div class="row">
          <div class="col-xl-4">
            <div class="card">
              <div
                class="card-body profile-card pt-4 d-flex flex-column align-items-center"
              >
                <img
                  src="../assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg"
                  alt="Profile"
                  class="rounded-circle"
                />
                <h2><?php echo $employee->position ?></h2>
                <h3>Staff</h3>
              </div>
            </div>
          </div>

          <div class="col-xl-8">
            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                  <li class="nav-item">
                    <button
                      class="nav-link active"
                      data-bs-toggle="tab"
                      data-bs-target="#profile-overview"
                    >
                      Overview
                    </button>
                  </li>

                  <li class="nav-item">
                    <button
                      class="nav-link"
                      data-bs-toggle="tab"
                      data-bs-target="#profile-edit"
                    >
                      Edit Profile
                    </button>
                  </li>

                  <li class="nav-item">
                    <button
                      class="nav-link"
                      data-bs-toggle="tab"
                      data-bs-target="#profile-change-password"
                    >
                      Change Password
                    </button>
                  </li>
                </ul>
                <div class="tab-content pt-2">
                  <div
                    class="tab-pane fade show active profile-overview"
                    id="profile-overview"
                  >
                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Full Name</div>
                      <div class="col-lg-9 col-md-8">
                        <?php echo $employee->getFullName() ?>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Company</div>
                      <div class="col-lg-9 col-md-8">
                        Panabo City Diagnostic Center
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Job</div>
                      <div class="col-lg-9 col-md-8">
                        <?php echo $employee->position ?>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Address</div>
                      <div class="col-lg-9 col-md-8">
                        <?php echo $employee->address ?>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Phone</div>
                      <div class="col-lg-9 col-md-8">
                        <?php echo $employee->mobile_number ?>
                      </div>
                    </div>
                  </div>

                  <div
                    class="tab-pane fade profile-edit pt-3"
                    id="profile-edit"
                  >
                    <!-- Profile Edit Form -->
                    <form method='POST' action='admin-profile.php'>
                      <div class="row mb-3">
                        <label  class="col-md-4 col-lg-3 col-form-label">Lastname</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="last_name" type="text" class="form-control" id="last_name" value=<?php echo $employee->last_name ?>>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label  class="col-md-4 col-lg-3 col-form-label">Firstname</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="first_name" type="text" class="form-control" id="first_name" value=<?php echo $employee->first_name ?>>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label
                          for="company"
                          class="col-md-4 col-lg-3 col-form-label"
                          >Company</label
                        >
                        <div class="col-md-8 col-lg-9">
                          <input
                            name="company"
                            type="text"
                            class="form-control"
                            id="company"
                            value="Panabo City Diagnostic Center"
                          />
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label
                          for="position"
                          class="col-md-4 col-lg-3 col-form-label"
                          >Job</label
                        >
                        <div class="col-md-8 col-lg-9">
                          <input
                            name="position"
                            type="text"
                            class="form-control"
                            id="Job"
                            value= <?php echo $employee->position ?>>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label
                          for="Address"
                          class="col-md-4 col-lg-3 col-form-label"
                          >Address</label
                        >
                        <div class="col-md-8 col-lg-9">
                          <input
                            name="address"
                            type="text"
                            class="form-control"
                            id="Address"
                            value=<?php echo $employee->address  ?>>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label
                          for="mobile_number"
                          class="col-md-4 col-lg-3 col-form-label"
                          >Phone</label
                        >
                        <div class="col-md-8 col-lg-9">
                          <input
                            name="mobile_number"
                            type="text"
                            class="form-control"
                            id="Phone"
                            value=<?php echo $employee->mobile_number ?>>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                          Save Changes
                        </button>
                      </div>
                    </form>
                    <!-- End Profile Edit Form -->
                  </div>

                  <div class="tab-pane fade pt-3" id="profile-settings">
                    <!-- Settings Form -->
                    <form>
                      <div class="row mb-3">
                        <label
                          for="fullName"
                          class="col-md-4 col-lg-3 col-form-label"
                          >Email Notifications</label
                        >
                        <div class="col-md-8 col-lg-9">
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="changesMade"
                              checked
                            />
                            <label class="form-check-label" for="changesMade">
                              Changes made to your account
                            </label>
                          </div>
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="newProducts"
                              checked
                            />
                            <label class="form-check-label" for="newProducts">
                              Information on new products and services
                            </label>
                          </div>
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="proOffers"
                            />
                            <label class="form-check-label" for="proOffers">
                              Marketing and promo offers
                            </label>
                          </div>
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="securityNotify"
                              checked
                              disabled
                            />
                            <label
                              class="form-check-label"
                              for="securityNotify"
                            >
                              Security alerts
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                          Save Changes
                        </button>
                      </div>
                    </form>
                    <!-- End settings Form -->
                  </div>

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form action="admin-profile.php" method="POST">
                      <div class="row mb-3">
                        <label
                          for="currentPassword"
                          class="col-md-4 col-lg-3 col-form-label"
                          >Current Password</label
                        >
                        <div class="col-md-8 col-lg-9">
                          <input
                            name="c_password"
                            type="password"
                            class="form-control"
                            id="c_password"
                          />
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label
                          for="newPassword"
                          class="col-md-4 col-lg-3 col-form-label"
                          >New Password</label
                        >
                        <div class="col-md-8 col-lg-9">
                          <input
                            name="n_password1"
                            type="password"
                            class="form-control"
                            id="n_password1"
                          />
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label
                          for="renewPassword"
                          class="col-md-4 col-lg-3 col-form-label"
                          >Re-enter New Password</label
                        >
                        <div class="col-md-8 col-lg-9">
                          <input
                            name="n_password2"
                            type="password"
                            class="form-control"
                            id="n_password2"
                          />
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                          Change Password
                        </button>
                      </div>
                    </form>
                    <!-- End Change Password Form -->
                  </div>
                </div>
                <!-- End Bordered Tabs -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <?php require 'components/required_js.html' ?>
  </body>
</html>
