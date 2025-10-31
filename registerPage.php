

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/registerPage.css">
    
    
    <style>

    body{
        display: flex;
        justify-content: center;
        align-items: center; 
        height: 100vh;  
        background-image: url('img/purple.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        color: #231942;
    }   
    
    #registerForm form{
        width: 450px;
        height: 530px;
        background-color: #9f86c0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
        border-radius: 20px;
        align-items: center;
         box-shadow:1px 1px 50px rgba(37, 0, 78, 0.4);
        
    }
    .input-box{
        display: flex;
        flex-direction: column;

        width: 90%;
    }
    .input-box input,select{
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

     #input-sub{
        border-radius: 30px;
        background-color: #5e548e;
        font-size: 20px;
        color: #f0e6ef;
        height: 45px;
        width: 90%;
        height: 56px;
        margin-top: 20px;
        margin-bottom: 15px;
        cursor: pointer;
        transition:1.5s;
        border: none;
    }

    #input-sub:hover{

    background-color: #4e447cff;
    }


    
    a{
        color: #231942;
        font-size: 18px;
        text-decoration: none;

    }

     #ui-err{
        display: none;
        color: rgba(175, 49, 49, 1);
        margin: 0px;
    }

    </style>



</head>
<body>
    <div id="registerForm" class="user-form">
    <form  method="post" action="">
        <h1>Register </h1>
        <p id="ui-err">User Already Exist</p>
    <div class="input-box">
        <input type="text" name="name" required placeholder="Name">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="pass" required placeholder="Password">
        
        <div id="select">
            <select name="gender" id="">
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
            </select>
            
            <select name="country">
                <option value="india">India</option>
                <option value="usa">USA</option>
                <option value="uk">UK</option>
                <option value="japan">Japan</option>
                <option value="finland">Finland</option>
                <option value="germany">Germany</option>
            </select>
        </div>
    
    </div>
            <a href="loginPage.php" onclick="setActiveForm('loginForm')" >Already have a Account </a>
        
            <input type="submit" id="input-sub" value="Sign Up" name="regSubmit">
        </form>
    </div>
     

</body>
</html>

<?php
session_start();
@include 'config.php';

if($con){
// echo' Server DB Connected successfully' ;

    if(isset($_POST['regSubmit'])){
    //loading data into variable 

    $name=$_POST['name'];
    $pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
    $email=$_POST['email'];
    $country=$_POST['country'];
    $gender=$_POST['gender'];
    $card_no=card_gen($con);
    $pin=pin_gen($con);
    $acc_no=rand(100000,1000000);
    $balance=500;
    
        if(mysqli_num_rows(email_checker($email,$con)) > 0){
            //echo"<script> alert('user email already exist!!');</script>";
            echo"<script> let uierr=document.getElementById('ui-err'); uierr.style.display='block';</script>";
        }

        else{
        $query="INSERT INTO user_data(name,gender,email,password,county,card_no,pin,acc_no,balance) VALUES('$name','$gender','$email','$pass','$country','$card_no','$pin','$acc_no','$balance')";
        
            if(!mysqli_query($con,$query)){
                echo("Can't Create Your profile!!");
            }  
            else{
                echo"<script> alert('Created Profile');</script>";
                sleep(3);
               echo "<script>window.location.href='loginPage.php'</script>";
            }

        }


    }



}



?>
