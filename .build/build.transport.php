<?php

include_once __DIR__.'/package.php';

/* define package */
define('PKG_NAME', $pkgName);
define('PKG_NAME_LOWER', strtolower(PKG_NAME));
define('PKG_NAME_UPPER', strtoupper(substr($pkgName, 0, 1)).substr($pkgName, 1));
define('NAMESPACE_NAME', PKG_NAME_LOWER);

define('PKG_PATH', PKG_NAME_LOWER);
define('PKG_CATEGORY', PKG_NAME);

define('PKG_VERSION', $pkgVersion);
define('PKG_RELEASE', $pkgRelease);

$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;

echo '<pre>';
require_once dirname(__FILE__).'/build.config.php';

/*
 * Set log Params
 */
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO'); echo '<pre>'; flush();

/*
 * Create Builder
 */
$modx->loadClass('transport.modPackageBuilder', '', false, true);
$builder = new modPackageBuilder($modx);

/*
 * Create Package
 */
$builder->createPackage(PKG_NAME_LOWER, PKG_VERSION, PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER, false, true, '{core_path}components/'.PKG_NAME_LOWER.'/');

/*
 * Load lexicon
 */
# include_once $sources['builder_includes'] . 'lexicon.php';

/*
 * Add Namespace
 */
include_once $sources['builder_includes'].'namespace.php';

/*
 * Add mediasources
 */
// include_once $sources['builder_includes'].'mediasources.php';

/*
 * Create system settings via vehicle
 */
// include_once $sources['builder_includes'].'system.settings.php';

/*
 * Create custom system settings via vehicle
 */
# include_once $sources['builder_includes'] . 'system.events.php';

/*
 * Create Category
 */
include_once $sources['builder_includes'].'category.php';

/* add plugins */
// include_once $sources['builder_includes'].'plugins.php';

/* add snippets */
// include_once $sources['builder_includes'].'snippets.php';

/* add chunks */
# include_once $sources['builder_includes'] . 'chunks.php';

/*
 * Create category vehicle
 */
include_once $sources['builder_includes'].'category.attributes.php';
$vehicle = $builder->createVehicle($category, $attr);
// eof Create Category

/*
 * Adding sources (3 sources by default)
 */
include_once $sources['resolvers'].'resolver.sources.php';

/*
 * Adding resolvers
 */
// init
include_once $sources['builder_includes'].'resolver.register.initialize.php';
// eof adding resolvers

// // resolve tables
// include_once $sources['builder_includes'].'resolver.tables.wrapper.php';

// // register package
// include_once $sources['builder_includes'].'resolver.register.wrapper.php';
// // eof adding resolvers

$builder->putVehicle($vehicle);

/*
 * Load Menu
 */
// include_once $sources['builder_includes'].'menu.php';

/* now pack in the license file, readme and setup options */
include_once $sources['builder_includes'].'eula.php';

$modx->log(modX::LOG_LEVEL_INFO, 'We are packing now…'); flush();
$builder->pack();

$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$tend = $mtime;

$totalTime = ($tend - $tstart);
$totalTime = sprintf('%2.4f s', $totalTime);

$modx->log(modX::LOG_LEVEL_INFO, "\n<br />Package Built.<br />\nExecution time: {$totalTime}\n");

exit();
