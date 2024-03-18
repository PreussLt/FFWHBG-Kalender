<style>
    <?php include './main.css'; ?>
    <?php include './tools.php' ?>
</style>
<?php
// Hier die Coustom Data Eintragen
$filename = "./ical/guel.json";
$calurl ="https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-mPHisdlh3n48Sdlyp8NfyDfDQTpXDiZo/cal.ics";

//Anlegen der Gruppe
$gruppe1 = [];
$gruppe2 = [];
$gruppe3 = [];
$gesamt = [];

// Die JSON auslesen:
$data = getDataFromJson($filename,$calurl);
// Arrays aus der Data holen,
getArrays($data,$gruppe1,"Gruppenübung -",$gruppe2,"Zugübung -",$gruppe3,"SÜ -",$gruppe3,"Gr. 1",$gesamt);

//Weiteren Kalender zur URL hinzufügen
//addCalender("./ical/ffw.json","https://calsync.alamos-gmbh.com/calendar/ical/technik%40leitstelle-boeblingen.de/public-BJzrvdoQS8ospFjntN9UZ300pscvGBrW/cal.ics",$gesamt);
// Ausgabe der Dateien in eine Gruppe:
showTable($gruppe1,"Gruppenübungen",$gruppe2,"Zugübung",$gruppe3,"Sonderübung",$gruppe3,"0",$gesamt,"Gesamt");
?>