
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Page</title>
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
        }
        .payment-form.active{
            display: block;
        }
        .payment-form {
            display: none;
        }
    </style>
</head>
<body>
    
<div class="payment-form active" id="crAmt">
    <form action="" method="POST" autocomplete="off">
        <input type="text" name="crAmt" maxlength="5"  required placeholder="Enter your Deposit Amt :" class="input-box">
        <p>min amt: 100 and max amt: 40000</p>
         <input type="button" onclick="cancel()"  value="cancel" class="input-sub">
        <input type="submit" name="crAmtsubmit" value="check" class="input-sub">
        
    </form>
</div>

<div class="payment-form" id="crPin">
    <form action="" method="POST" autocomplete="off">
        <input type="password" name="pin" maxlength="4"  required placeholder="Enter your pin :" class="input-box">
        <input type="button" onclick="cancel()"  value="cancel" class="input-sub">
        <input type="submit" name="crsubmit" value="check out" class="input-sub">
    </form>
</div>
 <script>
        function cancel(){
            window.location.href="atm.php";
        }
    </script>
</body>
</html>


<?php
@include 'config.php'; 
session_start();
// mysqli_query($con,"UPDATE user_data SET balance = $userAmt - balance  WHERE card_no = '$cardno';");

$cardno= $_SESSION['card_no'];

$res=mysqli_query($con,"SELECT * FROM user_data WHERE card_no = '$cardno' ;");

$DBdata = mysqli_fetch_assoc($res);

if(isset($_POST['crAmtsubmit'])){

    $userAmt = (int)$_POST['crAmt'];

    if( $userAmt <= 40000 && $userAmt >= 100){

         $_SESSION['crAmt']=$userAmt;
            echo"<style> .payment-form{display:block;} .payment-form.active{display:none;} </style>";
             
    }
    else
    {
         echo"<script>alert('invaild Amt !!')</script>";

    }

}


if(isset($_POST['crsubmit'])){
   
    $enterAmt=$_SESSION['crAmt'];
   
   
    if($_POST['pin'] == $DBdata['pin']){
        
        $query="UPDATE user_data SET balance = balance + $enterAmt  WHERE card_no = '$cardno';";
        $currentdate=date('Y-m-d H:i');
        if(mysqli_query($con,$query)){
            $Trans_query ="INSERT INTO transactions (acc_no,transaction,credit,timing) VALUES('$DBdata[acc_no]','$enterAmt has been Credited',true,'$currentdate')";
            mysqli_query($con,$Trans_query);
            echo"<script>alert(' $enterAmt Debited sucessfully!!')</script>";
           // header("Location:atm.php");
             echo"<script> window.location.href='atm.php';</script>";
            exit();
            
        }
        
    }   

}



?>
