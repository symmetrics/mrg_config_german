* DOCUMENTATION

** INSTALLATION
It is highly recommended to install the module on a fully
empty and new shop. Because of the installation the available
configuration is overwritten and the value-added tax
configuration is deleted.

1. Extract the content of this archive to your Magento directory.
Copy app/ folder to the Projekt-root.

2. Open config German/etc/config.xml and replace example texts with own
data. These data can later be changed in the the admin interface in
über die Admin-Oberfläche im Bereich "Konfiguration"
"Configuration" section.

For example: 
<shop_name><![CDATA[Shop-Name]]></shop_name>
change to
<shop_name><![CDATA[Mein Shop]]></shop_name>

Please note that the XML file should be saved in UTF-8 (without BOM).
4. Clear the cache
5. Go to fronted
6. Ready

ATTENTION!!! The module overwrites irreversibly the already available
configuration incl. the value-added tax configuration. All already created
classes and value-added rates are removed and overwritten. All already
made settings in "Configuration" are deleted as well. It is urgently needed
to install this module exclusively on an empty shop.

** USAGE
The Symmetrics_ConfigGerman module configures a
Magento shop for the German market. Typical settings that
one expects from a web-shop in Germany are made. Also the
example texts are installed in order to make it easier for the
shop owner to take the shop online as quickly as possible.

For others the module provides a convenient opportunity to change the texts
and other settings in a central place before the installation of the module, if
it is necessary.

It is highly recommended to use this module together with 
Symmetrics_ConfigGermanTexts and other Symmetrics
Config modules.

** FUNCTIONALITY
* A: The following settings are made:
        1. Configuration of value-added tax (7% and 19%)
        2. Language, country, currency
        3. Texts and e-mail addresses centrally changeable 
        4. Customer groups are created
        5. Tax rates are created
        6. Diverse base settings of the shop

** TECHNICAL
IMPORTANT! The data from config.xml are written to the
database only upon a new installation of the module. All
other changes in config.xml are ignored. All changes that
were made after the installation, should be made via the
admin-interface.

Upon installation of the module the SQL migration file is executed. This 
file then deletes already available value-added tax configuration and writes 
own classes and class dependencies to the database. This is necessary in order 
to avoid conflicts between different value-added tax rates that can occur due 
to already installed classes.

The configuration table is changed with the help of the Magento 
own function setConfigData. The settings are made for the 
Scope = Default (All
stores, all views)

You can also make other settings in the migration file 
mysql4-install-x.x.x.php. Please note, that these changes can 
be made only by someone who knows well the Magento structure and PHP.

Symmetrics_ConfigGerman is a configuration module. This means that the 
updates of this module are possible only when the configuration remains 
unchangeable after the installation. Within the frameworks of maintenance, 
the Symmetrics GmbH will always provide a DIFF- between the separate updates. 
So you can manually activate or deactivate new functions and changed settings 
by following the instructions in the update-READMEs.

** PROBLEMS
No problems are known.

TESTCASES
** BASIC
*** A: ATTENTION! A detailed test case is missing.
