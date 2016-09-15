<?php

$csp_headers = array(
    "Content-Security-Policy:default-src 'self' mc.yandex.ru www.google-analytics.com; script-src 'self' *.calltouch.ru www.google-analytics.com panel.piwik.dev.modx.site ssl.google-analytics.com connect.facebook.net ajax.googleapis.com mc.yandex.ru 'unsafe-inline' 'unsafe-eval'; img-src 'self' data: ssl.google-analytics.com mc.yandex.ru bs.yandex.ru panel.piwik.dev.modx.site www.google-analytics.com www.gravatar.com www.gravatar.com; style-src 'self' maxcdn.bootstrapcdn.com fonts.googleapis.com ajax.googleapis.com 'unsafe-inline'; font-src 'self' maxcdn.bootstrapcdn.com  fonts.googleapis.com fonts.gstatic.com ajax.googleapis.com themes.googleusercontent.com data: fonts.gstatic.com; child-src awaps.yandex.ru; connect-src 'self' mc.yandex.ru; frame-ancestors 'none'; sandbox allow-popups allow-top-navigation allow-forms allow-pointer-lock allow-scripts document.domain allow-modals allow-orientation-lock allow-presentation;",
    "Access-Control-Allow-Origin: *;",
    "Access-Control-Allow-Methods: POST, GET, OPTIONS;",
    "Access-Control-Allow-Headers: X-PINGOTHER, Content-Type;"
);

$html_content_type_update = function($heades) use (& $modx){

    $contentType = $modx->getObject('ContentType', array('file_extensions:LIKE' => '%.html%'));

    if(!$contentType){
        $modx->log(1, 'Can\'t find a .html content type');
        return false;
    }

    $contentType->set('headers', serialize($csp_headers));
    if(!$contentType->save()){
        $modx->log(1, 'Can\'t update .html content type headers');
        return false;
    }

};

return true;
