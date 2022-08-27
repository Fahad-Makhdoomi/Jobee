<?php
require 'conection.php';
$alert = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register'])) {
        $fname = strip_tags($_POST['fname']);
        $lname = strip_tags($_POST['lname']);
        $email = strip_tags($_POST['userEmail']);
        $tel = strip_tags($_POST['userTel']);
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password == $cpassword) {
            $hash =  password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `emplogin` (`fName` ,`lName` , `Phone` , `Email` ,`Password`) VALUES ( '$fname' ,'$lname' ,'$tel' , '$email' ,'$hash')";
            $result1 = mysqli_query($conn, $sql);
            if ($result1) {
                $alert =  "<div class='alert alert-success'>You have registered successfully!</div>";
            } else {
                $alert = "<div class='alert alert-danger'>Something went wrong!Try again</div>";
            }
        } else {
            $alert = '<div class="alert alert-danger"> Passwords do not match try again!</div>';
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <title>Sign up</title>
</head>

<body>
<?php include 'header.php'; ?>
    <h3 class="text-center">Register</h3>
    <div class="container">
        <form style="border: 2px solid black;" class="d-flex flex-column align-items-center justify-content-center bg-dark text-light" action="" method="POST">
            <div class="my-4">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname">
            </div>
            <div class="my-2">
                <label for="userEmail">Enter Email:</label>
                <input type="email" name="userEmail" id="userEmail">
                <label for="userTel">Phone Number:</label>
                <input type="tel" name="userTel" id="userTel">
            </div>
            <div class="my-4">
                <label for="password">Choose a password:</label>
                <input type="password" name="password" id="password" onfocusout="validation()">
                <label for="cpassword">Confirm password:</label>
                <input type="password" name="cpassword" id="cpassword" onfocusout="validation()">
                <div class="text-danger" id="alertbox"></div>
            </div>
            <input class="btn btn-primary my-4" type="submit" name='register' id="register" value="Sign Up">
            <?php echo $alert; ?>


        </form>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
<script type="text/javascript">
    const pwd = $('#password');
    const cpwd = $('#cpassword');


    function validation() {


        if (cpwd.val() != pwd.val()) {
            $('#alertbox').html("Password does not match");


        } else if (cpwd.val() == pwd.val()) {
            {
                $('#alertbox').html("");
            }
        }
    }
</script>

</html>