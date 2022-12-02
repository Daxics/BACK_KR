<?php

$connect = new mysqli("db", "user", "password", "appDB");
if(mysqli_connect_errno()) {
    throw new Exception("Couldn't connect to database.");
}