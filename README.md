# FFWHBG-Kalender

Ein Web-Service zur Anzeige von iCal-Kalendern für die verschiedenen Abteilungen der Freiwilligen Feuerwehr Herrenberg.

## Funktionsweise

Der Dienst ruft iCal-Daten von externen Quellen (z.B. Alamos Calsync) ab, parst diese mithilfe eines Node.js-Skripts (`reload.js`) in ein JSON-Format und stellt sie über eine PHP-Weboberfläche dar.

### Hauptkomponenten

- **PHP (`abt_*.php`)**: Frontend-Seiten für die einzelnen Abteilungen.
- **Node.js (`reload.js`)**: Parser, der die `.ics`-Dateien in `obj.json` umwandelt.
- **Docker**: Containerisierte Umgebung mit Apache, PHP 8.2 und Node.js.

## Voraussetzungen

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Installation & Start

1. Repository klonen oder Dateien in ein Verzeichnis kopieren.
2. Den Container starten:
   ```bash
   docker-compose up -d
   ```
3. Der Dienst ist nun unter [http://localhost:8112](http://localhost:8112) erreichbar.

## Verwendung

Die Kalender für die verschiedenen Abteilungen können über die jeweiligen PHP-Dateien aufgerufen werden:

- Abteilung 1: `http://localhost:8112/abt_1.php`
- Abteilung 5: `http://localhost:8112/abt_5.php`
- Abteilung 8: `http://localhost:8112/abt_8.php`
- etc.

## Kalender-Konfiguration im Detail

Jede Abteilung (z. B. `abt_6.php`) nutzt vordefinierte PHP-Funktionen aus der `tools.php`, um Daten zu laden und anzuzeigen.

### 1. Daten laden (`getDataFromJson`)
In jeder Datei wird zuerst die Datenquelle definiert:
```php
$filename = "./ical/kupp.json"; // Name der lokalen Cache-Datei (JSON)
$calurl = "https://.../cal.ics"; // URL zum iCal-Kalender
$data = getDataFromJson($filename, $calurl);
```
Die Funktion `getDataFromJson` führt intern ein Node.js-Skript (`reload.js`) aus, das die iCal-URL herunterlädt, parst und lokal im Ordner `ical/` speichert.

### 2. Daten filtern und gruppieren (`getArrays`)
Um Termine verschiedenen Gruppen (z. B. Gruppe 1, Gruppe 2) zuzuordnen, wird die Funktion `getArrays` verwendet. Diese filtert nach dem **Präfix** des Titels (Summary) im Kalender:

```php
// Beispiel: Termine, die mit "Gr. 1 -" beginnen, landen in $gruppe1
getArrays($data,
    $gruppe1, "Gr. 1 -",
    $gruppe2, "Gr. 2 -",
    $gruppe3, "Gr. 3 -",
    $gruppe4, "Gr. 4 -",
    $gesamt // Alle anderen Termine landen hier
);
```

### 3. Zusätzliche Kalender hinzufügen (`addCalender`)
Falls Termine aus einer weiteren Quelle (z. B. ein allgemeiner Feuerwehr-Kalender) in eine Gruppe gemischt werden sollen:

```php
addCalender("./ical/ffw.json", "https://.../ffw.ics", $gesamt);
```
Dies fügt alle Termine der zweiten Quelle direkt an das angegebene Array (hier `$gesamt`) an.

### 4. Tabellen anzeigen (`showTable`)
Die Funktion `showTable` rendert die HTML-Tabelle. Sie ordnet die Arrays den Spalten zu:

```php
showTable(
    $gruppe1, "Gruppe 1", // Spalte 1: Daten-Array und Titel
    $gruppe2, "Gruppe 2", // Spalte 2
    $gruppe3, "Gruppe 3", // Spalte 3
    $gruppe4, "0",         // Spalte 4 (mit "0" wird die Spalte ausgeblendet)
    $gesamt,  "Gesamt"    // Letzte Spalte: Allgemeine Infos
);
```
- Wenn als Spaltentitel `"0"` übergeben wird, wird diese Spalte in der Ausgabe **nicht** angezeigt.
- Die Termine werden innerhalb jeder Spalte automatisch nach Datum sortiert.
