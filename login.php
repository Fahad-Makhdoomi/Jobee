<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


    <title>LogIn</title>
</head>

<?php
include 'header.php';
$alert = false;
require("conection.php");

if (isset($_POST['submit'])) {


    $uid = $_POST["uid"];
    $password = $_POST["password"];



    $sql = "Select * from `emplogin` where `Email`='$uid'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['Password'])) {
              
                session_start();
                $_SESSION['loggedin'] = true;
               
                header("location: apanel.php");
            } else {
                $alert = true;
            }
        }
    } else {
        $alert = true;
    }
}
?>

<body>
    <h1 style="text-align: center; margin: 50px auto; font-size:40px;">Welcome User</h1>
    <div class="container">

        <form style="border: 2px solid black;" class="d-flex flex-column align-items-center justify-content-center bg-dark text-light" action="Login.php" method="POST">

            <label class="my-2" for="UID">Enter Email</label>
            <input class="my-2" id="UID" type="email" name="uid">
            <label class="my-2" for="Password">Enter Your Password</label>
            <input class="my-2" type="password" id="Password" name="password">
            <input class="my-2" type="submit" name="submit" value="LogIn" class="submit-btn">
            </from>

            <?php
            if ($alert) {

                echo "<div class='alert mx-4'><h4>Incorrect Credentials . Try Again!</h4></div>";
            }
      

            ?>
    </div>

    <?php include 'footer.php'; ?>
  
</body>

</html>