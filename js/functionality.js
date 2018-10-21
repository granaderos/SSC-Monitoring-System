var displayPhoto = "";
var formData = false;
$(document).ready(function() {
    //alert("script is wowking!");

    displayLogs();
    displayTimeSummary();

    if(window.FormData) formData = new FormData();

    $("#aAddOfficer").tooltip();

    $("#aUpdateInfo").click(function() {
        var curCode = prompt("Enter Your Current Code:");
        if(curCode.trim() != "") {
            $.ajax({
                type: "POST",
                url: "server/getInfoForUpdate.php",
                data: {"codeEntered": curCode},
                success: function(data) {
                    if(data == "") {
                        showDialog("Ooopss...", "You entered an invalid data;");
                    } else {
                        var parsedData = JSON.parse(data);
                        $("#divOfficerInfo").html("<p class='text-center'><img style='margin: auto; width: 30%; height: 40%;' src='images/"+parsedData.photo+"' class='img-responsive' /><br /><label>"+parsedData.type+": "+parsedData.name+"</label></p>");
                        $("#divUpdateOfficer").dialog({
                            title: "Hey " + parsedData.name.substring(0, parsedData.name.indexOf(" "))+ "! Wanna Update Some Thingy?",
                            show: {effect: "slide", direction: "up"},
                            hide: {effect: "slide", direction: "up"},
                            width: "90%",
                            modal: true,
                            modal: true,
                            draggable: false,
                            resizable: false,
                            buttons: {
                                "CANCEL": function() {
                                    $("#divUpdateOfficer").dialog("close");
                                }
                            }
                        });
                    }
                },
                error: function(data) {
                    console.log("Error in getting info " + JSON.stringify(data));
                }
            });
        } else {
            showDialog("Well...", "Either you did not enter anything or you entered an invalid data;");
        }
    });

    $("#aAddOfficer").click(function() {
        var passCode = prompt("ENTER AUTHENTICATION CODE:");
        if(passCode == "mqwneb") {
            $("#divAddOfficer").dialog({
                title: "Adding Poeple Here ^_^",
                show: {effect: "slide", direction: "up"},
                hide: {effect: "slide", direction: "up"},
                width: "90%",
                modal: true,
                modal: true,
                draggable: false,
                resizable: false,
                buttons: {
                    "CANCEL": function() {
                        $("#divAddOfficer").dialog("close");
                    }
                }
            });
        } else {
            if(passCode.trim() != "") {
                showDialog("ACCESS DENIED!", "Sorry; you are not supposed to reach this thing here;")
            }
        }
    });

    $("input[name='displayPhoto']").change(function() {
        displayPhoto = this.files[0];
    });
});

function updateOfficerInfo() {
    showDialog("Ooopps...", "Sorry for the inconvenience but... I changed my mind. I no longer want you to do this. Just continue using your existing code and if you are desperate to change your display photo, then I recommend you to contact the programmer; thanky ^_^")
    $("#divUpdateOfficer").dialog("close");
}

function resetForm() {
    $("#selType").val("");
    $("#txtStudNo").val("");
    $("#txtFullName").val("");
    $("#txtNewCode").val("");
    $("#txtReCode").val("");
}

var regExpInt = /^[0-9]+$/;
var regExpDec = /^[0-9, .]*$/;
var regExpString = /^[a-z, A-Z, -]*$/;
function addOfficer() {
    var type = $("#selType").val();
    var studNo = $("#txtStudNo").val();
    var fullName = $("#txtFullName").val();
    var code = $("#txtNewCode").val();
    var reCode= $("#txtReCode").val();

    if(code == reCode) {
        if(regExpInt.test(studNo) && regExpString.test(fullName) && fullName.trim() != "" && code.trim() != "") {
            var includeDisplayPhoto = 0;
            if($("input[name='displayPhoto']").val() != "") includeDisplayPhoto = 1;
            if(formData) {
                formData.append("includeDisplayPhoto", includeDisplayPhoto);
                formData.append("type", type);
                formData.append("studNo", studNo);
                formData.append("fullName", fullName);
                formData.append("code", code);
                formData.append("displayPhoto", displayPhoto);
            }
            $.ajax({
                type: "POST",
                url: "server/addOfficer.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    showDialog("SUCCESSFULLY ADDED!", "Well, a new person was just added; he or she may now log here;");
                    $("#divAddOfficer").dialog("close");
                    resetForm();
                },
                error: function(data) {
                    console.log("error in adding Mj!" + JSON.stringify(data));
                }
            });
        } else showDialog("Something's Wrong!", "Please check all the inputted data; make sure they are valid;")
    } else {
        showDialog("Code Mismatched!", "Please check your code; " + code + " - " + reCode)
    }
}

function showDialog(title, mess) {
    $("#divDialog").html(mess);
    $("#divDialog").dialog({
        title: title,
        show: {effect: "slide", direction: "up"},
        hide: {effect: "slide", direction: "up"},
        width: "90%",
        modal: true,
        draggable: false,
        resizable: false,
        buttons: {
            "Alrighty, close this thing now": function() {
                $("#divDialog").dialog("close");
            }
        }
    });
}

function updateScroll() {
    $("#divLogs").animate({ scrollTop: $('#divLogs').prop("scrollHeight")});
    //$('#divLogs').scrollTop($('#divLogs')[0].scrollHeight);
}

function logSSC() {
    var code = $("#txtCode").val();
    if(code != "") {
        $.ajax({
        type: "POST",
        url: "server/logSSC.php",
        data: {"code": code},
        success: function(data) {
            $("#divResult").html(data);
            $("#txtCode").val("");
            displayLogs();
            displayTimeSummary();
        },
        error: function(data) {
            console.log("error Mj! " + JSON.stringify(data));
        }
    });

    }
}

function displayLogs() {
    $.ajax({
        type: "POST",
        url: "server/displayLogs.php",
        success: function(data) {
            $("#tblLogs").html(data);
            displayLogs();
            updateScroll();
        },
        error: function(data) {
            console.log("error Mj! " + JSON.stringify(data));
        }
    });
}

function displayTimeSummary() {
    $.ajax({
        type: "POST",
        url: "server/displayTimeSummary.php",
        success: function(data) {
            var parsedData = JSON.parse(data);
            $("#tblSSCSummary").html(parsedData.SSCData);
            $("#tblYLEAPSummary").html(parsedData.YLEAPData);
        },
        error: function(data) {
            console.log("error Mj! " + JSON.stringify(data));
        }
    });
}

function displayWeeklyReport() {
    $.ajax({
        type: "POST",
        url: "server/displayWeeklyReport.php",
        success: function(data) {
            $("#tblYLEAPSummary").html(parsedData.YLEAPData);
        },
        error: function(data) {
            console.log("error in displaying report Mj! " + JSON.stringify(data));
        }
    });
}

