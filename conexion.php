<?php
const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'Steban0708';
const DB_NAME = 'sistemainventario2';


$conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conexion === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}