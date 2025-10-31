
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deposit page</title>
    <style>
        body{

            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-image: url('img/purple.jpg');
            background-size: cover;
            color: #231942;
        }
        form{
            padding: 20px;
            margin-top: 60px;
            border-radius: 20px;
            display: flex;
            width: 500px;
            align-items: center;
            flex-direction: column;
            justify-content: space-around;
            height: 600px;
            /* background-color: #9f86c0 */
        }


form img{
 width: 200px;   
}

#card-no{
    height: 60px;
    border-radius: 20px;
    padding-left: 12px;
    width: 90%;
    color: #231942;
    font-size: 20px;
    outline: none;
    background-color: #f0e6ef;
    border: none;

}

#input-sub{
    height: 60px;
    width: 70%;
    border-radius: 30px;
    background-color: #f0e6ef;
    font-size: 20px;
    background-color: #5e548e;
    color: #f0e6ef;
    transition: 1s;
    border: none;
    
}
form p{
        font-size: 22px;

}

#exit{
    width: 32px;
}

    </style>
</head>
<body>
    
<h1>WELCOME TO AURA'S BANK </h1>

<form action="" method="POST" autocomplete="off">

    <img src="img/card.png" alt="">
    <p>Insert Your ATM Card</p>
    <input type="text" name="card_no" maxlength="5" required placeholder="Enter your card No:" id="card-no" >
   
    <input type="submit" name="DPsubmit-btn" value="check" id="input-sub">
  <a href="logOutPage.php"><img src="img/exit.png"  id="exit" width ="32px"></a>
</form>

</body>
</html>


<?php
@include 'config.php';
session_start();

if(isset($_POST['DPsubmit-btn'])){
    $cardno= $_POST['card_no'];
    if(!card_checker($cardno,$con) > 0){
        echo"<script>alert('no account found')</script>";
    }
    else{
        $_SESSION['card_no'] = $cardno; 
        header("Location: KeypadPge.php");
        exit();

    }

}





?>