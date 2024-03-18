<?php
function formatDate($date) {
    return date('d.m.Y', strtotime($date));
}

function showTable($group1,$nameCell1,$group2,$nameCell2,$group3,$nameCell3,$group4,$nameCell4,$information,$nameCellInformation)
{
    // Eingabe Arrays Sortieren:

        //information Array
        usort($information, function($a, $b) {
            return strcmp($a['start'], $b['start']);
        });
        //group 1
        usort($group1, function($a, $b) {
            return strcmp($a['start'], $b['start']);
        });
        //group 2
        usort($group2, function($a, $b) {
            return strcmp($a['start'], $b['start']);
        });
        //group 3
        usort($group3, function($a, $b) {
            return strcmp($a['start'], $b['start']);
        });

        //group 4
        usort($group4, function($a, $b) {
            return strcmp($a['start'], $b['start']);
        });






    $maxCount = max(count($group1), count($group2), count($group3), count($information));

    echo "<table  id='ffw'>";
    echo "<tr>";
    if (($nameCell1 != "0") and ($nameCell1 != null)) echo "<th colspan='2'>".$nameCell1."</th>";
    if (($nameCell2 != "0") and ($nameCell2 != null)) echo "<th colspan='2'>".$nameCell2."</th>";
    if (($nameCell3 != "0") and ($nameCell3 != null)) echo "<th colspan='2'>".$nameCell3."</th>";
    if (($nameCell4 != "0") and ($nameCell4 != null)) echo "<th colspan='2'>".$nameCell4."</th>";
    if (($nameCellInformation != "0") and ($nameCellInformation != null)) echo "<th colspan='2'>".$nameCellInformation."</th>";


    echo "</tr>";

    for ($i = 0; $i < $maxCount; $i++) {
        echo "<tr>";

        // outout  group 1
        if (($nameCell1 != "0") and ($nameCell1 != null)){
            if (isset($group1[$i])) {
                echo "<td><strong>" . formatDate($group1[$i]['start']) . "</strong></td>";
                echo "<td style=' border-right: 1px solid black;'>{$group1[$i]['summary']}</td>";
            } else {
                echo "<td></td><td style=' border-right: 1px solid black;'></td>"; // Leere Zellen, falls kein Element vorhanden
            }
        }// End Output group 1

        // output für group 2
        if (($nameCell2 != "0") and ($nameCell2 != null)){
            if (isset($group2[$i])) {
            echo "<td><strong>" . formatDate($group2[$i]['start']) . "</strong></td>";
            echo "<td style=' border-right: 1px solid black;'>{$group2[$i]['summary']}</td>";
            } else {
                echo "<td></td><td style=' border-right: 1px solid black;'></td>"; // Leere Zellen, falls kein Element vorhanden
            }
        }// End output Group 2



        // output für group 3
        if (($nameCell3 != "0") and ($nameCell3 != null)){

            if (isset($group3[$i])) {
                echo "<td><strong>" . formatDate($group3[$i]['start']) . "</strong></td>";
                echo "<td style=' border-right: 1px solid black;'>{$group3[$i]['summary']}</td>";
            } else {
                echo "<td></td><td style=' border-right: 1px solid black;'></td>"; // Leere Zellen, falls kein Element vorhanden
            }
        }//End output Group 3

        if (($nameCell4 != "0") and ($nameCell4 != null)){

            if (isset($group3[$i])) {
                echo "<td><strong>" . formatDate($group4[$i]['start']) . "</strong></td>";
                echo "<td style=' border-right: 1px solid black;'>{$group4[$i]['summary']}</td>";
            } else {
                echo "<td></td><td style=' border-right: 1px solid black;'></td>"; // Leere Zellen, falls kein Element vorhanden
            }
        }//End output Group 3

        // Ausgabe für information
        if (($nameCellInformation != "0") and ($nameCellInformation != null)) {
            if (isset($information[$i])) {
                echo "<td><strong>" . formatDate($information[$i]['start']) . "</strong></td>";
                echo "<td style=' border-right: 1px solid black;'>{$information[$i]['summary']}</td>";
            } else {
                echo "<td></td><td style=' border-right: 1px solid black;'></td>"; // Leere Zellen, falls kein Element vorhanden
            }
        }// End output Group Information

        echo "</tr>";
    }

    echo "</table>";

}
function getArrays($data, &$gruppe1,$searchstring1, &$gruppe2,$searchstring2, &$gruppe3,$searchstring3,&$gruppe4,$searchstring4, &$gesamt)
{
    foreach ($data as $key => $value) {
        if (isset($value['type']) && $value['type'] === 'VEVENT') {
            // Überprüfen, ob summary vorhanden ist
            if (isset($value['summary'])) {
                $summaryText = explode("-", $value['summary'], 2); // Teilt die summary am "-" Zeichen
                $trimmedSummaryText = isset($summaryText[1]) ? trim($summaryText[1]) : '';

                // Überprüfen der Gruppenzugehörigkeit und Einfügen in das entsprechende Array
                if (strpos($value['summary'], $searchstring1) === 0) {
                    $gruppe1[] = ['summary' => $trimmedSummaryText, 'start' => $value['start']];
                } elseif (strpos($value['summary'], $searchstring2) === 0) {
                    $gruppe2[] = ['summary' => $trimmedSummaryText, 'start' => $value['start']];
                } elseif (strpos($value['summary'], $searchstring3) === 0) {
                    $gruppe3[] = ['summary' => $trimmedSummaryText, 'start' => $value['start']];
                } elseif (strpos($value['summary'], $searchstring4) === 0) {
                    $gruppe4[] = ['summary' => $trimmedSummaryText, 'start' => $value['start']];
                } else {
                    $gesamt[] = ['summary' => $value['summary'], 'start' => $value['start']];
                }
            }
        }

    }
}
function getDataFromJson($filename,$calurl)
{
    $ret = exec("node ./reload.js ".$filename.' '.$calurl.'  2>&1', $out, $err);
    return json_decode( file_get_contents($filename), true );

}

function addCalender($filename,$calurl,&$array)
{
    $tmpData = getDataFromJson($filename,$calurl);
    foreach ($tmpData as $key => $value) {
        if (isset($value['type']) && $value['type'] === 'VEVENT') {
            // Überprüfen, ob summary vorhanden ist
            if (isset($value['summary'])) {
                $array[] = ['summary' => $value['summary'], 'start' => $value['start']];

            }
        }

    }
}