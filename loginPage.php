<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginPage</title>
    <style>
        
        #loginForm form{
        width: 400px;
        height: 450px;
        background-color: #9f86c0;
       box-shadow:1px 1px 50px rgba(37, 0, 78, 0.4);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: column;
        padding: 20px;
        border-radius: 20px;
    }


     body{
        display: flex;
        justify-content: center;
        align-items: center; 
        height: 100vh; 
        background-image: url('img/purple.jpg');
        background-repeat: no-repeat;
        background-size: cover; 
        color: #231942;
        font-family: Poppins;
        
    }   

    .input-btn{
        background-color: #f0e6ef;
        border: none;
        border-radius: 14px;
        padding-left: 20px;
        outline: none;
        font-size: 20px;
        color: #231942;
        height: 54px;
        margin-bottom: 25px;

    }
    #input-box{
        display: flex;
        flex-direction: column;
        width: 90%;
    }

    #input-sub{
        border-radius: 30px;
        background-color: #5e548e;
        font-size: 20px;
        color: #f0e6ef;
        height: 45px;
        width: 90%;
        height: 56px;
        margin-bottom: 30px;
        cursor: pointer;
        transition: 1s;
        border: none;

    }

    #input-sub:hover{

    background-color: #4e447cff;
    }

    
    a{
        text-decoration: none;
        margin: 0px;
        color: #231942;
        text-align:end;
    }
    #links{
        display: flex;
        flex-direction: column;
    }
    #ui-err{
        display: none;
        color: rgba(175, 49, 49, 1);
    }

    </style>
</head>

<body>
    

 <div id="loginForm" class="user-form active">
    <form  method="post" action="">
        <h1>Login </h1>
        <p id="ui-err">Incorrect Email or Password</p>
        <div id="input-box">
            <input type="email" name="logemail" required placeholder="Email" class="input-btn" autocomplete="none">
            <input type="password" name="logpass" required placeholder="Password"  class="input-btn" >
            <a href="registerPage.php" > Create a Account </a>
        </div>
        
        <div id="links">
            <a href="atm.php" > <img src="img/atm.png" alt="ATM" width="32px"></a>
        </div>
        <input type="submit" value="Log in" name="logSubmit" id="input-sub">
    </form>
    </div>

</body>
</html>


<?php
@include 'config.php';
session_start();
if($con){
if(isset($_POST['logSubmit'])){
$logemail=$_POST['logemail'];
$logpass=$_POST['logpass'];

//check the data register in our database
    $result=mysqli_query($con,"SELECT * FROM user_data WHERE email = '$logemail'");
    if(mysqli_num_rows($result) > 0){
        $Dbdata = mysqli_fetch_assoc($result); 
        if(password_verify($logpass, $Dbdata['password'])){
            $_SESSION['name']=$Dbdata['name'];
            $_SESSION['email']=$Dbdata['email'];
            sleep(3);
            header("Location:outputPage.php");
            exit();
        }
        else{
            echo"<script> let uierr=document.getElementById('ui-err'); uierr.style.display='block';</script>";
        }



    } 

    else
    { 
         echo"<script> alert('No Profile Found!!');</script>";

     }



}

}





?>