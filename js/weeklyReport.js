$(document).ready(function() {

    displayWeeklyReport();
    displayYLEAPWeeklyReport();

});
function displayWeeklyReport() {
    $.ajax({
        type: "POST",
        url: "server/displayWeeklyReport.php",
        success: function(data) {
            $("#tblWeeklyReport").html(data);
        },
        error: function(data) {
            console.log("error in displaying report Mj! " + JSON.stringify(data));
            alert("error in displaying report Mj! " + JSON.stringify(data));
        }
    });
}

function displayYLEAPWeeklyReport() {
    $.ajax({
        type: "POST",
        url: "server/displayYLEAPWeeklyReport.php",
        success: function(data) {
            $("#tblWeeklyReportYLEAP").html(data);
        },
        error: function(data) {
            console.log("error in displaying report Mj! " + JSON.stringify(data));
            alert("error in displaying report Mj! " + JSON.stringify(data));
        }
    });
}
