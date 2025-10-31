<?php
// Use environment variables for production
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db = getenv('DB_NAME') ?: 'user_db';

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set charset to prevent SQL injection
mysqli_set_charset($con, "utf8mb4");

// All your existing functions remain the same
function data_exist_checker($column_name, $column_data, $con) {
    $column_data = mysqli_real_escape_string($con, $column_data);
    $query = "SELECT name FROM user_data WHERE $column_name = '$column_data'";
    return mysqli_query($con, $query);
}

function email_checker($email_data, $con) {
    $isemail = data_exist_checker('email', $email_data, $con);
    return $isemail;
}

function card_gen($con) {
    $card_data = random_gen(10000, 100000);
    while(mysqli_num_rows(data_exist_checker('card_no', $card_data, $con)) > 0) {
        $card_data = random_gen(10000, 100000);
    }
    return $card_data;
}

function pin_gen($con) {
    $pin_data = random_gen(1000, 10000);
    while(mysqli_num_rows(data_exist_checker('pin', $pin_data, $con)) > 0) {
        $pin_data = random_gen(1000, 10000);
    }
    return $pin_data;
}

function random_gen($min, $max) {
    return rand($min, $max);
}

function card_checker($card_no, $con) {
    return mysqli_num_rows(data_exist_checker('card_no', $card_no, $con));
}
?>