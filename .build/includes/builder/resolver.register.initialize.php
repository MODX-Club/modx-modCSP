<?php

$modx->log(modX::LOG_LEVEL_INFO, 'Initialize resolvers adding initiated…'); flush();
$vehicle->resolve('php', array(
 'source' => $sources['resolvers'].'resolver.init.php',
));

$modx->log(modX::LOG_LEVEL_INFO, 'Package was registered.'); flush();
