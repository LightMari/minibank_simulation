


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>keypadPage</title>
    <style>
        body{

            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/purple.jpg');
            background-size: cover;            

        }
        .input-box{
            margin-top: 10px;
            height: 60px;
            width: 90%;
            font-size: 20px;
            border-radius: 14px;
            padding-left: 12px;
            outline: none;
            color: #231942;
            background-color: #f0e6ef;
            border: none;
        }
        .input-sub{
            height: 60px;
            width: 90%;
            background-color: #5e548e;
            color: #f0e6ef;
            font-size: 20px;
            border-radius: 30px;
            border: none;
        }
        form p{
            font-size: 14px;
            font-weight: bolder;
            color: #231942;
        }
        form{
            padding: 20px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            width: 300px;
            background-color: #9f86c0;
            height: 400px;
            z-index: 1;
            position: relative;
    
        }


        .payment-form.active{
            display: block;
        }
        .payment-form {
            display: none;
        }
        #money{
            position: absolute;
            width: 170px;
            bottom: 300px;
            height: 300px;
            border-radius: 20px;
            background-color: green;
            animation-name: moneyPop;
            animation-duration: 1s;
            animation-timing-function: ease-in-out;
            animation-fill-mode: forwards;
            border: solid 12px darkgreen;
            display: none;
        }



        #dot{
            width: 90%;
            height: 90px;
            background-color: darkgreen; 
            margin-top: 110px;  
            margin-left: 8px; 
            border-radius: 80px;
           
        }
    

        @keyframes moneyPop{
            
            100%{
                transform: translateY(200px);
            }


        }



    </style>
</head>
<body>
    
<div class="payment-form active" id="dpAmt">
    <form action="" method="POST" autocomplete="off">
        <input type="text" name="dpAmt" maxlength="5" class="input-box"  required placeholder="Enter your Withdraw  Amt :">
        <p id="load">min amt: 100 and max amt :40,000</p>
        <input type="button" onclick="cancel()"  value="cancel" class="input-sub">
        <input type="submit" name="dpAmtsubmit" value="check" class="input-sub">
    </form>
</div>


<div class="payment-form" id="dpPin">
    <form action="" method="POST" autocomplete="off">
        <input type="password" name="pin" maxlength="4"  required placeholder="Enter your pin :" class="input-box">
         <input type="button" onclick="cancel()"  value="cancel" class="input-sub">
        <input type="submit" name="dpsubmit" value="check out" class="input-sub">
    </form>
    <div id="money"><div id="dot"></div></div>
 <script>
        function cancel(){
            window.location.href="atm.php";
        }
    </script>        

</div>

</body>
</html>


<?php
@include 'config.php'; 
session_start();
// mysqli_query($con,"UPDATE user_data SET balance = $userAmt - balance  WHERE card_no = '$cardno';");

$cardno= $_SESSION['card_no'];

$res=mysqli_query($con,"SELECT * FROM user_data WHERE card_no = '$cardno' ;");

$DBdata = mysqli_fetch_assoc($res);

if(isset($_POST['dpAmtsubmit'])){
    
    $userAmt = (int)$_POST['dpAmt'];

    if( $userAmt <= 40000 && $userAmt >= 100){

        if( $DBdata['balance'] > 0 && $userAmt <= $DBdata['balance'] ){

            $_SESSION['dpAmt']=$userAmt;
            echo"<style> .payment-form{display:block;} .payment-form.active{display:none;} </style>";
             
        }
        else{
             echo"<script>alert('insufficient balance !!')</script>";
        }

    }
    else
    {
         echo"<script>alert('invaild Amt !!')</script>";

    }

}


if(isset($_POST['dpsubmit'])){
   
    $enterAmt=$_SESSION['dpAmt'];
   
    if($_POST['pin'] == $DBdata['pin']){
        
        $query="UPDATE user_data SET balance = balance - $enterAmt  WHERE card_no = '$cardno';";
        
        $currentdate = date('Y-m-d H:i');
        if(mysqli_query($con,$query)){

            echo"<script>alert(' $enterAmt Debited  !!')</script>";
           
            $Trans_query ="INSERT INTO transactions (acc_no,transaction,credit,timing) VALUES('$DBdata[acc_no]','$enterAmt has been Debited',false,'$currentdate')";
            mysqli_query($con,$Trans_query);
        
            echo"<script> window.location.href='atm.php';</script>";
            
        }
        
    }   
    else{
        echo"<script>alert('Incorrect Pin!!')</script>";

    }

}



?>