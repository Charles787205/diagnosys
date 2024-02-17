<?php
require_once '../Objects/User.php';
include '../Models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = $_POST['register_lastname'];
    $firstname = $_POST['register_firstname'];
    $username = $_POST['register_username'];
    $password = $_POST['register_password'];
    $age = $_POST['register_age'];
    $address = $_POST['register_address'];
    $mobile_number = $_POST['mobile_number'];
    $user =  new User();
    $user->newUser(strtoupper($firstname), strtoupper($lastname), $username, $password, $age, strtoupper($address), $mobile_number);
    $userModel = new UserModel();
    session_start();

    if ($id = $userModel->registerUser($user)) {
        $_SESSION['id'] = $id;
        header('Location: index.php');
    }
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
    <link href="../assets/img/log.png" rel="icon">
    <link href="../assets/img/log.png" rel="apple-touch-icon">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

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
                        <a href="index.php">
                            <div class="alert-close" style="background-color: skyblue;">
                                <span class="fa fa-close"></span>
                            </div>
                        </a>
                        <center>
                        <h2 class="card-title">DIAGNOSYS</h2><br>
                        <h2>Register Now</h2>
                        </center>
                      


                        <form action="#" method="post">
                            <input type="text" class="name" name="register_lastname" placeholder="Enter Lastname" value="" required>
                            <input type="text" class="name" name="register_firstname" placeholder="Enter Firstname" value="" required>
                            <input type="number" class="name" name="register_age" placeholder="Enter Age" value="" required>
                            <input type="text" class="name" name="register_address" placeholder="Enter Address" value="" required>
                            <input type="tel" class="password" id="mobile_number" pmaxlength="11" oninput="validateNumber(event)" name="mobile_number" placeholder="Enter Your Mobile Number" required>
                            <input type="text" class="username" name="register_username" placeholder="Enter Your Username" value="" required>
                            <input type="password" class="password" name="register_password" placeholder="Enter Your Password" required>



                            <button name="submit" class="btn" type="submit" style="background-color:dodgerblue">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account? <a href="index.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="../js/jquery.min.js"></script>
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

</html>