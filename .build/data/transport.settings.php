<?php

$settings = array();

$setting_name = PKG_NAME_LOWER.'.analytics_url';
$setting = $modx->newObject('modSystemSetting');
$setting->fromArray(array(
    'key' => $setting_name,
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => NAMESPACE_NAME,
    'area' => 'default',
), '', true, true);

$settings[] = $setting;

$setting_name = PKG_NAME_LOWER.'.analytics_site_id';
$setting = $modx->newObject('modSystemSetting');
$setting->fromArray(array(
    'key' => $setting_name,
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => NAMESPACE_NAME,
    'area' => 'default',
), '', true, true);

$settings[] = $setting;

$setting_name = PKG_NAME_LOWER.'.phone_ph_name';
$setting = $modx->newObject('modSystemSetting');
$setting->fromArray(array(
    'key' => $setting_name,
    'value' => 'modpiwik.phone',
    'xtype' => 'textfield',
    'namespace' => NAMESPACE_NAME,
    'area' => 'default',
), '', true, true);

$settings[] = $setting;

unset($setting, $setting_name);

return $settings;
