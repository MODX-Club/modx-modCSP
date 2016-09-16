<?php

$snippets = array();

/* course snippets */

$list = array('modmetrics.getcode', 'modmetrics.getphone');

foreach ($list as $v) {
    $snippet_name = $v;
    $snippet_build_url = $sources['snippets'].$snippet_name.'.snippet.php';
    $content = getSnippetContent($snippet_build_url);
    
    $snippet_real_url = 'core/components/'.PKG_PATH.'/elements/snippets/'.$snippet_name.'.snippet.php';

    $new_snippet_name = str_replace('.', '-', $snippet_name);

    if (!empty($content)) {
        $snippet = $modx->newObject('modSnippet');
        $snippet->fromArray(array(
            'name' => $new_snippet_name,
            'description' => $snippet_name.'_desc',
            'snippet' => $content,
            'source' => 1,
            'static' => 1
        ), '', true, true);
        $snippet->set('static_file', $snippet_real_url);
        $modx->log(modX::LOG_LEVEL_INFO, $snippet_name.' snippet was added.');
        flush();

        $path = $sources['properties']."{$snippet_name}.snippet.properties.php";
        if (is_file($path)) {
            $properties = include $path;
            $snippet->setProperties($properties);
            $modx->log(modX::LOG_LEVEL_INFO, 'Properties for '.$snippet_name.' snippet were added.');
            flush();
        }

        $snippets[] = $snippet;
    }
}

unset($properties, $snippet, $path, $snippet_name, $content, $list);

return $snippets;
