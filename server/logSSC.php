<?php
	include_once "controller/ServerFunctions.php";

	$obj = new ServerFunctions();
	$obj->logOfficer($_POST["code"]);
?>