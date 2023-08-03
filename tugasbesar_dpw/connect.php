<?php

$conn=new mysqli('localhost', 'root', '', 'javaneseteakhubdata');

if(!$conn){
    die(mysqli_error($conn));
}

?>