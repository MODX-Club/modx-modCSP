<?php

$plugins = array();

$list = array(
    'modmetrics.visit' => array('OnPageNotFound', 'OnPageUnauthorized', 'OnLoadWebDocument'), 
    'modredirect.redirect' => array('OnBeforeDocFormSave', 'OnPageNotFound', 'OnResourceBeforeSort')
);

foreach ($list as $v => $evts) {

    $plugin_name = $v;
    $plugin_path = $sources['plugins'].$plugin_name.'.plugin.php';
    $content = getSnippetContent($plugin_path);
    
    if (!empty($content)) {
        $new_plugin_name = str_replace('.', '-', $plugin_name);
    
        $plugin = $modx->newObject('modPlugin');
        $plugin->set('id', 1);
        $plugin->set('name', $new_plugin_name);
        $plugin->set('description', $plugin_name.'_desc');
        $plugin->set('plugincode', $content);
    
        $plugin->fromArray(array(
            'static' => 1,
            'source' => 1,
            'static_file' => 'core/components/'.PKG_PATH.'/elements/plugins/'.$plugin_name.'.plugin.php',
        ));
    
        $events = array();
        foreach($evts as $e){
            
            $events[$e] = $modx->newObject('modPluginEvent');
            $events[$e]->fromArray(array(
              'event' => $e,
              'priority' => 0,
              'propertyset' => 0,
            ), '', true, true);
            
        }
    
        $plugin->addMany($events, 'PluginEvents');
        unset($events);
    
        $modx->log(xPDO::LOG_LEVEL_INFO, count($events).' Plugin Events were added.');
        flush();
    
        $plugins[] = $plugin;
    }
    
}

unset($plugin, $events, $plugin_name, $content);

return $plugins;
