<?php
$host="localhost";
$user="root";
$pass="";
$db="cinema_db";

$con=mysqli_connect($host,$user,$pass,$db);

session_start();
//session_reset();
$name=$_SESSION['name'];
$movie=$_SESSION['movie'];
$no_tic = $_SESSION['no_tic'];
$total=$_SESSION['total'];
$tax=$_SESSION['tax'];
echo"$name ,$movie, $no_tic  $ $total   %$tax";

if($con){
    if(isset($_POST['update'])){
        header("Location:update.php");
    }
    if(isset($_POST['bill'])){
        $query="INSERT INTO movies (name,moive,no_tickets) VALUES('$name','$movie','$no_tic');";
        if(mysqli_query($con,$query)){
            echo"done";
            header("Location:test.php");
        }
        else{
            echo"not done";
        }
    }
}
?>

<html>
<body>

<div>
<h3>name <?=$name ?></h3>
<h3>moive <?= $movie ?></h3>
<h3>no of tickets <?= $no_tic ?></h3>
<h3>tax %<?= $tax ?></h3>
<h3>total $ <?= $total +$tax?></h3>
</div>

<form action="" method="POST">
    <input type="submit" value="update" name="update">
    <input type="submit" value="Bill" name="bill">
    <input type="submit" value="cancel">
</form>


</body>
</html>