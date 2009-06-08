----------------------------------------------------
Description
----------------------------------------------------

This module configures an empty, new shop for the German
market. It is strongly recommendet NOT to install
this module on the existing shop because it will 
almost completely rewrite the configuration and 
taxes settings.

Symmetrics_ConfigGerman makes the first configuration
of an fresh installed shop more comfortable. It 
provides a bunch of configuration options that are
normally done in backend under "Configuration". 
So, before activating the module you can customize
all options you need in only one place - in
mysql-install-x.x.x.php. You can also modify our
example texts in config.xml.

Please note that ALL changes in setup or xml-file must 
be done BEFORE you install this module. SQL installation 
file reads the configuration from config.xml only once 
during the first installation. It is impossible to
read the config.xml later after you installed this 
module. But you can further edit all options through 
the backend. So, treat this module as a preconfiguration 
of the shop, not as a kind of configuration 
tool that can replace the backend.

All configuration is based on legal guidelines from
the German law for stores and online stores and may not
fit rules for other countries. But it also can be used
as a template for some other country configuration.

Features:

- Tax configuration (7%, 19%, 0%)
- Country, Language, Currency, Time Zone
- Some Texts and Attributes
- Custoerm groups settings
- many other small basic configurations