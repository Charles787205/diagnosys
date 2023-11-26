<?php
require_once '../Objects/Employee.php';
require_once '../Models/EmployeeModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = $_POST['register_lastname'];
    $firstname = $_POST['register_firstname'];
    $username = $_POST['register_username'];
    $password = $_POST['register_password'];
    $position = $_POST['position'];
    $age = $_POST['register_age'];
    $address = $_POST['register_address'];
    $mobile_number = $_POST['mobile_number'];
    $employee = new Employee();
    $employee->newEmployee($firstname, $lastname, $username, $password, $position, $age, $address, $mobile_number);
    $employeeModel = new EmployeeModel();
    $id = $employeeModel->registerEmployee($employee);
    session_start();
    $_SESSION['id'] = $id;
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Registration Form</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="../assets/img/image-200x200.jpg" rel="apple-touch-icon">
    <link href="../assets/img/image-200x200.jpg" rel="icon">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">

                    <div class="w3l_form align-self" style="background-color:paleturquoise;">
                        <div class="left_grid_info">
                            <img src="../assets/img/up.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>


                        <form action="#" method="post">
                            <input type="text" class="name" name="register_lastname" placeholder="Enter Lastname" value="" required>
                            <input type="text" class="name" name="register_firstname" placeholder="Enter Firstname" value="" required>
                            <input type="number" class="name" name="register_age" placeholder="Enter Age" value="" required>
                            <input type="text" class="name" name="register_address" placeholder="Enter Address" value="" required>
                            <input type="tel" class="password" name="mobile_number" placeholder="Enter Your Mobile Number" required>
                            <input type="text" class="username" name="register_username" placeholder="Enter Your Username" value="" required>
                            <input type="password" class="password" name="register_password" placeholder="Enter Your Password" required>
                            <select  class='form-select' name="position" id="position">
                            <option value="Information Desk Officer">Information Desk Officer</option>
                            <option value="cashier">Cashier</option>
                           </select>
                            

                              

                                <button name="submit" class="btn" type="submit" style="background-color:dodgerblue">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Already have an account? <a href="login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(c) {
            $('.alert-close').on('click', function(c) {     
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

<script>
  document.querySelector(".btn").addEventListener('click', function(){
  Swal.fire("Our First Alert", "With some body text and success icon!", "success");
});
</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>



