
<?php
    include_once "DatabaseConnector.php";

    class ServerFunctions extends DatabaseConnector {
        function logOfficer($code) {
            $this->openConnection();
            $officerID = $this->checkCode($code);
            if($officerID != "") {
                $status = $this->getStatus($officerID);
                if($status != "in") $stat = "out";
                else $stat = "in";
                $timeAndDateNow = $this->getTimeAndDateNow();
                $sql0 = $this->dbHolder->prepare("INSERT INTO logs VALUES (null, ?, ?, ?);");
                $sql0->execute(array($officerID, $timeAndDateNow, $status));

                $sql6 = $this->dbHolder->prepare("SELECT type, fullName, photo, DATE_FORMAT(?, '%b'), DATE_FORMAT(?, '%d'), DATE_FORMAT(?, '%Y'), DATE_FORMAT(?, '%r') FROM officers WHERE officerID = ?;");
                $sql6->execute(array($timeAndDateNow, $timeAndDateNow, $timeAndDateNow, $timeAndDateNow, $officerID));
                $formatted = $sql6->fetch();
                echo "<h3 class='single-spacing' style='line-height: 10px;'><label style='font-size: 16px'>[".$formatted[3]." ".$formatted[4].", ".$formatted[5]." | ".$formatted[6]."]</label><label>Logged-".$status." <label>".
                      "<br /><label class='label label-info' style='font-size: 17px;'>".$formatted[1]." (".$formatted[0].")</label>".
                      "<img class='img-responsive img-rounded' src='images/".$formatted[2]."' /></h3>";
            } else {
                echo "<h3>Invalid Code;</h3>";
            }

            $this->closeConnection();
        }

        function checkCode($code) {
            $sql = $this->dbHolder->prepare("SELECT officerID FROM officers WHERE code = ?;");
            $sql->execute(array($code));

            $data = "";
            while($content = $sql->fetch()) {
                $data = $content[0];
            }

            return $data;
        }

        function getStatus($officerID) {
            $sql2 = $this->dbHolder->prepare("SELECT status, timeLogged FROM logs WHERE logID = (SELECT MAX(logID) FROM logs WHERE userID = ?);");
            $sql2->execute(array($officerID));

            $status = $sql2->fetch();
            $stat  = "";
            if($status[0] == "" || $status[0] == "out") {
                $stat = "in";
            } else {
                $stat = "out";
                $timeDiff = $this->addTimeRendered($officerID, $status[1], $this->getTimeAndDateNow());

                $hour = floor($timeDiff/60);
                if($hour == 1) $hour .= " hr";
                else if($hour > 1) $hour .= " hrs";
                else $hour = "";
                $min = ceil($timeDiff%60);
                if($min == 1) {
                    if($hour == "") $min .= " min";
                    else $min = " and ".$min." min";
                } else if($min > 1) {
                    if($hour == "") $min .= " mins";
                    else $min = " and ".$min." mins";
                } else {
                    $min = "";
                }
                if($hour == "" && $min == "") $hour = "0 time";
                $stat .= " <label style='font-size:15px;'>+".$hour.$min."</label><br />";
            }
            return $stat;
        }

        function getCurrentStatus($officerID) {
            $sql2 = $this->dbHolder->prepare("SELECT status FROM logs WHERE logID = (SELECT MAX(logID) FROM logs WHERE userID = ?);");
            $sql2->execute(array($officerID));

            $status = $sql2->fetch();
            $stat  = "";
            if($status[0] == "" || $status[0] == "out") {
                $stat = "out";
            } else {
                $stat = "in";
            }
            return $stat;
        }

        function addTimeRendered($officerID, $timeIn, $timeOut) {
            $sql3 = $this->dbHolder->prepare("SELECT ROUND(TIME_TO_SEC(TIMEDIFF(?, ?)) / 60);");
            $sql3->execute(array($timeOut, $timeIn));

            $timeDiff = $sql3->fetch();

            $sql4 = $this->dbHolder->prepare("INSERT INTO timeRendered VALUES (null, ?, ?, ?, DATE_FORMAT(?, '%Y'));");
            $sql4->execute(array($officerID, $this->getWeek(), $timeDiff[0], $this->getTimeAndDateNow()));
            return $timeDiff[0];
        }

        function getWeek() {
            $sql5 = $this->dbHolder->prepare("SELECT WEEK(?);");
            $sql5->execute(array($this->getTimeAndDateNow()));

            $week = $sql5->fetch();
            return $week[0];
        }

        function getTimeAndDateNow() {
            $sql1 = $this->dbHolder->query("SELECT NOW();");
            $now = $sql1->fetch();

            return $now[0];
        }

        function displayLogs() {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT o.fullName, l.status, DATE_FORMAT(l.timeLogged, '%b'), DATE_FORMAT(l.timeLogged, '%d'), DATE_FORMAT(l.timeLogged, '%Y'), DATE_FORMAT(l.timeLogged, '%r') FROM officers o, logs l WHERE o.officerID = l.userID AND DATE_FORMAT(l.timeLogged, '%b') = DATE_FORMAT(?, '%b') AND DATE_FORMAT(l.timeLogged, '%d') = DATE_FORMAT(?, '%d') AND DATE_FORMAT(l.timeLogged, '%Y') = DATE_FORMAT(?, '%Y') ORDER BY l.logID;");
            $sql->execute(array($this->getTimeAndDateNow(), $this->getTimeAndDateNow(), $this->getTimeAndDateNow()));
            $data = "";

            while($content = $sql->fetch()) {
                $data .= "<tr><td>".ucwords($content[0])."</td><td>".$content[1]."</td><td>".$content[2]." ".$content[3]./*", ".$content[4].*/" | ".$content[5]."</td></tr>";
            }

            if($data != "") $data = "<tr class='fixed'><th>Officer</th><th>Status</th><th>Date | Time</th></tr>".$data;
            else $data = "<tr><th>No logs yet;</th></tr>";

            echo $data;

            $this->closeConnection();
        }

        function displayTimeSummary() {
            $this->openConnection();

            $sql0 = $this->dbHolder->query("SELECT * FROM officers WHERE type = 'SSC' ORDER BY type, fullName;");
            $data = "";
            while($officer = $sql0->fetch()) {
                $sql1 = $this->dbHolder->prepare("SELECT SUM(t.timeRendered) FROM officers o, timeRendered t WHERE o.officerID = t.officerID AND o.officerID = ? AND t.week = DATE_FORMAT(?, '%U') AND t.year = DATE_FORMAT(?, '%Y'); ");
                $sql1->execute(array($officer[0], $this->getTimeAndDateNow(), $this->getTimeAndDateNow()));

                $content = $sql1->fetch();
                $hour = floor($content[0]/60);
                if($hour == 1) $hour .= " hour";
                else if($hour > 1) $hour .= " hours";
                else $hour = "";
                $minutes = ceil($content[0]%60);
                if($minutes == 1) {
                    if($hour != "") $minutes = " and ".$minutes." min";
                    else $minutes .= " min";
                } else if($minutes > 1) {
                    if($hour != "") $minutes = " and ".$minutes." mins";
                    else $minutes .= " mins";
                } else $minutes = "";
                if($hour == "" && $minutes == "") $hour = "-----";
                $lack = 18-(floor($content[0]/60));
                if($lack < 0) $lack = "00.00";
                else {
                    $lack = ($lack*60)-(ceil($content[0]%60));
                    if($lack <= 0) $lack = "00.00";
                    else $lack = round(($lack/60)*20, 2);
                }
                $status = $this->getCurrentStatus($officer[0]);
                if($status == "out")
                    $data .= "<tr><td>".$officer[1]."</td><td><span style='color: black;'>".strtoupper($officer[3])."</span></td><td>".$hour.$minutes."</td><td>".$lack." Php</td></tr>";
                else
                    $data .= "<tr><td>".$officer[1]."</td><td><span style='color: green; font-weight: bolder;'>".strtoupper($officer[3])."</span></td><td>".$hour.$minutes."</td><td>".$lack." Php</td></tr>";


            }
            if($data != "") {
                $data = "<tr><th colspan='4' class='text-center alert-info'>SSC's Time Rendered Summary for this Week</th></tr>".
                        "<tr><th>Student#</th><th>SSC Officers</th><th>Total Time</th><th>Penalty</th></tr>".$data;
            } else {
                $data = "<tr><th colspan='2'>No Logs yet;</th></tr>";
            }

            //========== for YLEAP Data

            $sql0 = $this->dbHolder->query("SELECT * FROM officers WHERE type = 'YLEAP' ORDER BY type, fullName;");
            $YLEAPdata = "";
            while($officer = $sql0->fetch()) {
                $sql1 = $this->dbHolder->prepare("SELECT SUM(t.timeRendered) FROM officers o, timeRendered t WHERE o.officerID = t.officerID AND o.officerID = ? AND t.week = DATE_FORMAT(?, '%U') AND t.year = DATE_FORMAT(?, '%Y'); ");
                $sql1->execute(array($officer[0], $this->getTimeAndDateNow(), $this->getTimeAndDateNow()));

                $content = $sql1->fetch();
                $hour = floor($content[0]/60);
                if($hour == 1) $hour .= " hour";
                else if($hour > 1) $hour .= " hours";
                else $hour = "";
                $minutes = ceil($content[0]%60);
                if($minutes == 1) {
                    if($hour != "") $minutes = " and ".$minutes." min";
                    else $minutes .= " min";
                } else if($minutes > 1) {
                    if($hour != "") $minutes = " and ".$minutes." mins";
                    else $minutes .= " mins";
                } else $minutes = "";
                if($hour == "" && $minutes == "") $hour = "-----";
                $status = $this->getCurrentStatus($officer[0]);
                if($status == "out") {
                    $YLEAPdata .= "<tr><td>".$officer[1]."</td><td>".strtoupper($officer[3])."</td><td>".$hour.$minutes."</td></tr>";
                } else {
                    $YLEAPdata .= "<tr><td>".$officer[1]."</td><td><span style='color: green; font-weight: bolder;'>".strtoupper($officer[3])."</span></td><td>".$hour.$minutes."</td></tr>";
                }            }
            if($data != "") {
                $YLEAPdata = "<tr><th colspan='3' class='text-center alert-info'>YLEAP's Time Rendered Summary for this Week</th></tr>".
                    "<tr><th>Student#</th><th>YLEAP Mentees</th><th>Total Time</th></tr>".$YLEAPdata;
            } else {
                $YLEAPdata = "<tr><th colspan='2'>No Logs yet;</th></tr>";
            }

            $arrayData = array("SSCData"=>$data, "YLEAPData"=>$YLEAPdata);
            echo json_encode($arrayData);

            $this->closeConnection();
        }

        function addOfficer($type, $studNo, $fullName, $code, $ext) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO officers VALUES (null, ?, ?, ?, ?, '0.JPG');");
            $sql->execute(array(htmlentities($studNo), htmlentities($code), htmlentities($fullName), htmlentities($type)));

            $newName = "";
            if($ext != "") {
                $id = $this->dbHolder->lastInsertId();

                $newName = $id.".".$ext;

                $sql1 = $this->dbHolder->prepare("UPDATE officers SET photo = ? WHERE officerID = ?;");
                $sql1->execute(array($newName, $id));

            }
            $this->closeConnection();
            return $newName;
        }

        function getInfoForUpdate($codeEntered) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT * FROM officers WHERE code = ?;");
            $sql->execute(array($codeEntered));

            $data = "";
            if($content = $sql->fetch()) {
                $data = array("photo"=>$content[5],"type"=>$content[4], "name"=>$content[3]);
                echo json_encode($data);
            } else {
                echo $data;
            }
    
            $this->closeConnection();
        }

        function displayWeeklyReport() {
            $this->openConnection();

            $sql = $this->dbHolder->query("SELECT DISTINCT year, week FROM timeRendered;");

            $data = "";

            while($weekYear = $sql->fetch()) {
                $sql3 = $this->dbHolder->prepare("SELECT DATE_FORMAT(l.timeLogged, '%b'), DATE_FORMAT(l.timeLogged, '%d'), DATE_FORMAT(l.timeLogged, '%Y')
                                                  FROM logs l
                                                  WHERE DATE_FORMAT(l.timeLogged, '%Y') = ? 
                                                  AND week(l.timeLogged) = ?;");
                $sql3->execute(array($weekYear[0], $weekYear[1]));

                $counter = 0;
                $endDate = "";
                $data .= "<tr class='alert alert-info'><th colspan='3'>";
                while($dates = $sql3->fetch()) {
                    if($counter == 0) {
                        $data .= ($dates[0]." ".$dates[1]." - ");
                    }
                    $counter++;
                    $endDate = $dates[0]." ".$dates[1];
                }
                $data .= ($endDate.", ".$weekYear[0]."</th></tr>");

                $data .= "<tr><th>Name</th><th>Total Time Rendered</th><th>Penalty</th></tr>";

                $sql2 = $this->dbHolder->query("SELECT officerID, fullName FROM officers 
                                                 WHERE officerID  AND type='SSC'
                                                 ORDER BY fullName;");

                while($officers = $sql2->fetch()) {
                    $sql1 = $this->dbHolder->prepare("SELECT SUM(t.timeRendered) FROM officers o, timeRendered t 
                                                  WHERE o.officerID = t.officerID 
                                                  AND o.officerID = ? 
                                                  AND t.year = ? 
                                                  AND t.week = ?;");
                    $sql1->execute(array($officers[0], $weekYear[0], $weekYear[1]));
                    $content = $sql1->fetch();
                    $hour = floor($content[0]/60);
                    if($hour == 1) $hour .= " hour";
                    else if($hour > 1) $hour .= " hours";
                    else $hour = "";
                    $minutes = ceil($content[0]%60);
                    if($minutes == 1) {
                        if($hour != "") $minutes = " and ".$minutes." min";
                        else $minutes .= " min";
                    } else if($minutes > 1) {
                        if($hour != "") $minutes = " and ".$minutes." mins";
                        else $minutes .= " mins";
                    } else $minutes = "";
                    if($hour == "" && $minutes == "") $hour = "-----";
                    $lack = 18-(floor($content[0]/60));
                    if($lack < 0) $lack = "00.00";
                    else {
                        $lack = ($lack*60)-(ceil($content[0]%60));
                        if($lack <= 0) $lack = "00.00";
                        else $lack = round(($lack/60)*20, 2);
                    }
                    
                    $data .= ("<tr><td>".$officers[1]."</td><td>".$hour.$minutes."</td><td>".$lack." Php</td></tr>");
                }
            }

            echo $data;


            $this->closeConnection();
        }

        function displayYLEAPWeeklyReport() {
            $this->openConnection();

            $sql = $this->dbHolder->query("SELECT DISTINCT year, week FROM timeRendered;");

            $data = "";

            while($weekYear = $sql->fetch()) {
                $sql3 = $this->dbHolder->prepare("SELECT DATE_FORMAT(l.timeLogged, '%b'), DATE_FORMAT(l.timeLogged, '%d'), DATE_FORMAT(l.timeLogged, '%Y')
                                                  FROM logs l
                                                  WHERE DATE_FORMAT(l.timeLogged, '%Y') = ? 
                                                  AND week(l.timeLogged) = ?;");
                $sql3->execute(array($weekYear[0], $weekYear[1]));

                $counter = 0;
                $endDate = "";
                $data .= "<tr class='alert alert-info'><th colspan='3'>";
                while($dates = $sql3->fetch()) {
                    if($counter == 0) {
                        $data .= ($dates[0]." ".$dates[1]." - ");
                    }
                    $counter++;
                    $endDate = $dates[0]." ".$dates[1];
                }
                $data .= ($endDate.", ".$weekYear[0]."</th></tr>");

                $data .= "<tr><th>Name</th><th>Total Time Rendered</th></tr>";

                $sql2 = $this->dbHolder->query("SELECT officerID, fullName FROM officers 
                                                 WHERE officerID  AND type='YLEAP'
                                                 ORDER BY fullName;");

                while($officers = $sql2->fetch()) {
                    $sql1 = $this->dbHolder->prepare("SELECT SUM(t.timeRendered) FROM officers o, timeRendered t 
                                                  WHERE o.officerID = t.officerID 
                                                  AND o.officerID = ? 
                                                  AND t.year = ? 
                                                  AND t.week = ?;");
                    $sql1->execute(array($officers[0], $weekYear[0], $weekYear[1]));
                    $content = $sql1->fetch();
                    $hour = floor($content[0]/60);
                    if($hour == 1) $hour .= " hour";
                    else if($hour > 1) $hour .= " hours";
                    else $hour = "";
                    $minutes = ceil($content[0]%60);
                    if($minutes == 1) {
                        if($hour != "") $minutes = " and ".$minutes." min";
                        else $minutes .= " min";
                    } else if($minutes > 1) {
                        if($hour != "") $minutes = " and ".$minutes." mins";
                        else $minutes .= " mins";
                    } else $minutes = "";
                    if($hour == "" && $minutes == "") $hour = "-----";
                    $data .= ("<tr><td>".$officers[1]."</td><td>".$hour.$minutes."</td></tr>");
                }
            }

            echo $data;

            $this->closeConnection();
        }
    }