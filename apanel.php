<?php
session_start();
if ($_SESSION['loggedin'] == false) {
    header('location: login.php');
}

require 'conection.php';

$p = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submitBtn'])) {
        $jobtitle = strip_tags($_POST['JobTitle']);
        $jobdesc = strip_tags($_POST['JobDescreption']);

        $sql = "INSERT INTO `jobposts` (`JobTitle` ,`JobDescreption`) VALUES ( '$jobtitle' ,'$jobdesc')";
        $result1 = mysqli_query($conn, $sql);
        if ($result1) {
            $p =  "<div class='alert alert-success'>Job Posted Successfuly</div>";
        } else {
            $p = "<div class='alert alert-danger'>Job Not Posted!!</div>";
        }
    }
    if (isset($_POST['logout'])) {

        session_unset();
        session_destroy();

        header('location:login.php');
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <title>Admin Dashboard</title>
</head>

<body class="bg-dark text-light">
    <h1 style="text-align:center" class='my-2'>Admin Dashboard</h1>

    <div class="container">
        <form class='d-flex flex-column align-items-center justify-content-center' action="" method="POST">

            <label class='my-3' for="JobTitle">Job Title</label>
            <input class='my-3' type="text" name="JobTitle" id="JobTitle">
            <label class='my-3' for="JobDescreption">Job Descreption</label>
            <textarea class='my-3' rows="10" cols="50" name="JobDescreption" id="JobDescreption"></textarea>
            <input class='my-3 btn btn-primary' type="submit" name="submitBtn" id="submitBtn" value="Post">

        </form>
        <?php echo $p; ?>
    </div>

    <form class="mx-auto" style="width: 120px;" action="" method="POST">

        <input class='my-3 btn btn-danger mx-4' type="submit" name='logout' value="Log Out">
    </form>
 
    <?php include 'footer.php'; ?>
</body>

</html>