----------------------------------------------------
Installation
----------------------------------------------------

Es ist sehr empfehlenswert das Modul auf einen 
komplett leeren Shop zu installieren. Durch die 
Installation wird die Konfiguration überschrieben
und die Mehrwersteuerkonfiguration gelöscht!

1. Ordner Symmetrics/ConfigGerman, wo sich das Modul 
befindet, nach app/code/local oder app/code/community 
kopieren.

2. ConfigGerman/etc/config.xml öffnen und Beispieltexte
mit eigenen Daten ersetzen. Diese Daten können später 
über die Admin-Oberfläche im Bereich "Konfiguration" 
geändert werden.

z.B.: 
<shop_name><![CDATA[Shop-Name]]></shop_name>
ändern in
<shop_name><![CDATA[Mein Shop]]></shop_name>

3. Cache löschen

4. Frontend aufrufen

5. Fertig!

ACHTUNG!!! Das Modul überschreibt unwiderruflich 
die bereits vorhandene Konfiguration inkl. 
Mehrwersteuerkonfiguration. Alle bereits erstellte 
Klassen und Mehrwersteuerstätze werden entfernt und 
überschrieben. Es werden auch alle bereits gemachte
Einstellungen in "Konfiguration" gelöscht. Es ist
dringend empfehlenswert dieses Modul ausschliesslich
auf einen leeren Shop zu installieren!

----------------------------------------------------
Beschreibung
----------------------------------------------------

Das Modul Symmetrics_ConfigGerman konfiguriert einen
Magento-Shop für den deutschen Markt. Es werden typische
Einstellungen am Shop vorgenommen, die man eigentlich
von einem Webshop in Deutschland erwartet. Es werden 
auch Beispieltexte installiert um dem Shopbetreiber
es leichter zu machen den Shop so schnell wie möglich
Online zu bringen.

Zum Anderen bietet das Modul eine bequeme Möglichkeit
die Texte und andere Einstellungen über eine zentrale
Stelle vor der Installation des Moduls zu verändern.

Sehr empfehlenswert ist es dieses Modul zusammen mit
Symmetrics_ConfigGermanTexts und anderen Symmetrics
Config Modulen zu verwenden.

Einzelne Features des Moduls sind:

- Konfiguration der Mehrwertsteuer (7% und 19%)
- Sprache, Land, Währung
- Texte und E-Mail Adressen zentral veränderbar

----------------------------------------------------
Funktonalität und Besonderheiten
----------------------------------------------------

WICHTIG! Die Daten aus config.xml werden nur bei
der Neuinstallation des Moduls in die Datenbank
geschrieben. Alle weitere Änderungen in config.xml
werden ignoriert. Alle Änderungen, die nach der
Installation gemacht werden, müssen über die Admin-
Oberfläche erfolgen.

Bei der Installation des Moduls wird die 
SQL-Migrationsdatei ausgeführt. Diese Datei löscht
zunächst bereits vorhandene Mehrwertsteuerkonfiguration
und schreibt eigene Klassen und Klassenabhängigkeiten
in die Datenbank. Dies ist nötig um Konflikte zwischen
unterschiedlichen Mehrwertsteuerseätzen zu vermeiden, 
die durch bereits installierte Klassen auftreten 
können.

Die Konfigurationstabelle wird mithilfe der Magento
eigenen Funktion setConfigData verändert. Die 
Einstellungen werden für den Scope = Default (Alle
Stores, Alle Views) vorgenommen.