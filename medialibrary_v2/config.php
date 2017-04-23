<?php
$connection = new mysqli("localhost", "root", "", "medialibrary");

if($connection->connect_error)
{
    die("connection doesnt work". $connection->connect_errno. " ". $connection->connect_error);
}

