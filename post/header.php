<?php 
 session_start();
 include_once("config.php");
if($_SESSION['id']=="")
{
header("location:index.php");
}?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title></title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		 <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet"  href="css/jsDatePick_ltr.min.css" type="text/css" media="all">

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jsDatePick.jquery.min.1.3.js"></script> 
<script type="text/javascript" src="js/dateTimePicker.js"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	</head>