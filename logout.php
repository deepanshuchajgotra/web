<?php
include_once("security.php");
session_unset();
session_destroy();
header("location:login.php");
?>