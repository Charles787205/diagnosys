<?php
require_once '../Objects/Employee.php';
require_once '../Models/EmployeeModel.php';
$employeeModel = new EmployeeModel();
$security_questions = $employeeModel->getSecurityQuestions();

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
    $employee->addSecurityQuestion($_POST['security_question'], $_POST['register_answer']);
    $id = $employeeModel->registerEmployee($employee);

    if ($position == "Cashier") {
        header("Location: ../Cashier/index.php");
    } else {

        header('Location: dashboard.php');
    }



    session_start();
    $_SESSION['id'] = $id;
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
    <link href="../assets/img/log.png" rel="apple-touch-icon">
    <link href="../assets/img/log.png" rel="icon">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>
<style>
    .border-red {
        border: 1px solid red !important;
    }
</style>

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
                        <center>
                        <h2 class="card-title">DIAGNOSYS</h2><br>
                        <h2 class="card-title">Register Now</h2>

                        </center>
                       

                        <form action="register.php" method="post" id='register-form'>

                            <input type="text" class="name" name="register_lastname" placeholder="Enter Lastname" value="" required>
                            <input type="text" class="name" name="register_firstname" placeholder="Enter Firstname" value="" required>
                            <input type="number" class="name" name="register_age" placeholder="Enter Age" value="" required>
                            <input type="text" class="name" name="register_address" placeholder="Enter Address" value="" required>
                            <input type="tel" class="password" id="mobile_number" pattern="[0-9]{11}" pmaxlength="11" oninput="validateNumber(event)" name="mobile_number" placeholder="Enter Your Mobile Number" required>
                            <input type="text" class="username" name="register_username" placeholder="Enter Your Username" value="" required>
                            <input type="password" class="password" name="register_password" placeholder="Enter Your Password" required>
                            <select class='form-select' name="position" id="position">
                                <option value="Information Desk Officer">Information Desk Officer</option>
                                <option value="Cashier">Cashier</option>
                            </select>
                            <select class='form-select' name="security_question" placeholder="Security Question" id="security_question">
                                <?php foreach ($security_questions as $security_question) : ?>
                                    <option value=<?php echo $security_question['id']; ?>><?php echo $security_question['question']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <input type="text" class="name" name="register_answer" placeholder="Enter Answer" required>
                            <button name="registerButton" class="btn" onclick="submitForm(event)" style="background-color:dodgerblue">Register</button>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(c) {
            $('.alert-close').on('click', function(c) {
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });


        function submitForm(e) {

            e.preventDefault();
            console.log()
            formInputs = $('#register-form').find('input');
            let isError = false;
            for (const input of formInputs) {
                if ($(input).val() == "") {
                    $(input).addClass("border-red")
                    isError = true;
                } else {
                    console.log("hello")
                    $(input).removeClass("border-red");
                }
            }
            const form = $("#register-form").get(0);

            if (!isError) {
                Swal.fire({
                    title: 'Registration Successful!',
                    text: 'You can now log in with your credentials.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('register-form').submit();
                    }
                });
            }


        }
    </script>
    <script>
        function validateNumber(event) {
            const input = event.target;
            const regex = /^[0-9]*$/; // Regular expression to match only numbers

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            }

            // Limit input to 11 digits
            if (input.value.length > 11) {
                input.value = input.value.slice(0, 11);
            }
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>