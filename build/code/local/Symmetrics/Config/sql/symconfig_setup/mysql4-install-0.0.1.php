<?php
$installer = $this;
$installer->startSetup();

# agb's

$query = <<< EOF
DELETE FROM `checkout_agreement`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `checkout_agreement` (`agreement_id`, `name`, `content`, `content_height`, `checkbox_text`, `is_active`, `is_html`) VALUES
(1, 'AGB', '${text_agb}', '', 'Hiermit werden die Allgemeinen Geschäftsbedingungen und die Widerrufsbelehrung akzeptiert.', 1, 1);
EOF;
$installer->run($query);

# taxes

$query = <<< EOF
DELETE FROM `tax_calculation_rate`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `tax_calculation_rate` (`tax_calculation_rate_id`, `tax_country_id`, `tax_region_id`, `tax_postcode`, `code`, `rate`) VALUES
(1, 'DE', 0, '*', 'Standard 19%', 19.0000),
(2, 'DE', 0, '*', 'Ermäßigt 7%', 7.0000),
(3, 'DE', 0, '*', 'Händler 0%', 0.0000);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `tax_calculation_rule`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `tax_calculation_rule` (`tax_calculation_rule_id`, `code`, `priority`, `position`) VALUES
(1, 'Standard 19%', 0, 1),
(2, 'Ermäßigt 7%', 0, 2),
(3, 'Händler Standard 0%', 0, 3);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `tax_class`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `tax_class` (`class_id`, `class_name`, `class_type`) VALUES
(1, 'Ermäßigt 7%', 'PRODUCT'),
(2, 'Endkunde', 'CUSTOMER'),
(3, 'Standard 19%', 'PRODUCT'),
(4, 'Händler 0%', 'PRODUCT'),
(5, 'Händler', 'CUSTOMER');
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `tax_calculation`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `tax_calculation` (`tax_calculation_rate_id`, `tax_calculation_rule_id`, `customer_tax_class_id`, `product_tax_class_id`) VALUES
(1, 1, 2, 3),
(2, 2, 2, 1),
(3, 3, 5, 4);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `customer_group`;
EOF;
$installer->run($query);

# customer groups

$query = <<< EOF
INSERT INTO `customer_group` (`customer_group_id`, `customer_group_code`, `tax_class_id`) VALUES
(0, 'NOT LOGGED IN', 3),
(1, 'Endkunde', 3),
(3, 'Händler', 5);
EOF;
$installer->run($query);

# customers

$query = <<< EOF
DELETE FROM `customer_entity`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `customer_entity` (`entity_id`, `entity_type_id`, `attribute_set_id`, `website_id`, `email`, `group_id`, `increment_id`, `store_id`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, 0, 1, 'endkunde@muster.de', 1, '000000001', 0, '2009-01-30 08:02:19', '2009-01-30 08:06:13', 1),
(2, 1, 0, 1, 'haendler@muster.de', 3, '000000002', 0, '2009-01-30 08:03:13', '2009-01-30 08:08:18', 1);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `customer_address_entity`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `customer_address_entity` (`entity_id`, `entity_type_id`, `attribute_set_id`, `increment_id`, `parent_id`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 2, 0, '', 1, '2009-01-30 08:06:13', '2009-01-30 08:06:13', 1),
(2, 2, 0, '', 1, '2009-01-30 08:06:13', '2009-01-30 08:06:13', 1),
(3, 2, 0, '', 2, '2009-01-30 08:08:18', '2009-01-30 08:08:18', 1),
(4, 2, 0, '', 2, '2009-01-30 08:08:18', '2009-01-30 08:08:18', 1);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `customer_address_entity_int`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `customer_address_entity_int` (`value_id`, `entity_type_id`, `attribute_id`, `entity_id`, `value`) VALUES
(1, 2, 27, 1, 79),
(2, 2, 27, 2, 79),
(3, 2, 27, 3, 79),
(4, 2, 27, 4, 79);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `customer_address_entity_text`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `customer_address_entity_text` (`value_id`, `entity_type_id`, `attribute_id`, `entity_id`, `value`) VALUES
(1, 2, 23, 1, 'Musterstr. 1'),
(2, 2, 23, 2, 'Musterstr. 1'),
(3, 2, 23, 3, 'Geschäftstrasse 1'),
(4, 2, 23, 4, 'Lieferstrasse 2');
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `customer_address_entity_varchar`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `customer_address_entity_varchar` (`value_id`, `entity_type_id`, `attribute_id`, `entity_id`, `value`) VALUES
(1, 2, 17, 1, ''),
(2, 2, 18, 1, 'Max'),
(3, 2, 19, 1, ''),
(4, 2, 20, 1, 'Endkunde'),
(5, 2, 21, 1, ''),
(6, 2, 22, 1, ''),
(7, 2, 24, 1, 'Hannover'),
(8, 2, 25, 1, 'DE'),
(9, 2, 26, 1, 'Niedersachsen'),
(10, 2, 28, 1, '30159'),
(11, 2, 29, 1, '0511 123456'),
(12, 2, 30, 1, ''),
(13, 2, 17, 2, ''),
(14, 2, 18, 2, 'Max'),
(15, 2, 19, 2, ''),
(16, 2, 20, 2, 'Endkunde'),
(17, 2, 21, 2, ''),
(18, 2, 22, 2, ''),
(19, 2, 24, 2, 'Hannover'),
(20, 2, 25, 2, 'DE'),
(21, 2, 26, 2, 'Niedersachsen'),
(22, 2, 28, 2, '30159'),
(23, 2, 29, 2, '0511 123456'),
(24, 2, 30, 2, ''),
(25, 2, 17, 3, ''),
(26, 2, 18, 3, 'Petra'),
(27, 2, 19, 3, ''),
(28, 2, 20, 3, 'Händler'),
(29, 2, 21, 3, ''),
(30, 2, 22, 3, 'Muster GmbH'),
(31, 2, 24, 3, 'Hannover'),
(32, 2, 25, 3, 'DE'),
(33, 2, 26, 3, 'Niedersachsen'),
(34, 2, 28, 3, '30159'),
(35, 2, 29, 3, '0511 123456'),
(36, 2, 30, 3, '0511 654321'),
(37, 2, 17, 4, ''),
(38, 2, 18, 4, 'Petra'),
(39, 2, 19, 4, ''),
(40, 2, 20, 4, 'Händler'),
(41, 2, 21, 4, ''),
(42, 2, 22, 4, 'Muster GmbH'),
(43, 2, 24, 4, 'Hannover'),
(44, 2, 25, 4, 'DE'),
(45, 2, 26, 4, 'Niedersachsen'),
(46, 2, 28, 4, '30159'),
(47, 2, 29, 4, '0511 123456'),
(48, 2, 30, 4, '');
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `customer_entity_int`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `customer_entity_int` (`value_id`, `entity_type_id`, `attribute_id`, `entity_id`, `value`) VALUES
(1, 1, 13, 1, 1),
(2, 1, 14, 1, 2),
(3, 1, 13, 2, 3),
(4, 1, 14, 2, 4);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `customer_entity_varchar`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `customer_entity_varchar` (`value_id`, `entity_type_id`, `attribute_id`, `entity_id`, `value`) VALUES
(1, 1, 4, 1, ''),
(2, 1, 5, 1, 'Max'),
(3, 1, 6, 1, ''),
(4, 1, 7, 1, 'Endkunde'),
(5, 1, 8, 1, ''),
(6, 1, 12, 1, 'd3a2341b35113905cf21aa830aec04b6:je'),
(7, 1, 15, 1, ''),
(8, 1, 3, 1, 'Admin'),
(9, 1, 4, 2, ''),
(10, 1, 5, 2, 'Petra'),
(11, 1, 6, 2, ''),
(12, 1, 7, 2, 'Händler'),
(13, 1, 8, 2, ''),
(14, 1, 12, 2, '8df1934676146792dde7f3383831e711:SC'),
(15, 1, 15, 2, ''),
(16, 1, 3, 2, 'Admin');
EOF;
$installer->run($query);

