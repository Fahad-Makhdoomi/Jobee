<?php
session_start();
if ($_SESSION['loggedin'] == false) {
    header('location: login.php');
}

require 'conection.php';

$p = '';
$p2 = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {



    $target_dir = "Images/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    $productName = strip_tags($_POST['productName']);
    $productPrice = strip_tags($_POST['productPrice']);
    $productDescription = strip_tags($_POST['productDescription']);
    $productImage = $target_dir . $_FILES["productImage"]["name"];


    // Check if image file is a actual image or fake image
    if (isset($_POST["submitBtn"])) {
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if ($check !== false) {;
            $uploadOk = 1;
        } else {
            $p = "<div class='alert alert-danger'>File not an image</div>";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $p = "<div class='alert alert-danger'>File already exists!</div>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["productImage"]["size"] > 240000) {
        $p = "<div class='alert alert-danger'>File too large</div>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $p = "<div class='alert alert-danger'>Only jpg, png, jpeg and gif formats are allowed!</div>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $p2 = "<div class='alert alert-danger'>File Not uploaded!</div>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {


            $sql = "INSERT INTO products (`productName` ,`productDescription` , `productImage` , `productPrice`) VALUES ( '$productName' ,'$productDescription' , '$productImage' ,'$productPrice')";
            $result1 = mysqli_query($conn, $sql);
            if ($result1) {
                $p = "<div class='alert alert-success'>The product was posted!</div>";
            }
        } else {
            $p2 = "<div class='alert alert-danger'>Some problem occured while uploading the file!</div>";
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
        <form class='d-flex flex-column align-items-center justify-content-center' action="" method="POST" enctype="multipart/form-data">

            <label class='my-3' for="productName">Title</label>
            <input class='my-3' type="text" name="productName" id="productName">
            <label class='my-3' for="productDescription">Descreption</label>
            <textarea class='my-3' rows="10" cols="50" name="productDescription" id="productDescription"></textarea>
            <div>
                <label class='my-3' for="productImage" style="margin-right:5vw ;">Product Image:</label>
                <input class='my-3' type="file" name="productImage" id="productImage">
            </div>
            <div>
            <label class="my-3" for="productPrice">Price:</label>
            <input class="my-3" type="number" id="productPrice" name="productPrice">
        
        </div>
            <input class='my-3 btn btn-primary' type="submit" name="submitBtn" id="submitBtn" value="Post">

        </form>

    </div>


    <?php echo $p; ?>
    <?php echo $p2; ?>


    <form class="mx-auto" style="width: 120px;" action="" method="POST">

        <input class='my-3 btn btn-danger mx-4' type="submit" name='logout' value="Log Out">
    </form>

    <?php include 'footer.php'; ?>
</body>

</html>
