* DOCUMENTATION

** INSTALLATION
Es ist sehr empfehlenswert das Modul auf einen 
komplett leeren  und neuen Shop zu installieren. Durch die 
Installation wird die vorhandene Konfiguration überschrieben
und die Mehrwersteuerkonfiguration gelöscht.

1. Extrahieren Sie den Inhalt dieses Archivs in Ihr Magento Verzeichnis.
Ordner app/ in den Projekt-Root kopieren.

2. ConfigGerman/etc/config.xml öffnen und Beispieltexte
mit eigenen Daten ersetzen. Diese Daten können später 
über die Admin-Oberfläche im Bereich "Konfiguration" 
geändert werden.

z.B.: 
<shop_name><![CDATA[Shop-Name]]></shop_name>
ändern in
<shop_name><![CDATA[Mein Shop]]></shop_name>

Bitte beachten Sie, dass die XML-Datei in UTF-8
(Ohne BOM) gespeichert werden muss.

4. Cache löschen

5. Frontend aufrufen

6. Fertig

ACHTUNG!!! Das Modul überschreibt unwiderruflich 
die bereits vorhandene Konfiguration inkl. 
Mehrwersteuerkonfiguration. Alle bereits erstellten 
Klassen und Mehrwersteuersätze werden entfernt und 
überschrieben. Es werden auch alle bereits gemachten
Einstellungen in "Konfiguration" gelöscht. Es ist
dringend nötig dieses Modul ausschliesslich
auf einen leeren Shop zu installieren.

** USAGE
Das Modul Symmetrics_ConfigGerman konfiguriert einen
Magento-Shop für den deutschen Markt. Es werden typische
Einstellungen am Shop vorgenommen, die man von einem
Webshop in Deutschland erwartet. Es werden 
auch Beispieltexte installiert um dem Shopbetreiber
es zu erleichtern, den Shop so schnell wie möglich
online zu bringen.

Zum Anderen bietet das Modul eine bequeme Möglichkeit
die Texte und andere Einstellungen über eine zentrale
Stelle vor der Installation des Moduls zu verändern, falls
dies gewünscht ist.

Sehr empfehlenswert ist es dieses Modul zusammen mit
Symmetrics_ConfigGermanTexts und anderen Symmetrics
Config Modulen zu verwenden.

** FUNCTIONALITY
*** A: Folgende Einstellungen werden vorgenommen:
        1. Konfiguration der Mehrwertsteuer (7% und 19%)
        2. Sprache, Land, Währung
        3. Texte und E-Mail Adressen zentral veränderbar
        4. Kundengruppen werden angelegt
        5. Steuersätze werden angelegt
        6. diverse Grund Einstellungen des Shops

** TECHNICAL
WICHTIG! Die Daten aus config.xml werden nur bei
der Neuinstallation des Moduls in die Datenbank
geschrieben. Alle weiteren Änderungen in config.xml
werden ignoriert. Alle Aenderungen, die nach der
Installation vorgenommen werden, müssen über die Admin-
Oberfläche erfolgen.

Bei der Installation des Moduls wird die 
SQL-Migrationsdatei ausgeführt. Diese Datei löscht
zunächst die bereits vorhandene Mehrwertsteuerkonfiguration
und schreibt eigene Klassen und Klassenabhängigkeiten
in die Datenbank. Dies ist nötig um Konflikte zwischen
unterschiedlichen Mehrwertsteuersätzen zu vermeiden, 
die durch, bereits installierte, Klassen auftreten 
können.

Die Konfigurationstabelle wird mit Hilfe der Magento
eigenen Funktion setConfigData verändert. Die 
Einstellungen werden für den Scope = Default (Alle
Stores, Alle Views) vorgenommen.

Sie können auch andere Einstellungen in der 
Migrationsdatei mysql4-install-x.x.x.php vornehmen.
Beachten Sie bitte, dass diese Änderungen nur
von jemanden vorgenommen werden können der sich
gut mit der Magento-Struktur und PHP auskennt.

Symmetrics_ConfigGerman ist ein Konfigurationsmodul.
Das heisst, dass die Updates dieses Moduls nur dann
möglich sind, wenn die Konfiguration nach der
Installation unverändert bleibt. Im Rahmen der 
Wartung wird die Symmetrics GmbH aber immer ein DIFF-
zwischen den einzelnen Updates zur Verfügung stellen.
So können Sie manuell die benötigten neuen Funktionen
und veränderten Einstellungen aktivieren oder deaktivieren
indem Sie den Anweisungen in den Update-READMEs folgen.

** PROBLEMS
Keine Probleme bekannt.

* TESTCASES
** BASIC
*** A: ACHTUNG! Es fehlt ein ausführlicher Testfall.

