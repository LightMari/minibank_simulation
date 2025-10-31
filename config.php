<?php
$host="localhost";
$user="root";
$pass="";
$db="user_db";
$con=mysqli_connect($host,$user,$pass,$db);




function data_exist_checker($column_name,$column_data,$con){
$query ="SELECT name FROM user_data WHERE $column_name = '$column_data' ";
return mysqli_query($con,$query);

}


    function email_checker($email_data,$con)
    {
    $isemail =data_exist_checker('email',$email_data,$con);
    return $isemail;
    
    }
    
    
    function card_gen($con)
    {
        $card_data=random_gen(1_0000,1_00000);

        while(mysqli_num_rows(data_exist_checker('card_no',$card_data,$con)) > 0)
        {
         $card_data=random_gen(1_0000,1_00000);
        } 
        
        return $card_data;
        
    }

    function pin_gen($con)
    {
         $pin_data=random_gen(1_000,1_0000);
        
         while(mysqli_num_rows(data_exist_checker('pin',$pin_data,$con))  > 0)
        {
             $pin_data =  $pin_data=random_gen(1_000,1_0000);
            
        }
    
        return $pin_data;

    }



   function random_gen($min,$max)
    {
   
        return rand($min,$max);
   
    }

    function card_checker($card_no ,$con)
    {
        return mysqli_num_rows(data_exist_checker('card_no',$card_no,$con));

    }




?>