# cms pages
$query = <<< EOF
DELETE FROM `cms_page`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `cms_page` (`page_id`, `title`, `root_template`, `meta_keywords`, `meta_description`, `identifier`, `content`, `creation_time`, `update_time`, `is_active`, `sort_order`, `layout_update_xml`, `custom_theme`, `custom_theme_from`, `custom_theme_to`) VALUES
(1, 'Seite nicht gefunden', 'two_columns_right', 'Page keywords', 'Page description', 'not-found', '${text_pagenotfound}', '${datetime}', '${datetime}', 1, 0, '', '', NULL, NULL),
(2, 'Startseite', 'two_columns_right', '', '', 'home', '${text_home}', '${datetime}', '${datetime}', 1, 0, '<!--<reference name="content">\r\n<block type="catalog/product_new" name="home.catalog.product.new" alias="product_new" template="catalog/product/new.phtml" after="cms_page"><action method="addPriceBlockType"><type>bundle</type><block>bundle/catalog_product_price</block><template>bundle/catalog/product/price.phtml</template></action></block>\r\n<block type="reports/product_viewed" name="home.reports.product.viewed" alias="product_viewed" template="reports/home_product_viewed.phtml" after="product_new"><action method="addPriceBlockType"><type>bundle</type><block>bundle/catalog_product_price</block><template>bundle/catalog/product/price.phtml</template></action></block>\r\n<block type="reports/product_compared" name="home.reports.product.compared" template="reports/home_product_compared.phtml" after="product_viewed"><action method="addPriceBlockType"><type>bundle</type><block>bundle/catalog_product_price</block><template>bundle/catalog/product/price.phtml</template></action></block>\r\n</reference><reference name="right">\r\n<action method="unsetChild"><alias>right.reports.product.viewed</alias></action>\r\n<action method="unsetChild"><alias>right.reports.product.compared</alias></action>\r\n</reference>-->', '', NULL, NULL),
(3, 'AGB / Rückgaberecht', 'one_column', '', '', 'agb', '${text_agb}', '${datetime}', '${datetime}', 1, 0, '', '', NULL, NULL),
(4, 'Impressum', 'one_column', '', '', 'impressum', '<h2>Impressum</h2>\r\n\r\n<p>\r\n{{block type="symmetrics_impressum/impressum" value="address"}}\r\n</p>\r\n\r\n<p>\r\n{{block type="symmetrics_impressum/impressum" value="communication"}}\r\n</p>\r\n\r\n<p>\r\n{{block type="symmetrics_impressum/impressum" value="legal"}}\r\n</p>\r\n\r\n<p>\r\nInhaltlich verantwortlich gemäß § 5 TMG ist {{block type="symmetrics_impressum/impressum" value="ceo"}}, Kontaktdaten siehe oben. \r\n</p>\r\n\r\n<p>\r\n{{block type="symmetrics_impressum/impressum" value="tax"}}\r\n</p>\r\n\r\n<h3>Bankverbindung</h3>\r\n\r\n<p>\r\n{{block type="symmetrics_impressum/impressum" value="bank"}}\r\n</p>', '${datetime}', '${datetime}', 1, 0, '', '', NULL, NULL),
(5, 'Über uns', 'one_column', '', '', 'about-us', '${text_ueberuns}', '${datetime}', '${datetime}', 1, 0, '', '', NULL, NULL),
(6, 'Zahlung und Versand', 'one_column', '', '', 'payment-shipping', '${text_zahlung}', '${datetime}', '${datetime}', 1, 0, '', '', NULL, NULL),
(7, 'Widerrufsbelehrung', 'one_column', '', '', 'widerrufsbelehrung', '<h2>Widerrufsbelehrung</h2>\r\n\r\n<h3>Widerrufsrecht</h3>\r\n\r\n<p>Sie können Ihre Vertragserklärung innerhalb von zwei Wochen ohne Angabe von Gründen in Textform (z. B. Brief, Fax, E-Mail) oder - wenn Ihnen die Sache vor Fristablauf überlassen wird - durch Rücksendung der Sache widerrufen. Die Frist beginnt nach Erhalt dieser Belehrung in Textform, jedoch nicht vor Eingang der Ware beim Empfänger (bei der wiederkehrenden Lieferung gleichartiger Waren nicht vor dem Eingang der ersten Teillieferung) und auch nicht vor Erfüllung unserer Informationspflichten gemäß § 312c Abs. 2 BGB in Verbindung mit § 1 Abs. 1, 2 und 4 BGB-InfoV sowie unserer Pflichten gemäß § 312e Abs. 1 Satz 1 BGB in Verbindung mit § 3 BGB-InfoV. Zur Wahrung der Widerrufsfrist genügt die rechtzeitige Absendung des Widerrufs oder der Sache. Der Widerruf ist zu richten an:</p>\r\n<p>{{block type="symmetrics_impressum/impressum" value="address"}}</p>\r\n<p>{{block type="symmetrics_impressum/impressum" value="communication"}}</p>\r\n\r\n<h3>Widerrufsfolgen</h3>\r\n\r\n<p>Im Falle eines wirksamen Widerrufs sind die beiderseits empfangenen Leistungen zurückzugewähren und ggf. gezogene Nutzungen (z. B. Zinsen) herauszugeben. Können Sie uns die empfangene Leistung ganz oder teilweise nicht oder nur in verschlechtertem Zustand zurückgewähren, müssen Sie uns insoweit ggf. Wertersatz leisten. Bei der Überlassung von Sachen gilt dies nicht, wenn die Verschlechterung der Sache ausschließlich auf deren Prüfung - wie sie Ihnen etwa im Ladengeschäft möglich gewesen wäre - zurückzuführen ist. Im Übrigen können Sie die Pflicht zum Wertersatz für eine durch die bestimmungsgemäße Ingebrauchnahme der Sache entstandene Verschlechterung vermeiden, indem Sie die Sache nicht wie Ihr Eigentum in Gebrauch nehmen und alles unterlassen, was deren Wert beeinträchtigt.</p>\r\n<p>Paketversandfähige Sachen sind auf unsere Gefahr zurückzusenden. Sie haben die Kosten der Rücksendung zu tragen, wenn die gelieferte Ware der bestellten entspricht und wenn der Preis der zurückzusendenden Sache einen Betrag von 40 Euro nicht übersteigt oder wenn Sie bei einem höheren Preis der Sache zum Zeitpunkt des Widerrufs noch nicht die Gegenleistung oder eine vertraglich vereinbarte Teilzahlung erbracht haben. Anderenfalls ist die Rücksendung für Sie kostenfrei. Nicht paketversandfähige Sachen werden bei Ihnen abgeholt. Verpflichtungen zur Erstattung von Zahlungen müssen innerhalb von 30 Tagen erfüllt werden. Die Frist beginnt für Sie mit der Absendung Ihrer Widerrufserklärung oder der Sache, für uns mit deren Empfang.</p>', '2009-02-23 19:59:38', '2009-02-23 19:59:54', 1, 0, '', '', NULL, NULL),
(8, 'Datenschutz', 'one_column', '', '', 'datenschutz', '<h2>Datenschutz</h2>\r\n\r\n<p>Die {{block type="symmetrics_impressum/impressum" value="company1"}} nimmt den Schutz personenbezogener Daten sehr ernst. Wir möchten, dass Sie wissen, wann wir welche Daten speichern und wie wir sie verwenden. Als privatrechtliches Unternehmen unterliegen wir den Bestimmungen des Bundesdatenschutzgesetzes (BDSG). Wir haben technische und organisatorische Maßnahmen getroffen, die sicherstellen, dass die Vorschriften über den Datenschutz sowohl von uns als auch von externen Dienstleistern beachtet werden.</p>\r\n\r\n<h3>Datenschutzhinweis</h3>\r\n\r\n<p>Ihre E-Mail-Adresse wird nicht an andere Unternehmen weiter gegeben. Wir verwenden die von Ihnen mitgeteilten Daten zur Erfüllung und Abwicklung Ihrer Bestellung. Bei Anmeldung zum Newsletter wird Ihre E-Mail-Adresse mit Ihrer Einwilligung für eigene Werbezwecke genutzt, bis Sie sich vom Newsletter abmelden.</p>\r\n<p>Der Widerruf ist zu richten an:</p>\r\n<p>{{block type="symmetrics_impressum/impressum" value="address"}}</p>\r\n<p>{{block type="symmetrics_impressum/impressum" value="communication"}}</p>\r\n\r\n<h3>Einsatz von Cookies</h3>\r\n\r\n<p>Ein "Cookie" ist eine kleine Datendatei, die von uns auf Ihren Computers übertragen wird, wenn Sie auf unserer Site surfen. Ein Cookie kann nur Informationen enthalten, die wir selbst an Ihren Rechner senden – private Daten lassen sich damit nicht auslesen. Wenn Sie die Cookies auf unserer Site akzeptieren, haben wir keinen Zugriff auf Ihre persönlichen Informationen, aber mit Hilfe der Cookies können wir Ihren Computer identifizieren. </p>\r\n<p>Wir verwenden Cookies: Sie verbleiben nicht auf Ihrem Computer. Verlassen Sie unsere Seiten, wird auch der temporäre Cookie nach einer Stunde verworfen. Mit Hilfe der zusammengetragenen Informationen können wir Nutzungsmuster und -strukturen unserer Website analysieren. Auf diese Weise können wir unsere Website immer weiter optimieren, indem wir den Inhalt oder die Personalisierung verbessern und die Nutzung vereinfachen.</p>\r\n<p>Wir verwenden Cookies damit Sie den Warenkorb während Ihrer Sitzung mit Bestellungen auffüllen und verwalten können. Um den Warenkorb nutzen zu können müssen die temporären Cookies zugelassen werden. </p>\r\n\r\n<h3>Kinder</h3>\r\n<p>Personen unter 18 Jahren sollten ohne Zustimmung der Eltern oder Erziehungsberechtigten keine personenbezogenen Daten an uns übermitteln. Wir fordern keine personenbezogenen Daten von Kindern an, sammeln diese nicht und geben sie nicht an Dritte weiter. </p>\r\n\r\n<h3>Fragen und Kommentare</h3>\r\n<p>Nach dem Bundesdatenschutzgesetz haben Sie ein Recht auf unentgeltliche Auskunft über Ihre gespeicherten Daten sowie ggf. ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten. Für Fragen, Anregungen oder Kommentare zum Thema Datenschutz wenden Sie sich bitte per E-Mail an {{block type="symmetrics_impressum/impressum" value="email"}}.</p>', '2009-02-23 20:04:20', '2009-02-23 20:04:46', 1, 0, '', '', NULL, NULL);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `cms_page_store`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `cms_page_store` (`page_id`, `store_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0);
EOF;
$installer->run($query);

# footer links

$query = <<< EOF
DELETE FROM `cms_block`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `cms_block` (`block_id`, `title`, `identifier`, `content`, `creation_time`, `update_time`, `is_active`) VALUES
(1, 'Footer Links', 'footer_links', '<ul>\r\n<li><a href="{{store url=""}}about-us">Über uns</a></li>\r\n<li><a href="{{store url=""}}agb">AGB - Rückgaberecht</a></li>\r\n<li><a href="{{store url=""}}widerrufsbelehrung">Widerrufsbelehrung</a></li>\r\n<li><a href="{{store url=""}}datenschutz">Datenschutz</a></li>\r\n<li><a href="{{store url=""}}payment-shipping">Zahlung und Versand</a></li>\r\n<li class="last"><a href="{{store url=""}}impressum">Impressum</a></li>\r\n</ul>', '${datetime}', '${datetime}', 1);
EOF;
$installer->run($query);

$query = <<< EOF
DELETE FROM `cms_block_store`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `cms_block_store` (`block_id`, `store_id`) VALUES
(1, 0);
EOF;
$installer->run($query);

# email templates

$query = <<< EOF
DELETE FROM `core_email_template`;
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `core_email_template` (`template_id`, `template_code`, `template_text`, `template_type`, `template_subject`, `template_sender_name`, `template_sender_email`, `added_at`, `modified_at`) VALUES
(5, 'Neues Admin-Passwort (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n	<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n		<tr>\r\n			<td align="center" valign="top">\r\n				<!-- [ header starts here] -->\r\n				<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n				<tr>\r\n					<td valign="top">\r\n						<p><a href="{{store url=""}}" style="color:#1E7EC8;"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}" border="0"/></a></p>\r\n					</td>\r\n				</tr>\r\n				</table>\r\n				<!-- [ middle starts here] -->\r\n				<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n				<tr>\r\n					<td valign="top">\r\n						<p><strong>Hallo {{var user.name}}</strong>,<br/>Ihr neues Passwort lautet: {{var password}}</p>\r\n						<p>Sie können Ihr Passwort jederzeit ändern, indem Sie sich in <a href="{{store url="adminhtml/system_account/"}}" style="color:#1E7EC8;">Ihrem Kundenbereichen</a> anmelden.<p>\r\n					</td>\r\n				</tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n				</table>\r\n			</td>\r\n		</tr>\r\n	</table>\r\n</div>', 2, 'Neues Passwort für {{var user.name}}', NULL, NULL, '2009-02-01 17:27:50', '2009-02-23 17:45:15'),
(6, 'Währung Aktualisierung (Template)', 'Warnungen bei Währungsupdate:\r\n\r\n{{var warnings}}', 1, 'Warnungen bei Währungsupdate', NULL, NULL, '2009-02-01 17:28:18', '2009-02-23 17:45:31'),
(7, 'Neues Konto (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n	<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n	<tr>\r\n		<td align="center" valign="top">\r\n			<!-- [ header starts here] -->\r\n			<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n			<tr>\r\n				<td valign="top">\r\n					<a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a>\r\n				</td>\r\n			</tr>\r\n			</table>\r\n			<!-- [ middle starts here] -->\r\n			<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n			<tr>\r\n				<td valign="top">\r\n						\r\n						<p><strong>Hallo {{var customer.name}}</strong>,<br/>herzlich willkommen in unserem Shop. Um sich bei Ihrem nächsten Besuch in unserem Shop einzuloggen, klicken Sie einfach auf <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">Login</a> oder <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">Mein Kundenkonto</a> im oberen Bereich jeder Seite, und geben Sie Ihre E-Mail-Adresse und Passwort ein.</p>\r\n						\r\n						<p style="border:1px solid #BEBCB7; padding:13px 18px; background:#F8F7F5; ">\r\n							Mit folgenden Zugangsdaten können Sie sich anmelden:<br/>\r\n							E-Mail: {{var customer.email}}<br/>\r\n							Passwort: {{var customer.password}}\r\n						</p>\r\n						\r\n						<p>Nach erfolgreichem Login auf unserer Seite haben Sie die folgenden Möglichkeiten:</p>\r\n							<ul>\r\n								<li>Schnellerer Bezahlvorgang beim nächsten Einkauf</li>\r\n								<li>Alle laufenden Bestellungen im Auge behalten</li>\r\n								<li>Verlauf der vergangenen Bestellungen</li>\r\n								<li>Verwalten der Kundenkonto-Einstellungen</li>\r\n								<li>Ihr Passwort ändern</li>\r\n								<li>Verschiedene Adressen für den Versand an Familienmitglieder und Freunde sowie Rechnungsadressen speichern</li>\r\n							</ul>\r\n						\r\n						<p>Sollten Sie Fragen zu Ihrem Kundenkonto oder andere Anfragen haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a></p>\r\n\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n				</td>\r\n			</tr>\r\n			</table>\r\n		</td>\r\n	</tr>\r\n    </table>\r\n</div>', 2, 'Willkommen, {{var customer.name}}!', NULL, NULL, '2009-02-01 17:28:36', '2009-02-23 17:49:39'),
(8, 'Neues Konto Aktivierung  (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n	<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n	<tr>\r\n		<td align="center" valign="top">\r\n			<!-- [ header starts here] -->\r\n			<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n			<tr>\r\n				<td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n			</tr>\r\n			</table>\r\n			<!-- [ middle starts here] -->\r\n			\r\n			<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n			<tr>\r\n				<td valign="top">\r\n					<p><strong>Hallo {{var customer.name}}</strong>, <br/> herzlich willkommen in unserem Shop.</p>\r\n					<p>Ihre E-Mail-Adresse {{var customer.email}} muß bestätigt werden, bevor Sie sich damit in unserem Shop einloggen können.</p>\r\n					<p>Um die E-Mail-Adresse zu bestätigen und sich sofort einzuloggen, benutzen Sie bitte <a href="{{store url="customer/account/confirm/" _query_id=\$customer.id _query_key=\$customer.confirmation _query_back_url=\$back_url}}" style="color:#1E7EC8;">diesen Bestätigunslink</a>. Dieser Link ist nur einmal gülitig.</p>\r\n					<p>Sollten Sie Fragen zu Ihrem Kundenkonto oder andere Anfragen haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n				</td>\r\n			</tr>\r\n			</table>\r\n		</td>\r\n	</tr>\r\n	</table>\r\n</div>', 2, 'Bestätigung des Kundenkontos für {{var customer.name}}', NULL, NULL, '2009-02-01 17:29:07', '2009-02-23 17:51:59'),
(9, 'Neues Konto Bestätigung (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n	<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n	<tr>\r\n		<td align="center" valign="top">\r\n			<!-- [ header starts here] -->\r\n			<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n			<tr>\r\n				<td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n			</tr>\r\n			</table>\r\n			<!-- [ middle starts here] -->\r\n			\r\n			<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n			<tr>\r\n				<td valign="top">\r\n					<p><strong>Hallo {{var customer.name}}</strong>,<br/>herzlich willkommen in unserem Shop. Um sich bei Ihrem nächsten Besuch in unserem Shop einzuloggen, klicken Sie einfach auf <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">Login</a> or <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">Mein Kundenkonto</a> im oberen Bereich jeder Seite, und geben Sie Ihre E-Mail-Adresse und Passwort ein.</p>\r\n					<p>Nach erfolgreichem Login auf unsere Seite haben Sie die folgenden Möglichkeiten:</p>\r\n					<ul>\r\n						<li>Schnellerer Bezahlvorgang beim nächsten Einkauf</li>\r\n						<li>Alle laufenden Bestellungen im Auge behalten</li>\r\n						<li>Verlauf der vergangenen Bestellungen</li>\r\n						<li>Verwalten der Kundenkonto-Einstellungen</li>\r\n						<li>Ihr Passwort ändern</li>\r\n						<li>Verschiedene Adressen für den Versand an Familienmitglieder und Freunde sowie Rechnungsadressen speichern</li>\r\n					</ul>\r\n					<p>Sollten Sie Fragen zu Ihrem Kundenkonto oder andere Anfragen haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n				</td>\r\n			</tr>\r\n			</table>\r\n		</td>\r\n	</tr>\r\n	</table>\r\n</div>', 2, 'Willkommen, {{var customer.name}}!', NULL, NULL, '2009-02-01 17:29:31', '2009-02-23 17:54:22'),
(10, 'Neues Passwort (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n	<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n	<tr>\r\n		<td align="center" valign="top">\r\n		<!-- [ header starts here] -->\r\n		<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n			<tr>\r\n				<td valign="top">\r\n					<p><a href="{{store url=""}}" style="color:#1E7EC8;"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}" border="0"/></a></p>\r\n				</td>\r\n			</tr>\r\n		</table>\r\n		<!-- [ middle starts here] -->\r\n		<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n			<tr>\r\n				<td valign="top">\r\n					<p><strong>Hallo {{var user.name}}</strong>,<br/>Ihr neues Passwort lautet: {{var password}}</p>\r\n					<p>Sie können Ihr Passwort jederzeit ändern, indem Sie sich in <a href="{{store url="adminhtml/system_account/"}}" style="color:#1E7EC8;">Ihrem Kundenbereichen</a> anmelden.<p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n				</td>\r\n			</tr>\r\n		</table>\r\n		</td>\r\n	</tr>\r\n	</table>\r\n</div>', 2, 'Neues Passwort für {{var customer.name}}', NULL, NULL, '2009-02-01 17:29:49', '2009-02-23 17:59:14'),
(11, 'Neue Bestellung (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n	<td align="center" valign="top">\r\n		<!-- [ header starts here] -->\r\n		<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n		<tr>\r\n				<td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n		</tr>\r\n		</table>\r\n		<!-- [ middle starts here] -->\r\n		<table cellspacing="0" cellpadding="0" border="0" width="650">\r\n		<tr>\r\n			<td valign="top">\r\n				<p><strong>Hallo {{var order.getCustomerName()}}</strong>,<br/>Vielen Dank für Ihre Bestellung bei {{var order.getStoreGroupName()}}. Sobald Ihre Sendung verschickt wurde, erhalten Sie per E-Mail weitere Informationen zur Sendungsverfolgung. Sie können den aktuellen Status Ihrer Bestellung jederzeit <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">in Ihrem Kundenbereich</a> einsehen. Sollten Sie Fragen zu Ihrem Kundenkonto oder Ihrer Bestellung haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.</p>\r\n				<p>Nachfolgend finden Sie Ihre Bestellbestätigung, vielen Dank!</p>\r\n\r\n				<h3 style="border-bottom:2px solid #eee; font-size:1.05em; padding-bottom:1px; ">Ihre Bestellung Nr. {{var order.increment_id}} <small>({{var order.getCreatedAtFormated(''long'')}})</small></h3>\r\n				<table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n				<thead>\r\n				<tr>\r\n					<th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Rechnungsinformationen:</th>\r\n					<th width="3%"></th>\r\n					<th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Zahlungsmethode:</th>\r\n				</tr>\r\n				</thead>\r\n				<tbody>\r\n				<tr>\r\n					<td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n						{{var order.getBillingAddress().format(''html'')}}\r\n					</td>\r\n					<td>&nbsp;</td>\r\n					<td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n						{{var payment_html}}\r\n					</td>\r\n				</tr>\r\n				</tbody>\r\n				</table>\r\n				\r\n				<br/>\r\n                \r\n				{{depend order.getIsNotVirtual()}}\r\n				\r\n				<table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n				<thead>\r\n				<tr>\r\n					<th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandinformationen:</th>\r\n					<th width="3%"></th>\r\n					<th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandart:</th>\r\n				</tr>\r\n				</thead>\r\n				<tbody>\r\n				<tr>\r\n					<td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n						{{var order.getShippingAddress().format(''html'')}}\r\n					</td>\r\n					<td>&nbsp;</td>\r\n					<td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n						{{var order.getShippingDescription()}}\r\n					</td>\r\n				</tr>\r\n				</tbody>\r\n				</table>\r\n\r\n				<br/>\r\n\r\n				{{/depend}}\r\n				{{layout handle="sales_email_order_items" order=\$order}}\r\n				{{var items_html}}\r\n				\r\n				<br/>\r\n                \r\n				{{var order.getEmailCustomerNote()}}\r\n                \r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n				</td>\r\n			</tr>\r\n		</table>\r\n	</td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Neue Bestellung Nr. # {{var order.increment_id}}', NULL, NULL, '2009-02-01 17:30:05', '2009-02-23 18:07:52'),
(12, 'Neue Bestellung Gast (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n            </tr>\r\n        </table>\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top">\r\n                    <p>\r\n                        <strong>Hallo {{var order.getBillingAddress().getName()}}</strong>,<br/>\r\n                        Vielen Dank für Ihre Bestellung bei {{var order.getStoreGroupName()}}.\r\n                        Sobald Ihre Sendung verschickt wurde, erhalten Sie per E-Mail weitere Informationen zur Sendungsverfolgung.\r\n                        Sollten Sie Fragen zu Ihrer Bestellung haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                    </p>\r\n                    <p>Nachfolgend finden Sie Ihre Bestellbestätigung, vielen Dank!</p>\r\n\r\n                    <h3 style="border-bottom:2px solid #eee; font-size:1.05em; padding-bottom:1px; ">Ihre Bestellung Nr. {{var order.increment_id}} <small>({{var order.getCreatedAtFormated(''long'')}})</small></h3>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Rechnungsinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Zahlungsmethode:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.getBillingAddress().format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var payment_html}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{depend order.getIsNotVirtual()}}\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandart:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.getShippingAddress().format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.getShippingDescription()}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{/depend}}\r\n                    {{layout handle="sales_email_order_items" order=\$order}}\r\n                    <br/>\r\n                    {{var order.getEmailCustomerNote()}}\r\n                </td>\r\n            </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Neue Bestellung Nr. # {{var order.increment_id}}', NULL, NULL, '2009-02-01 17:30:21', '2009-02-23 18:09:34'),
(13, 'Bestellung Aktualsierung (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n        </tr>\r\n        </table>\r\n\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top">\r\n                <p><strong>Hallo {{var order.getCustomerName()}}</strong>,</p>\r\n                <p>Status Ihrer Bestellung Nr. {{var order.increment_id}} ist jetzt: <strong>{{var order.getStatusLabel()}}</strong>.</p>\r\n                <p>Sie können den aktuellen Status Ihrer Bestellung jederzeit <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">in Ihrem Kundenbereich</a> einsehen.</p>\r\n                <p>{{var comment}}</p>\r\n                <p>\r\n                    Sollten Sie Fragen haben,\r\n                    senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Bestellung Nr. # {{var order.increment_id}} Aktualisierung', NULL, NULL, '2009-02-01 17:30:42', '2009-02-23 18:11:12'),
(14, 'Bestellung Aktualsierung Gast (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n        </tr>\r\n        </table>\r\n\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top">\r\n                <p><strong>Hallo {{var order.getCustomerName()}}</strong>,</p>\r\n                <p>Status Ihrer Bestellung Nr. {{var order.increment_id}} ist jetzt: <strong>{{var order.getStatusLabel()}}</strong>.</p>\r\n                <p>{{var comment}}</p>\r\n                <p>\r\n                    Sollten Sie Fragen haben,\r\n                    senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Bestellung Nr. # {{var order.increment_id}} Aktualisierung', NULL, NULL, '2009-02-01 17:30:59', '2009-02-23 18:11:51'),
(15, 'Neue Rechnung (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n            </tr>\r\n        </table>\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top">\r\n                    <p>\r\n                        <strong>Hallo {{var order.getCustomerName()}}</strong>,<br/>\r\n                        Vielen Dank für Ihre Bestellung bei {{block type="symmetrics_impressum/impressum" value="shopname"}}.\r\n                        Sie können den aktuellen Status Ihrer Bestellung jederzeit <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">in Ihrem Kundenbereich</a> einsehen.\r\n                        Sollten Sie Fragen zu Ihrem Kundenkonto oder andere Anfragen haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                        Vielen Dank!\r\n                    </p>\r\n                    <h3 style="border-bottom:2px solid #eee; font-size:1.05em; padding-bottom:1px; ">\r\n                        Ihre Rechnung Nr. {{var invoice.increment_id}} für Ihre Bestellung Nr. {{var order.increment_id}}\r\n                    </h3>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Rechnungsinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Zahlungsmethode:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.billing_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var payment_html}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{depend order.getIsNotVirtual()}}\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandart:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_description}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{/depend}}\r\n\r\n                    {{layout area="frontend" handle="sales_email_order_invoice_items" invoice=\$invoice order=\$order}}\r\n                    <p>{{var comment}}</p>\r\n                </td>\r\n            </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Rechung Nr. # {{var invoice.increment_id}} für Bestellung Nr. # {{var order.increment_id}}', NULL, NULL, '2009-02-01 17:31:17', '2009-02-23 18:14:43'),
(16, 'Neue Rechnung Gast (Template)', '<style type="text/css">\r\n    body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n            </tr>\r\n        </table>\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top">\r\n                    <p>\r\n                        <strong>Hallo {{var billing.getName()}}</strong>,<br/>\r\n                        Vielen Dank für Ihre Bestellung bei {{var order.getStoreGroupName()}}.\r\n                        Sollten Sie Fragen haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                        Vielen Dank!\r\n                    </p>\r\n                    <h3 style="border-bottom:2px solid #eee; font-size:1.05em; padding-bottom:1px; ">\r\n                        Ihre Rechnung Nr. {{var invoice.increment_id}} für Ihre Bestellung Nr. {{var order.increment_id}}\r\n                    </h3>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Rechnungsinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Zahlungsmethode:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.billing_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var payment_html}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{depend order.getIsNotVirtual()}}\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandart:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_description}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{/depend}}\r\n\r\n                    {{layout handle="sales_email_order_invoice_items" invoice=\$invoice order=\$order}}\r\n\r\n                    <p>{{var comment}}</p>\r\n\r\n                </td>\r\n            </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Rechnung Nr. # {{var invoice.increment_id}} für Bestellung Nr. # {{var order.increment_id}}', NULL, NULL, '2009-02-01 17:31:33', '2009-02-23 18:15:29'),
(17, 'Rechnung Aktualisierung (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n        </tr>\r\n        </table>\r\n\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top">\r\n                <p><strong>Hallo {{var order.getCustomerName()}}</strong>,</p>\r\n				<p>Ihre Rechnung Nr. {{var order.increment_id}} wurde atkualisiert. Neuer Status: <strong>{{var order.getStatusLabel()}}</strong>.</p>\r\n                <p>Sie können den aktuellen Status Ihrer Bestellung jederzeit <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">in Ihrem Kundenbereich</a> einsehen.</p>\r\n                <p>{{var comment}}</p>\r\n                <p>\r\n                    Sollten Sie Fragen haben,\r\n                    senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Rechnung Nr. # {{var invoice.increment_id}} Aktualisierung', NULL, NULL, '2009-02-01 17:31:54', '2009-02-23 18:16:07'),
(18, 'Rechnung Aktualisierung Gast (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n        </tr>\r\n        </table>\r\n\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top">\r\n                <p><strong>Hallo {{var order.getCustomerName()}}</strong>,</p>\r\n				<p>Ihre Rechnung Nr. {{var order.increment_id}} wurde atkualisiert. Neuer Status: <strong>{{var order.getStatusLabel()}}</strong>.</p>\r\n                <p>{{var comment}}</p>\r\n                <p>\r\n                    Sollten Sie Fragen haben,\r\n                    senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Rechnung Nr. # {{var invoice.increment_id}} Aktualisierung', NULL, NULL, '2009-02-01 17:32:13', '2009-02-23 18:17:11'),
(19, 'Neue Gutschrift (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n            </tr>\r\n        </table>\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top">\r\n                    <p>\r\n                        <strong>Hallo {{var order.getCustomerName()}}</strong>,<br/>\r\n                        Vielen Dank für Ihre Bestellung bei {{block type="symmetrics_impressum/impressum" value="shopname"}}.\r\n                        Sie können den aktuellen Status Ihrer Bestellung jederzeit <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">in Ihrem Kundenbereich</a> einsehen.</p>\r\n                        Sollten Sie Fragen zu Ihrem Kundenkonto oder andere Anfragen haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                        Vielen Dank!\r\n                    </p>\r\n                    <h3 style="border-bottom:2px solid #eee; font-size:1.05em; padding-bottom:1px; ">\r\n                        Ihre Gutschrift Nr. {{var creditmemo.increment_id}} für Ihre Bestellung Nr. {{var order.increment_id}}\r\n                    </h3>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Rechnungsinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Zahlungsmethode:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.billing_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var payment_html}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{depend order.getIsNotVirtual()}}\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandart:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_description}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{/depend}}\r\n\r\n                    {{layout handle="sales_email_order_creditmemo_items" creditmemo=\$creditmemo order=\$order}}\r\n\r\n                    <p>{{var comment}}</p>\r\n                </td>\r\n            </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Gutschrift Nr. # {{var creditmemo.increment_id}} für Bestellung Nr. # {{var order.increment_id}}', NULL, NULL, '2009-02-01 17:33:09', '2009-02-23 18:18:06');
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `core_email_template` (`template_id`, `template_code`, `template_text`, `template_type`, `template_subject`, `template_sender_name`, `template_sender_email`, `added_at`, `modified_at`) VALUES
(20, 'Neue Gutschrift Gast (Template)', '<style type="text/css">\r\n    body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n            </tr>\r\n        </table>\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top">\r\n                    <p>\r\n                        <strong>Hallo {{var billing.getName()}}</strong>,<br/>\r\n                        Vielen Dank für Ihre Bestellung bei {{block type="symmetrics_impressum/impressum" value="shopname"}}.\r\n                        Sollten Sie Fragen haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                        Vielen Dank!\r\n                    </p>\r\n                    <h3 style="border-bottom:2px solid #eee; font-size:1.05em; padding-bottom:1px; ">\r\n                        Ihre Gutschrift Nr. {{var creditmemo.increment_id}} für Ihre Bestellung Nr. {{var order.increment_id}}\r\n                    </h3>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Rechnungsinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Zahlungsmethode:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.billing_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var payment_html}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{depend order.getIsNotVirtual()}}\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandart:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_description}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    {{/depend}}\r\n\r\n                    {{layout handle="sales_email_order_creditmemo_items" creditmemo=\$creditmemo order=\$order}}\r\n\r\n                    <p>{{var comment}}</p>\r\n                </td>\r\n            </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Gutschrift Nr. # {{var creditmemo.increment_id}} für Bestellung Nr. # {{var order.increment_id}}', NULL, NULL, '2009-02-01 17:33:32', '2009-02-23 18:18:51'),
(21, 'Gutschrift Aktualisierung (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n        </tr>\r\n        </table>\r\n\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top">\r\n                <p><strong>Hallo {{var order.getCustomerName()}}</strong>,</p>\r\n				<p>Ihre Gutschrift Nr. {{var order.increment_id}} wurde atkualisiert. Neuer Status: <strong>{{var order.getStatusLabel()}}</strong>.</p>\r\n                <p>Sie können den aktuellen Status Ihrer Bestellung jederzeit <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">in Ihrem Kundenbereich</a> einsehen.</p>\r\n                <p>{{var comment}}</p>\r\n                <p>\r\n                    Sollten Sie Fragen haben,\r\n                    senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Gutschrift Nr. # {{var creditmemo.increment_id}} Aktualisierung', NULL, NULL, '2009-02-01 17:33:54', '2009-02-23 18:19:40'),
(22, 'Gutschrift Aktualisierung Gast (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n        </tr>\r\n        </table>\r\n\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top">\r\n                <p><strong>Hallo {{var order.getCustomerName()}}</strong>,</p>\r\n				<p>Ihre Gutschrift Nr. {{var order.increment_id}} wurde atkualisiert. Neuer Status: <strong>{{var order.getStatusLabel()}}</strong>.</p>\r\n                <p>{{var comment}}</p>\r\n                <p>\r\n                    Sollten Sie Fragen haben,\r\n                    senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Gutschrift Nr. # {{var creditmemo.increment_id}} Aktualisierung', NULL, NULL, '2009-02-01 17:34:11', '2009-02-23 18:20:12'),
(23, 'Neue Lieferung (Template)', '<style type="text/css">\r\n    body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n            </tr>\r\n        </table>\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top">\r\n                    <p>\r\n                        <strong>Hallo {{var order.getCustomerName()}}</strong>,<br/>\r\n                        Vielen Dank für Ihre Bestellung bei {{block type="symmetrics_impressum/impressum" value="shopname"}}.\r\n                        Sobald Ihre Sendung verschickt wurde, erhalten Sie per E-Mail weitere Informationen zur Sendungsverfolgung.\r\n                        Sie können den aktuellen Status Ihrer Bestellung jederzeit <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">in Ihrem Kundenbereich</a> einsehen.\r\n                        Sollten Sie Fragen zu Ihrem Kundenkonto oder Ihrer Bestellung haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                    </p>\r\n                    <p>\r\n                        Nachfolgend finden Sie Ihren Lieferschein, vielen Dank!\r\n                    </p>\r\n\r\n                    <h3 style="border-bottom:2px solid #eee; font-size:1.05em; padding-bottom:1px; ">\r\n                        Ihr Lieferschein Nr. {{var shipment.increment_id}} für Ihre Bestellung Nr. {{var order.increment_id}}\r\n                    </h3>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Rechnungsinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Zahlungsmethode:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.billing_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var payment_html}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandart:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_description}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n\r\n                    {{layout handle="sales_email_order_shipment_items" shipment=\$shipment order=\$order}}\r\n\r\n                    <br/>\r\n                    {{block type=''core/template'' area=''frontend'' template=''email/order/shipment/track.phtml'' shipment=\$shipment order=\$order}}\r\n                    <p>{{var comment}}</p>\r\n                </td>\r\n            </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Lieferschein Nr. # {{var shipment.increment_id}} für Bestellung Nr. # {{var order.increment_id}}', NULL, NULL, '2009-02-01 17:34:29', '2009-02-23 18:25:49'),
(24, 'Neue Lieferung Gast (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n            </tr>\r\n        </table>\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n            <tr>\r\n                <td valign="top">\r\n                    <p>\r\n                        <strong>Hallo {{var billing.getName()}}</strong>,<br/>\r\n                        Vielen Dank für Ihre Bestellung bei {{block type="symmetrics_impressum/impressum" value="shopname"}}.\r\n                        Sobald Ihre Sendung verschickt wurde, erhalten Sie per E-Mail weitere Informationen zur Sendungsverfolgung.\r\n                        Sollten Sie Fragen zu Ihrer Bestellung haben, senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>\r\n                    </p>\r\n                    <p>\r\n                        Nachfolgend finden Sie Ihren Lieferschein, vielen Dank!\r\n                    </p>\r\n\r\n                    <h3 style="border-bottom:2px solid #eee; font-size:1.05em; padding-bottom:1px; ">\r\n                        Ihre Lieferschein Nr. {{var shipment.increment_id}} für Ihre Bestellung Nr. {{var order.increment_id}}\r\n                    </h3>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Rechnungsinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Zahlungsmethode:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.billing_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var payment_html}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n                    <table cellspacing="0" cellpadding="0" border="0" width="100%">\r\n                        <thead>\r\n                        <tr>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandinformationen:</th>\r\n                            <th width="3%"></th>\r\n                            <th align="left" width="48.5%" bgcolor="#d9e5ee" style="padding:5px 9px 6px 9px; border:1px solid #bebcb7; border-bottom:none; line-height:1em;">Versandart:</th>\r\n                        </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                        <tr>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_address.format(''html'')}}\r\n                            </td>\r\n                            <td>&nbsp;</td>\r\n                            <td valign="top" style="padding:7px 9px 9px 9px; border:1px solid #bebcb7; border-top:0; background:#f8f7f5;">\r\n                                {{var order.shipping_description}}\r\n                            </td>\r\n                        </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <br/>\r\n\r\n                    {{layout handle="sales_email_order_shipment_items" shipment=\$shipment order=\$order}}\r\n\r\n                    <br/>\r\n                    {{block type=''core/template'' area=''frontend'' template=''email/order/shipment/track.phtml'' shipment=\$shipment order=\$order}}\r\n                    <p>{{var comment}}</p>\r\n                </td>\r\n            </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Lieferschein Nr. # {{var shipment.increment_id}} für Bestellung Nr. # {{var order.increment_id}}', NULL, NULL, '2009-02-01 17:34:48', '2009-02-23 18:26:35'),
(25, 'Lieferung Aktualisierung (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n        </tr>\r\n        </table>\r\n\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top">\r\n                <p><strong>Hallo {{var order.getCustomerName()}}</strong>,</p>\r\n				<p>Ihr Lieferschein Nr. {{var order.increment_id}} wurde atkualisiert. Neuer Status: <strong>{{var order.getStatusLabel()}}</strong>.</p>\r\n                <p>Sie können den aktuellen Status Ihrer Bestellung jederzeit <a href="{{store url="customer/account/"}}" style="color:#1E7EC8;">in Ihrem Kundenbereich</a> einsehen.</p>\r\n                <p>{{var comment}}</p>\r\n                <p>\r\n                    Sollten Sie Fragen haben,\r\n                    senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Lieferschein Nr. # {{var shipment.increment_id}} Aktualisierung', NULL, NULL, '2009-02-01 17:35:08', '2009-02-23 18:27:28'),
(26, 'Lieferung Aktualisierung Gast (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n<table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n<tr>\r\n    <td align="center" valign="top">\r\n        <!-- [ header starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top"><a href="{{store url=""}}"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}"  style="margin-bottom:10px;" border="0"/></a></td>\r\n        </tr>\r\n        </table>\r\n\r\n        <!-- [ middle starts here] -->\r\n        <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n        <tr>\r\n            <td valign="top">\r\n                <p><strong>Hallo {{var order.getCustomerName()}}</strong>,</p>\r\n				<p>Ihr Lieferschein Nr. {{var order.increment_id}} wurde atkualisiert. Neuer Status: <strong>{{var order.getStatusLabel()}}</strong>.</p>\r\n                <p>{{var comment}}</p>\r\n                <p>\r\n                    Sollten Sie Fragen haben,\r\n                    senden Sie uns eine E-Mail an <a href="mailto:{{block type="symmetrics_impressum/impressum" value="email"}}" style="color:#1E7EC8;">{{block type="symmetrics_impressum/impressum" value="email"}}</a>.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n</table>\r\n</div>', 2, '{{var order.getStoreGroupName()}}: Lieferschein Nr. # {{var shipment.increment_id}} Aktualisierung', NULL, NULL, '2009-02-01 17:35:42', '2009-02-23 18:28:08'),
(27, 'Zahlung fehlgeschlagen (Template)', '<table>\r\n    <thead>\r\n        <tr>\r\n            <th>Transaktion fehlgeschlagen.</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n                <p>\r\n                    <b>Grund</b><br />\r\n                    {{var reason}}\r\n                </p>\r\n                <p>\r\n                    <b>Typ</b><br />\r\n                    {{var checkoutType}}\r\n                </p>\r\n                <p>\r\n                    <b>Kunde:</b><br />\r\n                    <a href="mailto:{{var customerEmail}}">{{var customer}}</a> &lt;{{var customerEmail}}&gt;\r\n                </p>\r\n                <p>\r\n                    <b>Artikel</b><br />\r\n                    {{var items}}\r\n                </p>\r\n                <p>\r\n                    <b>Summe:</b><br />\r\n                    {{var total}}\r\n                </p>\r\n                <p>\r\n                    <b>Rechnungsadresse:</b><br />\r\n                    {{var billingAddress.format(''html'')}}\r\n                </p>\r\n                <p>\r\n                    <b>Lieferadresse:</b><br />\r\n                    {{var shippingAddress.format(''html'')}}\r\n                </p>\r\n                <p>\r\n                    <b>Lieferung:</b><br />\r\n                    {{var shippingMethod}}\r\n                </p>\r\n                <p>\r\n                    <b>Zahlungsmethode:</b><br />\r\n                    {{var paymentMethod}}\r\n                </p>\r\n                <p>\r\n                    <b>Datum & Zeit:</b><br />\r\n                    {{var dateAndTime}}\r\n                </p>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 2, 'Transaktion fehlgeschlagen', NULL, NULL, '2009-02-01 17:36:09', '2009-02-20 18:39:53'),
(28, 'Log Aufräumung Warnungen (Template)', 'Warnung bei der Log-Löschlung:\r\n\r\n{{var warnings}}', 1, 'Warnung bei der Log-Löschlung', NULL, NULL, '2009-02-01 17:36:44', '2009-02-20 18:40:24'),
(29, 'Newsletter Anmeldung Bestätigung (Template)', '<style type="text/css">\r\n	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n	a { color:#1E7EC8; }\r\n</style>\r\n\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n    <table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n        <tr>\r\n            <td align="center" valign="top">\r\n                <!-- [ header starts here] -->\r\n                <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n                    <tr>\r\n                        <td valign="top">\r\n                            <p><a href="{{store url=""}}" style="color:#1E7EC8;"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}" border="0"/></a></p></td>\r\n                    </tr>\r\n                </table>\r\n\r\n                <!-- [ middle starts here] -->\r\n                <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n                    <tr>\r\n                        <td valign="top">\r\n                            <p><strong>Hallo {{var customer.name}}</strong>,<br/>\r\n                            vielen Dank, dass Sie sich als Abonennt unseres kostenlosen Newsletters angemeldet haben.</p>\r\n                            <p style="border:1px solid #BEBCB7; padding:13px 18px; background:#F8F7F5; ">Um Sie in den Versandverteiler aufnehmen zu können, müssen Sie einmalig und abschließen Ihre Anmeldung bestätigen. Klicken Sie dazu bitte auf den folgenden Link:<br />\r\n                            <a href="{{var subscriber.getConfirmationLink()}}" style="color:#1E7EC8;">{{var subscriber.getConfirmationLink()}}</a></p>\r\n                        </td>\r\n                    </tr>\r\n				<tr>\r\n					<td>\r\n						{{block type="symmetrics_impressum/impressum" value="emailfooter"}}\r\n					</td>\r\n				</tr>\r\n                </table>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n</div>', 2, 'Newsletter Anmeldung Bestätigung', NULL, NULL, '2009-02-01 17:37:06', '2009-02-23 18:29:50'),
(30, 'Newsletter Anmeldung Erfolg (Template)', 'Newsletter Anmeldung erfolgreich', 2, 'Newsletter Anmeldung erfolgreich', NULL, NULL, '2009-02-01 17:38:24', '2009-02-20 18:41:28'),
(31, 'Newsletter Abmeldung Erfolg (Template)', 'Newsletter Abmeldung erfolgreich', 2, 'Newsletter Abmeldung erfolgreich', NULL, NULL, '2009-02-01 17:39:21', '2009-02-20 18:41:58'),
(32, 'Wunschliste gemeinsam nutzen (Template)', '<style type="text/css">\r\n    body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }\r\n</style>\r\n<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">\r\n    <table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">\r\n        <tr>\r\n            <td align="center" valign="top">\r\n            <!-- [ header starts here] -->\r\n                <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n                    <tr>\r\n                        <td valign="top">\r\n                            <p><a href="{{store url=""}}" style="color:#1E7EC8;"><img src="{{skin url="images/logo_email.gif" _area=''frontend''}}" alt="{{block type="symmetrics_impressum/impressum" value="shopname"}}" border="0"/></a></p></td>\r\n                    </tr>\r\n                </table>\r\n\r\n            <!-- [ middle starts here] -->\r\n                <table cellspacing="0" cellpadding="0" border="0" width="650">\r\n                    <tr>\r\n                        <td valign="top">\r\n                        <p>Hallo,<br/>\r\n                        hier gibt es meinen Wunschzettel!</p>\r\n\r\n<p>{{var message}}</p>\r\n\r\n                        {{var items}}\r\n\r\n                        <br/>\r\n\r\n{{depend salable}}<p><strong><a href="{{var addAllLink}}" style="color:#DC6809;">Alle Artikel in Warenkorb legen</a></strong> |{{/depend}}  <strong><a href="{{var viewOnSiteLink}}" style="color:#1E7EC8;">Alle Artikel im Shop ansehen!</a></strong></p>\r\n\r\n                        <p>Danke,<br/><strong>{{var customer.name}}</strong></p>\r\n\r\n\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    </div>', 2, 'Schauen Sie sich {{var customer.name}}''s Wunschzettel an', NULL, NULL, '2009-02-01 17:41:16', '2009-02-20 18:23:08'),
(33, 'Produkt an einen Freund verschicken (Template)', 'Willkommen, {{var name}}<br /><br />Bitte schau dir <a href="{{var product_url}}">{{var product_name}}</a><br /><br />Hier ist die Nachricht: <br />{{var message}}<br /><br />', 2, 'Willkommen, {{var name}}', NULL, NULL, '2009-02-01 17:41:41', '2009-02-20 18:42:30'),
(34, 'Kontaktformular (Template)', 'Name: {{var data.name}}\r\nE-Mail: {{var data.email}}\r\nTelefon: {{var data.telephone}}\r\n\r\nKommentar: {{var data.comment}}', 1, 'Kontaktformular', NULL, NULL, '2009-02-01 17:42:24', '2009-02-20 18:42:59'),
(35, 'Sitemap Generierung Warnungen (Template)', 'Sitemap Generierung - Warnung:\r\n\r\n{{var warnings}}', 1, 'Sitemap Generierung - Warnung', NULL, NULL, '2009-02-01 17:42:46', '2009-02-23 18:31:05'),
(36, 'Produkt wieder verfügbar (Template)', 'Hallo {{var customerName}},\r\n\r\n{{var alertGrid}}', 2, 'Produkt wieder verfügbar', NULL, NULL, '2009-02-01 17:43:25', '2009-02-20 18:43:59'),
(37, 'Produkt Preisänderung (Template)', 'Hallo {{var customerName}},\r\n\r\n{{var alertGrid}}', 2, 'Produkt Preisänderung', NULL, NULL, '2009-02-01 17:43:43', '2009-02-20 18:44:19'),
(38, 'Produkt Cron Fehler (Template)', 'Product alerts cron warnings:\r\n\r\n{{var warnings}}', 2, 'Product alerts Cron error', NULL, NULL, '2009-02-01 17:44:02', '2009-02-20 18:44:31');
EOF;
$installer->run($query);

# configuration

$query = <<< EOF
DELETE FROM `core_config_data` WHERE `scope`='default' AND `scope_id`=0 AND `path`='catalog/category/root_id';
EOF;
$installer->run($query);

$query = <<< EOF
INSERT INTO `core_config_data` (`scope`, `scope_id`, `path`, `value`) VALUES
('default', 0, 'catalog/category/root_id', '2'),
('default', 0, 'general/country/default', 'DE'),
('default', 0, 'general/country/allow', 'DE'),
('default', 0, 'general/locale/firstday', '1'),
('default', 0, 'general/locale/weekend', '0,6'),
('default', 0, 'design/package/name', 'default'),
('default', 0, 'design/package/ua_regexp', 'a:0:{}'),
('default', 0, 'design/theme/locale', ''),
('default', 0, 'design/theme/template', ''),
('default', 0, 'design/theme/template_ua_regexp', 'a:0:{}'),
('default', 0, 'design/theme/skin', ''),
('default', 0, 'design/theme/skin_ua_regexp', 'a:0:{}'),
('default', 0, 'design/theme/layout', ''),
('default', 0, 'design/theme/layout_ua_regexp', 'a:0:{}'),
('default', 0, 'design/theme/default', ''),
('default', 0, 'design/theme/default_ua_regexp', 'a:0:{}'),
('default', 0, 'design/head/default_title', '${shopname}'),
('default', 0, 'design/head/title_prefix', ''),
('default', 0, 'design/head/title_suffix', ''),
('default', 0, 'design/head/default_description', '${meta_description}'),
('default', 0, 'design/head/default_keywords', '${meta_keywords}'),
('default', 0, 'design/head/default_robots', '${meta_robots}'),
('default', 0, 'design/head/includes', ''),
('default', 0, 'design/header/logo_src', 'images/logo.gif'),
('default', 0, 'design/header/logo_alt', '${shopname}'),
('default', 0, 'design/header/welcome', '${welcome}'),
('default', 0, 'design/footer/copyright', '${copyright}'),
('default', 0, 'design/footer/absolute_footer', ''),
('default', 0, 'design/watermark/image_size', ''),
('default', 0, 'design/watermark/image_position', 'stretch'),
('default', 0, 'design/watermark/small_image_size', ''),
('default', 0, 'design/watermark/small_image_position', 'stretch'),
('default', 0, 'design/watermark/thumbnail_size', ''),
('default', 0, 'design/watermark/thumbnail_position', 'stretch'),
('default', 0, 'trans_email/ident_general/name', '${company}'),
('default', 0, 'trans_email/ident_general/email', '${email_general}'),
('default', 0, 'trans_email/ident_sales/name', 'Shop Verkaufsabteilung'),
('default', 0, 'trans_email/ident_sales/email', '${email_sales}'),
('default', 0, 'trans_email/ident_support/name', 'Kundenbetreuung'),
('default', 0, 'trans_email/ident_support/email', '${email_support}'),
('default', 0, 'trans_email/ident_custom1/name', 'Zusätzliche E-Mail 1'),
('default', 0, 'trans_email/ident_custom1/email', '${email_custom1}'),
('default', 0, 'trans_email/ident_custom2/name', 'Zusätzliche E-Mail 2'),
('default', 0, 'trans_email/ident_custom2/email', '${email_custom2}'),
('default', 0, 'contacts/contacts/enabled', '1'),
('default', 0, 'contacts/email/recipient_email', '${email}'),
('default', 0, 'contacts/email/sender_email_identity', 'general'),
('default', 0, 'contacts/email/email_template', '34'),
('default', 0, 'catalog/review/allow_guest', '1'),
('default', 0, 'catalog/frontend/list_mode', 'grid-list'),
('default', 0, 'catalog/frontend/grid_per_page_values', '9,15,30'),
('default', 0, 'catalog/frontend/grid_per_page', '9'),
('default', 0, 'catalog/frontend/list_per_page_values', '5,10,15,20,25'),
('default', 0, 'catalog/frontend/list_per_page', '10'),
('default', 0, 'catalog/productalert/allow_price', '0'),
('default', 0, 'catalog/productalert/email_price_template', '37'),
('default', 0, 'catalog/productalert/allow_stock', '0'),
('default', 0, 'catalog/productalert/email_stock_template', '36'),
('default', 0, 'catalog/productalert/email_identity', 'general'),
('default', 0, 'catalog/productalert_cron/frequency', 'D'),
('default', 0, 'crontab/jobs/catalog_product_alert/schedule/cron_expr', '0 0 * * *'),
('default', 0, 'crontab/jobs/catalog_product_alert/run/model', 'productalert/observer::process'),
('default', 0, 'catalog/productalert_cron/time', '00,00,00'),
('default', 0, 'catalog/productalert_cron/error_email', ''),
('default', 0, 'catalog/productalert_cron/error_email_identity', 'general'),
('default', 0, 'catalog/productalert_cron/error_email_template', '38'),
('default', 0, 'catalog/recently_products/scope', 'website'),
('default', 0, 'catalog/recently_products/viewed_count', '5'),
('default', 0, 'catalog/recently_products/compared_count', '5'),
('default', 0, 'catalog/price/scope', '0'),
('default', 0, 'catalog/search/min_query_length', '1'),
('default', 0, 'catalog/search/max_query_length', '128'),
('default', 0, 'catalog/search/max_query_words', '10'),
('default', 0, 'catalog/search/search_type', '1'),
('default', 0, 'catalog/search/use_layered_navigation_count', '2000'),
('default', 0, 'catalog/navigation/max_depth', '0'),
('default', 0, 'catalog/seo/search_terms', '1'),
('default', 0, 'catalog/seo/site_map', '1'),
('default', 0, 'catalog/seo/product_url_suffix', '.html'),
('default', 0, 'catalog/seo/category_url_suffix', '.html'),
('default', 0, 'catalog/seo/product_use_categories', '1'),
('default', 0, 'catalog/seo/title_separator', '-'),
('default', 0, 'catalog/downloadable/order_status', 'complete'),
('default', 0, 'catalog/downloadable/downloads_number', '0'),
('default', 0, 'catalog/downloadable/shareable', '0'),
('default', 0, 'catalog/downloadable/samples_title', 'Samples'),
('default', 0, 'catalog/downloadable/links_title', 'Links'),
('default', 0, 'catalog/downloadable/links_target_new_window', '1'),
('default', 0, 'catalog/downloadable/content_disposition', 'inline'),
('default', 0, 'catalog/downloadable/disable_guest_checkout', '1'),
('default', 0, 'sitemap/category/changefreq', 'daily'),
('default', 0, 'sitemap/category/priority', '0.5'),
('default', 0, 'sitemap/product/changefreq', 'daily'),
('default', 0, 'sitemap/product/priority', '1'),
('default', 0, 'sitemap/page/changefreq', 'daily'),
('default', 0, 'sitemap/page/priority', '0.25'),
('default', 0, 'sitemap/generate/enabled', '1'),
('default', 0, 'sitemap/generate/time', '00,00,00'),
('default', 0, 'sitemap/generate/frequency', 'D'),
('default', 0, 'crontab/jobs/sitemap_generate/schedule/cron_expr', '0 0 * * *'),
('default', 0, 'crontab/jobs/sitemap_generate/run/model', 'sitemap/observer::scheduledGenerateSitemaps'),
('default', 0, 'sitemap/generate/error_email', ''),
('default', 0, 'sitemap/generate/error_email_identity', 'general'),
('default', 0, 'sitemap/generate/error_email_template', '35'),
('default', 0, 'sendfriend/email/enabled', '1'),
('default', 0, 'sendfriend/email/template', '33'),
('default', 0, 'sendfriend/email/allow_guest', '0'),
('default', 0, 'sendfriend/email/max_recipients', '5'),
('default', 0, 'sendfriend/email/max_per_hour', '5'),
('default', 0, 'sendfriend/email/check_by', '0'),
('default', 0, 'newsletter/subscription/un_email_identity', 'support'),
('default', 0, 'newsletter/subscription/un_email_template', '31'),
('default', 0, 'newsletter/subscription/success_email_template', '30'),
('default', 0, 'newsletter/subscription/success_email_identity', 'general'),
('default', 0, 'newsletter/subscription/confirm_email_identity', 'support'),
('default', 0, 'newsletter/subscription/confirm_email_template', '29'),
('default', 0, 'newsletter/subscription/confirm', '1'),
('default', 0, 'newsletter/sending/set_return_path', '0'),
('default', 0, 'customer/online_customers/online_minutes_interval', ''),
('default', 0, 'customer/account_share/scope', '1'),
('default', 0, 'customer/create_account/default_group', '1'),
('default', 0, 'customer/create_account/email_domain', '${emaildomain}'),
('default', 0, 'customer/create_account/email_template', '7'),
('default', 0, 'customer/create_account/email_identity', 'general'),
('default', 0, 'customer/create_account/confirm', '0'),
('default', 0, 'customer/create_account/email_confirmation_template', '8'),
('default', 0, 'customer/create_account/email_confirmed_template', '9'),
('default', 0, 'customer/password/forgot_email_template', '10'),
('default', 0, 'customer/password/forgot_email_identity', 'support'),
('default', 0, 'customer/address/street_lines', '2'),
('default', 0, 'customer/address/prefix_show', 'req'),
('default', 0, 'customer/address/prefix_options', 'Herr;Frau'),
('default', 0, 'customer/address/middlename_show', '0'),
('default', 0, 'customer/address/suffix_show', ''),
('default', 0, 'customer/address/suffix_options', ''),
('default', 0, 'customer/address/dob_show', ''),
('default', 0, 'customer/address/taxvat_show', ''),
('default', 0, 'wishlist/general/active', '1'),
('default', 0, 'wishlist/email/email_template', '32'),
('default', 0, 'wishlist/email/email_identity', 'general'),
('default', 0, 'sales_email/order/enabled', '1'),
('default', 0, 'sales_email/order/identity', 'sales'),
('default', 0, 'sales_email/order/template', '11'),
('default', 0, 'sales_email/order/guest_template', '12'),
('default', 0, 'sales_email/order/copy_to', ''),
('default', 0, 'sales_email/order/copy_method', 'bcc'),
('default', 0, 'sales_email/order_comment/enabled', '1'),
('default', 0, 'sales_email/order_comment/identity', 'sales'),
('default', 0, 'sales_email/order_comment/template', '13'),
('default', 0, 'sales_email/order_comment/guest_template', '14'),
('default', 0, 'sales_email/order_comment/copy_to', ''),
('default', 0, 'sales_email/order_comment/copy_method', 'bcc'),
('default', 0, 'sales_email/invoice/enabled', '1'),
('default', 0, 'sales_email/invoice/identity', 'sales'),
('default', 0, 'sales_email/invoice/template', '15'),
('default', 0, 'sales_email/invoice/guest_template', '16'),
('default', 0, 'sales_email/invoice/copy_to', ''),
('default', 0, 'sales_email/invoice/copy_method', 'bcc'),
('default', 0, 'sales_email/invoice_comment/enabled', '1'),
('default', 0, 'sales_email/invoice_comment/identity', 'sales'),
('default', 0, 'sales_email/invoice_comment/template', '17'),
('default', 0, 'sales_email/invoice_comment/guest_template', '18'),
('default', 0, 'sales_email/invoice_comment/copy_to', ''),
('default', 0, 'sales_email/invoice_comment/copy_method', 'bcc'),
('default', 0, 'sales_email/shipment/enabled', '1'),
('default', 0, 'sales_email/shipment/identity', 'sales'),
('default', 0, 'sales_email/shipment/template', '23'),
('default', 0, 'sales_email/shipment/guest_template', '24'),
('default', 0, 'sales_email/shipment/copy_to', ''),
('default', 0, 'sales_email/shipment/copy_method', 'bcc'),
('default', 0, 'sales_email/shipment_comment/enabled', '1'),
('default', 0, 'sales_email/shipment_comment/identity', 'sales'),
('default', 0, 'sales_email/shipment_comment/template', '25'),
('default', 0, 'sales_email/shipment_comment/guest_template', '26'),
('default', 0, 'sales_email/shipment_comment/copy_to', ''),
('default', 0, 'sales_email/shipment_comment/copy_method', 'bcc'),
('default', 0, 'sales_email/creditmemo/enabled', '1'),
('default', 0, 'sales_email/creditmemo/identity', 'sales'),
('default', 0, 'sales_email/creditmemo/template', '19'),
('default', 0, 'sales_email/creditmemo/guest_template', '20'),
('default', 0, 'sales_email/creditmemo/copy_to', ''),
('default', 0, 'sales_email/creditmemo/copy_method', 'bcc'),
('default', 0, 'sales_email/creditmemo_comment/enabled', '1'),
('default', 0, 'sales_email/creditmemo_comment/identity', 'sales'),
('default', 0, 'sales_email/creditmemo_comment/template', '21'),
('default', 0, 'sales_email/creditmemo_comment/guest_template', '22'),
('default', 0, 'sales_email/creditmemo_comment/copy_to', ''),
('default', 0, 'sales_email/creditmemo_comment/copy_method', 'bcc'),
('default', 0, 'tax/classes/shipping_tax_class', '3'),
('default', 0, 'tax/calculation/based_on', 'origin'),
('default', 0, 'tax/calculation/price_includes_tax', '1'),
('default', 0, 'tax/calculation/shipping_includes_tax', '1'),
('default', 0, 'tax/calculation/apply_after_discount', '0'),
('default', 0, 'tax/calculation/discount_tax', '0'),
('default', 0, 'tax/calculation/apply_tax_on', '0'),
('default', 0, 'tax/defaults/country', 'DE'),
('default', 0, 'tax/defaults/region', '0'),
('default', 0, 'tax/defaults/postcode', '*'),
('default', 0, 'tax/display/column_in_summary', '3'),
('default', 0, 'tax/display/full_summary', '1'),
('default', 0, 'tax/display/shipping', '2'),
('default', 0, 'tax/display/type', '3'),
('default', 0, 'tax/display/zero_tax', '1'),
('default', 0, 'tax/weee/enable', '0'),
('default', 0, 'tax/weee/display_list', '0'),
('default', 0, 'tax/weee/display', '0'),
('default', 0, 'tax/weee/display_sales', '0'),
('default', 0, 'tax/weee/display_email', '0'),
('default', 0, 'tax/weee/discount', '0'),
('default', 0, 'tax/weee/apply_vat', '0'),
('default', 0, 'tax/weee/include_in_subtotal', '0'),
('default', 0, 'checkout/options/onepage_checkout_disabled', '0'),
('default', 0, 'checkout/options/guest_checkout', '1'),
('default', 0, 'checkout/options/enable_agreements', '1'),
('default', 0, 'checkout/cart/delete_quote_after', '30'),
('default', 0, 'checkout/cart/redirect_to_cart', '1'),
('default', 0, 'checkout/cart/grouped_product_image', 'itself'),
('default', 0, 'checkout/cart/configurable_product_image', 'parent'),
('default', 0, 'checkout/cart_link/use_qty', '0'),
('default', 0, 'checkout/sidebar/display', '1'),
('default', 0, 'checkout/sidebar/count', '3'),
('default', 0, 'checkout/payment_failed/reciever', 'general'),
('default', 0, 'checkout/payment_failed/identity', 'general'),
('default', 0, 'checkout/payment_failed/template', '27'),
('default', 0, 'checkout/payment_failed/copy_to', ''),
('default', 0, 'checkout/payment_failed/copy_method', 'bcc'),
('default', 0, 'shipping/origin/country_id', 'DE'),
('default', 0, 'shipping/origin/region_id', '0'),
('default', 0, 'shipping/origin/postcode', '${zip}'),
('default', 0, 'shipping/origin/city', '${city}'),
('default', 0, 'shipping/option/checkout_multiple', '1'),
('default', 0, 'shipping/option/checkout_multiple_maximum_qty', '100'),
('default', 0, 'dev/restrict/allow_ips', ''),
('default', 0, 'dev/debug/profiler', '0'),
('default', 0, 'dev/translate_inline/active', '0'),
('default', 0, 'dev/translate_inline/active_admin', '0'),
('default', 0, 'dev/log/active', '0'),
('default', 0, 'dev/log/file', 'system.log'),
('default', 0, 'dev/log/exception_file', 'exception.log'),
('default', 0, 'dev/js/deprecation', '0'),
('default', 0, 'sales/totals_sort/subtotal', '10'),
('default', 0, 'sales/totals_sort/discount', '20'),
('default', 0, 'sales/totals_sort/shipping', '30'),
('default', 0, 'sales/totals_sort/weee', '50'),
('default', 0, 'sales/totals_sort/tax', '40'),
('default', 0, 'sales/totals_sort/grand_total', '100'),
('default', 0, 'sales/reorder/allow', '1'),
('default', 0, 'sales/identity/address', '${company}\r\n${firstname} ${lastname}\r\n${street}\r\n${zip} ${city}\r\n${country}'),
('default', 0, 'sales/minimum_order/active', '0'),
('default', 0, 'sales/minimum_order/amount', ''),
('default', 0, 'sales/minimum_order/description', ''),
('default', 0, 'sales/minimum_order/error_message', ''),
('default', 0, 'sales/minimum_order/multi_address', '0'),
('default', 0, 'sales/minimum_order/multi_address_description', ''),
('default', 0, 'sales/minimum_order/multi_address_error_message', ''),
('default', 0, 'sales/gift_messages/allow_order', '0'),
('default', 0, 'sales/gift_messages/allow_items', '0'),
('default', 0, 'general/impressum/company1', '${company}'),
('default', 0, 'general/impressum/company2', '${company2}'),
('default', 0, 'general/impressum/street', '${street}'),
('default', 0, 'general/impressum/zip', '${zip}'),
('default', 0, 'general/impressum/city', '${city}'),
('default', 0, 'general/impressum/telephone', '${telephone}'),
('default', 0, 'general/impressum/email', '${email}'),
('default', 0, 'general/impressum/fax', '${fax}'),
('default', 0, 'general/impressum/web', '${homepage}'),
('default', 0, 'general/impressum/taxnumber', '${tax_number}'),
('default', 0, 'general/impressum/vatid', '${sales_tax_id_number}'),
('default', 0, 'general/impressum/court', '${commercial_register}'),
('default', 0, 'general/impressum/taxoffice', '${tax_office}'),
('default', 0, 'general/impressum/ceo', '${firstname} ${lastname}'),
('default', 0, 'general/impressum/hrb', '${hrb}'),
('default', 0, 'general/impressum/bankaccount', '${bank_account}'),
('default', 0, 'general/impressum/bankcodenumber', '${bank_id_code}'),
('default', 0, 'general/impressum/bankname', '${bank_connection}'),
('default', 0, 'general/impressum/swift', '${swift}'),
('default', 0, 'general/impressum/iban', '${iban}'),
('default', 0, 'general/impressum/shopname', '${shopname}'),
('default', 0, 'sales_pdf/invoice/put_order_id', '1'),
('default', 0, 'sales_pdf/invoice/maturity', '${invoice_maturity}'),
('default', 0, 'sales_pdf/invoice/note', '${invoice_note}'),
('default', 0, 'sales_pdf/shipment/put_order_id', '1'),
('default', 0, 'sales_pdf/creditmemo/put_order_id', '1'),
('default', 0, 'sales/identity/logo', 'default/logo.jpg'),
('default', 0, 'general/impressum/bankaccountowner', '${bank_account_owner}'),
('default', 0, 'sales_pdf/invoice/customeridprefix', '${invoice_customerprefix}');
EOF;
$installer->run($query);

$installer->endSetup();