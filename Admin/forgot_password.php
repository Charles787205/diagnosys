<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->
<?php

session_start();
require_once '../Models/EmployeeModel.php';

$employeeModel = new EmployeeModel();
$security_questions = $employeeModel->getSecurityQuestions();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $security_question = $_POST['security_question'];
    $answer = $_POST['answer'];
    $new_password = $_POST['new_password'];
    $employeeModel = new EmployeeModel();
    $id = $employeeModel->getIdByFirstNameAndLastName($first_name, $last_name);
    //$_SESSION['id'] = $id;
    if ($id != null) {
        $user_security_question = $employeeModel->getUserSecurityQuestions($id);
        if ($user_security_question['id'] == $security_question && $user_security_question['answer'] == $answer) {
            $employee = $employeeModel->getUserById($id);
            $employee->password = $new_password;
            $employeeModel->updateUser($employee);
            header('Location: login.php');
        }
    }

    $employee = $employeeModel->getEmployeeById($id);
    //if ($employee != null) {
    //
    //    if ($employee->position == 'Cashier') {
    //        header('Location: ../Cashier/Sales.php');
    //    } else {
    //        header('Location: dashboard.php');
    //    }
    //} else {
    //    echo '<script>alert("Invalid Email and Password")</script>';
    //}
}


?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Forgot Password</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Forgot Password" />
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
                            <img src="../assets/img/log.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Forgot Password </h2>

                        <form action="forgot_password.php" method="POST">
                            <input type="text" name="first_name" placeholder="Enter your first name" required>
                            <input type="text" name="last_name" placeholder="Enter your last name" required>
                            <select class='form-select' name="security_question" placeholder="Security Question" id="security_question">
                                <?php foreach ($security_questions as $security_question) : ?>
                                    <option value="<?php echo $security_question['id']; ?>"><?php echo $security_question['question']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <input type="text" name="answer" placeholder="Enter your answer" required>
                            <input type="password" name="new_password" placeholder="Enter your new password" required>

                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;"></a></p>
                            <button name="submit" name="submit" class="btn" type="submit" style="background-color:dodgerblue">Change Password</button>
                        </form>
                        <div class="social-icons">
                            <p>Don't have an Account? <a href="register.php">Register</a>.</p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="../assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function(c) {
            $('.alert-close').on('click', function(c) {
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>