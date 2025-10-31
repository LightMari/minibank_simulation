<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('img/purple.jpg');
            background-size: cover;
            
        }
        form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 25px;
            color: #231942;
        }


        #opt{
            height: 200px;
            padding: 20px;
            width: 600px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            

        }
        .options{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bolder;
            color: #231942;
            transition: 0.5s;
            border-radius: 12px;
            padding: 30px;
            text-decoration: none;
        }
        .options:hover{
            background-color: rgba(0, 0, 0, 0.2);
        }

        .options img{
            width: 90px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
        
    <form action="">
        <h2>Choose Your transations</h2>
        <div id="opt">
            <a href="creditPage.php" class="options">
            <img src="img/user.png" alt="">
            <label for="Deposit">Deposit To Me</label>
            </a>
   
        <a href="creditOther.php" class="options">
            <img src="img/group.png" alt="">
            <label for="withdraw">Deposit To Other</label>
        </a>
    </div>
    </form>


</body>
</html>