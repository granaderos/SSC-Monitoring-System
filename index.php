 <?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>SSC Monitoring</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" />
        <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="shortcut icon" href="images/SSClogo.png" type="image/x-icon">
        <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/functionality.js" type="text/javascript"></script>
    </head>
    <body>
        <h4 id="header" class="alert alert-info text-center">
            <span class="pull-left">Weekly Report&nbsp;</span>
            <a href="ssc-weekly-report.php" target="_blank" class="pull-left" >[SSC]</a>
            <a href="yleap-weekly-report.php" target="_blank" class="pull-left" >[YLEAP]</a>
            
            SSC and YLEAP Monitoring System
            <a id="aUpdateInfo" class="pull-right menu" title="Update">[ <img src="images/updateInfo.png" style="width: 25px; height: 25px;" />]</a>
            <a id="aAddOfficer" class="pull-right menu" title="Add">[ <img src="images/addUser.png" style="width: 25px; height: 25px;" /> ]</a>
        </h4>
        <div id="divMainContainer" class="container container-fluid">

            <div class="row">
                <div id="" class="col-lg-5">
                    <form class="form-group" onsubmit="logSSC(); return false;">
                        <input type="text" class="transparent form-control" id="txtCode" placeholder="Enter code here"/>
                    </form>
                    <div id="divResult">
                        <img src="images/SSCwave.png" class="img-responsive img-rounded" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <h4>Recent Logs (Today)</h4>
                    <div style="height: 550px; overflow-y: auto;" id="divLogs">
                        <table class="table table-hover table-striped" style="background: transparent;" id="tblLogs"></table>
                    </div>
                </div>
            </div>
            <br/><br/>
            <h6 class="alert alert-success block" style="font-weight: bolder;">*Names on green are CURRENTLY LOGGED-IN</h6>
            <div id="divTimeSummary" class="row">
                <div class="col-lg-7">
                    <table style="margin: auto; font-size: 13px;" id="tblSSCSummary" class="table table-responsive table-striped"></table>
                </div>
                <div class="col-lg-5">
                    <table style="margin: auto; font-size: 13px;" id="tblYLEAPSummary" class="table table-responsive table-striped"></table>
                </div>
            </div>
        </div>

        <div id="divAddOfficer" class="container container-fluid">
            <br />
            <label>What Are You?</label>
            <select id="selType" class="form-control">
                <option value="SSC">SSC Officer</option>
                <option value="YLEAP">YLEAP Mentee</option>
            </select>
            <label>Student No.:</label><input type="number" class="form-control" id="txtStudNo" />
            <label>Full Name:</label><input type="text" class="form-control" id="txtFullName" />
            <label>Code:</label><input type="password" class="form-control" id="txtNewCode" />
            <label>Retype Code:</label><input type="password" class="form-control" id="txtReCode" />
            <label>Upload A Display Photo If You Want!</label>
            <input type="file" name="displayPhoto" class="form-control" />
            <br />
            <div class="text-center">
                <input type="submit" value="SUBMIT" onclick="addOfficer()" class="btn btn-primary btn-lg"/>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="RESET" onclick="resetForm()" class="btn btn-danger btn-lg"/>
            </div>
        </div>

        <div id="divUpdateOfficer" class="container container-fluid">
            <br />
            <div id="divOfficerInfo"></div>
            <h5>Wanna Change Your Code? Please fill out the fields below;</h5>
            <label>Code:</label><input placeholder="Enter New Code" type="password" class="form-control" id="txtUpdateCode" />
            <label>Retype Code:</label><input placeholder="Re-Enter New Code" type="password" class="form-control" id="txtReUpdateCode" />
            
            <label>Change Your Dispaly Photo If You Want!</label>
            <input type="file" name="newDisplayPhoto" class="form-control" />
            <br />
            <div class="text-center">
                <input type="submit" value="SUBMIT" onclick="updateOfficerInfo()" class="btn btn-primary btn-lg"/>
            </div>
        </div>
    <div id="divDialog"></div>
    <div class="text-center" style="color: white"><br/>Copyright 2016<br>T.I.P. Supreme Student Council</div>
    </body>
</html>