<?php
	include_once "controller/ServerFunctions.php";

	$obj = new ServerFunctions();
	$obj->getInfoForUpdate($_POST["codeEntered"]);
?>