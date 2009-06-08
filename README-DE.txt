----------------------------------------------------
Installation
----------------------------------------------------

Es ist sehr empfehlenswert das Modul auf einen 
komplett leeren  und neuen Shop zu installieren. Durch die 
Installation wird die vorhandene Konfiguration ueberschrieben
und die Mehrwersteuerkonfiguration geloescht.

1. Ordner app/ in den Projekt-Root kopieren.

2. ConfigGerman/etc/config.xml oeffnen und Beispieltexte
mit eigenen Daten ersetzen. Diese Daten koennen spaeter 
ueber die Admin-Oberflaeche im Bereich "Konfiguration" 
geaendert werden.

z.B.: 
<shop_name><![CDATA[Shop-Name]]></shop_name>
aendern in
<shop_name><![CDATA[Mein Shop]]></shop_name>

Bitte beachten Sie, dass die XML-Datei in UTF-8
(Ohne BOM) gespeichert werden muss.

4. Cache loeschen

5. Frontend aufrufen

6. Fertig

ACHTUNG!!! Das Modul ueberschreibt unwiderruflich 
die bereits vorhandene Konfiguration inkl. 
Mehrwersteuerkonfiguration. Alle bereits erstellten 
Klassen und Mehrwersteuersaetze werden entfernt und 
ueberschrieben. Es werden auch alle bereits gemachten
Einstellungen in "Konfiguration" geloescht. Es ist
dringend empfehlenswert dieses Modul ausschliesslich
auf einen leeren Shop zu installieren.

----------------------------------------------------
Beschreibung
----------------------------------------------------

Das Modul Symmetrics_ConfigGerman konfiguriert einen
Magento-Shop fuer den deutschen Markt. Es werden typische
Einstellungen am Shop vorgenommen, die man eigentlich
von einem Webshop in Deutschland erwartet. Es werden 
auch Beispieltexte installiert um dem Shopbetreiber
es leichter zu machen den Shop so schnell wie moeglich
online zu bringen.

Zum Anderen bietet das Modul eine bequeme Moeglichkeit
die Texte und andere Einstellungen ueber eine zentrale
Stelle vor der Installation des Moduls zu veraendern wenn das gewuenscht ist.

Sehr empfehlenswert ist es dieses Modul zusammen mit
Symmetrics_ConfigGermanTexts und anderen Symmetrics
Config Modulen zu verwenden.

Einzelne Features des Moduls sind:

- Konfiguration der Mehrwertsteuer (7% und 19%)
- Sprache, Land, Waehrung
- Texte und E-Mail Adressen zentral veraenderbar
- Kundengruppen werden angelegt
- Steuersaetze werden angelegt
- diverse Grund Einstellungen des Shops

----------------------------------------------------
Funktionalitaet und Besonderheiten
----------------------------------------------------

WICHTIG! Die Daten aus config.xml werden nur bei
der Neuinstallation des Moduls in die Datenbank
geschrieben. Alle weitere Aenderungen in config.xml
werden ignoriert. Alle Aenderungen, die nach der
Installation gemacht werden, muessen ueber die Admin-
Oberflaeche erfolgen.

Bei der Installation des Moduls wird die 
SQL-Migrationsdatei ausgefuehrt. Diese Datei loescht
zunaechst die bereits vorhandene Mehrwertsteuerkonfiguration
und schreibt eigene Klassen und Klassenabhaengigkeiten
in die Datenbank. Dies ist noetig um Konflikte zwischen
unterschiedlichen Mehrwertsteuersaetzen zu vermeiden, 
die durch bereits installierte Klassen auftreten 
koennen.

Die Konfigurationstabelle wird mithilfe der Magento
eigenen Funktion setConfigData veraendert. Die 
Einstellungen werden fuer den Scope = Default (Alle
Stores, Alle Views) vorgenommen.

Sie koennen auch andere Einstellungen in der 
Migrationsdatei mysql4-install-x.x.x.php vornehmen.
Beachten Sie bitte, dass diese Aenderungen nur
von jemanden vorgenommen werden koennen der sich
gut mit der Magento-Struktur und PHP auskennt.

Symmetrics_ConfigGerman ist ein Konfigurationsmodul.
Das heisst, dass die Updates dieses Moduls nur dann
moeglich sind, wenn die Konfiguration nach der
Installation unveraendert bleibt. Im Rahmen der 
Wartung wird die Symmetrics GmbH aber immer ein DIFF-
zwischen den einzelnen Update zur Verfuegung stellen.
So koennen Sie manuell die benoetigten neuen Funktionen
und veraenderten Einstellungen aktivieren oder deaktivieren
indem Sie den Anweisungen in den Update-READMEs folgen.
