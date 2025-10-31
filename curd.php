<?php

$con=mysqli_connect("localhost","root","","curd_db");
if($con){
    if(isset($_POST['insert'])){    
        
        $name=$_POST['name'];
        $email=$_POST['email'];
        $country=$_POST['country'];
            
        $sql="INSERT INTO curd_tb (name,email,country)VALUES('$name','$email','$country');";
        if(mysqli_query($con,$sql)){
            echo"insert succss";
        }
        else{
             echo"insert error";
        }

    }


     if(isset($_POST['update'])){    
        
        $name=$_POST['name'];
        $email=$_POST['email'];
        $country=$_POST['country'];
        $oemail=$_POST['oemail'];

        $sql="UPDATE curd_tb set name='$name',email='$email',country='$country'WHERE email = '$oemail';";
        if(mysqli_query($con,$sql)){
            echo"update succss";
        }else{
             echo"update error";
        }

    }
     if(isset($_POST['delete'])){    
    
        $oemail=$_POST['oemail'];
       

        $sql="DELETE from curd_tb where email='$oemail';";
        if(mysqli_query($con,$sql)){
            echo"delete succss";
        }else{
             echo"delete error";
        }

    }




}


?>

<html>
<head>
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">

    <input type="text" name="name" placeholder="name">
    <input type="email" name="email" placeholder="email">
    <input type="email" name="oemail" placeholder="old email">
    <select name="country" id="">
    <option value="india">INDIA</option>
    <option value="usa">USA</option>
    <option value="uk">UK</option>
    <option value="spain">SPAIN</option>
    <option value="japan">JAPAN</option>
    </select>

    <input type="submit" value="Insert" name="insert">
    <input type="submit" value="Update" name="update">
    <input type="submit" value="Delete" name="delete">
    </form>    


</body>
</html>
