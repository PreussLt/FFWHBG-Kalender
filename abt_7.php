<style>
 <?php include './main.css'; ?>
</style>

<?php
include './tools.php';
// Hier die Coustom Data Eintragen
$filename = "./ical/moench.json";
$calurl ="https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-hcKrLsRY45Epf7WoEwZm2EdPNOQP38bh/cal.ics";

//Anlegen der Gruppe
$gruppe1 = [];
$gruppe2 = [];
$gruppe3 = [];
$gesamt = [];

// Die JSON auslesen:
$data = getDataFromJson($filename,$calurl);
// Arrays aus der Data holen,
getArrays($data,$gruppe1,"Gr. 1 -",$gruppe2,"Gr. 2 -",$gruppe3,"Gr. 3 -",$gruppe3,"Gr. 4 - ",$gesamt);

//Weiteren Kalender zur URL hinzufügen
addCalender("./ical/ffw.json","https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-BJzrvdoQS8ospFjntN9UZ300pscvGBrW/cal.ics",$gesamt);
addCalender("./ical/laz.json","https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-kk8zgJUYegpzDfwTmS57MI0EycIiMy0m/cal.ics",$gesamt);
// Ausgabe der Dateien in eine Gruppe:
showTable($gruppe1,"Gruppe 1",$gruppe2,"Gruppe 2",$gruppe3,"Gruppe 3",$gruppe3,"0",$gesamt,"Gesamt");
?>