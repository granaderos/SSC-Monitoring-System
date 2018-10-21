 <?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>YLEAP Weekly Report</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" />
        <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="shortcut icon" href="images/SSClogo.png" type="image/x-icon">
        <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/weeklyReport.js" type="text/javascript"></script>
    </head>
    <body>
        <h4 id="header" class="alert alert-info text-center">
            Time Rendered Weekly Report
        </h4>
        <div id="divMainContainer" class="container container-fluid">
            <div>
                <h6 class="alert alert-info text-center">YLEAP Mentees</h6>
                <table style="margin: auto; font-size: 12px;" class="table table-bordered table-striped" id="tblWeeklyReportYLEAP"></table>
            </div>
        </div>
    <div id="divDialog"></div>
    <div class="text-center" style="color: white"><br/>Copyright 2016<br>T.I.P. Supreme Student Council</div>
    </body>
</html>