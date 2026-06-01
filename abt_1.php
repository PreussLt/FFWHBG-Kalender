<style>
    <?php include './main.css'; ?>
    <?php include './tools.php' ?>
</style>
<?php
// Hier die Coustom Data Eintragen
$filename = "./ical/hbg.json";
$calurl = "https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-EwOi3xwxB57Tr7OvWoDrgbaBaNtZpSUv/cal.ics";

//Anlegen der Gruppe
$gruppe1 = [];
$gruppe2 = [];
$gruppe3 = [];
$gruppe4 = [];
$gesamt = [];
$hbg = [];

// Die JSON auslesen:
$data = getDataFromJson($filename, $calurl);

// Bug Array anlegen
$bugs = [];

// Arrays aus der Data holen und Bugs sammeln
getArrays($data, $gruppe1, "XYZ", $gruppe2, "XYZ", $gruppe3, "XYZ", $gruppe4, "XYZ", $hbg, $bugs);

// Weiteren Kalender zur URL hinzufügen und Bugs sammeln
addCalender("./ical/ffw.json", "https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-BJzrvdoQS8ospFjntN9UZ300pscvGBrW/cal.ics", $gesamt, $bugs);
addCalender("./ical/iuk.json", "https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-OhSMU2WZrTysDKnu9PZgodKvxphIYUsQ/cal.ics", $gesamt, $bugs);
addCalender("./ical/juf.json", "https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-j3iccbU8NXO7609IzZCNgHEJVy5z4WHI/cal.ics", $gesamt, $bugs);

// Ausgabe der Dateien in eine Gruppe:
showTable($hbg, "Abt. Stadtmitte", $gruppe2, "0", $gruppe3, "0", $gruppe3, "0", $gesamt, "Gesamt");

// Bug Liste anzeigen
showBugList($bugs);
?>