<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $con=mysqli_connect("localhost","root","");
    if(!$con)
    {
        die("couldnt connect".mysqli_error());
    }

    $sql="create database SchoolMS";
    $result=mysqli_query($con,$sql) or die("couldnt create datbase");
    echo "Data base has been created";
    ?>
   
</body>
</html>