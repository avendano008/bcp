<?php
$servername = "localhost";
$username = "u476821515_SMS";
$password = "Bcpsms12@";
$dbname = "u476821515_SMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Manila');

      $datestamp = date("Y-m-d");
      $timestamp = date("H:i:s");

      $date_time = date("Y-m-d H:i:s");
      $timestamp2 = date("H:i a");
      $day=date('l');
      $day_num=date('d');
      $month=date('M');
      $year=date('Y');

      $date_now = date("d/m/Y");

      $today_str = strtotime(date("Y-m-d H:i:s"));
?>