<?php

$configData = Mage::getConfig()
    ->getNode('default/config_german')
    ->asArray();

$installer = $this;
$installer->startSetup();

$installer->endSetup();
