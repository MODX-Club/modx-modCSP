<?php

$menus = array();
$menuindex = 0;

$menu = $modx->newObject('modMenu');
$menu->fromArray(array(
  'text' => NAMESPACE_NAME,
  'parent' => 'components',
  'description' => NAMESPACE_NAME.'.desc',
  # 'icon' => 'images/icons/plugin.gif',
  'action' => 'controllers/mgr/modmetrics/index',
  'params' => '',
  'handler' => '',
  'menuindex' => $menuindex++,
  'permissions' => 'modmetrics',
  'namespace' => NAMESPACE_NAME,
), '', true, true);

$menus[] = $menu;
unset($menu);

return $menus;
