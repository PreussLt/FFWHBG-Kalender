<style>
    <?php include './main.css'; ?>
    <?php include './tools.php' ?>
</style>
<?php
// Hier die Coustom Data Eintragen
$filename = "./ical/guel.json";
$calurl = "https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-kB3M56xzmy6SuX5ZQ5oxguptYfE72WQA/cal.ics";

//Anlegen der Gruppe
$gruppe1 = [];
$gruppe2 = [];
$gruppe3 = [];
$gruppe4 = [];
$gesamt = [];
$guel = [];

// Die JSON auslesen:
$data = getDataFromJson($filename, $calurl);

// Bug Array anlegen
$bugs = [];

// Arrays aus der Data holen,
getArrays($data, $gruppe1, "XYZ", $gruppe2, "XYZ", $gruppe3, "XYZ", $gruppe4, "XYZ", $guel, $bugs);

// Weiteren Kalender zur URL hinzufügen
addCalender("./ical/ffw.json", "https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-BJzrvdoQS8ospFjntN9UZ300pscvGBrW/cal.ics", $gesamt, $bugs);

// Ausgabe der Dateien in eine Gruppe:
showTable($guel, "Abt. Haslach", $gruppe2, "0", $gruppe3, "0", $gruppe3, "0", $gesamt, "Gesamt");

// Bug Liste anzeigen
showBugList($bugs);
?>