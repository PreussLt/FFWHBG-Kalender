<style>
    <?php include './main.css'; ?>
    <?php include './tools.php' ?>
</style>
<?php
// Hier die Coustom Data Eintragen
$filename = "./ical/aff.json";
$calurl = "https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-Je5ju3kmmDMngyGWm5knFU5qUribUOGg/cal.ics";

//Anlegen der Gruppe
$gruppe1 = [];
$gruppe2 = [];
$gruppe3 = [];
$gruppe4 = [];
$gesamt = [];
$aff = [];

// Die JSON auslesen:
$data = getDataFromJson($filename, $calurl);

// Bug Array anlegen
$bugs = [];

// Arrays aus der Data holen,
getArrays($data, $gruppe1, "XYZ", $gruppe2, "XYZ", $gruppe3, "XYZ", $gruppe4, "XYZ", $aff, $bugs);

// Weiteren Kalender zur URL hinzufügen (optional, hier leer gelassen wie in anderen Vorlagen)
// addCalender("./ical/ffw.json", "https://...", $gesamt, $bugs);

// Ausgabe der Dateien in eine Gruppe:
showTable($aff, "Abt. Affstätt", $gruppe2, "0", $gruppe3, "0", $gruppe3, "0", $gesamt, "Gesamt");

// Bug Liste anzeigen
showBugList($bugs);
?>