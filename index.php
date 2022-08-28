<?php
require 'conection.php';

$sql = "SELECT  * FROM products";

$result = mysqli_query($conn, $sql);

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
    <title>Home</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <h2 style="text-align:center" class="my-3">Welcome to <span class="text-primary"><b>Jobee</b></span></h2>
    <hr>
    <h3 class="text-primary text-center ">Recent Posts</h3>
    <div class="container d-flex flex-wrap justify-content-center bg-dark">

        <?php

        while ($row = mysqli_fetch_assoc($result)) {


            echo '
    
     <div class="card my-5 mx-5" style="width: 20%;">
     <img src='.$row["productImage"].' class="card-img-top" alt="...">
     <div class="card-body">
       <h5 class="card-title">' . stripcslashes($row["productName"]) . '</h5>
       <p class="card-text">' . stripcslashes($row["productDescription"]) . '</p>
       <a href="#" class="btn btn-primary">Price:'.stripcslashes($row["productPrice"]) .'/INR</a>
    </div>
    </div>';
        } ?>

    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
