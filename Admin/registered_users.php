<?php 
  require_once 'utils/is_login.php';
  require_once '../Models/EmployeeModel.php';
  require_once '../Models/UserModel.php';
  require_once '../Models/AppointmentModel.php';
  $head_title = 'Registered Users';
  $page_title = 'Dashboard';
  $employeeModel = new EmployeeModel();
  $employee = $employeeModel->getEmployeeById($_SESSION['id']); 
  $userModel = new UserModel();
  $users = $userModel->getUsers();

  
  ?>
<!DOCTYPE html>
<html lang="en">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
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
  <?php require 'components/header.html';
  require 'components/sidebar.html' ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Registered Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Registered Users</li>
          <li class="breadcrumb-item"></li>
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
            <h5 class="card-title">List of Registered Users</h5>
        
            <button type="button" class="btn btn-primary  mb-2" data-bs-toggle="modal" data-bs-target="#basicModal"> 
             
            <i class="bi bi-plus-square"></i> Add User
              </button>

              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Registered User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form onsubmit="addUser(event)" class="row g-3">
                      <div class="col-12">
                        <label  class="form-label">Lastame</label>
                        <input type="text" name="register_lastname" class="form-control" required >
                      </div>
                      <div class="col-12">
                        <label  class="form-label">Firstname</label>
                        <input type="text" name="register_firstname" class="form-control"  required>
                      </div>
                      <div class="col-12">
                        <label  class="form-label">Age</label>
                        <input type="text" name="register_age" class="form-control" >
                      </div>
                      <div class="col-12">
                        <label  class="form-label">Address</label>
                        <input type="text" name="register_address" class="form-control"  required>
                      </div>
                      <div class="col-12">
                        <label  class="form-label">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control"  required>
                      </div>
                      <div class="col-12">
                        <label for="inputEmail4" class="form-label">Username</label>
                        <input type="text" name="register_username" class="form-control" id="inputEmail4" required>
                      </div>
                      <div class="col-12">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" name="register_password" class="form-control" id="inputPassword4" required>
                      </div>
                      <div class="col-md-12">
                        <select name="position" id="inputState" class="form-select" required>
                          <option selected>Choose...</option>
                          <option value="Information Desk">Information Desk</option>
                          <option value="Cashier">Cashier</option>
                        </select>
                      </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button  id="third" name="submit" class="btn btn-primary">Add</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            
      
                  
              <table class="table table-bordered">
                <thead>
                
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <tr>

                    
                    <?php
                      
                      foreach($users as $user){ ?>
                        <tr>   
                          <td><?php echo $user->id ?></td>
                          <td><?php echo $user->getFullName() ?></td>
                          <td>
                          
                            <a href=<?php echo "users-profile.php?user_id=$user->id"?> class="btn btn-primary"><i class="bi bi-eye-fill"></i> </a>
                            <button onclick='<?php echo "deleteUser($user->id)" ?>' class="btn btn-danger"> <i class="bi bi-trash3-fill"></i></button>
                            
                            
                          </td>   
                        </tr>
                      
                    <?php }
                    ?>        
                      </td>

                      
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
   function deleteUser(id){
    postData ={
        id: id,
        object: 'user'
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
              fetch('utils/delete_object.php',{
            method: 'POST',
            body: JSON.stringify(postData)
          }).then((response) => {
            if(response.ok){

              Swal.fire({
                title: "Deleted!",
                text: "The user has been deleted.",
                icon: "success",
                
              }).then(()=> {
                location.reload();
              })
            }
          })
            
        }
      });
    }

    function addUser(e) {
        e.preventDefault(); // Prevent the default form submission

        // Get form data
        const formData = new FormData(e.target);

        // Create a JSON object from the form data
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });

        // Send a POST request to the server
        fetch('utils/add_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(jsonData),
        })
        .then(response => response.json())
        .then(data => {
          Swal.fire({
                title: "User created!",
                text: "The user has been added.",
                icon: "success",
                
              }).then(()=> {
                location.reload();
              })
        })
        .catch(error => {
            
            console.error('Error:', error);
        });
    }

</script>
</body>

</html>