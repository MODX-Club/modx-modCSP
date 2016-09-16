<?php

$pkgNameLower = $options['namespace'];

if ($object->xpdo) {
    $modx = &$object->xpdo;
    $modelPath = $modx->getOption("{$pkgNameLower}.core_path", null, $modx->getOption('core_path')."components/{$pkgNameLower}/").'model/';

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        if ($modx instanceof modX) {
            $modx->setLogLevel(modX::LOG_LEVEL_ERROR);
            $manager = $modx->getManager();

            // write code here

            # $modx->setLogLevel(modX::LOG_LEVEL_INFO);
            # $modx->log(xPDO::LOG_LEVEL_INFO, 'Fields were added');
        }

        if ($modx instanceof modX) {
            $modx->setLogLevel(modX::LOG_LEVEL_ERROR);

            $modx->addExtensionPackage('modmetrics', "[[++core_path]]components/{$pkgNameLower}/model/", array(
                'serviceName' => 'modMetrics',
                'serviceClass' => 'services.Modmetrics',
            ));

            $modx->addExtensionPackage('modredirect', "[[++core_path]]components/{$pkgNameLower}/model/");

            $modx->setLogLevel(modX::LOG_LEVEL_INFO);
            $modx->log(xPDO::LOG_LEVEL_INFO, 'Package was registered');
        }
      break;

    case xPDOTransport::ACTION_UNINSTALL:
        if ($modx instanceof modX) {
            $modx->removeExtensionPackage($pkgNameLower);
        }
        break;
  }
}

return true;
