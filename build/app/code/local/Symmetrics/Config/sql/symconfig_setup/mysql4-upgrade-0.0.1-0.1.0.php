<?php
$installer = $this;
$installer->startSetup();

$installer->setConfigData('tax/calculation/apply_after_discount', '0');
$installer->setConfigData('tax/calculation/discount_tax', '1');

$installer->endSetup();
