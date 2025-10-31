
<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['email'])){
header("Location:loginPage.php ");
exit();
}
$userEmail = $_SESSION['email'];
$res = mysqli_query($con,"SELECT * FROM user_data where email = '$userEmail';");
$userdata = mysqli_fetch_assoc($res);
$rz = mysqli_query($con,"SELECT * FROM transactions WHERE acc_no = '$userdata[acc_no]';");

$statements = [];
 while($row = mysqli_fetch_assoc($rz)){
  $statements[] = $row;
 }

if(isset($_POST['con-bt'])){
  $res1="DELETE FROM user_data WHERE email='$userEmail';";
  $res2="DELETE FROM transactions WHERE acc_no='$userdata[acc_no]';";
  if(mysqli_query($con,$res1) && mysqli_query($con,$res2)){
    sleep(3);
    echo "<script>alert('Deleted successfully');</script>";
    echo "<script>window.location.href='loginPage.php';</script>";
  }


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-image: url('img/purple.jpg');
            background-size: cover;
            height: 100vh;
        }

        #page{
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2)
            
        }


/* Card */
@import url("https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap");

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: "Rubik", sans-serif;
}


.card {
  width: 380px;
  height: 230px;
  border: 2px solid rgba(255, 255, 255, 0.2);
  background: #9f86c0;
  border-radius: 10px;
  z-index: 1;
  box-shadow:1px 1px 50px rgba(37, 0, 78, 0.4);
  overflow: hidden;
  position: relative;

}

.visa_logo {
  float: right;
  padding: 10px;
}

.visa_logo img {
  width: 70px;
  height: 40px;
}

.visa_info {
  padding: 10px;
  margin: 30px 0;
}
.visa_info img {
  width: 60px;
  height: 45px;
}

.visa_info p {
  font-size: 22px;
  padding: 10px 0;
  letter-spacing: 2px;
  color: #ffffff;
}

.visa_crinfo {
  display: flex;
  justify-content: space-between;
  padding: 0 10px;
  
  color: #ffffff;
}

.icos{
    display: flex;
    align-items: center;
    justify-content: center;
    
}
#icos{
    width: 500px;
    justify-content: space-between;
}



#img{
width: 65px;
height: 40px;
background-color: lightyellow;
border-radius: 8px;

}

#statements{
  background-color: #9f86c0;
  border-radius: 20px;
  color: #231942;
  padding: 20px;
  text-align: center;
  height: 45px;
  overflow: auto;
  transition: 280ms ease;
  scrollbar-width: none;
  -ms-overflow-style: none;

}

    #ex-del-btn{

      display: flex;
      align-items: center;
      width: 500px;
      justify-content: space-between;
    }


#statements:hover{
height: 300px;

}

#statements b{
  font-size: 20px;
}
#conf-box{
  height: 100%;
  background-color: #231942;
  position: fixed;
  width: 100%;
  z-index: 100;
  display: none;
}
#conf-btn{
  display: flex;
  flex-direction: column;
  justify-content:space-around;
  align-items: center;
  height: 200px;
  font-size: 20px;
  width: 400px;
  background-color: #9f86c0;
  color: #ffffff;
  padding: 20px;
  border-radius: 14px;
}
input,#conf-btn input{
        border-radius: 30px;
        background-color: #5e548e;
        font-size: 20px;
        color: #f0e6ef;
        height: 45px;
        width: 30%;
        height: 56px;
        margin-bottom: 30px;
        cursor: pointer;
        transition: 1s;
        border: none;

    }

    #conf-btn input{
      width: 150px;
    }
    #bts{
      margin-top: 20px;
      display: flex;
      width: 90%;
      justify-content: space-between;
    }


    </style>
</head>
<body>
    <div id="page">
        <h1>Welcome Back <span> <?= $userdata['name'];?> </span> !</h1> 
         <div class="icos">
            <img src="img/portrait.png" width="32px"> 
            <h2 > :<span> <?= $userdata['acc_no']?></span> </h2>
       </div>

        <div class="container">  
            <div class="card">
                <div class="visa_logo">
                </div>
             
                <div class="visa_info">
                  <div id="img"></div>
                    <p>XXXX <span> <?= $userdata['card_no']?></span> XXXX</p>
                </div>
             
                <div class="visa_crinfo">
                    <p>02/12</p>
                    <p><span> <?= $userdata['name'];?> </span></p>
                </div>
            </div>
        </div>
       
       <div class="icos" id="icos">
           
           <div class="icos">
               <img src="img/lock.png" width="32px"> 
               <h2 > :<span> <?= $userdata['pin']?></span> </h2>
           </div>
      
           <div class="icos">
                <img src="img/indian-rupee-sign.png" width="32px"> 
                <h2 > :<span> <?= $userdata['balance']?></span> </h2>
           </div>
       </div>
      <div id="statements">
        <b>Statements</b>
      <?php
         foreach($statements as $state){
           echo"<p>$state[transaction] : $state[timing]</p>";
          }
      
      ?>
      </div>
      <div id="ex-del-btn">
        <a href="logOutPage.php"><img src="img/exit.png" width ="32px"></a>    
        <input type="button" value="Delete Acc" onclick="enableBox()">
      </div> 

      <div id="conf-box">
          <div id="conf-btn">
            <p>Are You Sure To <strong>Delete</strong> Your ACC</p>
            <div id="bts">
              <form action="" method="post">
              <input type="button" value="Cancel" onclick="cancelBox()">
              <input type="submit" value="Confirm" name="con-bt">
              </form>  
            </div>
          </div>
      </div>
    
          <script>
            function cancelBox(){
              let cancel_bt= document.getElementById('conf-box');
              cancel_bt.style.display='none';
            }
            function enableBox(){
              let enable_bt= document.getElementById('conf-box');
              enable_bt.style.display='flex';
              enable_bt.style.justifyContent='center';
              enable_bt.style.alignItems='center';
              enable_bt.style.flexDirection='column';

            }
          
          </script>

    </div>
  
</body>
</html>



