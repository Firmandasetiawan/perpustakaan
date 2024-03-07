<?php
$conn = new mysqli ("localhost","root","","perpus");

if ($conn->connect_error){
    die("koneksi gagal:".$conn->connect_error);
}