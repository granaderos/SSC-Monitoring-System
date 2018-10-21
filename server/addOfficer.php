<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 11/4/16
 * Time: 12:20 AM
 */

include_once "controller/ServerFunctions.php";

$obj = new ServerFunctions();

if($_POST["includeDisplayPhoto"] == 1) {
    $allowedImageType = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/pjpeg", "image/x-png");
    $allowedImageExtension = array("gif", "jpeg", "jpg", "png");
    $imageName = $_FILES["displayPhoto"]["name"];
    $imageExtension = end(explode(".", $imageName));
    $uploadingError = "";
    if(in_array($_FILES["displayPhoto"]["type"], $allowedImageType) || in_array($imageExtension, $allowedImageExtension)) {
        if($_FILES["displayPhoto"]["error"] > 0) $uploadingError = "Sorry. An error occur while uploading the package photo";
        else {
            $newName = $obj->addOfficer($_POST["type"], $_POST["studNo"], $_POST["fullName"], $_POST["code"], $imageExtension);
            echo "new name = ".$newName;
            move_uploaded_file($_FILES["displayPhoto"]["tmp_name"], "../images/".$newName);
        }
    }
    echo "error is ".$uploadingError;
} else {
    $obj->addOfficer($_POST["type"], $_POST["studNo"], $_POST["fullName"], $_POST["code"], "");
}